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

                    <i class="fas fa-palette"></i>

                    Auto Colors

                </h3>


                <a
                    href="{{ route('color.create') }}"
                    class="btn btn-success btn-sm float-right">

                    <i class="fas fa-plus"></i>

                    Add Auto Color

                </a>

            </div>


            {{-- ==========================================================
                 SEARCH / FILTER
            =========================================================== --}}

            <div class="card-body">

                <form
                    method="GET"
                    action="{{ route('color.index') }}">

                    <div class="row">

                        {{-- Search --}}
                        <div class="col-md-5">

                            <div class="form-group">

                                <label for="search">
                                    Search Color
                                </label>

                                <input
                                    type="text"
                                    name="search"
                                    id="search"
                                    value="{{ $search }}"
                                    class="form-control"
                                    placeholder="Search name or HEX code...">

                            </div>

                        </div>


                        {{-- Status --}}
                        <div class="col-md-3">

                            <div class="form-group">

                                <label for="status">
                                    Status
                                </label>

                                <select
                                    name="status"
                                    id="status"
                                    class="form-control my-select">

                                    <option value="">
                                        All Colors
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
                        <div class="col-md-2">

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
                                href="{{ route('color.index') }}"
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
                                Color
                            </th>

                            <th>
                                Preview
                            </th>

                            <th>
                                HEX Code
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

                        @forelse($colors as $color)

                            <tr>

                                <td>
                                    {{ $colors->firstItem() + $loop->index }}
                                </td>

                                <td>

                                    <strong>
                                        {{ $color->name }}
                                    </strong>

                                </td>

                                <td>

                                    <div
                                        style="
                                            width: 35px;
                                            height: 35px;
                                            border-radius: 50%;
                                            border: 1px solid #333;
                                            background-color: {{ $color->hex_code ?: '#ffffff' }};
                                        ">
                                    </div>

                                </td>

                                <td>

                                    @if($color->hex_code)

                                        <code>
                                            {{ $color->hex_code }}
                                        </code>

                                    @else

                                        <span class="text-muted">
                                            —
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <code>
                                        {{ $color->slug }}
                                    </code>

                                </td>

                                <td>

                                    <span class="badge badge-secondary">
                                        {{ $color->autos_count }}
                                    </span>

                                </td>

                                <td>

                                    @if($color->is_active)

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
                                    {{ $color->sort_order }}
                                </td>

                                <td>

                                    <a
                                        href="{{ route('color.edit', $color) }}"
                                        class="btn btn-sm btn-primary"
                                        title="Edit Auto Color">

                                        <i class="fas fa-edit"></i>

                                    </a>


                                    <form
                                        action="{{ route('color.destroy', $color) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this color?');">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-danger"
                                            title="Delete Auto Color">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="9"
                                    class="text-center py-4">

                                    <i class="fas fa-palette fa-2x text-muted mb-2"></i>

                                    <p class="mb-0">
                                        No colors found.
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

            @if($colors->hasPages())

                <div class="card-footer">

                  
             
    {{ $colors->appends(request()->query())->links('pagination-links') }}

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