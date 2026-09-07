@extends('backend.layouts.master')

@section('content')

<style>

.auto-switch {
    padding-left: 0 !important;
    min-height: 30px;
    display: flex;
    align-items: center;
}

.auto-switch .custom-control-label {
    padding-left: 0;
    min-height: 30px;
    display: flex;
    align-items: center;
}

/* Switch background */
.auto-switch .custom-control-label::before {
    width: 58px;
    height: 30px;
    top: 0;
    left: 0;
    border-radius: 30px;
    cursor: pointer;
}

/* Switch circle */
.auto-switch .custom-control-label::after {
    width: 24px;
    height: 24px;
    top: 3px;
    left: 3px;
    border-radius: 50%;
    cursor: pointer;
}

/* Move circle when checked */
.auto-switch .custom-control-input:checked ~ .custom-control-label::after {
    transform: translateX(28px);
}

/* Status text */
.auto-switch-label {
    display: inline-flex;
    min-width: 70px;
    height: 30px;
    align-items: center;
    justify-content: flex-start;
    margin-left: 68px;   /* important */
    font-size: 15px;
    font-weight: 600;
    line-height: 1;
    cursor: pointer;
}


.feature-group {
    border: 1px solid #161515;
    border-radius: 6px;
    padding: 15px;
    margin-bottom: 15px;
    background: #fafafa;
}

/* ---------------------------------------------------------
   IMAGE MANAGEMENT
--------------------------------------------------------- */

.auto-image-card {
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    background: #fff;
    height: 100%;
    transition: 0.2s ease;
}

.auto-image-card:hover {
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
}

.auto-image-card.is-primary {
    border: 2px solid #28a745;
}

.auto-image-wrapper {
    width: 100%;
    height: 180px;
    background: #f5f5f5;
    overflow: hidden;
}

.auto-image {
    width: 100%;
    height: auto;
    object-fit: cover;
}

.auto-image-info {
    padding: 12px;
}

.primary-radio,
.delete-image {
    display: block;
    margin-bottom: 8px;
    cursor: pointer;
    font-size: 14px;
}

.primary-radio input,
.delete-image input {
    margin-right: 6px;
}

.primary-radio span {
    color: #333;
}

.delete-image span {
    color: #dc3545;
}

.add-images-box {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    background: #fafafa;
}

.add-images-title {
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 5px;
}

.image-upload-area {
    border: 2px dashed #aaa;
    border-radius: 8px;
    padding: 30px 20px;
    text-align: center;
    display: block;
    cursor: pointer;
    background: #fff;
    transition: 0.2s ease;
}

.image-upload-area:hover {
    border-color: #007bff;
    background: #f8fbff;
}

.image-upload-area i {
    display: block;
    font-size: 35px;
    margin-bottom: 10px;
    color: #007bff;
}

.image-upload-area strong {
    display: block;
    font-size: 16px;
}

.image-upload-area span {
    display: block;
    margin-top: 5px;
    color: #777;
    font-size: 13px;
}

.new-image-preview {
    position: relative;
    border: 1px solid #ddd;
    border-radius: 6px;
    overflow: hidden;
    background: #fff;
}

.new-image-preview img {
    width: auto;
    height: 210px;
    object-fit: cover;
}

.new-image-name {
    padding: 7px;
    font-size: 12px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}



/* Bigger radio button */
.primary-radio input[type="radio"] {
    width: 22px;
    height: 22px;
    cursor: pointer;
    vertical-align: middle;
}

/* Bigger checkbox */
.delete-image input[type="checkbox"] {
    width: 22px;
    height: 22px;
    cursor: pointer;
    vertical-align: middle;
}

/* Optional: make the text align nicely */
.primary-radio,
.delete-image {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
}


.custom-control.custom-checkbox {
    min-height: 28px;
    display: flex;
    align-items: center;
}

.custom-control.custom-checkbox .custom-control-label {
    padding-left: 10px;
    line-height: 24px;
    cursor: pointer;
}

.custom-control.custom-checkbox .custom-control-label::before,
.custom-control.custom-checkbox .custom-control-label::after {
    width: 24px;
    height: 24px;
    top: 50%;
    transform: translateY(-50%);
     border: 2px solid #000;
}

.custom-control.custom-checkbox .custom-control-label::before {
    left: -1.5rem;
}

.custom-control.custom-checkbox .custom-control-label::after {
    left: -1.5rem;
}

</style>


<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">

          <div class="col-md-12">

            @include('backend.layouts.notification')
            
            
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>
            <i class="fas fa-exclamation-circle"></i>
            Please check the following:
        </strong>

        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


            <div class="card card-primary">

              <div class="card-header">

                <h3 class="card-title">

                  <i class="fas fa-edit"></i>

                  Edit Auto Post

                </h3>


                <a
                  href="{{ route('auto.index') }}"
                  class="btn btn-danger btn-sm float-right">

                  <i class="fas fa-list"></i>

                  Auto Post List

                </a>

              </div>


        <form
            action="{{ route('auto.update', $auto->id) }}"
            method="POST"
            enctype="multipart/form-data">

                @csrf

                @method('PUT')


                <div class="card-body">


                  {{-- VEHICLE --}}

                  <div class="section-title">

                    <i class="fas fa-car-side"></i>

                    Vehicle Information

                  </div>
                  
                  
                  <div class="row">
    <div class="col-md-12">
        <div class="form-group">

            <label for="title">
                Title
                <span class="text-danger">*</span>
            </label>

            <input
                type="text"
                name="title"
                id="title"
                value="{{ old('title', $auto->title ?? '') }}"
                class="form-control @error('title') is-invalid @enderror"
                placeholder="e.g. BMW 320d M Sport"
                maxlength="255"
            >

            @error('title')
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
            @enderror

        </div>
    </div>
</div>


                  <div class="row">


                    <div class="col-md-4">

                      <div class="form-group">

                        <label for="brand_id">

                          Brand
                          <span class="text-danger">*</span>

                        </label>

                      <select
                            name="brand_id"
                            id="brand_id"
                            class="form-control my-select"
                            required>

                            <option value="">Select Brand</option>

                            @foreach($brands as $brand)

                                <option
                                    value="{{ $brand->id }}"
                                    {{ old('brand_id', $auto->brand_id) == $brand->id ? 'selected' : '' }}>

                                    {{ $brand->name }}

                                </option>

                            @endforeach

                        </select>

                      </div>

                    </div>


                    <div class="col-md-4">

                      <div class="form-group">

                        <label for="vehicle_model_id">

                          Vehicle Model
                          <span class="text-danger">*</span>

                        </label>
                          

<select
    name="vehicle_model_id"
    id="vehicle_model_id"
    class="form-control"
    required>

    <option value="">Select Model</option>

    @foreach($models as $model)

        <option
            value="{{ $model->id }}"
            data-brand="{{ $model->brand_id }}"
            {{ old('vehicle_model_id', $auto->vehicle_model_id) == $model->id ? 'selected' : '' }}>

            {{ $model->brand->name ?? '' }} - {{ $model->name }}

        </option>

    @endforeach

</select>

                      </div>

                    </div>


                    <div class="col-md-4">

                      <div class="form-group">

                        <label for="variant">

                          Variant

                        </label>

                        <input
                          type="text"
                          name="variant"
                          id="variant"
                          value="{{ old('variant', $auto->variant) }}"
                          class="form-control">

                      </div>

                    </div>


                    <div class="col-md-4">

                      <div class="form-group">

                        <label for="stock_number">

                          Stock Number

                        </label>

                        <input
                          type="text"
                          name="stock_number"
                          id="stock_number"
                          value="{{ old('stock_number', $auto->stock_number) }}"
                          class="form-control">

                      </div>

                    </div>


                    <div class="col-md-4">

                      <div class="form-group">

                        <label for="vin">

                          VIN

                        </label>

                        <input
                          type="text"
                          name="vin"
                          id="vin"
                          maxlength="17"
                          value="{{ old('vin', $auto->vin) }}"
                          class="form-control">

                      </div>

                    </div>


                    @php
                      $selects = [
                        'body_type_id' => [
                          'label' => 'Body Type',
                          'items' => $bodyTypes,
                          'value' => $auto->body_type_id,
                        ],
                        'fuel_type_id' => [
                          'label' => 'Fuel Type',
                          'items' => $fuelTypes,
                          'value' => $auto->fuel_type_id,
                        ],
                        'transmission_id' => [
                          'label' => 'Transmission',
                          'items' => $transmissions,
                          'value' => $auto->transmission_id,
                        ],
                        'color_id' => [
                          'label' => 'Exterior Color',
                          'items' => $colors,
                          'value' => $auto->color_id,
                        ],
                        'condition_id' => [
                          'label' => 'Vehicle Condition',
                          'items' => $conditions,
                          'value' => $auto->condition_id,
                        ],
                        'emission_class_id' => [
                          'label' => 'Emission Class',
                          'items' => $emissionClasses,
                          'value' => $auto->emission_class_id,
                        ],
                      ];
                    @endphp


                    @foreach($selects as $field => $config)

                      <div class="col-md-4">

                        <div class="form-group ">

                          <label for="{{ $field }}">

                            {{ $config['label'] }}

                          </label>

                          <select
                            name="{{ $field }}"
                            id="{{ $field }}"
                            class="form-control my-select">

                            <option value="">
                              Select {{ $config['label'] }}
                            </option>

                            @foreach($config['items'] as $item)

                              <option
                                value="{{ $item->id }}"
                                {{ old($field, $config['value']) == $item->id ? 'selected' : '' }}>

                                {{ $item->name }}

                              </option>

                            @endforeach

                          </select>

                        </div>

                      </div>

                    @endforeach

                  </div>


                  <hr>


                  {{-- PRICE --}}

                  <div class="section-title">

                    <i class="fas fa-euro-sign"></i>

                    Pricing & Mileage

                  </div>


                  <div class="row">

                    <div class="col-md-4">

                      <div class="form-group">

                        <label for="price">

                          Price
                          <span class="text-danger">*</span>

                        </label>

                        <input
                          type="number"
                          name="price"
                          id="price"
                          step="0.01"
                          min="0"
                          value="{{ old('price', $auto->price) }}"
                          class="form-control"
                          required>

                      </div>

                    </div>


                    <div class="col-md-2">

                      <div class="form-group">

                        <label for="currency">

                          Currency

                        </label>

                        <input
                          type="text"
                          name="currency"
                          id="currency"
                          maxlength="3"
                          value="{{ old('currency', $auto->currency) }}"
                          class="form-control">

                      </div>

                    </div>


                    <div class="col-md-4">

                      <div class="form-group">

                        <label for="mileage">

                          Mileage
                          <span class="text-danger">*</span>

                        </label>

                        <input
                          type="number"
                          name="mileage"
                          id="mileage"
                          min="0"
                          value="{{ old('mileage', $auto->mileage) }}"
                          class="form-control"
                          required>

                      </div>

                    </div>


                    <div class="col-md-2">

                      <div class="form-group">

                        <label for="mileage_unit">

                          Unit

                        </label>

                        <select
                          name="mileage_unit"
                          id="mileage_unit"
                          class="form-control my-select">

                          <option
                            value="km"
                            {{ old('mileage_unit', $auto->mileage_unit) === 'km' ? 'selected' : '' }}>

                            km

                          </option>

                          <option
                            value="mi"
                            {{ old('mileage_unit', $auto->mileage_unit) === 'mi' ? 'selected' : '' }}>

                            mi

                          </option>

                        </select>

                      </div>

                    </div>

                  </div>


                  <hr>


                  {{-- DATE --}}

                  <div class="section-title">

                    <i class="fas fa-calendar-alt"></i>

                    Registration & Inspection

                  </div>


                  <div class="row">

                    <div class="col-md-6">

                      <div class="form-group">

                        <label for="first_registration">

                          First Registration

                        </label>

                        <input
                          type="date"
                          name="first_registration"
                          id="first_registration"
                          value="{{ old('first_registration', optional($auto->first_registration)->format('Y-m-d')) }}"
                          class="form-control">

                      </div>

                    </div>


                    <div class="col-md-6">

                      <div class="form-group">

                        <label for="inspection_date">

                          Inspection / HU-AU Date

                        </label>

                        <input
                          type="date"
                          name="inspection_date"
                          id="inspection_date"
                          value="{{ old('inspection_date', optional($auto->inspection_date)->format('Y-m-d')) }}"
                          class="form-control">

                      </div>

                    </div>

                  </div>


                  <hr>


                  {{-- ENGINE --}}

                  <div class="section-title">

                    <i class="fas fa-cogs"></i>

                    Engine & Performance

                  </div>


                  <div class="row">


                    @foreach([
                      'engine_cc' => 'Engine CC',
                      'engine_size' => 'Engine Size',
                      'power_hp' => 'Power HP',
                      'power_kw' => 'Power kW',
                      'gears' => 'Gears',
                      'drivetrain' => 'Drivetrain',
                      'co2_emissions' => 'CO₂ Emissions'
                    ] as $field => $label)

                      <div class="col-md-3">

                        <div class="form-group">

                          <label for="{{ $field }}">

                            {{ $label }}

                          </label>

                          <input
                            type="{{ in_array($field, ['engine_size', 'drivetrain']) ? 'text' : 'number' }}"
                            name="{{ $field }}"
                            id="{{ $field }}"
                            value="{{ old($field, $auto->{$field}) }}"
                            class="form-control">

                        </div>

                      </div>

                    @endforeach

                  </div>


                  <hr>


                  {{-- GENERAL --}}

                  <div class="section-title">

                    <i class="fas fa-info-circle"></i>

                    General Vehicle Details

                  </div>


                  <div class="row">


                    <div class="col-md-3">

                      <div class="form-group">

                        <label for="doors">

                          Doors

                        </label>

                        <input
                          type="number"
                          name="doors"
                          id="doors"
                          value="{{ old('doors', $auto->doors) }}"
                          class="form-control">

                      </div>

                    </div>


                    <div class="col-md-3">

                      <div class="form-group">

                        <label for="seats">

                          Seats

                        </label>

                        <input
                          type="number"
                          name="seats"
                          id="seats"
                          value="{{ old('seats', $auto->seats) }}"
                          class="form-control">

                      </div>

                    </div>


                    <div class="col-md-6">

                      <div class="form-group">

                        <label for="interior_color">

                          Interior Color

                        </label>

                        <input
                          type="text"
                          name="interior_color"
                          id="interior_color"
                          value="{{ old('interior_color', $auto->interior_color) }}"
                          class="form-control">

                      </div>

                    </div>


                    <div class="col-md-4">

                      <div class="form-group">

                        <label for="previous_owners">

                          Previous Owners

                        </label>

                        <input
                          type="number"
                          name="previous_owners"
                          id="previous_owners"
                          value="{{ old('previous_owners', $auto->previous_owners) }}"
                          class="form-control">

                      </div>

                    </div>

{{-- Accident Free --}}
<div class="col-md-4">

    <div class="form-group">

        <label for="accident_free">
            Accident Free
        </label>

        <select
            name="accident_free"
            id="accident_free"
            class="form-control my-select @error('accident_free') is-invalid @enderror">

            <option value="1"
                {{ old('accident_free', $auto->accident_free) == '1' ? 'selected' : '' }}>
                Yes
            </option>

            <option value="0"
                {{ old('accident_free', $auto->accident_free) == '0' ? 'selected' : '' }}>
                No
            </option>

        </select>

        @error('accident_free')
            <span class="d-block text-danger mt-1">
                {{ $message }}
            </span>
        @enderror

    </div>

</div>


{{-- VAT Deductible --}}
<div class="col-md-4">

    <div class="form-group">

        <label for="vat_deductible">
            VAT Deductible
        </label>

        <select
            name="vat_deductible"
            id="vat_deductible"
            class="form-control my-select @error('vat_deductible') is-invalid @enderror">

            <option value="1"
                {{ old('vat_deductible', $auto->vat_deductible) == '1' ? 'selected' : '' }}>
                Yes
            </option>

            <option value="0"
                {{ old('vat_deductible', $auto->vat_deductible) == '0' ? 'selected' : '' }}>
                No
            </option>

        </select>

        @error('vat_deductible')
            <span class="d-block text-danger mt-1">
                {{ $message }}
            </span>
        @enderror

    </div>

</div>

                  </div>
                  
                  
                  
                  <hr>
                  
                  {{-- IMAGES --}}

<div class="section-title">

    <i class="fas fa-images"></i>

    Vehicle Images

</div>


{{-- EXISTING IMAGES --}}

@if($auto->images->count())

    <div class="existing-images">

        <div class="row">

            @foreach($auto->images as $image)

                <div class="col-md-3 col-sm-6 mb-4">

                    <div
                        class="auto-image-card
                        {{ $image->is_primary ? 'is-primary' : '' }}">

                        <div class="auto-image-wrapper">

                            <img
                                src="{{ asset('autoimages/' . $image->image_path) }}"
                                alt="{{ $image->alt_text }}"
                                class="auto-image">

                        </div>


                        <div class="auto-image-info">

                            @if($image->is_primary)

                                <span class="badge badge-success mb-2">

                                    <i class="fas fa-star"></i>

                                    Primary Image

                                </span>

                            @else

                                <label
                                    class="primary-radio">

                                    <input
                                        type="radio"
                                        name="primary_image"
                                        value="{{ $image->id }}">

                                    <span>

                                        <i class="far fa-star"></i>

                                        Make Primary

                                    </span>

                                </label>

                            @endif


                            <label
                                class="delete-image">

                                <input
                                    type="checkbox"
                                    name="delete_images[]"
                                    value="{{ $image->id }}">

                                <span>

                                    <i class="fas fa-trash"></i>

                                    Delete Image

                                </span>

                            </label>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

@else

    <div class="alert alert-info">

        <i class="fas fa-info-circle"></i>

        No images have been uploaded for this vehicle yet.

    </div>

@endif


{{-- ADD NEW IMAGES --}}

<div class="add-images-box">

    <div class="add-images-title">

        <i class="fas fa-cloud-upload-alt"></i>

        Add More Images

    </div>


    <p class="text-muted">

        Select multiple images at once. JPG, PNG and WebP are supported.
        Maximum 5 MB per image.

    </p>


    <label
        for="images"
        class="image-upload-area">

        <i class="fas fa-images"></i>

        <strong>
            Click here to select images
        </strong>

        <span>
            You can select multiple images
        </span>

    </label>


    <input
        type="file"
        name="images[]"
        id="images"
        class="d-none"
        accept="image/jpeg,image/png,image/webp"
        multiple>
    
    <div
    id="image-error"
    class="alert alert-danger mt-3"
    style="display: none;">
</div>


    <div
        id="image-preview"
        class="row mt-3">
    </div>

</div>





                  <hr>


                  {{-- DESCRIPTION --}}

                  <div class="section-title">

                    <i class="fas fa-align-left"></i>

                    Vehicle Description

                  </div>


                  <div class="form-group">

                    <label for="description">

                      Description

                    </label>

                    <textarea
                      name="description"
                      id="description"
                      rows="8"
                      class="form-control">{{ old('description', $auto->description) }}</textarea>

                  </div>


                  <hr>


                  {{-- FEATURES --}}

                  <div class="section-title">

                    <i class="fas fa-list-check"></i>

                    Equipment & Features

                  </div>


                  @php
                    $selected = old(
                      'features',
                      $selectedFeatures
                    );
                  @endphp


                  @foreach($featureCategories as $category)

                    @if($category->features->count())

                      <div class="feature-group">

                        <div class="feature-group-title">

                          <i class="fas fa-folder-open"></i>

                          {{ $category->name }}

                        </div>


                        <div class="row">

                          @foreach($category->features as $feature)

                            <div class="col-md-4 mb-2">

                              <div class="custom-control custom-checkbox">

                                <input
                                  type="checkbox"
                                  name="features[]"
                                  value="{{ $feature->id }}"
                                  id="feature_{{ $feature->id }}"
                                  class="custom-control-input"
                                  {{ in_array($feature->id, $selected) ? 'checked' : '' }}>

                                <label
                                  class="custom-control-label"
                                  for="feature_{{ $feature->id }}">

                                  {{ $feature->name }}

                                </label>

                              </div>

                            </div>

                          @endforeach

                        </div>

                      </div>

                    @endif

                  @endforeach


                  <hr>  


                  {{-- PUBLISHING --}}

                  <div class="section-title">

                    <i class="fas fa-globe"></i>

                    SEO & Publishing

                  </div>


                  <div class="row">


                    <div class="col-md-8">

                      <div class="form-group">

                        <label for="slug">

                          URL Slug

                        </label>

                        <input
                          type="text"
                          name="slug"
                          id="slug"
                          value="{{ old('slug', $auto->slug) }}"
                          class="form-control">

                      </div>

                    </div>


                    <div class="col-md-4">

                      <div class="form-group">

                        <label for="status">

                          Status
                          <span class="text-danger">*</span>

                        </label>

                        <select
                          name="status"
                          id="status"
                          class="form-control my-select"
                          required>

                          @foreach([
                            'draft' => 'Draft',
                            'published' => 'Published',
                            'inactive' => 'Inactive',
                            'sold' => 'Sold'
                          ] as $value => $label)

                            <option
                              value="{{ $value }}"
                              {{ old('status', $auto->status) === $value ? 'selected' : '' }}>

                              {{ $label }}

                            </option>

                          @endforeach

                        </select>

                      </div>

                    </div>



{{-- Public Visibility --}}
<div class="col-md-6">
    <div class="form-group">

        <label for="public_visibility">
            Public Visibility
        </label>

        <select
            name="is_visible"
            id="public_visibility"
            class="form-control my-select @error('is_visible') is-invalid @enderror"
            required
        >
            <option value="1"
                {{ old('is_visible', $auto->is_visible) == '1' ? 'selected' : '' }}>
                Yes
            </option>

            <option value="0"
                {{ old('is_visible', $auto->is_visible) == '0' ? 'selected' : '' }}>
                No
            </option>
        </select>

        @error('is_visible')
            <span class="d-block text-danger mt-1">
                {{ $message }}
            </span>
        @enderror

    </div>
</div>


{{-- Featured Vehicle --}}
<div class="col-md-6">

    <div class="form-group">

        <label for="is_featured">
            Featured Vehicle
        </label>

        <select
            name="is_featured"
            id="is_featured"
            class="form-control my-select @error('is_featured') is-invalid @enderror">

            <option value="1"
                {{ old('is_featured', $auto->is_featured) == '1' ? 'selected' : '' }}>
                Yes
            </option>

            <option value="0"
                {{ old('is_featured', $auto->is_featured) == '0' ? 'selected' : '' }}>
                No
            </option>

        </select>

        @error('is_featured')
            <span class="d-block text-danger mt-1">
                {{ $message }}
            </span>
        @enderror

    </div>

</div>


                      
                      
                      

                  </div>
                  
                  
                  
                  <div class="row">
    <div class="col-md-12">
        <div class="form-group">

            <label for="meta_title">
                SEO Meta Title
            </label>

            <input
                type="text"
                name="meta_title"
                id="meta_title"
                value="{{ old('meta_title', $auto->meta_title ?? '') }}"
                class="form-control @error('meta_title') is-invalid @enderror"
                placeholder="SEO meta title"
                maxlength="255"
            >

            @error('meta_title')
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
            @enderror

        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="form-group">

            <label for="meta_description">
                SEO Meta Description
            </label>

            <textarea
                name="meta_description"
                id="meta_description"
                class="form-control @error('meta_description') is-invalid @enderror"
                rows="4"
                maxlength="160"
                placeholder="SEO meta description"
            >{{ old('meta_description', $auto->meta_description ?? '') }}</textarea>

            @error('meta_description')
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
            @enderror

        </div>
    </div>
</div>


                </div>


                <div class="card-footer">

                  <button
                    type="submit"
                    class="btn btn-primary" id="update-auto-button">
                      

                    <i class="fas fa-save"></i>

                    Update Auto Post

                  </button>


                  <a
                    href="{{ route('auto.index') }}"
                    class="btn btn-secondary">

                    <i class="fas fa-times"></i>

                    Cancel

                  </a>

                </div>

              </form>

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

    /*
    |--------------------------------------------------------------------------
    | Toggle Switches
    |--------------------------------------------------------------------------
    */

    function setupToggle(
        checkboxId,
        textId
    ) {

        const checkbox =
            document.getElementById(checkboxId);

        const text =
            document.getElementById(textId);

        if (!checkbox || !text) {
            return;
        }

        function update() {

            text.textContent =
                checkbox.checked
                    ? 'Active'
                    : 'Inactive';
        }

        checkbox.addEventListener(
            'change',
            update
        );

        update();
    }


    setupToggle(
        'accident_free',
        'accident-status-text'
    );

    setupToggle(
        'vat_deductible',
        'vat-status-text'
    );

    setupToggle(
        'is_visible',
        'visible-status-text'
    );

    setupToggle(
        'is_featured',
        'featured-status-text'
    );


   /*
|--------------------------------------------------------------------------
| Brand / Model
|--------------------------------------------------------------------------
*/

const brand = document.getElementById('brand_id');
const model = document.getElementById('vehicle_model_id');

if (brand && model) {

    function filterModels(clearInvalidSelection = false) {

        const brandId = brand.value;

        Array.from(model.options).forEach(function (option) {

            // Always show placeholder
            if (!option.value) {
                option.hidden = false;
                return;
            }

            // Show only models belonging to selected brand
            option.hidden = option.dataset.brand !== brandId;
        });

        /*
        |--------------------------------------------------------------------------
        | Clear model only when the user changes the Brand
        |--------------------------------------------------------------------------
        */
        if (clearInvalidSelection) {

            const selected = model.options[model.selectedIndex];

            if (
                selected &&
                selected.value &&
                selected.dataset.brand !== brandId
            ) {
                model.value = '';
            }
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Initial page load
    |--------------------------------------------------------------------------
    |
    | Do NOT clear the existing model here.
    |
    */
    filterModels(false);


    /*
    |--------------------------------------------------------------------------
    | When user changes Brand
    |--------------------------------------------------------------------------
    */
    brand.addEventListener('change', function () {

        filterModels(true);

    });

}

    /*
    |--------------------------------------------------------------------------
    | Status / Visibility
    |--------------------------------------------------------------------------
    */

    const status =
        document.getElementById('status');

    const visible =
        document.getElementById('is_visible');

    if (status && visible) {

        function updateVisibilityState() {

            if (
                status.value === 'draft' ||
                status.value === 'inactive'
            ) {

                visible.checked = false;

                visible.disabled = true;

                visible.dispatchEvent(
                    new Event('change')
                );

            } else {

                visible.disabled = false;

            }
        }


        status.addEventListener(
            'change',
            updateVisibilityState
        );

        updateVisibilityState();
    }


    /*
    |--------------------------------------------------------------------------
    | IMAGE UPLOAD
    |--------------------------------------------------------------------------
    */

    const imageInput =
        document.getElementById('images');

    const imagePreview =
        document.getElementById('image-preview');

    const imageError =
        document.getElementById('image-error');

    const submitButton =
        document.getElementById('update-auto-button');

    const autoForm =
        imageInput
            ? imageInput.closest('form')
            : null;


    /*
    |--------------------------------------------------------------------------
    | Maximum Image Size
    |--------------------------------------------------------------------------
    */

    const MAX_FILE_SIZE =
        5 * 1024 * 1024; // 5 MB


    /*
    |--------------------------------------------------------------------------
    | Button State
    |--------------------------------------------------------------------------
    */

    function enableSubmitButton() {

        if (!submitButton) {
            return;
        }

        submitButton.disabled = false;

        submitButton.classList.remove(
            'disabled'
        );
    }


    function disableSubmitButton() {

        if (!submitButton) {
            return;
        }

        submitButton.disabled = true;

        submitButton.classList.add(
            'disabled'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Show Image Error
    |--------------------------------------------------------------------------
    */

    function showImageError(message) {

        if (!imageError) {
            return;
        }

        imageError.innerHTML =
            '<i class="fas fa-exclamation-circle"></i> ' +
            message;

        imageError.style.display =
            'block';
    }


    /*
    |--------------------------------------------------------------------------
    | Hide Image Error
    |--------------------------------------------------------------------------
    */

    function hideImageError() {

        if (!imageError) {
            return;
        }

        imageError.innerHTML = '';

        imageError.style.display =
            'none';
    }


    /*
    |--------------------------------------------------------------------------
    | Validate Selected Images
    |--------------------------------------------------------------------------
    */

    function validateImages() {

        if (!imageInput) {
            return true;
        }

        const files =
            Array.from(imageInput.files);


        /*
         * No new images selected
         *
         * This is completely valid on Edit page.
         */
        if (files.length === 0) {

            hideImageError();

            enableSubmitButton();

            return true;
        }


        /*
         * Check every image
         */
        for (const file of files) {

            /*
             * Check file size
             */
            if (file.size > MAX_FILE_SIZE) {

                const fileSize =
                    (
                        file.size /
                        (1024 * 1024)
                    ).toFixed(2);


                showImageError(
                    '<strong>' +
                    file.name +
                    '</strong> is too large. ' +
                    'Maximum allowed size is 5 MB. ' +
                    'This file is ' +
                    fileSize +
                    ' MB.'
                );


                /*
                 * IMPORTANT:
                 * Disable submit button
                 */
                disableSubmitButton();


                return false;
            }


            /*
             * Check file type
             */
            if (
                ![
                    'image/jpeg',
                    'image/png',
                    'image/webp'
                ].includes(file.type)
            ) {

                showImageError(
                    '<strong>' +
                    file.name +
                    '</strong> is not a supported image type. ' +
                    'Please select JPG, PNG or WebP.'
                );


                disableSubmitButton();


                return false;
            }

        }


        /*
         * Everything is valid
         */
        hideImageError();

        enableSubmitButton();

        return true;
    }


    /*
    |--------------------------------------------------------------------------
    | Image Preview
    |--------------------------------------------------------------------------
    */

    function showImagePreview() {

        if (!imagePreview || !imageInput) {
            return;
        }

        imagePreview.innerHTML = '';


        const files =
            Array.from(imageInput.files);


        files.forEach(function (file) {

            if (!file.type.startsWith('image/')) {
                return;
            }


            const reader =
                new FileReader();


            reader.onload =
                function (event) {

                    const col =
                        document.createElement('div');


                    col.className =
                        'col-md-3 col-sm-6 mb-3';


                    col.innerHTML = `
                        <div class="new-image-preview">

                            <img
                                src="${event.target.result}"
                                alt="New image">

                            <div class="new-image-name">
                                ${file.name}
                            </div>

                        </div>
                    `;


                    imagePreview.appendChild(
                        col
                    );

                };


            reader.readAsDataURL(file);

        });
    }


    /*
    |--------------------------------------------------------------------------
    | User Selects Images
    |--------------------------------------------------------------------------
    */

    if (imageInput) {

        imageInput.addEventListener(
            'change',
            function () {

                /*
                 * First validate
                 */
                const valid =
                    validateImages();


                /*
                 * Do not show preview
                 * if there is an invalid image
                 */
                if (!valid) {

                    if (imagePreview) {
                        imagePreview.innerHTML = '';
                    }

                    return;
                }


                /*
                 * Show preview
                 */
                showImagePreview();

            }
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Prevent Form Submit
    |--------------------------------------------------------------------------
    */

    if (autoForm) {

        autoForm.addEventListener(
            'submit',
            function (event) {

                /*
                 * Check images one more time
                 */
                if (!validateImages()) {

                    event.preventDefault();


                    /*
                     * Scroll to error
                     */
                    if (imageError) {

                        imageError.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });

                    }

                    return false;
                }

            }
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Initial State
    |--------------------------------------------------------------------------
    */

    enableSubmitButton();

});

</script>

@endsection