<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\EmissionClass;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class EmissionClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of emission classes.
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

        $emissionClasses = EmissionClass::query()
            ->withCount('autos')
            ->search($search)
            ->status($status)
            ->orderBy($sort, $direction)
            ->orderBy('id', 'desc')
            ->paginate(15)
            ->withQueryString();

        return view(
            'backend.admin.emission.index',
            compact(
                'emissionClasses',
                'search',
                'status',
                'sort',
                'direction'
            )
        );
    }

    /**
     * Show the form for creating a new emission class.
     */
    public function create(): View
    {
        return view(
            'backend.admin.emission.create'
        );
    }

    /**
     * Store a newly created emission class.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:emission_classes,name',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:emission_classes,slug',
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

        while (EmissionClass::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        EmissionClass::create([
            'name' => trim($validated['name']),
            'slug' => $slug,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        return redirect()
            ->route('schadstoffklasse.index')
            ->with(
                'success',
                'Emission class created successfully.'
            );
    }

    /**
     * Display the specified emission class.
     */
    public function show(
        EmissionClass $schadstoffklasse
    ): View {
        $schadstoffklasse->loadCount('autos');

        return view(
            'backend.admin.emission.show',
            compact('schadstoffklasse')
        );
    }

    /**
     * Show the form for editing the specified emission class.
     */
    public function edit(
        EmissionClass $schadstoffklasse
    ): View {
        return view(
            'backend.admin.emission.edit',
            compact('schadstoffklasse')
        );
    }

    /**
     * Update the specified emission class.
     */
    public function update(
        Request $request,
        EmissionClass $schadstoffklasse
    ): RedirectResponse {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('emission_classes', 'name')
                    ->ignore($schadstoffklasse->id),
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('emission_classes', 'slug')
                    ->ignore($schadstoffklasse->id),
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
         * Make sure the generated slug is unique,
         * excluding the current emission class.
         */
        $originalSlug = $slug;
        $counter = 1;

        while (
            EmissionClass::where('slug', $slug)
                ->where('id', '!=', $schadstoffklasse->id)
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $schadstoffklasse->update([
            'name' => trim($validated['name']),
            'slug' => $slug,
            'is_active' => $request->boolean('is_active', false),
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        return redirect()
            ->route('schadstoffklasse.index')
            ->with(
                'success',
                'Emission class updated successfully.'
            );
    }

    /**
     * Remove the specified emission class.
     */
    public function destroy(
        EmissionClass $schadstoffklasse
    ): RedirectResponse {
        $autoCount = $schadstoffklasse->autos()->count();

        /*
         * Never delete an emission class currently used
         * by vehicles.
         */
        if ($autoCount > 0) {
            return redirect()
                ->route('schadstoffklasse.index')
                ->with(
                    'error',
                    'This emission class cannot be deleted because '
                    . 'it is currently used by '
                    . $autoCount
                    . ' vehicle(s). Please deactivate it instead.'
                );
        }

        $schadstoffklasse->delete();

        return redirect()
            ->route('schadstoffklasse.index')
            ->with(
                'success',
                'Emission class deleted successfully.'
            );
    }
}