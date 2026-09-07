<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\BodyType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class BodyTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of body types.
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

        $bodyTypes = BodyType::query()
            ->withCount('autos')
            ->search($search)
            ->status($status)
            ->orderBy($sort, $direction)
            ->orderBy('id', 'desc')
            ->paginate(15)
            ->withQueryString();

        return view(
            'backend.admin.bodytype.index',
            compact(
                'bodyTypes',
                'search',
                'status',
                'sort',
                'direction'
            )
        );
    }

    /**
     * Show the form for creating a new body type.
     */
    public function create(): View
    {
        return view(
            'backend.admin.bodytype.create'
        );
    }

    /**
     * Store a newly created body type.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:body_types,name',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:body_types,slug',
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

        while (BodyType::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        BodyType::create([
            'name' => trim($validated['name']),
            'slug' => $slug,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        return redirect()
            ->route('fahrzeugtyp.index')
            ->with(
                'success',
                'Body type created successfully.'
            );
    }

    /**
     * Display the specified body type.
     */
    public function show(BodyType $fahrzeugtyp): View
    {
        $fahrzeugtyp->loadCount('autos');

        return view(
            'backend.admin.bodytype.show',
            compact('fahrzeugtyp')
        );
    }

    /**
     * Show the form for editing the specified body type.
     */
    public function edit(BodyType $fahrzeugtyp): View
    {
        return view(
            'backend.admin.bodytype.edit',
            compact('fahrzeugtyp')
        );
    }

    /**
     * Update the specified body type.
     */
    public function update(
        Request $request,
        BodyType $fahrzeugtyp
    ): RedirectResponse {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('body_types', 'name')
                    ->ignore($fahrzeugtyp->id),
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('body_types', 'slug')
                    ->ignore($fahrzeugtyp->id),
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
         * excluding the current body type.
         */
        $originalSlug = $slug;
        $counter = 1;

        while (
            BodyType::where('slug', $slug)
                ->where('id', '!=', $fahrzeugtyp->id)
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $fahrzeugtyp->update([
            'name' => trim($validated['name']),
            'slug' => $slug,
            'is_active' => $request->boolean('is_active', false),
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        return redirect()
            ->route('fahrzeugtyp.index')
            ->with(
                'success',
                'Body type updated successfully.'
            );
    }

    /**
     * Remove the specified body type.
     */
        public function destroy(BodyType $fahrzeugtyp): RedirectResponse
        {
            if ($fahrzeugtyp->autos()->exists()) {
                return redirect()
                    ->route('fahrzeugtyp.index')
                    ->with(
                        'error',
                        'This body type cannot be deleted because it is still used by one or more auto posts. Please delete or change those auto posts first.'
                    );
            }

            $fahrzeugtyp->delete();

            return redirect()
                ->route('fahrzeugtyp.index')
                ->with(
                    'success',
                    'Body type deleted successfully.'
                );
        }

    
}