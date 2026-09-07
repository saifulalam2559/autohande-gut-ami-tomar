@extends('backend.layouts.master')

@section('content')

<div class="card">


{{-- ==========================================================
     HEADER
=========================================================== --}}

<div class="card-header">

    <div class="d-flex justify-content-between align-items-center">

        <h3 class="mb-0">
            User Manuals
        </h3>

        <a
            href="{{ route('user-manuals.create') }}"
            class="btn btn-dark">

            <i class="fas fa-plus"></i>

            Add User Manual

        </a>

    </div>

</div>


<div class="card-body">

    @include('backend.layouts.notification')


    {{-- ==========================================================
         SEARCH
    =========================================================== --}}

    <form
        method="GET"
        action="{{ route('user-manuals.index') }}"
        class="mb-4">

        <div class="row">

            <div class="col-md-8">

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    value="{{ request('search') }}"
                    placeholder="Search product, SKU, barcode, artikel number, source, store...">

            </div>


            <div class="col-md-2">

                <button
                    type="submit"
                    class="btn btn-dark w-100">

                    <i class="fas fa-search"></i>

                    Search

                </button>

            </div>


            <div class="col-md-2">

                <a
                    href="{{ route('user-manuals.index') }}"
                    class="btn btn-danger btn-sm w-100">

                    <i class="fas fa-sync-alt"></i>

                    Clear

                </a>

            </div>

        </div>

    </form>


    {{-- ==========================================================
         TABLE
    =========================================================== --}}

    <div class="table-responsive">

        <table class="table table-bordered table-hover align-middle">

            <thead>

                <tr>

                    <th>
                        #
                    </th>

                    <th>
                        Product
                    </th>
                    
                    <th>
                        Barcode
                    </th>
                    
                    <th>
                        Store
                    </th>

                    <th>
                        SKU
                    </th>

                    <th>
                        Artikel No.
                    </th>



                    <th>
                        Source
                    </th>



                    <th>
                        DOC
                    </th>

                    <th>
                        PDF
                    </th>

                    <th>
                        Actions
                    </th>

                </tr>

            </thead>


            <tbody>

            @forelse($userManuals as $manual)

                <tr>

                    {{-- ==================================================
                         ID
                    =================================================== --}}

                    <td>

                        {{ $manual->id }}

                    </td>


                    {{-- ==================================================
                         PRODUCT
                    =================================================== --}}

                    <td>

                        <strong>

                            {{ $manual->product?->name
                                ?? $manual->product_name
                                ?? 'Unknown Product'
                            }}

                        </strong>






                    </td>
                    
                    
                   {{-- ==================================================
                         BARCODE
                    =================================================== --}}

                    <td>

                        {{ $manual->barcode
                            ?? $manual->product?->barcode
                            ?? '-'
                        }}

                    </td>
                    
                    
                    
                    {{-- ==================================================
                         STORE
                    =================================================== --}}

                    <td>

                        @if($manual->store_no)

                            {{ $manual->store_no }}

                        @else

                            <span class="text-muted">
                                Not available
                            </span>

                        @endif

                    </td>


                    {{-- ==================================================
                         SKU
                    =================================================== --}}

                    <td>

                        {{ $manual->product?->sku ?? '-' }}

                    </td>


                    {{-- ==================================================
                         ARTIKEL NUMBER
                    =================================================== --}}

                    <td>

                        @if($manual->artikelnr)

                            {{ $manual->artikelnr }}

                        @else

                            <span class="text-muted">
                                Not available
                            </span>

                        @endif

                    </td>





                    {{-- ==================================================
                         SOURCE
                    =================================================== --}}

                    <td>

                        @if($manual->source)

                            {{ $manual->source }}

                        @else

                            <span class="text-muted">
                                Not available
                            </span>

                        @endif

                    </td>




                    {{-- ==================================================
                         DOC
                    =================================================== --}}

                    <td>

                        @if($manual->doc_file_path)

                            <a
                                href="{{ asset($manual->doc_file_path) }}"
                                target="_blank"
                                class="btn btn-sm btn-outline-primary">

                                <i class="fas fa-file-word"></i>

                                DOC

                            </a>

                        @else

                            <span class="text-danger">

                                <i class="fas fa-times-circle"></i>

                                Missing

                            </span>

                        @endif

                    </td>


                    {{-- ==================================================
                         PDF
                    =================================================== --}}

                    <td>

                        @if($manual->pdf_file_path)

                            <a
                                href="{{ asset($manual->pdf_file_path) }}"
                                target="_blank"
                                class="btn btn-sm btn-outline-danger">

                                <i class="fas fa-file-pdf"></i>

                                PDF

                            </a>

                        @else

                            <span class="text-danger">

                                <i class="fas fa-times-circle"></i>

                                Missing

                            </span>

                        @endif

                    </td>


                    {{-- ==================================================
                         ACTIONS
                    =================================================== --}}

                    <td>

                        <div class="d-flex gap-1">

                            {{-- EDIT --}}

                            <a
                                href="{{ route(
                                    'user-manuals.edit',
                                    $manual
                                ) }}"
                    class="btn btn-sm btn-warning" style="margin-right:10px;">

                                <i class="fas fa-edit"></i>

                                Edit

                            </a>


                            {{-- DELETE --}}

                            <form
                                action="{{ route(
                                    'user-manuals.destroy',
                                    $manual
                                ) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm(
                                    'Are you sure you want to delete this user manual and its files?'
                                );">

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-sm btn-danger">

                                    <i class="fas fa-trash"></i>

                                    Delete

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>


            @empty

                <tr>

                    <td
                        colspan="10"
                        class="text-center py-4">

                        <div class="text-muted">

                            <i class="fas fa-file-alt fa-2x mb-2"></i>

                            <br>

                            No user manuals found.

                        </div>

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>


    {{-- ==========================================================
         PAGINATION
    =========================================================== --}}

    <div class="mt-3">

     
        {{ $userManuals->appends(request()->query())->links('pagination-links') }}

    </div>

</div>


</div>

@endsection
