@extends('backend.layouts.master')

@section('content')

<style>

.form-control {
    border: 1px solid #333 !important;
    box-shadow: none !important;
}

.form-control:focus {
    border-color: #333 !important;
    box-shadow: 0 0 0 0.1rem rgba(0, 0, 0, 0.08) !important;
}

.auto-image-thumb {
    width: 90px;
    height: 65px;
    object-fit: cover;
    border-radius: 5px;
    border: 1px solid #ddd;
}

.primary-badge {
    font-size: 12px;
}

</style>


<div class="wrapper">

    <div class="content-wrapper">

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

                                    <i class="fas fa-images"></i>

                                    Auto Images

                                </h3>


                                <a
                                    href="{{ route('autobilder.create') }}"
                                    class="btn btn-success btn-sm float-right">

                                    <i class="fas fa-plus"></i>

                                    Add Auto Image

                                </a>

                            </div>


                            {{-- ==========================================================
                                 FILTER
                            =========================================================== --}}

                            <div class="card-body border-bottom">

                                <form
                                    method="GET"
                                    action="{{ route('autobilder.index') }}">

                                    <div class="row">


                                        {{-- Search --}}
                                        <div class="col-md-3">

                                            <div class="form-group mb-2">

                                                <label for="search">

                                                    Search

                                                </label>

                                                <input
                                                    type="text"
                                                    name="search"
                                                    id="search"
                                                    value="{{ $search }}"
                                                    class="form-control"
                                                    placeholder="Vehicle, stock no., alt text...">

                                            </div>

                                        </div>


                                        {{-- Vehicle --}}
                                        <div class="col-md-3">

                                            <div class="form-group mb-2">

                                                <label for="auto_id">

                                                    Vehicle

                                                </label>

                                                <select
                                                    name="auto_id"
                                                    id="auto_id"
                                                    class="form-control my-select">

                                                    <option value="">

                                                        All Vehicles

                                                    </option>

                                                    @foreach($autos as $auto)

                                                        <option
                                                            value="{{ $auto->id }}"
                                                            {{ (string)$autoId === (string)$auto->id ? 'selected' : '' }}>

                                                            {{ $auto->brand->name ?? '' }}
                                                            {{ $auto->model->name ?? '' }}

                                                            @if($auto->variant)
                                                                - {{ $auto->variant }}
                                                            @endif

                                                            @if($auto->stock_number)
                                                                | {{ $auto->stock_number }}
                                                            @endif

                                                        </option>

                                                    @endforeach

                                                </select>

                                            </div>

                                        </div>


                                        {{-- Primary --}}
                                        <div class="col-md-2">

                                            <div class="form-group mb-2">

                                                <label for="primary">

                                                    Image Type

                                                </label>

                                                <select
                                                    name="primary"
                                                    id="primary"
                                                    class="form-control my-select">

                                                    <option
                                                        value=""
                                                        {{ $primary === null || $primary === '' ? 'selected' : '' }}>

                                                        All Images

                                                    </option>

                                                    <option
                                                        value="1"
                                                        {{ (string)$primary === '1' ? 'selected' : '' }}>

                                                        Primary

                                                    </option>

                                                    <option
                                                        value="0"
                                                        {{ (string)$primary === '0' ? 'selected' : '' }}>

                                                        Secondary

                                                    </option>

                                                </select>

                                            </div>

                                        </div>


                                        {{-- Sort --}}
                                        <div class="col-md-2">

                                            <div class="form-group mb-2">

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
                                                        value="id"
                                                        {{ $sort === 'id' ? 'selected' : '' }}>

                                                        ID

                                                    </option>

                                                    <option
                                                        value="created_at"
                                                        {{ $sort === 'created_at' ? 'selected' : '' }}>

                                                        Created

                                                    </option>

                                                    <option
                                                        value="is_primary"
                                                        {{ $sort === 'is_primary' ? 'selected' : '' }}>

                                                        Primary

                                                    </option>

                                                </select>

                                            </div>

                                        </div>


                                        {{-- Direction --}}
                                        <div class="col-md-2">

                                            <div class="form-group mb-2">

                                                <label for="direction">

                                                    Direction

                                                </label>

                                                <select
                                                    name="direction"
                                                    id="direction"
                                                    class="form-control my-select">

                                                    <option
                                                        value="asc"
                                                        {{ $direction === 'asc' ? 'selected' : '' }}>

                                                        Ascending

                                                    </option>

                                                    <option
                                                        value="desc"
                                                        {{ $direction === 'desc' ? 'selected' : '' }}>

                                                        Descending

                                                    </option>

                                                </select>

                                            </div>

                                        </div>


                                        {{-- Buttons --}}
                                        <div class="col-md-12">

                                            <button
                                                type="submit"
                                                class="btn btn-primary">

                                                <i class="fas fa-search"></i>

                                                Search / Filter

                                            </button>


                                            <a
                                                href="{{ route('autobilder.index') }}"
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

                            <div class="card-body p-0">

                                <div class="table-responsive">

                                    <table class="table table-bordered table-hover mb-0">

                                        <thead class="thead-light">

                                            <tr>

                                                <th width="60">
                                                    #
                                                </th>

                                                <th width="120">
                                                    Image
                                                </th>

                                                <th>
                                                    Vehicle
                                                </th>

                                                <th>
                                                    Alt Text
                                                </th>

                                                <th width="100">
                                                    Position
                                                </th>

                                                <th width="120">
                                                    Type
                                                </th>

                                                <th width="180">
                                                    Actions
                                                </th>

                                            </tr>

                                        </thead>


                                        <tbody>

                                            @forelse($images as $image)

                                                <tr>

                                                    <td>

                                                        {{ $images->firstItem() + $loop->index }}

                                                    </td>


                                                    <td>

                                                        <img
                                                            src="{{ asset('autoimages/' . $image->image_path) }}"
                                                            alt="{{ $image->alt_text ?? 'Vehicle Image' }}"
                                                            class="auto-image-thumb">

                                                    </td>


                                                <td>
                                                    @if($image->auto)

                                                        <strong>
                                                            {{ $image->auto->brand->name ?? '' }}
                                                            {{ $image->auto->model->name ?? '' }}
                                                        </strong>

                                                        @if($image->auto->variant)
                                                            <br>

                                                            <small class="text-muted">
                                                                {{ $image->auto->variant }}
                                                            </small>
                                                        @endif

                                                        @if($image->auto->stock_number)
                                                            <br>

                                                            <small>
                                                                Stock: {{ $image->auto->stock_number }}
                                                            </small>
                                                        @endif

                                                    @else

                                                        <span class="text-muted">
                                                            Vehicle no longer exists
                                                        </span>

                                                    @endif
                                                </td>


                                                    <td>

                                                        {{ $image->alt_text ?: '—' }}

                                                    </td>


                                                    <td>

                                                        {{ $image->sort_order }}

                                                    </td>


                                                    <td>

                                                        @if($image->is_primary)

                                                            <span class="badge badge-success primary-badge">

                                                                <i class="fas fa-star"></i>

                                                                Primary

                                                            </span>

                                                        @else

                                                            <span class="badge badge-secondary">

                                                                Secondary

                                                            </span>

                                                        @endif

                                                    </td>


                                                    <td>

                                                        <a
                                                            href="{{ route('autobilder.show', $image->id) }}"
                                                            class="btn btn-info btn-sm"
                                                            title="View">

                                                            <i class="fas fa-eye"></i>

                                                        </a>


                                                        <a
                                                            href="{{ route('autobilder.edit', $image->id) }}"
                                                            class="btn btn-primary btn-sm"
                                                            title="Edit">

                                                            <i class="fas fa-edit"></i>

                                                        </a>


                                                        <form
                                                            action="{{ route('autobilder.destroy', $image->id) }}"
                                                            method="POST"
                                                            class="d-inline delete-image-form">

                                                            @csrf

                                                            @method('DELETE')

                                                            <button
                                                                type="submit"
                                                                class="btn btn-danger btn-sm"
                                                                title="Delete">

                                                                <i class="fas fa-trash"></i>

                                                            </button>

                                                        </form>

                                                    </td>

                                                </tr>

                                            @empty

                                                <tr>

                                                    <td
                                                        colspan="7"
                                                        class="text-center py-4">

                                                        <i class="fas fa-images fa-2x text-muted"></i>

                                                        <br><br>

                                                        No vehicle images found.

                                                    </td>

                                                </tr>

                                            @endforelse

                                        </tbody>

                                    </table>

                                </div>

                            </div>


                            {{-- ==========================================================
                                 PAGINATION
                            =========================================================== --}}

                            @if($images->hasPages())

                                <div class="card-footer">

                               
                                    
    {{ $images->appends(request()->query())->links('pagination-links') }}

                                </div>

                            @endif


                        </div>

                    </div>

                </div>


            </div>

        </section>

    </div>

</div>

@endsection



@section('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    // Your existing JavaScript...


    // Delete image confirmation
    document.querySelectorAll('.delete-image-form').forEach(function (form) {

        form.addEventListener('submit', function (e) {

            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel'
            }).then(function (result) {

                if (result.isConfirmed) {
                    form.submit();
                }

            });

        });

    });

});


</script>

@endsection