<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\FeatureCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class FeatureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of features.
     */
    public function index(Request $request): View
    {
        $search = trim((string) $request->input('search'));
        $categoryId = $request->input('feature_category_id');
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

        $features = Feature::query()
            ->with('category')
            ->withCount('autos')
            ->search($search)
            ->category($categoryId)
            ->status($status)
            ->orderBy('features.' . $sort, $direction)
            ->orderBy('features.id', 'desc')
            ->paginate(20)
            ->withQueryString();

        /*
         * Load active categories for the filter.
         */
        $categories = FeatureCategory::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get([
                'id',
                'name',
            ]);

        /*
         * Also keep the selected category available in the
         * filter if it has been deactivated.
         */
        if (
            filled($categoryId) &&
            ! $categories->contains('id', (int) $categoryId)
        ) {
            $selectedCategory = FeatureCategory::find($categoryId);

            if ($selectedCategory) {
                $categories->prepend($selectedCategory);
            }
        }

        return view(
            'backend.admin.feature.index',
            compact(
                'features',
                'categories',
                'search',
                'categoryId',
                'status',
                'sort',
                'direction'
            )
        );
    }

    /**
     * Show the form for creating a new feature.
     */
    public function create(): View
    {
        $categories = FeatureCategory::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get([
                'id',
                'name',
            ]);

        return view(
            'backend.admin.feature.create',
            compact('categories')
        );
    }

    /**
     * Store a newly created feature.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'feature_category_id' => [
                'required',
                'integer',
                'exists:feature_categories,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
                'unique:features,name',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:features,slug',
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

        /*
         * Make sure the selected category is active.
         */
        $category = FeatureCategory::query()
            ->where('id', $validated['feature_category_id'])
            ->where('is_active', true)
            ->first();

        if (! $category) {
            return back()
                ->withInput()
                ->withErrors([
                    'feature_category_id' =>
                        'The selected feature category is inactive.'
                ]);
        }

        $slug = filled($validated['slug'] ?? null)
            ? Str::slug($validated['slug'])
            : Str::slug($validated['name']);

        /*
         * Make sure generated slug is unique.
         */
        $originalSlug = $slug;
        $counter = 1;

        while (Feature::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        Feature::create([
            'feature_category_id' => $validated['feature_category_id'],
            'name' => trim($validated['name']),
            'slug' => $slug,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        return redirect()
            ->route('ausstattung.index')
            ->with(
                'success',
                'Auto feature created successfully.'
            );
    }

    /**
     * Display the specified feature.
     */
    public function show(Feature $ausstattung): View
    {
        $ausstattung->load('category');
        $ausstattung->loadCount('autos');

        return view(
            'backend.admin.feature.show',
            compact('ausstattung')
        );
    }

    /**
     * Show the form for editing the specified feature.
     */
    public function edit(Feature $ausstattung): View
    {
        $categories = FeatureCategory::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get([
                'id',
                'name',
            ]);

        /*
         * Keep the current category available even if
         * it has been deactivated.
         */
        if (
            $ausstattung->category &&
            ! $categories->contains(
                'id',
                $ausstattung->feature_category_id
            )
        ) {
            $categories->prepend(
                $ausstattung->category
            );
        }

        return view(
            'backend.admin.feature.edit',
            compact(
                'ausstattung',
                'categories'
            )
        );
    }

    /**
     * Update the specified feature.
     */
    public function update(
        Request $request,
        Feature $ausstattung
    ): RedirectResponse {
        $validated = $request->validate([
            'feature_category_id' => [
                'required',
                'integer',
                'exists:feature_categories,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('features', 'name')
                    ->ignore($ausstattung->id),
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('features', 'slug')
                    ->ignore($ausstattung->id),
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

        /*
         * Make sure the selected category exists and is active.
         *
         * If this is the current category and it was deactivated,
         * the edit page can still show it, but changing to an
         * inactive category is not allowed.
         */
        $category = FeatureCategory::query()
            ->where('id', $validated['feature_category_id'])
            ->where('is_active', true)
            ->first();

        if (! $category) {
            return back()
                ->withInput()
                ->withErrors([
                    'feature_category_id' =>
                        'The selected feature category is inactive.'
                ]);
        }

        $slug = filled($validated['slug'] ?? null)
            ? Str::slug($validated['slug'])
            : Str::slug($validated['name']);

        /*
         * Make sure generated slug is unique,
         * excluding the current feature.
         */
        $originalSlug = $slug;
        $counter = 1;

        while (
            Feature::where('slug', $slug)
                ->where('id', '!=', $ausstattung->id)
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $ausstattung->update([
            'feature_category_id' => $validated['feature_category_id'],
            'name' => trim($validated['name']),
            'slug' => $slug,
            'is_active' => $request->boolean('is_active', false),
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        return redirect()
            ->route('ausstattung.index')
            ->with(
                'success',
                'Auto feature updated successfully.'
            );
    }

    /**
     * Remove the specified feature.
     */
    public function destroy(Feature $ausstattung): RedirectResponse
    {
        $autoCount = $ausstattung->autos()->count();

        /*
         * Never delete a feature currently assigned
         * to vehicles.
         */
        if ($autoCount > 0) {
            return redirect()
                ->route('ausstattung.index')
                ->with(
                    'error',
                    'This feature cannot be deleted because it '
                    . 'is currently assigned to '
                    . $autoCount
                    . ' vehicle(s). Please deactivate it instead.'
                );
        }

        $ausstattung->delete();

        return redirect()
            ->route('ausstattung.index')
            ->with(
                'success',
                'Auto feature deleted successfully.'
            );
    }
}