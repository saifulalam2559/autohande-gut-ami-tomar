<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of brands.
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

        $brands = Brand::query()
            ->withCount([
                'models',
                'autos',
            ])
            ->search($search)
            ->status($status)
            ->orderBy($sort, $direction)
            ->orderBy('id', 'desc')
            ->paginate(15)
            ->withQueryString();

        return view(
            'backend.admin.brand.index',
            compact(
                'brands',
                'search',
                'status',
                'sort',
                'direction'
            )
        );
    }

    /**
     * Show the form for creating a new brand.
     */
    public function create(): View
    {
        return view(
            'backend.admin.brand.create'
        );
    }

    /**
     * Store a newly created brand.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:brands,name',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:brands,slug',
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

        while (Brand::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        Brand::create([
            'name' => trim($validated['name']),
            'slug' => $slug,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        return redirect()
            ->route('marke.index')
            ->with(
                'success',
                'Brand created successfully.'
            );
    }

    /**
     * Display the specified brand.
     */
    public function show(Brand $marke): View
    {
        $marke->loadCount([
            'models',
            'autos',
        ]);

        return view(
            'backend.admin.brand.show',
            compact('marke')
        );
    }

    /**
     * Show the form for editing a brand.
     */
    public function edit(Brand $marke): View
    {
        return view(
            'backend.admin.brand.edit',
            compact('marke')
        );
    }

    /**
     * Update the specified brand.
     */
    public function update(
        Request $request,
        Brand $marke
    ): RedirectResponse {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('brands', 'name')
                    ->ignore($marke->id),
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('brands', 'slug')
                    ->ignore($marke->id),
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
         * Make sure generated slug is unique
         * while ignoring the current brand.
         */
        $originalSlug = $slug;
        $counter = 1;

        while (
            Brand::where('slug', $slug)
                ->where('id', '!=', $marke->id)
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $marke->update([
            'name' => trim($validated['name']),
            'slug' => $slug,
            'is_active' => $request->boolean('is_active', false),
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        return redirect()
            ->route('marke.index')
            ->with(
                'success',
                'Brand updated successfully.'
            );
    }

    /**
     * Remove the specified brand.
     */
    public function destroy(Brand $marke): RedirectResponse
    {
        /*
         * Safety check:
         * Never allow deletion of a brand that is being used.
         */
        $modelCount = $marke->models()->count();
        $autoCount = $marke->autos()->count();

        if ($modelCount > 0 || $autoCount > 0) {
            return redirect()
                ->route('marke.index')
                ->with(
                    'error',
                    'This brand cannot be deleted because it is already '
                    . 'used by ' . $modelCount . ' vehicle model(s) and '
                    . $autoCount . ' vehicle(s). '
                    . 'Please deactivate it instead.'
                );
        }

        $marke->delete();

        return redirect()
            ->route('marke.index')
            ->with(
                'success',
                'Brand deleted successfully.'
            );
    }
    
    
    
} // END