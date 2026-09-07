@extends('backend.layouts.master')

@section('content')

<div class="card">


<div class="card-header">

    <h3 class="mb-0">
        Add User Manual
    </h3>

</div>


<div class="card-body">

    @include('backend.layouts.notification')


    <form
        method="POST"
        action="{{ route('user-manuals.store') }}"
        enctype="multipart/form-data">

        @csrf


        {{-- ==========================================================
             PRODUCT SELECTION
        =========================================================== --}}

        <div class="row">

            {{-- Product --}}

            <div class="col-md-8">

                <label for="product_id">

                    Product

                    <span class="text-danger">*</span>

                </label>


                <select
                    name="product_id"
                    id="product_id"
                    class="form-control my-select"
                    required>

                    <option value="">

                        Select Product

                    </option>


                    @foreach($products as $product)

                        <option

                            value="{{ $product->id }}"

                            data-product-id="{{ $product->id }}"

                            data-product-name="{{ $product->name ?? '' }}"

                            data-sku="{{ $product->sku ?? '' }}"

                            data-barcode="{{ $product->barcode ?? '' }}"

                            data-store-no="{{ $product->store_no ?? '' }}"

                            {{ old('product_id') == $product->id ? 'selected' : '' }}>

                            {{ $product->name ?? 'Unknown Product' }}

                            |

                            SKU:
                            {{ $product->sku ?? '-' }}

                            |

                            Barcode:
                            {{ $product->barcode ?? '-' }}

                        </option>

                    @endforeach

                </select>


                @error('product_id')

                    <span class="text-danger">

                        {{ $message }}

                    </span>

                @enderror

            </div>


            {{-- Product ID --}}

            <div class="col-md-4">

                <label for="product_id_display">

                    Product ID

                </label>


                <input

                    type="text"

                    id="product_id_display"

                    class="form-control"

                    value=""

                    placeholder="Product ID"

                    readonly>

            </div>

        </div>



        {{-- ==========================================================
             PRODUCT INFORMATION
        =========================================================== --}}

        <div class="row mt-3">


            {{-- Product Name --}}

            <div class="col-md-6">

                <label for="product_name">

                    Product Name

                </label>


                <input

                    type="text"

                    id="product_name"

                    class="form-control"

                    value="{{ old('product_name') }}"

                    placeholder="Product Name"

                    readonly>

            </div>



            {{-- SKU --}}

            <div class="col-md-3">

                <label for="product_sku">

                    SKU

                </label>


                <input

                    type="text"

                    id="product_sku"

                    class="form-control"

                    value=""

                    placeholder="SKU"

                    readonly>

            </div>



            {{-- Barcode --}}

            <div class="col-md-3">

                <label for="product_barcode">

                    Barcode

                </label>


                <input

                    type="text"

                    id="product_barcode"

                    class="form-control"

                    value=""

                    placeholder="Barcode"

                    readonly>

            </div>

        </div>



        {{-- ==========================================================
             STORE INFORMATION
        =========================================================== --}}

        <div class="row mt-3">

            {{-- Store No --}}

            <div class="col-md-4">

                <label for="store_no">

                    Store No

                </label>


                <input

                    type="text"

                    name="store_no"

                    id="store_no"

                    class="form-control"

                    value="{{ old('store_no') }}"

                    placeholder="Store No"

                    readonly>

                <small class="text-muted">

                    Automatically populated from the product.

                </small>


                @error('store_no')

                    <span class="text-danger d-block">

                        {{ $message }}

                    </span>

                @enderror

            </div>

        </div>



        {{-- ==========================================================
             MARKETPLACE INFORMATION
        =========================================================== --}}

        <div class="card mt-4">

            <div class="card-header">

                <h4 class="mb-0">

                    Marketplace Information

                </h4>

                <small class="text-muted">

                    Optional. You can add Amazon/eBay Artikel
                    information later.

                </small>

            </div>


            <div class="card-body">

                <div class="row">


                    {{-- Source --}}

                    <div class="col-md-6">

                        <label for="source">

                            Source

                        </label>


                        <input

                            type="text"

                            name="source"

                            id="source"

                            class="form-control"

                            placeholder="Amazon, eBay, Webshop, Supplier"

                            value="{{ old('source') }}">


                        @error('source')

                            <span class="text-danger d-block">

                                {{ $message }}

                            </span>

                        @enderror

                    </div>



                    {{-- Artikel Number --}}

                    <div class="col-md-6">

                        <label for="artikelnr">

                            Artikel Number

                        </label>


                        <input

                            type="text"

                            name="artikelnr"

                            id="artikelnr"

                            class="form-control"

                            placeholder="Optional"

                            value="{{ old('artikelnr') }}">


                        @error('artikelnr')

                            <span class="text-danger d-block">

                                {{ $message }}

                            </span>

                        @enderror

                    </div>

                </div>

            </div>

        </div>



        {{-- ==========================================================
             FILE UPLOAD
        =========================================================== --}}

        <div class="card mt-4">

            <div class="card-header">

                <h4 class="mb-0">

                    User Manual Files

                </h4>

            </div>


            <div class="card-body">

                <div class="row">


                    {{-- DOC --}}

                    <div class="col-md-6">

                        <label for="doc_file">

                            DOC / DOCX File

                            <span class="text-danger">*</span>

                        </label>


                        <input

                            type="file"

                            name="doc_file"

                            id="doc_file"

                            class="form-control"

                            accept=".doc,.docx"

                            required>


                        <small class="text-muted">

                            Allowed: DOC, DOCX.
                            Maximum 10 MB.

                        </small>


                        @error('doc_file')

                            <span class="text-danger d-block">

                                {{ $message }}

                            </span>

                        @enderror

                    </div>



                    {{-- PDF --}}

                    <div class="col-md-6">

                        <label for="pdf_file">

                            PDF File

                            <span class="text-danger">*</span>

                        </label>


                        <input

                            type="file"

                            name="pdf_file"

                            id="pdf_file"

                            class="form-control"

                            accept=".pdf"

                            required>


                        <small class="text-muted">

                            Allowed: PDF.
                            Maximum 10 MB.

                        </small>


                        @error('pdf_file')

                            <span class="text-danger d-block">

                                {{ $message }}

                            </span>

                        @enderror

                    </div>

                </div>

            </div>

        </div>



        {{-- ==========================================================
             BUTTONS
        =========================================================== --}}

        <div class="mt-4">

            <button
                type="submit"
                class="btn btn-dark">

                <i class="fas fa-save"></i>

                Save User Manual

            </button>


            <a
                href="{{ route('user-manuals.index') }}"
                class="btn btn-danger">

                <i class="fas fa-times"></i>

                Cancel

            </a>

        </div>


    </form>

</div>


</div>

@endsection

@section('scripts')

<script>

$(document).ready(function () {


    /*
    |--------------------------------------------------------------------------
    | Product Selection
    |--------------------------------------------------------------------------
    */

    $('#product_id').on('change', function () {

        let selectedOption =
            $(this).find('option:selected');


        /*
        |--------------------------------------------------------------------------
        | Clear Fields When No Product Selected
        |--------------------------------------------------------------------------
        */

        if (!selectedOption.val()) {

            $('#product_id_display').val('');

            $('#product_name').val('');

            $('#product_sku').val('');

            $('#product_barcode').val('');

            $('#store_no').val('');

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Read Product Data
        |--------------------------------------------------------------------------
        */

        let productId =
            selectedOption.attr(
                'data-product-id'
            ) || '';


        let productName =
            selectedOption.attr(
                'data-product-name'
            ) || '';


        let sku =
            selectedOption.attr(
                'data-sku'
            ) || '';


        let barcode =
            selectedOption.attr(
                'data-barcode'
            ) || '';


        let storeNo =
            selectedOption.attr(
                'data-store-no'
            ) || '';


        /*
        |--------------------------------------------------------------------------
        | Populate Product Information
        |--------------------------------------------------------------------------
        */

        $('#product_id_display')
            .val(productId);


        $('#product_name')
            .val(productName);


        $('#product_sku')
            .val(sku);


        $('#product_barcode')
            .val(barcode);


        /*
        |--------------------------------------------------------------------------
        | Populate Store Number
        |--------------------------------------------------------------------------
        */

        $('#store_no')
            .val(storeNo);

    });


    /*
    |--------------------------------------------------------------------------
    | Restore Product After Validation Error
    |--------------------------------------------------------------------------
    */

    $('#product_id').trigger('change');

});

</script>

@endsection
