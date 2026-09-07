<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Auto;
use App\Models\AutoImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AutoImageController extends Controller
{
    /**
     * Physical image storage path.
     */
    private string $storagePath;

    public function __construct()
    {
        $this->middleware('auth');

        $this->storagePath = public_path('autoimages/');
    }


    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $search = trim(
            $request->input('search', '')
        );

        $autoId = $request->input('auto_id');

        $primary = $request->input('primary');

        $allowedSorts = [
            'id',
            'auto_id',
            'sort_order',
            'is_primary',
            'created_at',
        ];

        $sort = $request->input(
            'sort',
            'sort_order'
        );

        if (!in_array($sort, $allowedSorts, true)) {
            $sort = 'sort_order';
        }

        $direction = strtolower(
            $request->input(
                'direction',
                'asc'
            )
        );

        if (!in_array($direction, ['asc', 'desc'], true)) {
            $direction = 'asc';
        }

        $images = AutoImage::query()
            ->with([
                'auto.brand',
                'auto.model',
            ])
            ->search($search)
            ->when(
                $autoId,
                function ($query) use ($autoId) {
                    $query->where(
                        'auto_id',
                        $autoId
                    );
                }
            )
            ->primary($primary)
            ->orderBy(
                $sort,
                $direction
            )
            ->orderByDesc('id')
            ->paginate(15)
            ->withQueryString();

        $autos = Auto::query()
            ->with([
                'brand',
                'model',
            ])
            ->withCount('images')
            ->orderByDesc('id')
            ->get();

        return view(
            'backend.admin.autoimage.index',
            compact(
                'images',
                'autos',
                'search',
                'autoId',
                'primary',
                'sort',
                'direction'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create(Request $request)
    {
        $autos = Auto::query()
            ->with([
                'brand',
                'model',
            ])
            ->withCount('images')
            ->orderByDesc('id')
            ->get();

        $selectedAutoId = $request->input(
            'auto_id'
        );

        return view(
            'backend.admin.autoimage.create',
            compact(
                'autos',
                'selectedAutoId'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE ONE IMAGE
    |--------------------------------------------------------------------------
    |
    | The frontend uploader can select many files, but sends each
    | image separately to this method.
    |
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate(
            [
                'auto_id' => [
                    'required',
                    'integer',
                    'exists:autos,id',
                ],

                'image' => [
                    'required',
                    'file',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:5120',
                ],

                'alt_text' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'sort_order' => [
                    'nullable',
                    'integer',
                    'min:0',
                    'max:255',
                ],

                'is_primary' => [
                    'nullable',
                    'boolean',
                ],
            ],
            [
                'auto_id.required' =>
                    'Please select a vehicle.',

                'auto_id.exists' =>
                    'The selected vehicle does not exist.',

                'image.required' =>
                    'Please select an image.',

                'image.uploaded' =>
                    'The image failed to upload. Please check the image size.',

                'image.image' =>
                    'The selected file is not a valid image.',

                'image.mimes' =>
                    'Only JPG, JPEG, PNG and WEBP images are allowed.',

                'image.max' =>
                    'The image may not be larger than 5 MB.',

                'alt_text.max' =>
                    'The image alt text may not exceed 255 characters.',
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Vehicle
        |--------------------------------------------------------------------------
        */

        $auto = Auto::findOrFail(
            $validated['auto_id']
        );


        /*
        |--------------------------------------------------------------------------
        | Maximum 15 Images
        |--------------------------------------------------------------------------
        */

        $imageCount =
            $auto->images()->count();


        if ($imageCount >= 15) {

            if ($request->expectsJson()) {

                return response()->json([
                    'success' => false,
                    'message' =>
                        'This vehicle already has the maximum of 15 images.',
                ], 422);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'This vehicle already has the maximum of 15 images.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Uploaded File
        |--------------------------------------------------------------------------
        */

        $file =
            $request->file('image');


        if (!$file || !$file->isValid()) {

            $message =
                $file
                    ? 'The uploaded image failed: ' .
                        $file->getErrorMessage()
                    : 'No image file was received.';


            if ($request->expectsJson()) {

                return response()->json([
                    'success' => false,
                    'message' => $message,
                ], 422);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    $message
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Create Storage Folder
        |--------------------------------------------------------------------------
        */

        if (!File::exists(
            $this->storagePath
        )) {

            File::makeDirectory(
                $this->storagePath,
                0755,
                true
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Generate Unique Filename
        |--------------------------------------------------------------------------
        */

        $extension =
            strtolower(
                $file->getClientOriginalExtension()
            );


        $filename =
            Str::uuid()->toString()
            . '.'
            . $extension;


        $fullPath =
            $this->storagePath
            . $filename;


        /*
        |--------------------------------------------------------------------------
        | Move Uploaded Image
        |--------------------------------------------------------------------------
        */

        try {

            $file->move(
                $this->storagePath,
                $filename
            );

        } catch (\Throwable $e) {

            report($e);


            if ($request->expectsJson()) {

                return response()->json([
                    'success' => false,
                    'message' =>
                        'The image could not be saved to the autoimages folder.',
                ], 500);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'The image could not be saved to the autoimages folder.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Verify Physical File
        |--------------------------------------------------------------------------
        */

        if (!File::exists(
            $fullPath
        )) {

            if ($request->expectsJson()) {

                return response()->json([
                    'success' => false,
                    'message' =>
                        'The uploaded image could not be found after saving.',
                ], 500);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'The uploaded image could not be found after saving.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Primary Image
        |--------------------------------------------------------------------------
        |
        | If this is the first image, it automatically becomes primary.
        |
        |--------------------------------------------------------------------------
        */

        $isFirstImage =
            $imageCount === 0;


        $isPrimary =
            $isFirstImage
                ? true
                : $request->boolean(
                    'is_primary'
                );


        /*
        |--------------------------------------------------------------------------
        | If This Image Is Primary
        |--------------------------------------------------------------------------
        */

        if ($isPrimary) {

            $auto->images()
                ->where(
                    'is_primary',
                    true
                )
                ->update([
                    'is_primary' => false,
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Save Database Record
        |--------------------------------------------------------------------------
        */

        try {

            $autoImage =
                AutoImage::create([
                    'auto_id' =>
                        $auto->id,

                    'image_path' =>
                        $filename,

                    'alt_text' =>
                        $validated['alt_text']
                        ?? null,

                    'sort_order' =>
                        $validated['sort_order']
                        ?? 0,

                    'is_primary' =>
                        $isPrimary,
                ]);

        } catch (\Throwable $e) {

            /*
            |--------------------------------------------------------------------------
            | Roll Back Physical File
            |--------------------------------------------------------------------------
            */

            if (File::exists(
                $fullPath
            )) {

                File::delete(
                    $fullPath
                );
            }


            report($e);


            if ($request->expectsJson()) {

                return response()->json([
                    'success' => false,
                    'message' =>
                        'The image file was uploaded, but its database record could not be created.',
                ], 500);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'The image database record could not be created.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | JSON Response For Multi-Upload
        |--------------------------------------------------------------------------
        */

        if ($request->expectsJson()) {

            return response()->json([
                'success' => true,

                'message' =>
                    'Image uploaded successfully.',

                'image' => [
                    'id' =>
                        $autoImage->id,

                    'filename' =>
                        $autoImage->image_path,

                    'url' =>
                        asset(
                            'autoimages/' .
                            $autoImage->image_path
                        ),

                    'is_primary' =>
                        $autoImage->is_primary,

                    'sort_order' =>
                        $autoImage->sort_order,
                ],
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Normal Browser Submission
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'autobilder.index',
                [
                    'auto_id' => $auto->id,
                ]
            )
            ->with(
                'success',
                'Vehicle image has been uploaded successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(
        AutoImage $autobilder
    ) {
        $autobilder->load([
            'auto.brand',
            'auto.model',
        ]);

        return view(
            'backend.admin.autoimage.show',
            compact(
                'autobilder'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(
        AutoImage $autobilder
    ) {
        $autobilder->load([
            'auto.brand',
            'auto.model',
        ]);

        $autos = Auto::query()
            ->with([
                'brand',
                'model',
            ])
            ->withCount('images')
            ->orderByDesc('id')
            ->get();

        return view(
            'backend.admin.autoimage.edit',
            compact(
                'autobilder',
                'autos'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        AutoImage $autobilder
    ) {
        $validated = $request->validate(
            [
                'auto_id' => [
                    'required',
                    'integer',
                    'exists:autos,id',
                ],

                'image' => [
                    'nullable',
                    'file',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:5120',
                ],

                'alt_text' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'sort_order' => [
                    'nullable',
                    'integer',
                    'min:0',
                    'max:255',
                ],

                'is_primary' => [
                    'nullable',
                    'boolean',
                ],
            ],
            [
                'image.uploaded' =>
                    'The replacement image failed to upload. Please check the file size.',

                'image.image' =>
                    'The replacement file must be a valid image.',

                'image.mimes' =>
                    'Only JPG, JPEG, PNG and WEBP images are allowed.',

                'image.max' =>
                    'The replacement image may not be larger than 5 MB.',
            ]
        );


        $oldAutoId =
            $autobilder->auto_id;


        $newAuto =
            Auto::findOrFail(
                $validated['auto_id']
            );


        /*
        |--------------------------------------------------------------------------
        | Maximum Images When Moving
        |--------------------------------------------------------------------------
        */

        if (
            $oldAutoId !=
            $newAuto->id
        ) {

            $newAutoImageCount =
                $newAuto
                    ->images()
                    ->count();


            if (
                $newAutoImageCount >= 15
            ) {

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'The selected vehicle already has the maximum of 15 images.'
                    );
            }
        }


        $isPrimary =
            $request->boolean(
                'is_primary'
            );


        $oldFilePath =
            $this->storagePath
            . $autobilder->image_path;


        $newFilePath = null;


        /*
        |--------------------------------------------------------------------------
        | Replace Existing Physical Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            $file =
                $request->file('image');


            if (!$file->isValid()) {

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'The replacement image failed: ' .
                        $file->getErrorMessage()
                    );
            }


            if (!File::exists(
                $this->storagePath
            )) {

                File::makeDirectory(
                    $this->storagePath,
                    0755,
                    true
                );
            }


            $newFilename =
                Str::uuid()->toString()
                . '.'
                . strtolower(
                    $file->getClientOriginalExtension()
                );


            $newFilePath =
                $this->storagePath
                . $newFilename;


            try {

                $file->move(
                    $this->storagePath,
                    $newFilename
                );

            } catch (\Throwable $e) {

                report($e);

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'The replacement image could not be saved.'
                    );
            }


            $autobilder->image_path =
                $newFilename;
        }


        /*
        |--------------------------------------------------------------------------
        | Move Image To Another Vehicle
        |--------------------------------------------------------------------------
        */

        if (
            $oldAutoId !=
            $newAuto->id
        ) {

            /*
            |--------------------------------------------------------------------------
            | Replace Primary On Old Vehicle
            |--------------------------------------------------------------------------
            */

            if (
                $autobilder->is_primary
            ) {

                $replacementPrimary =
                    AutoImage::query()
                        ->where(
                            'auto_id',
                            $oldAutoId
                        )
                        ->where(
                            'id',
                            '!=',
                            $autobilder->id
                        )
                        ->orderBy(
                            'sort_order'
                        )
                        ->orderBy('id')
                        ->first();


                if ($replacementPrimary) {

                    $replacementPrimary->update([
                        'is_primary' => true,
                    ]);
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Check New Vehicle Images
            |--------------------------------------------------------------------------
            */

            $newVehicleImageCount =
                $newAuto
                    ->images()
                    ->where(
                        'id',
                        '!=',
                        $autobilder->id
                    )
                    ->count();


            if (
                $newVehicleImageCount === 0
            ) {

                $isPrimary = true;
            }


            /*
            |--------------------------------------------------------------------------
            | Remove New Vehicle Primary
            |--------------------------------------------------------------------------
            */

            if ($isPrimary) {

                $newAuto->images()
                    ->where(
                        'id',
                        '!=',
                        $autobilder->id
                    )
                    ->where(
                        'is_primary',
                        true
                    )
                    ->update([
                        'is_primary' => false,
                    ]);
            }


            $autobilder->auto_id =
                $newAuto->id;
        }


        /*
        |--------------------------------------------------------------------------
        | Primary Image
        |--------------------------------------------------------------------------
        */

        if ($isPrimary) {

            $newAuto->images()
                ->where(
                    'id',
                    '!=',
                    $autobilder->id
                )
                ->where(
                    'is_primary',
                    true
                )
                ->update([
                    'is_primary' => false,
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Update Record
        |--------------------------------------------------------------------------
        */

        $autobilder->alt_text =
            $validated['alt_text']
            ?? null;


        $autobilder->sort_order =
            $validated['sort_order']
            ?? 0;


        $autobilder->is_primary =
            $isPrimary;


        try {

            $autobilder->save();

        } catch (\Throwable $e) {

            if (
                $newFilePath &&
                File::exists(
                    $newFilePath
                )
            ) {

                File::delete(
                    $newFilePath
                );
            }

            report($e);

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'The image could not be updated.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Delete Old Physical File
        |--------------------------------------------------------------------------
        */

        if (
            $newFilePath &&
            $newFilePath != $oldFilePath &&
            File::exists($oldFilePath)
        ) {

            File::delete(
                $oldFilePath
            );
        }


        return redirect()
            ->route(
                'autobilder.index'
            )
            ->with(
                'success',
                'Vehicle image has been updated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy(
        AutoImage $autobilder
    ) {
        $autoId =
            $autobilder->auto_id;


        $wasPrimary =
            $autobilder->is_primary;


        /*
        |--------------------------------------------------------------------------
        | Delete Physical File
        |--------------------------------------------------------------------------
        */

        $filePath =
            $this->storagePath
            . $autobilder->image_path;


        if (
            !empty($autobilder->image_path)
            && File::exists($filePath)
        ) {

            File::delete(
                $filePath
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Delete Database
        |--------------------------------------------------------------------------
        */

        $autobilder->delete();


        /*
        |--------------------------------------------------------------------------
        | Promote Replacement Primary
        |--------------------------------------------------------------------------
        */

        if ($wasPrimary) {

            $replacementPrimary =
                AutoImage::query()
                    ->where(
                        'auto_id',
                        $autoId
                    )
                    ->orderBy(
                        'sort_order'
                    )
                    ->orderBy('id')
                    ->first();


            if ($replacementPrimary) {

                $replacementPrimary->update([
                    'is_primary' => true,
                ]);
            }
        }


        return redirect()
            ->route(
                'autobilder.index'
            )
            ->with(
                'success',
                'Vehicle image has been deleted successfully.'
            );
    }
    
    
}