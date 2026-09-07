@extends('backend.layouts.master')

@section('content')



<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

<div class="row">

    <div class="col-md-12">

        @include('backend.layouts.notification')

        <div class="card card-primary">

            {{-- ==========================================================
                 HEADER
            =========================================================== --}}

            <div class="card-header">

                <h3 class="card-title">

                    <i class="fas fa-car-side"></i>

                    Vehicle Models

                </h3>

                <a
                    href="{{ route('modell.create') }}"
                    class="btn btn-success btn-sm float-right">

                    <i class="fas fa-plus"></i>

                    Add Model

                </a>

            </div>


            {{-- ==========================================================
                 SEARCH / FILTER
            =========================================================== --}}

            <div class="card-body">

                <form
                    method="GET"
                    action="{{ route('modell.index') }}">

                    <div class="row">

                        {{-- Search --}}
                        <div class="col-md-4">

                            <div class="form-group">

                                <label for="search">
                                    Search Model
                                </label>

                                <input
                                    type="text"
                                    name="search"
                                    id="search"
                                    value="{{ $search }}"
                                    class="form-control"
                                    placeholder="Search model name...">

                            </div>

                        </div>


                        {{-- Brand --}}
                        <div class="col-md-3">

                            <div class="form-group">

                                <label for="brand_id">
                                    Brand
                                </label>

                                <select
                                    name="brand_id"
                                    id="brand_id"
                                    class="form-control my-select">

                                    <option value="">
                                        All Brands
                                    </option>

                                    @foreach($brands as $brand)

                                        <option
                                            value="{{ $brand->id }}"
                                            {{ $brandId == $brand->id ? 'selected' : '' }}>

                                            {{ $brand->name }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>


                        {{-- Status --}}
                        <div class="col-md-2">

                            <div class="form-group">

                                <label for="status">
                                    Status
                                </label>

                                <select
                                    name="status"
                                    id="status"
                                    class="form-control my-select">

                                    <option value="">
                                        All
                                    </option>

                                    <option
                                        value="active"
                                        {{ $status === 'active' ? 'selected' : '' }}>

                                        Active

                                    </option>

                                    <option
                                        value="inactive"
                                        {{ $status === 'inactive' ? 'selected' : '' }}>

                                        Inactive

                                    </option>

                                </select>

                            </div>

                        </div>


                        {{-- Sort --}}
                        <div class="col-md-2">

                            <div class="form-group">

                                <label for="sort">
                                    Sort By
                                </label>

                                <select
                                    name="sort"
                                    id="sort"
                                    class="form-control my-select">

                                    <option
                                        value="sort_order"
                                        {{ $sort === 'sort_order' ? 'selected' : '' }}>

                                        Sort Order

                                    </option>

                                    <option
                                        value="name"
                                        {{ $sort === 'name' ? 'selected' : '' }}>

                                        Name

                                    </option>

                                    <option
                                        value="created_at"
                                        {{ $sort === 'created_at' ? 'selected' : '' }}>

                                        Created

                                    </option>

                                </select>

                            </div>

                        </div>


                        {{-- Direction --}}
                        <div class="col-md-1">

                            <div class="form-group">

                                <label for="direction">
                                    Order
                                </label>

                                <select
                                    name="direction"
                                    id="direction"
                                    class="form-control my-select">

                                    <option
                                        value="asc"
                                        {{ $direction === 'asc' ? 'selected' : '' }}>

                                        ↑

                                    </option>

                                    <option
                                        value="desc"
                                        {{ $direction === 'desc' ? 'selected' : '' }}>

                                        ↓

                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>


                    {{-- Buttons --}}
                    <div class="row">

                        <div class="col-md-12">

                            <button
                                type="submit"
                                class="btn btn-primary">

                                <i class="fas fa-search"></i>

                                Search

                            </button>

                            <a
                                href="{{ route('modell.index') }}"
                                class="btn btn-secondary">

                                <i class="fas fa-redo"></i>

                                Reset

                            </a>

                        </div>

                    </div>

                </form>

            </div>


            {{-- ==========================================================
                 TABLE
            =========================================================== --}}

            <div class="card-body table-responsive p-0">

                <table class="table table-hover text-nowrap">

                    <thead>

                        <tr>

                            <th width="60">
                                #
                            </th>

                            <th>
                                Brand
                            </th>

                            <th>
                                Model
                            </th>

                            <th>
                                Slug
                            </th>

                            <th>
                                Vehicles
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Sort Order
                            </th>

                            <th width="150">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($models as $model)

                            <tr>

                                <td>
                                    {{ $models->firstItem() + $loop->index }}
                                </td>

                                <td>

                                    <span class="badge badge-info">
                                        {{ $model->brand->name }}
                                    </span>

                                </td>

                                <td>

                                    <strong>
                                        {{ $model->name }}
                                    </strong>

                                </td>

                                <td>

                                    <code>
                                        {{ $model->slug }}
                                    </code>

                                </td>

                                <td>

                                    <span class="badge badge-secondary">
                                        {{ $model->autos_count }}
                                    </span>

                                </td>

                                <td>

                                    @if($model->is_active)

                                        <span class="badge badge-success">
                                            Active
                                        </span>

                                    @else

                                        <span class="badge badge-danger">
                                            Inactive
                                        </span>

                                    @endif

                                </td>

                                <td>
                                    {{ $model->sort_order }}
                                </td>

                                <td>

                                    <a
                                        href="{{ route('modell.edit', $model) }}"
                                        class="btn btn-sm btn-primary"
                                        title="Edit Model">

                                        <i class="fas fa-edit"></i>

                                    </a>

                                    <form
                                        action="{{ route('modell.destroy', $model) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this vehicle model?');">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-danger"
                                            title="Delete Model">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="8"
                                    class="text-center py-4">

                                    <i class="fas fa-car-side fa-2x text-muted mb-2"></i>

                                    <p class="mb-0">
                                        No vehicle models found.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- ==========================================================
                 PAGINATION
            =========================================================== --}}

            @if($models->hasPages())

                <div class="card-footer">

                
                    
                    
    {{ $models->appends(request()->query())->links('pagination-links') }}

                </div>

            @endif

        </div>

    </div>

</div>
          
           
</div>
   
</div>
   </section>
</div>


@endsection