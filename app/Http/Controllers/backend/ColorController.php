<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class ColorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of colors.
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

        $colors = Color::query()
            ->withCount('autos')
            ->search($search)
            ->status($status)
            ->orderBy($sort, $direction)
            ->orderBy('id', 'desc')
            ->paginate(15)
            ->withQueryString();

        return view(
            'backend.admin.color.index',
            compact(
                'colors',
                'search',
                'status',
                'sort',
                'direction'
            )
        );
    }

    /**
     * Show the form for creating a new color.
     */
    public function create(): View
    {
        return view(
            'backend.admin.color.create'
        );
    }

    /**
     * Store a newly created color.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:colors,name',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:colors,slug',
            ],

            'hex_code' => [
                'nullable',
                'string',
                'regex:/^#[0-9A-Fa-f]{6}$/',
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
         * Make sure generated slug is unique.
         */
        $originalSlug = $slug;
        $counter = 1;

        while (Color::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        Color::create([
            'name' => trim($validated['name']),
            'slug' => $slug,
            'hex_code' => ! empty($validated['hex_code'])
                ? strtoupper($validated['hex_code'])
                : null,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        return redirect()
            ->route('color.index')
            ->with(
                'success',
                'Auto color created successfully.'
            );
    }

    /**
     * Display the specified color.
     */
    public function show(Color $color): View
    {
        $color->loadCount('autos');

        return view(
            'backend.admin.color.show',
            compact('color')
        );
    }

    /**
     * Show the form for editing the specified color.
     */
    public function edit(Color $color): View
    {
        return view(
            'backend.admin.color.edit',
            compact('color')
        );
    }

    /**
     * Update the specified color.
     */
    public function update(
        Request $request,
        Color $color
    ): RedirectResponse {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('colors', 'name')
                    ->ignore($color->id),
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('colors', 'slug')
                    ->ignore($color->id),
            ],

            'hex_code' => [
                'nullable',
                'string',
                'regex:/^#[0-9A-Fa-f]{6}$/',
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
         * excluding the current color.
         */
        $originalSlug = $slug;
        $counter = 1;

        while (
            Color::where('slug', $slug)
                ->where('id', '!=', $color->id)
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $color->update([
            'name' => trim($validated['name']),
            'slug' => $slug,
            'hex_code' => ! empty($validated['hex_code'])
                ? strtoupper($validated['hex_code'])
                : null,
            'is_active' => $request->boolean('is_active', false),
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        return redirect()
            ->route('color.index')
            ->with(
                'success',
                'Auto color updated successfully.'
            );
    }

    /**
     * Remove the specified color.
     */
    public function destroy(Color $color): RedirectResponse
    {
        $autoCount = $color->autos()->count();

        /*
         * Never delete a color currently used by vehicles.
         */
        if ($autoCount > 0) {
            return redirect()
                ->route('color.index')
                ->with(
                    'error',
                    'This color cannot be deleted because it '
                    . 'is currently used by '
                    . $autoCount
                    . ' vehicle(s). Please deactivate it instead.'
                );
        }

        $color->delete();

        return redirect()
            ->route('color.index')
            ->with(
                'success',
                'Auto color deleted successfully.'
            );
    }
}