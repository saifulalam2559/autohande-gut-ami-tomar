<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\FuelType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class FuelTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of fuel types.
     */
    public function index(Request $request): View
    {
        $search = trim((string) $request->input('search'));
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

        $fuelTypes = FuelType::query()
            ->withCount('autos')
            ->search($search)
            ->status($status)
            ->orderBy($sort, $direction)
            ->orderBy('id', 'desc')
            ->paginate(15)
            ->withQueryString();

        return view(
            'backend.admin.fueltype.index',
            compact(
                'fuelTypes',
                'search',
                'status',
                'sort',
                'direction'
            )
        );
    }

    /**
     * Show the form for creating a new fuel type.
     */
    public function create(): View
    {
        return view(
            'backend.admin.fueltype.create'
        );
    }

    /**
     * Store a newly created fuel type.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:fuel_types,name',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:fuel_types,slug',
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
         * Make sure the generated slug is unique.
         */
        $originalSlug = $slug;
        $counter = 1;

        while (FuelType::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        FuelType::create([
            'name' => trim($validated['name']),
            'slug' => $slug,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        return redirect()
            ->route('kraftstoffart.index')
            ->with(
                'success',
                'Fuel type created successfully.'
            );
    }

    /**
     * Display the specified fuel type.
     */
    public function show(FuelType $kraftstoffart): View
    {
        $kraftstoffart->loadCount('autos');

        return view(
            'backend.admin.fueltype.show',
            compact('kraftstoffart')
        );
    }

    /**
     * Show the form for editing the specified fuel type.
     */
    public function edit(FuelType $kraftstoffart): View
    {
        return view(
            'backend.admin.fueltype.edit',
            compact('kraftstoffart')
        );
    }

    /**
     * Update the specified fuel type.
     */
    public function update(
        Request $request,
        FuelType $kraftstoffart
    ): RedirectResponse {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('fuel_types', 'name')
                    ->ignore($kraftstoffart->id),
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('fuel_types', 'slug')
                    ->ignore($kraftstoffart->id),
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
         * excluding the current fuel type.
         */
        $originalSlug = $slug;
        $counter = 1;

        while (
            FuelType::where('slug', $slug)
                ->where('id', '!=', $kraftstoffart->id)
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $kraftstoffart->update([
            'name' => trim($validated['name']),
            'slug' => $slug,
            'is_active' => $request->boolean('is_active', false),
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        return redirect()
            ->route('kraftstoffart.index')
            ->with(
                'success',
                'Fuel type updated successfully.'
            );
    }

    /**
     * Remove the specified fuel type.
     */
    public function destroy(FuelType $kraftstoffart): RedirectResponse
    {
        $autoCount = $kraftstoffart->autos()->count();

        /*
         * Never delete a fuel type that is already
         * being used by vehicles.
         */
        if ($autoCount > 0) {
            return redirect()
                ->route('kraftstoffart.index')
                ->with(
                    'error',
                    'This fuel type cannot be deleted because it '
                    . 'is currently used by '
                    . $autoCount
                    . ' vehicle(s). Please deactivate it instead.'
                );
        }

        $kraftstoffart->delete();

        return redirect()
            ->route('kraftstoffart.index')
            ->with(
                'success',
                'Fuel type deleted successfully.'
            );
    }
    
}