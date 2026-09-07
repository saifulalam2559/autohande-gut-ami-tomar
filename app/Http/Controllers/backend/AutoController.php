<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Auto;
use App\Models\BodyType;
use App\Models\Brand;
use App\Models\Color;
use App\Models\EmissionClass;
use App\Models\Feature;
use App\Models\FeatureCategory;
use App\Models\FuelType;
use App\Models\Transmission;
use App\Models\VehicleCondition;
use App\Models\VehicleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AutoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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

        $brandId = $request->input('brand_id');
        $modelId = $request->input('vehicle_model_id');
        $bodyTypeId = $request->input('body_type_id');
        $fuelTypeId = $request->input('fuel_type_id');
        $transmissionId = $request->input('transmission_id');
        $conditionId = $request->input('condition_id');
        $emissionClassId = $request->input('emission_class_id');

        $status = $request->input('status');
        $visibility = $request->input('visibility');
        $featured = $request->input('featured');

        $priceMin = $request->input('price_min');
        $priceMax = $request->input('price_max');

        /*
        |--------------------------------------------------------------------------
        | Allowed Sorting
        |--------------------------------------------------------------------------
        */

        $allowedSorts = [
            'id',
            'stock_number',
            'price',
            'mileage',
            'first_registration',
            'status',
            'is_visible',
            'is_featured',
            'published_at',
            'created_at',
        ];

        $sort = $request->input(
            'sort',
            'id'
        );

        if (!in_array($sort, $allowedSorts, true)) {
            $sort = 'id';
        }

        $direction = strtolower(
            $request->input(
                'direction',
                'desc'
            )
        );

        if (!in_array(
            $direction,
            ['asc', 'desc'],
            true
        )) {
            $direction = 'desc';
        }

        /*
        |--------------------------------------------------------------------------
        | Autos Query
        |--------------------------------------------------------------------------
        */

        $autos = Auto::query()
            ->with([
                'brand',
                'model',
                'bodyType',
                'fuelType',
                'transmission',
                'condition',
                'primaryImage',
            ])
            ->withCount([
                'images',
                'features',
            ])
            ->search($search)

            ->when(
                $brandId,
                function ($query) use ($brandId) {
                    $query->where(
                        'brand_id',
                        $brandId
                    );
                }
            )

            ->when(
                $modelId,
                function ($query) use ($modelId) {
                    $query->where(
                        'vehicle_model_id',
                        $modelId
                    );
                }
            )

            ->when(
                $bodyTypeId,
                function ($query) use ($bodyTypeId) {
                    $query->where(
                        'body_type_id',
                        $bodyTypeId
                    );
                }
            )

            ->when(
                $fuelTypeId,
                function ($query) use ($fuelTypeId) {
                    $query->where(
                        'fuel_type_id',
                        $fuelTypeId
                    );
                }
            )

            ->when(
                $transmissionId,
                function ($query) use ($transmissionId) {
                    $query->where(
                        'transmission_id',
                        $transmissionId
                    );
                }
            )

            ->when(
                $conditionId,
                function ($query) use ($conditionId) {
                    $query->where(
                        'condition_id',
                        $conditionId
                    );
                }
            )

            ->when(
                $emissionClassId,
                function ($query) use ($emissionClassId) {
                    $query->where(
                        'emission_class_id',
                        $emissionClassId
                    );
                }
            )

            ->status($status)
            ->visibility($visibility)
            ->featured($featured)

            ->when(
                $priceMin !== null
                    && $priceMin !== '',
                function ($query) use ($priceMin) {
                    $query->where(
                        'price',
                        '>=',
                        $priceMin
                    );
                }
            )

            ->when(
                $priceMax !== null
                    && $priceMax !== '',
                function ($query) use ($priceMax) {
                    $query->where(
                        'price',
                        '<=',
                        $priceMax
                    );
                }
            )

            ->orderBy(
                $sort,
                $direction
            )

            ->orderByDesc('id')

            ->paginate(5)

            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Filter Data
        |--------------------------------------------------------------------------
        */

        $brands = Brand::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $models = VehicleModel::query()
            ->with('brand')
            ->where('is_active', true)
            ->orderBy('brand_id')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $bodyTypes = BodyType::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $fuelTypes = FuelType::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $transmissions = Transmission::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $conditions = VehicleCondition::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $emissionClasses = EmissionClass::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view(
            'backend.admin.auto.index',
            compact(
                'autos',
                'brands',
                'models',
                'bodyTypes',
                'fuelTypes',
                'transmissions',
                'conditions',
                'emissionClasses',
                'search',
                'brandId',
                'modelId',
                'bodyTypeId',
                'fuelTypeId',
                'transmissionId',
                'conditionId',
                'emissionClassId',
                'status',
                'visibility',
                'featured',
                'priceMin',
                'priceMax',
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

    public function create()
    {
        $lookups = $this->getFormData();

        return view(
            'backend.admin.auto.create',
            $lookups
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        
        $uploadError = $this->handleUploadError($request);

        if ($uploadError) {
            return $uploadError;
        }


        $validated = $this->validateAuto(
            $request
        );

        /*
        |--------------------------------------------------------------------------
        | Slug
        |--------------------------------------------------------------------------
        */

        $validated['slug'] =
            $this->makeUniqueSlug(
                $request->input('title'),
              
            );

        /*
        |--------------------------------------------------------------------------
        | Status Logic
        |--------------------------------------------------------------------------
        */

        $status = $request->input(
            'status',
            'draft'
        );

        $validated['status'] = $status;

        /*
        |--------------------------------------------------------------------------
        | Visibility
        |--------------------------------------------------------------------------
        */

        if (
            in_array(
                $status,
                ['draft', 'inactive'],
                true
            )
        ) {
            $validated['is_visible'] = false;
        } else {
            $validated['is_visible'] =
                $request->boolean(
                    'is_visible'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Featured
        |--------------------------------------------------------------------------
        */

        $validated['is_featured'] =
            $request->boolean(
                'is_featured'
            );

        /*
        |--------------------------------------------------------------------------
        | Published / Sold Timestamps
        |--------------------------------------------------------------------------
        */

        if ($status === 'published') {

            $validated['published_at'] = now();
            $validated['sold_at'] = null;

        } elseif ($status === 'sold') {

            $validated['sold_at'] = now();

            $validated['published_at'] =
                $request->input(
                    'published_at'
                ) ?: null;

        } else {

            $validated['published_at'] = null;
            $validated['sold_at'] = null;
        }

        /*
        |--------------------------------------------------------------------------
        | Create Auto
        |--------------------------------------------------------------------------
        */

        $auto = Auto::create(
            $validated
        );

        /*
        |--------------------------------------------------------------------------
        | Features
        |--------------------------------------------------------------------------
        */

        $features = $this->validFeatureIds(
            $request->input(
                'features',
                []
            )
        );

        $auto->features()->sync(
            $features
        );

        /*
        |--------------------------------------------------------------------------
        | Images
        |--------------------------------------------------------------------------
        */

        $this->storeImages(
            $request,
            $auto
        );

        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('auto.index')
            ->with(
                'success',
                'Auto post has been created successfully.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(Auto $auto)
    {
        $auto->load([
            'brand',
            'model',
            'bodyType',
            'fuelType',
            'transmission',
            'color',
            'condition',
            'emissionClass',
            'images',
            'primaryImage',
            'features.category',
        ]);

        return view(
            'backend.admin.auto.show',
            compact('auto')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(Auto $auto)
    {
        $lookups = $this->getFormData();

        /*
        |--------------------------------------------------------------------------
        | Load Features + Images
        |--------------------------------------------------------------------------
        */

        $auto->load([
            'features',
            'images',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Selected Features
        |--------------------------------------------------------------------------
        */

        $selectedFeatures = $auto
            ->features
            ->pluck('id')
            ->toArray();

        return view(
            'backend.admin.auto.edit',
            array_merge(
                $lookups,
                compact(
                    'auto',
                    'selectedFeatures'
                )
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
    Auto $auto
) {

    /*
    |--------------------------------------------------------------------------
    | Upload Error
    |--------------------------------------------------------------------------
    */

    $uploadError = $this->handleUploadError($request);

    if ($uploadError) {
        return $uploadError;
    }

    /*
    |--------------------------------------------------------------------------
    | Validate
    |--------------------------------------------------------------------------
    */

    $validated = $this->validateAuto(
        $request,
        $auto->id
    );

    /*
    |--------------------------------------------------------------------------
    | Slug
    |--------------------------------------------------------------------------
    */

        $validated['slug'] =
            $this->makeUniqueSlug(
                $request->input('title')
            );
    /*
    |--------------------------------------------------------------------------
    | Status
    |--------------------------------------------------------------------------
    */

    $status = $request->input(
        'status',
        'draft'
    );

    $validated['status'] = $status;

    /*
    |--------------------------------------------------------------------------
    | Visibility
    |--------------------------------------------------------------------------
    | Yes = true / 1
    | No  = false / 0
    |
    | Public visibility is controlled directly
    | by the Yes/No dropdown.
    |--------------------------------------------------------------------------
    */

    $validated['is_visible'] =
        $request->boolean('is_visible');

    /*
    |--------------------------------------------------------------------------
    | Featured
    |--------------------------------------------------------------------------
    */

    $validated['is_featured'] =
        $request->boolean('is_featured');

    /*
    |--------------------------------------------------------------------------
    | Published / Sold Timestamps
    |--------------------------------------------------------------------------
    */

    if ($status === 'published') {

        $validated['published_at'] =
            $auto->published_at ?: now();

        $validated['sold_at'] = null;

    } elseif ($status === 'sold') {

        $validated['sold_at'] =
            $auto->sold_at ?: now();

        $validated['published_at'] =
            $auto->published_at ?: now();

    } else {

        $validated['sold_at'] = null;
    }

    /*
    |--------------------------------------------------------------------------
    | Update Auto
    |--------------------------------------------------------------------------
    */

    $auto->update(
        $validated
    );

    /*
    |--------------------------------------------------------------------------
    | Features
    |--------------------------------------------------------------------------
    */

    $features = $this->validFeatureIds(
        $request->input(
            'features',
            []
        )
    );

    $auto->features()->sync(
        $features
    );

    /*
    |--------------------------------------------------------------------------
    | Delete Existing Images
    |--------------------------------------------------------------------------
    */

    $this->deleteImages(
        $request,
        $auto
    );

    /*
    |--------------------------------------------------------------------------
    | Add New Images
    |--------------------------------------------------------------------------
    */

    $this->storeNewImages(
        $request,
        $auto
    );

    /*
    |--------------------------------------------------------------------------
    | Update Primary Image
    |--------------------------------------------------------------------------
    */

    $this->updatePrimaryImage(
        $request,
        $auto
    );

    /*
    |--------------------------------------------------------------------------
    | Make Sure A Primary Image Exists
    |--------------------------------------------------------------------------
    */

    $this->ensurePrimaryImage(
        $auto
    );

    /*
    |--------------------------------------------------------------------------
    | Redirect
    |--------------------------------------------------------------------------
    */

    return redirect()
        ->route('auto.index')
        ->with(
            'success',
            'Auto post has been updated successfully.'
        );
}
    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy(Auto $auto)
    {
        /*
        |--------------------------------------------------------------------------
        | Delete Physical Image Files
        |--------------------------------------------------------------------------
        */

        $auto->load('images');

        foreach ($auto->images as $image) {

            $filePath = public_path(
                'autoimages/' .
                $image->image_path
            );

            if (
                !empty($image->image_path)
                && is_file($filePath)
            ) {
                @unlink($filePath);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Delete Auto
        |--------------------------------------------------------------------------
        |
        | If your auto_images table has ON DELETE CASCADE,
        | the image records will be removed automatically.
        |
        */

       $auto->forceDelete();

        return redirect()
            ->route('auto.index')
            ->with(
                'success',
                'Auto post has been deleted successfully.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE IMAGES
    |--------------------------------------------------------------------------
    |
    | Used when creating a new auto.
    |
    */

    private function storeImages(
        Request $request,
        Auto $auto
    ): void {
        if (!$request->hasFile('images')) {
            return;
        }

        foreach (
            $request->file('images')
            as $index => $image
        ) {
            if (!$image->isValid()) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Generate Unique Filename
            |--------------------------------------------------------------------------
            */

            $filename =
                Str::uuid()
                . '.'
                . $image->getClientOriginalExtension();

            /*
            |--------------------------------------------------------------------------
            | Move Image
            |--------------------------------------------------------------------------
            */

            $image->move(
                public_path('autoimages'),
                $filename
            );

            /*
            |--------------------------------------------------------------------------
            | Create Image Record
            |--------------------------------------------------------------------------
            */

            $auto->images()->create([
                'image_path' => $filename,

                'alt_text' =>
                    ($auto->brand->name ?? '')
                    . ' '
                    . ($auto->model->name ?? ''),

                'sort_order' => $index,

                /*
                |--------------------------------------------------------------------------
                | First uploaded image = primary
                |--------------------------------------------------------------------------
                */

                'is_primary' => $index === 0,
            ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | STORE NEW IMAGES
    |--------------------------------------------------------------------------
    |
    | Used when editing an existing auto.
    |
    */

    private function storeNewImages(
        Request $request,
        Auto $auto
    ): void {
        if (!$request->hasFile('images')) {
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Get Current Maximum Sort Order
        |--------------------------------------------------------------------------
        */

        $currentMaxOrder = (int) (
            $auto->images()
                ->max('sort_order') ?? -1
        );

        /*
        |--------------------------------------------------------------------------
        | Check Existing Primary
        |--------------------------------------------------------------------------
        */

        $hasPrimary = $auto->images()
            ->where(
                'is_primary',
                true
            )
            ->exists();

        foreach (
            $request->file('images')
            as $index => $image
        ) {
            if (!$image->isValid()) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Generate Unique Filename
            |--------------------------------------------------------------------------
            */

            $filename =
                Str::uuid()
                . '.'
                . $image->getClientOriginalExtension();

            /*
            |--------------------------------------------------------------------------
            | Move Image
            |--------------------------------------------------------------------------
            */

            $image->move(
                public_path('autoimages'),
                $filename
            );

            /*
            |--------------------------------------------------------------------------
            | Primary Logic
            |--------------------------------------------------------------------------
            |
            | If there is no primary image, the first newly uploaded
            | image becomes primary.
            |
            */

            $isPrimary =
                !$hasPrimary
                && $index === 0;

            /*
            |--------------------------------------------------------------------------
            | Create Image
            |--------------------------------------------------------------------------
            */

            $auto->images()->create([
                'image_path' => $filename,

                'alt_text' =>
                    ($auto->brand->name ?? '')
                    . ' '
                    . ($auto->model->name ?? ''),

                'sort_order' =>
                    $currentMaxOrder
                    + $index
                    + 1,

                'is_primary' => $isPrimary,
            ]);

            if ($isPrimary) {
                $hasPrimary = true;
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE IMAGES
    |--------------------------------------------------------------------------
    |
    | Deletes both the database record and physical image file.
    |
    */

    private function deleteImages(
        Request $request,
        Auto $auto
    ): void {
        $imageIds = $request->input(
            'delete_images',
            []
        );

        if (empty($imageIds)) {
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Only images belonging to this auto can be deleted
        |--------------------------------------------------------------------------
        */

        $images = $auto->images()
            ->whereIn(
                'id',
                $imageIds
            )
            ->get();

        foreach ($images as $image) {

            /*
            |--------------------------------------------------------------------------
            | Delete Physical File
            |--------------------------------------------------------------------------
            */

            $filePath = public_path(
                'autoimages/' .
                $image->image_path
            );

            if (
                !empty($image->image_path)
                && is_file($filePath)
            ) {
                @unlink($filePath);
            }

            /*
            |--------------------------------------------------------------------------
            | Delete Database Record
            |--------------------------------------------------------------------------
            */

            $image->delete();
        }
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE PRIMARY IMAGE
    |--------------------------------------------------------------------------
    */

    private function updatePrimaryImage(
        Request $request,
        Auto $auto
    ): void {
        $primaryImageId =
            $request->input(
                'primary_image'
            );

        /*
        |--------------------------------------------------------------------------
        | No Primary Selection
        |--------------------------------------------------------------------------
        |
        | ensurePrimaryImage() will handle this later.
        |
        */

        if (!$primaryImageId) {
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Verify Image Belongs To Auto
        |--------------------------------------------------------------------------
        */

        $primaryImage = $auto->images()
            ->where(
                'id',
                $primaryImageId
            )
            ->first();

        if (!$primaryImage) {
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Remove Primary From All Images
        |--------------------------------------------------------------------------
        */

        $auto->images()->update([
            'is_primary' => false,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Set Selected Image As Primary
        |--------------------------------------------------------------------------
        */

        $primaryImage->update([
            'is_primary' => true,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | ENSURE PRIMARY IMAGE
    |--------------------------------------------------------------------------
    |
    | Guarantees that an auto with images always has one primary image.
    |
    */

    private function ensurePrimaryImage(
        Auto $auto
    ): void {
        /*
        |--------------------------------------------------------------------------
        | Check Existing Primary
        |--------------------------------------------------------------------------
        */

        $primaryExists = $auto->images()
            ->where(
                'is_primary',
                true
            )
            ->exists();

        if ($primaryExists) {
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Find First Remaining Image
        |--------------------------------------------------------------------------
        */

        $firstImage = $auto->images()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->first();

        /*
        |--------------------------------------------------------------------------
        | Make First Image Primary
        |--------------------------------------------------------------------------
        */

        if ($firstImage) {
            $firstImage->update([
                'is_primary' => true,
            ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | FORM DATA
    |--------------------------------------------------------------------------
    */

    private function getFormData(): array
    {
        return [

            /*
            |--------------------------------------------------------------------------
            | Brands
            |--------------------------------------------------------------------------
            */

            'brands' => Brand::query()
                ->where(
                    'is_active',
                    true
                )
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(),

            /*
            |--------------------------------------------------------------------------
            | Vehicle Models
            |--------------------------------------------------------------------------
            */

            'models' => VehicleModel::query()
                ->with('brand')
                ->where(
                    'is_active',
                    true
                )
                ->orderBy('brand_id')
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(),

            /*
            |--------------------------------------------------------------------------
            | Body Types
            |--------------------------------------------------------------------------
            */

            'bodyTypes' => BodyType::query()
                ->where(
                    'is_active',
                    true
                )
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(),

            /*
            |--------------------------------------------------------------------------
            | Fuel Types
            |--------------------------------------------------------------------------
            */

            'fuelTypes' => FuelType::query()
                ->where(
                    'is_active',
                    true
                )
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(),

            /*
            |--------------------------------------------------------------------------
            | Transmissions
            |--------------------------------------------------------------------------
            */

            'transmissions' => Transmission::query()
                ->where(
                    'is_active',
                    true
                )
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(),

            /*
            |--------------------------------------------------------------------------
            | Colors
            |--------------------------------------------------------------------------
            */

            'colors' => Color::query()
                ->where(
                    'is_active',
                    true
                )
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(),

            /*
            |--------------------------------------------------------------------------
            | Conditions
            |--------------------------------------------------------------------------
            */

            'conditions' => VehicleCondition::query()
                ->where(
                    'is_active',
                    true
                )
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(),

            /*
            |--------------------------------------------------------------------------
            | Emission Classes
            |--------------------------------------------------------------------------
            */

            'emissionClasses' =>
                EmissionClass::query()
                    ->where(
                        'is_active',
                        true
                    )
                    ->orderBy('sort_order')
                    ->orderBy('name')
                    ->get(),

            /*
            |--------------------------------------------------------------------------
            | Feature Categories + Features
            |--------------------------------------------------------------------------
            */

            'featureCategories' =>
                FeatureCategory::query()
                    ->with([
                        'features' => function ($query) {
                            $query
                                ->where(
                                    'is_active',
                                    true
                                )
                                ->orderBy(
                                    'sort_order'
                                )
                                ->orderBy(
                                    'name'
                                );
                        },
                    ])
                    ->orderBy('sort_order')
                    ->orderBy('name')
                    ->get(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDATE AUTO
    |--------------------------------------------------------------------------
    */

    private function validateAuto(
        Request $request,
        ?int $autoId = null
    ): array {
        return $request->validate([
            
            
            'title' => [
            'nullable',
            'string',
            'max:255',
            ],

            'meta_title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'meta_description' => [
                'nullable',
                'string',
                'max:160',
            ],

            /*
            |--------------------------------------------------------------------------
            | Brand / Model
            |--------------------------------------------------------------------------
            */

            'brand_id' => [
                'required',
                'integer',
                'exists:brands,id',
            ],

            'vehicle_model_id' => [
                'required',
                'integer',
                'exists:vehicle_models,id',
            ],

            /*
            |--------------------------------------------------------------------------
            | Vehicle Classification
            |--------------------------------------------------------------------------
            */

            'body_type_id' => [
                'nullable',
                'integer',
                'exists:body_types,id',
            ],

            'fuel_type_id' => [
                'nullable',
                'integer',
                'exists:fuel_types,id',
            ],

            'transmission_id' => [
                'nullable',
                'integer',
                'exists:transmissions,id',
            ],

            'color_id' => [
                'nullable',
                'integer',
                'exists:colors,id',
            ],

            'condition_id' => [
                'nullable',
                'integer',
                'exists:vehicle_conditions,id',
            ],

            'emission_class_id' => [
                'nullable',
                'integer',
                'exists:emission_classes,id',
            ],

            /*
            |--------------------------------------------------------------------------
            | Basic Information
            |--------------------------------------------------------------------------
            */

            'stock_number' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique(
                    'autos',
                    'stock_number'
                )->ignore($autoId),
            ],

            'variant' => [
                'nullable',
                'string',
                'max:255',
            ],

            'vin' => [
                'nullable',
                'string',
                'size:17',
                Rule::unique(
                    'autos',
                    'vin'
                )->ignore($autoId),
            ],

            /*
            |--------------------------------------------------------------------------
            | Pricing
            |--------------------------------------------------------------------------
            */

            'price' => [
                'required',
                'numeric',
                'min:0',
                'max:9999999999.99',
            ],

            'currency' => [
                'required',
                'string',
                'size:3',
            ],

            /*
            |--------------------------------------------------------------------------
            | Mileage
            |--------------------------------------------------------------------------
            */

            'mileage' => [
                'required',
                'integer',
                'min:0',
            ],

            'mileage_unit' => [
                'required',
                'string',
                'max:10',
            ],

            /*
            |--------------------------------------------------------------------------
            | Registration
            |--------------------------------------------------------------------------
            */

            'first_registration' => [
                'nullable',
                'date',
            ],

            /*
            |--------------------------------------------------------------------------
            | Engine
            |--------------------------------------------------------------------------
            */

            'engine_cc' => [
                'nullable',
                'integer',
                'min:0',
                'max:65535',
            ],

            'engine_size' => [
                'nullable',
                'string',
                'max:255',
            ],

            'power_hp' => [
                'nullable',
                'integer',
                'min:0',
                'max:65535',
            ],

            'power_kw' => [
                'nullable',
                'integer',
                'min:0',
                'max:65535',
            ],

            'gears' => [
                'nullable',
                'integer',
                'min:0',
                'max:255',
            ],

            'drivetrain' => [
                'nullable',
                'string',
                'max:255',
            ],

            /*
            |--------------------------------------------------------------------------
            | Emissions
            |--------------------------------------------------------------------------
            */

            'co2_emissions' => [
                'nullable',
                'integer',
                'min:0',
                'max:65535',
            ],

            /*
            |--------------------------------------------------------------------------
            | Inspection
            |--------------------------------------------------------------------------
            */

            'inspection_date' => [
                'nullable',
                'date',
            ],

            /*
            |--------------------------------------------------------------------------
            | Interior / Capacity
            |--------------------------------------------------------------------------
            */

            'doors' => [
                'nullable',
                'integer',
                'min:1',
                'max:20',
            ],

            'seats' => [
                'nullable',
                'integer',
                'min:1',
                'max:50',
            ],

            'interior_color' => [
                'nullable',
                'string',
                'max:255',
            ],

            /*
            |--------------------------------------------------------------------------
            | Ownership / Condition
            |--------------------------------------------------------------------------
            */

            'previous_owners' => [
                'nullable',
                'integer',
                'min:0',
                'max:255',
            ],

            'accident_free' => [
                'nullable',
                'boolean',
            ],

            'vat_deductible' => [
                'nullable',
                'boolean',
            ],

            /*
            |--------------------------------------------------------------------------
            | Description
            |--------------------------------------------------------------------------
            */

            'description' => [
                'nullable',
                'string',
            ],



            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            'status' => [
                'required',
                Rule::in([
                    'draft',
                    'published',
                    'inactive',
                    'sold',
                ]),
            ],

            /*
            |--------------------------------------------------------------------------
            | Visibility
            |--------------------------------------------------------------------------
            */

            'is_visible' => [
                'nullable',
                'boolean',
            ],

            /*
            |--------------------------------------------------------------------------
            | Featured
            |--------------------------------------------------------------------------
            */

            'is_featured' => [
                'nullable',
                'boolean',
            ],

            /*
            |--------------------------------------------------------------------------
            | Features
            |--------------------------------------------------------------------------
            */

            'features' => [
                'nullable',
                'array',
            ],

            'features.*' => [
                'integer',
                'exists:features,id',
            ],

            /*
            |--------------------------------------------------------------------------
            | NEW IMAGES
            |--------------------------------------------------------------------------
            */

            'images' => [
                'nullable',
                'array',
                'max:30',
            ],

            'images.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            /*
            |--------------------------------------------------------------------------
            | DELETE EXISTING IMAGES
            |--------------------------------------------------------------------------
            */

            'delete_images' => [
                'nullable',
                'array',
            ],

            'delete_images.*' => [
                'integer',
                'exists:auto_images,id',
            ],

            /*
            |--------------------------------------------------------------------------
            | PRIMARY IMAGE
            |--------------------------------------------------------------------------
            */

            'primary_image' => [
                'nullable',
                'integer',
                'exists:auto_images,id',
            ],
        ]);
    }

 
    
    /*
|--------------------------------------------------------------------------
| MAKE UNIQUE SLUG
|--------------------------------------------------------------------------
*/

private function makeUniqueSlug(
    ?string $title,
    ?int $ignoreId = null
): string {
    /*
    |--------------------------------------------------------------------------
    | Generate Slug From Title
    |--------------------------------------------------------------------------
    */

    $slug = Str::slug(
        trim($title ?? '')
    );

    /*
    |--------------------------------------------------------------------------
    | Fallback
    |--------------------------------------------------------------------------
    */

    if (blank($slug)) {
        $slug = 'vehicle';
    }

    /*
    |--------------------------------------------------------------------------
    | Make Unique
    |--------------------------------------------------------------------------
    */

    $originalSlug = $slug;
    $counter = 1;

    while (
        Auto::query()
            ->where('slug', $slug)
            ->when(
                $ignoreId,
                function ($query) use ($ignoreId) {
                    $query->where(
                        'id',
                        '!=',
                        $ignoreId
                    );
                }
            )
            ->exists()
    ) {
        $slug =
            $originalSlug
            . '-'
            . $counter;

        $counter++;
    }

    return $slug;
}


    /*
    |--------------------------------------------------------------------------
    | VALID FEATURE IDS
    |--------------------------------------------------------------------------
    */

    private function validFeatureIds(
        array $featureIds
    ): array {
        return Feature::query()
            ->whereIn(
                'id',
                $featureIds
            )
            ->where(
                'is_active',
                true
            )
            ->pluck('id')
            ->toArray();
    }
    
    
        private function handleUploadError(Request $request)
    {
        if (
            $request->has('images') === false
            && $request->server('CONTENT_LENGTH')
            && (int) $request->server('CONTENT_LENGTH')
                > $this->getPostMaxSize()
        ) {
            return back()
                ->withInput()
                ->with('error', 'The uploaded images are too large. Please select smaller images and try again.');
        }

        return null;
    }

    private function getPostMaxSize(): int
    {
        $value = ini_get('post_max_size');

        $unit = strtolower(
            substr($value, -1)
        );

        $number = (int) $value;

        return match ($unit) {
            'g' => $number * 1024 * 1024 * 1024,
            'm' => $number * 1024 * 1024,
            'k' => $number * 1024,
            default => $number,
        };
    }
    
    
}