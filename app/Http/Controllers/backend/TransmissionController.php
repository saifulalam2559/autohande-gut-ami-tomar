<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Transmission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class TransmissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of transmissions.
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

        $transmissions = Transmission::query()
            ->withCount('autos')
            ->search($search)
            ->status($status)
            ->orderBy($sort, $direction)
            ->orderBy('id', 'desc')
            ->paginate(15)
            ->withQueryString();

        return view(
            'backend.admin.transmission.index',
            compact(
                'transmissions',
                'search',
                'status',
                'sort',
                'direction'
            )
        );
    }

    /**
     * Show the form for creating a new transmission.
     */
    public function create(): View
    {
        return view(
            'backend.admin.transmission.create'
        );
    }

    /**
     * Store a newly created transmission.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:transmissions,name',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:transmissions,slug',
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

        while (Transmission::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        Transmission::create([
            'name' => trim($validated['name']),
            'slug' => $slug,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        return redirect()
            ->route('getriebe.index')
            ->with(
                'success',
                'Transmission created successfully.'
            );
    }

    /**
     * Display the specified transmission.
     */
    public function show(Transmission $getriebe): View
    {
        $getriebe->loadCount('autos');

        return view(
            'backend.admin.transmission.show',
            compact('getriebe')
        );
    }

    /**
     * Show the form for editing the specified transmission.
     */
    public function edit(Transmission $getriebe): View
    {
        return view(
            'backend.admin.transmission.edit',
            compact('getriebe')
        );
    }

    /**
     * Update the specified transmission.
     */
    public function update(
        Request $request,
        Transmission $getriebe
    ): RedirectResponse {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('transmissions', 'name')
                    ->ignore($getriebe->id),
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('transmissions', 'slug')
                    ->ignore($getriebe->id),
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
         * excluding the current transmission.
         */
        $originalSlug = $slug;
        $counter = 1;

        while (
            Transmission::where('slug', $slug)
                ->where('id', '!=', $getriebe->id)
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $getriebe->update([
            'name' => trim($validated['name']),
            'slug' => $slug,
            'is_active' => $request->boolean('is_active', false),
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        return redirect()
            ->route('getriebe.index')
            ->with(
                'success',
                'Transmission updated successfully.'
            );
    }

    /**
     * Remove the specified transmission.
     */
    public function destroy(Transmission $getriebe): RedirectResponse
    {
        $autoCount = $getriebe->autos()->count();

        /*
         * Never delete a transmission that is already
         * being used by vehicles.
         */
        if ($autoCount > 0) {
            return redirect()
                ->route('getriebe.index')
                ->with(
                    'error',
                    'This transmission cannot be deleted because it '
                    . 'is currently used by '
                    . $autoCount
                    . ' vehicle(s). Please deactivate it instead.'
                );
        }

        $getriebe->delete();

        return redirect()
            ->route('getriebe.index')
            ->with(
                'success',
                'Transmission deleted successfully.'
            );
    }
}