<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\VehicleModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class ModelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of vehicle models.
     */
    public function index(Request $request): View
    {
        $search = trim((string) $request->input('search'));
        $brandId = $request->input('brand_id');
        $status = $request->input('status');

        $allowedSorts = [
            'name',
            'sort_order',
            'created_at',
        ];

        $sort = $request->input('sort', 'sort_order');

        if (! in_array($sort, $allowedSorts, true)) {
            $sort = 'sort_order';
        }

        $direction = $request->input('direction', 'asc');

        if (! in_array($direction, ['asc', 'desc'], true)) {
            $direction = 'asc';
        }

        $models = VehicleModel::query()
            ->with('brand')
            ->withCount('autos')
            ->search($search)
            ->brand($brandId)
            ->status($status)
            ->orderBy($sort, $direction)
            ->orderBy('id', 'desc')
            ->paginate(15)
            ->withQueryString();

        $brands = Brand::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get([
                'id',
                'name',
            ]);

        return view(
            'backend.admin.model.index',
            compact(
                'models',
                'brands',
                'search',
                'brandId',
                'status',
                'sort',
                'direction'
            )
        );
    }

    /**
     * Show the form for creating a new vehicle model.
     */
    public function create(): View
    {
        $brands = Brand::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get([
                'id',
                'name',
            ]);

        return view(
            'backend.admin.model.create',
            compact('brands')
        );
    }

    /**
     * Store a newly created vehicle model.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'brand_id' => [
                'required',
                'integer',
                'exists:brands,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('vehicle_models', 'name')
                    ->where(
                        fn ($query) => $query->where(
                            'brand_id',
                            $request->brand_id
                        )
                    ),
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:vehicle_models,slug',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
                'max:999999',
            ],
        ]);

        $slug = filled($validated['slug'] ?? null)
            ? Str::slug($validated['slug'])
            : Str::slug($validated['name']);

        /*
         * Make sure slug is unique.
         */
        $originalSlug = $slug;
        $counter = 1;

        while (VehicleModel::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        VehicleModel::create([
            'brand_id' => $validated['brand_id'],
            'name' => trim($validated['name']),
            'slug' => $slug,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        return redirect()
            ->route('modell.index')
            ->with(
                'success',
                'Vehicle model created successfully.'
            );
    }

    /**
     * Display the specified vehicle model.
     */
    public function show(VehicleModel $modell): View
    {
        $modell->load('brand');
        $modell->loadCount('autos');

        return view(
            'backend.admin.model.show',
            compact('modell')
        );
    }

    /**
     * Show the form for editing the specified vehicle model.
     */
    public function edit(VehicleModel $modell): View
    {
        $brands = Brand::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get([
                'id',
                'name',
            ]);

        /*
         * Make sure the current brand is available
         * even if it was deactivated.
         */
        if (
            $modell->brand &&
            ! $brands->contains('id', $modell->brand_id)
        ) {
            $brands->prepend(
                $modell->brand
            );
        }

        return view(
            'backend.admin.model.edit',
            compact(
                'modell',
                'brands'
            )
        );
    }

    /**
     * Update the specified vehicle model.
     */
    public function update(
        Request $request,
        VehicleModel $modell
    ): RedirectResponse {
        $validated = $request->validate([
            'brand_id' => [
                'required',
                'integer',
                'exists:brands,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('vehicle_models', 'name')
                    ->ignore($modell->id)
                    ->where(
                        fn ($query) => $query->where(
                            'brand_id',
                            $request->brand_id
                        )
                    ),
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('vehicle_models', 'slug')
                    ->ignore($modell->id),
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
                'max:999999',
            ],
        ]);

        $slug = filled($validated['slug'] ?? null)
            ? Str::slug($validated['slug'])
            : Str::slug($validated['name']);

        /*
         * Make sure generated slug is unique,
         * excluding the current model.
         */
        $originalSlug = $slug;
        $counter = 1;

        while (
            VehicleModel::where('slug', $slug)
                ->where('id', '!=', $modell->id)
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $modell->update([
            'brand_id' => $validated['brand_id'],
            'name' => trim($validated['name']),
            'slug' => $slug,
            'is_active' => $request->boolean('is_active', false),
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        return redirect()
            ->route('modell.index')
            ->with(
                'success',
                'Vehicle model updated successfully.'
            );
    }

    /**
     * Remove the specified vehicle model.
     */
    public function destroy(VehicleModel $modell): RedirectResponse
    {
        $autoCount = $modell->autos()->count();

        /*
         * Do not delete a model that is already used
         * by vehicles.
         */
        if ($autoCount > 0) {
            return redirect()
                ->route('modell.index')
                ->with(
                    'error',
                    'This vehicle model cannot be deleted because '
                    . 'it is currently used by '
                    . $autoCount
                    . ' vehicle(s). Please deactivate it instead.'
                );
        }

        $modell->delete();

        return redirect()
            ->route('modell.index')
            ->with(
                'success',
                'Vehicle model deleted successfully.'
            );
    }
}