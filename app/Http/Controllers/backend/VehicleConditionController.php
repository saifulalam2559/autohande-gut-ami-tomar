<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\VehicleCondition;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class VehicleConditionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of vehicle conditions.
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

        $conditions = VehicleCondition::query()
            ->withCount('autos')
            ->search($search)
            ->status($status)
            ->orderBy($sort, $direction)
            ->orderBy('id', 'desc')
            ->paginate(15)
            ->withQueryString();

        return view(
            'backend.admin.vehiclecondition.index',
            compact(
                'conditions',
                'search',
                'status',
                'sort',
                'direction'
            )
        );
    }

    /**
     * Show the form for creating a new vehicle condition.
     */
    public function create(): View
    {
        return view(
            'backend.admin.vehiclecondition.create'
        );
    }

    /**
     * Store a newly created vehicle condition.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:vehicle_conditions,name',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:vehicle_conditions,slug',
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

        while (VehicleCondition::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        VehicleCondition::create([
            'name' => trim($validated['name']),
            'slug' => $slug,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        return redirect()
            ->route('fahrzeugzustand.index')
            ->with(
                'success',
                'Vehicle condition created successfully.'
            );
    }

    /**
     * Display the specified vehicle condition.
     */
    public function show(
        VehicleCondition $fahrzeugzustand
    ): View {
        $fahrzeugzustand->loadCount('autos');

        return view(
            'backend.admin.vehiclecondition.show',
            compact('fahrzeugzustand')
        );
    }

    /**
     * Show the form for editing the specified vehicle condition.
     */
    public function edit(
        VehicleCondition $fahrzeugzustand
    ): View {
        return view(
            'backend.admin.vehiclecondition.edit',
            compact('fahrzeugzustand')
        );
    }

    /**
     * Update the specified vehicle condition.
     */
    public function update(
        Request $request,
        VehicleCondition $fahrzeugzustand
    ): RedirectResponse {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('vehicle_conditions', 'name')
                    ->ignore($fahrzeugzustand->id),
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('vehicle_conditions', 'slug')
                    ->ignore($fahrzeugzustand->id),
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
         * excluding the current condition.
         */
        $originalSlug = $slug;
        $counter = 1;

        while (
            VehicleCondition::where('slug', $slug)
                ->where('id', '!=', $fahrzeugzustand->id)
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $fahrzeugzustand->update([
            'name' => trim($validated['name']),
            'slug' => $slug,
            'is_active' => $request->boolean('is_active', false),
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        return redirect()
            ->route('fahrzeugzustand.index')
            ->with(
                'success',
                'Vehicle condition updated successfully.'
            );
    }

    /**
     * Remove the specified vehicle condition.
     */
    public function destroy(
        VehicleCondition $fahrzeugzustand
    ): RedirectResponse {
        $autoCount = $fahrzeugzustand->autos()->count();

        /*
         * Never delete a condition currently used
         * by vehicles.
         */
        if ($autoCount > 0) {
            return redirect()
                ->route('fahrzeugzustand.index')
                ->with(
                    'error',
                    'This vehicle condition cannot be deleted because '
                    . 'it is currently used by '
                    . $autoCount
                    . ' vehicle(s). Please deactivate it instead.'
                );
        }

        $fahrzeugzustand->delete();

        return redirect()
            ->route('fahrzeugzustand.index')
            ->with(
                'success',
                'Vehicle condition deleted successfully.'
            );
    }
}