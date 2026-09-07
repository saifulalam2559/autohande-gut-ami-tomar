<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\FeatureCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class FeatureCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of feature categories.
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

        $categories = FeatureCategory::query()
            ->withCount('features')
            ->search($search)
            ->status($status)
            ->orderBy($sort, $direction)
            ->orderBy('id', 'desc')
            ->paginate(15)
            ->withQueryString();

        return view(
            'backend.admin.featurecategory.index',
            compact(
                'categories',
                'search',
                'status',
                'sort',
                'direction'
            )
        );
    }

    /**
     * Show the form for creating a new feature category.
     */
    public function create(): View
    {
        return view(
            'backend.admin.featurecategory.create'
        );
    }

    /**
     * Store a newly created feature category.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:feature_categories,name',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:feature_categories,slug',
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

        while (
            FeatureCategory::where('slug', $slug)->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        FeatureCategory::create([
            'name' => trim($validated['name']),
            'slug' => $slug,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        return redirect()
            ->route('ausstattungcategory.index')
            ->with(
                'success',
                'Feature category created successfully.'
            );
    }

    /**
     * Display the specified feature category.
     */
    public function show(
        FeatureCategory $ausstattungcategory
    ): View {
        $ausstattungcategory->loadCount('features');

        return view(
            'backend.admin.featurecategory.show',
            compact('ausstattungcategory')
        );
    }

    /**
     * Show the form for editing the specified feature category.
     */
    public function edit(
        FeatureCategory $ausstattungcategory
    ): View {
        return view(
            'backend.admin.featurecategory.edit',
            compact('ausstattungcategory')
        );
    }

    /**
     * Update the specified feature category.
     */
    public function update(
        Request $request,
        FeatureCategory $ausstattungcategory
    ): RedirectResponse {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('feature_categories', 'name')
                    ->ignore($ausstattungcategory->id),
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('feature_categories', 'slug')
                    ->ignore($ausstattungcategory->id),
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
         * excluding the current category.
         */
        $originalSlug = $slug;
        $counter = 1;

        while (
            FeatureCategory::where('slug', $slug)
                ->where('id', '!=', $ausstattungcategory->id)
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $ausstattungcategory->update([
            'name' => trim($validated['name']),
            'slug' => $slug,
            'is_active' => $request->boolean('is_active', false),
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        return redirect()
            ->route('ausstattungcategory.index')
            ->with(
                'success',
                'Feature category updated successfully.'
            );
    }

    /**
     * Remove the specified feature category.
     */
    public function destroy(
        FeatureCategory $ausstattungcategory
    ): RedirectResponse {
        $featureCount = $ausstattungcategory->features()->count();

        /*
         * Never delete a category that is already being
         * used by features.
         */
        if ($featureCount > 0) {
            return redirect()
                ->route('ausstattungcategory.index')
                ->with(
                    'error',
                    'This feature category cannot be deleted because '
                    . 'it is currently used by '
                    . $featureCount
                    . ' feature(s). Please deactivate it instead.'
                );
        }

        $ausstattungcategory->delete();

        return redirect()
            ->route('ausstattungcategory.index')
            ->with(
                'success',
                'Feature category deleted successfully.'
            );
    }
}