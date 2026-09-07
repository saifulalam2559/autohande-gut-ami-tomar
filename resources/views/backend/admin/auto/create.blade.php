```blade
@extends('backend.layouts.master')

@section('content')

<style>

/* ==========================================================
   AutoHouse Professional Toggle
   ========================================================== */

.auto-switch {
    padding-left: 0 !important;
    min-height: 30px;
}

.auto-switch .custom-control-label::before {
    width: 58px;
    height: 30px;
    top: 0;
    left: 0;
    border-radius: 30px;
    cursor: pointer;
}

.auto-switch .custom-control-label::after {
    width: 24px;
    height: 24px;
    top: 3px;
    left: 3px;
    border-radius: 50%;
    cursor: pointer;
}

.auto-switch
.custom-control-input:checked
~ .custom-control-label::after {
    transform: translateX(28px);
}

.auto-switch-label {
    display: inline-flex;
    min-width: 70px;
    height: 30px;
    align-items: center;
    justify-content: flex-start;
    font-size: 15px;
    font-weight: 600;
    line-height: 1;
    cursor: pointer;
}

/* ==========================================================
   Form
   ========================================================== */

.form-control {
    border: 1px solid #333 !important;
    box-shadow: none !important;
}

.form-control:focus {
    border-color: #333 !important;
    box-shadow: 0 0 0 0.1rem rgba(0, 0, 0, 0.08) !important;
}

.section-title {
    font-size: 17px;
    font-weight: 700;
    margin-bottom: 18px;
}

.feature-group {
    border: 1px solid #161515;
    border-radius: 6px;
    padding: 15px;
    margin-bottom: 15px;
    background: #fafafa;
}

.feature-group-title {
    font-weight: 700;
    font-size: 15px;
    margin-bottom: 12px;
}

/* ==========================================================
   Validation
   ========================================================== */

.validation-summary {
    border-left: 4px solid #dc3545;
}

.validation-summary ul {
    margin-bottom: 0;
    padding-left: 20px;
}

.invalid-feedback {
    display: block;
}

.custom-control-input.is-invalid ~ .custom-control-label {
    color: #dc3545;
}

.feature-error {
    color: #dc3545;
    font-size: 80%;
    margin-top: 5px;
}


/* ==========================================================
   Vehicle Image Upload
   ========================================================== */

.image-upload-box {
    width: 100%;
}

.image-upload-label {
    border: 2px dashed #aaa;
    border-radius: 8px;
    min-height: 180px;
    padding: 30px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    background: #fafafa;
    transition: all 0.2s ease;
    text-align: center;
}

.image-upload-label:hover {
    border-color: #007bff;
    background: #f5f9ff;
}

.image-upload-label i {
    font-size: 42px;
    margin-bottom: 12px;
    color: #007bff;
}

.image-upload-label strong {
    font-size: 17px;
}

.image-upload-label span {
    margin-top: 5px;
    color: #666;
}

.image-upload-label small {
    margin-top: 8px;
    color: #888;
}


/* ==========================================================
   Image Preview
   ========================================================== */

.image-preview-item {
    position: relative;
    margin-bottom: 15px;
}

.image-preview-card {
    position: relative;
    border: 1px solid #ddd;
    border-radius: 6px;
    overflow: hidden;
    background: #fff;
}

.image-preview-card img {
    width: 100%;
    height: auto;
    object-fit: cover;
    display: block;
}

.image-preview-primary {
    position: absolute;
    top: 8px;
    left: 8px;
    background: #007bff;
    color: #fff;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 600;
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
            
            
            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
            @endif


            <div class="card card-primary">

              {{-- HEADER --}}

              <div class="card-header">

                <h3 class="card-title">

                  <i class="fas fa-car"></i>

                  Create Auto Post

                </h3>


                <a
                  href="{{ route('auto.index') }}"
                  class="btn btn-danger btn-sm float-right">

                  <i class="fas fa-list"></i>

                  Auto Post List

                </a>

              </div>


              {{-- ==========================================================
                   VALIDATION ERROR SUMMARY
              =========================================================== --}}

              @if($errors->any())

                <div class="card-body pb-0">

                  <div class="alert alert-danger validation-summary">

                    <h5 class="mb-2">

                      <i class="fas fa-exclamation-triangle"></i>

                      Please correct the following errors:

                    </h5>

                    <ul>

                      @foreach($errors->all() as $error)

                        <li>
                          {{ $error }}
                        </li>

                      @endforeach

                    </ul>

                  </div>

                </div>

              @endif


            <form
                action="{{ route('auto.store') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf


                <div class="card-body">


                  {{-- =====================================================
                       VEHICLE
                  ====================================================== --}}

                  <div class="section-title">

                    <i class="fas fa-car-side"></i>

                    Vehicle Information

                  </div>
                  
                  <div class="row">
                      
                     <div class="col-md-12">

                      <div class="form-group">

                        <label for="brand_id">

                          Title
                          <span class="text-danger">*</span>

                        </label>
                          
                       <input
                          type="text"
                          name="title"
                          id="title"
                          value="{{ old('title') }}"
                          class="form-control @error('title') is-invalid @enderror"
                          placeholder="e.g. Title">

                        @error('title')

                          <span class="invalid-feedback">
                            {{ $message }}
                          </span>

                        @enderror
                      
                      </div>
                    </div>
                   </div>

                  <div class="row">


                    {{-- Brand --}}
                    <div class="col-md-4">

                      <div class="form-group">

                        <label for="brand_id">

                          Brand
                          <span class="text-danger">*</span>

                        </label>

                        <select
                          name="brand_id"
                          id="brand_id"
                          class="form-control my-select @error('brand_id') is-invalid @enderror"
                          required>

                          <option value="">
                            Select Brand
                          </option>

                          @foreach($brands as $brand)

                            <option
                              value="{{ $brand->id }}"
                              {{ old('brand_id') == $brand->id ? 'selected' : '' }}>

                              {{ $brand->name }}

                            </option>

                          @endforeach

                        </select>

                        @error('brand_id')

                          <span class="invalid-feedback">
                            {{ $message }}
                          </span>

                        @enderror

                      </div>

                    </div>


                    {{-- Model --}}
                    <div class="col-md-4">

                      <div class="form-group">

                        <label for="vehicle_model_id">

                          Vehicle Model
                          <span class="text-danger">*</span>

                        </label>

                        <select
                          name="vehicle_model_id"
                          id="vehicle_model_id"
                          class="form-control my-select @error('vehicle_model_id') is-invalid @enderror"
                          required>

                          <option value="">
                            Select Model
                          </option>

                          @foreach($models as $model)

                            <option
                              value="{{ $model->id }}"
                              data-brand="{{ $model->brand_id }}"
                              {{ old('vehicle_model_id') == $model->id ? 'selected' : '' }}>

                              {{ $model->brand->name ?? '' }}
                              -
                              {{ $model->name }}

                            </option>

                          @endforeach

                        </select>

                        @error('vehicle_model_id')

                          <span class="invalid-feedback">
                            {{ $message }}
                          </span>

                        @enderror

                      </div>

                    </div>


                    {{-- Variant --}}
                    <div class="col-md-4">

                      <div class="form-group">

                        <label for="variant">
                          Variant
                        </label>

                        <input
                          type="text"
                          name="variant"
                          id="variant"
                          value="{{ old('variant') }}"
                          class="form-control @error('variant') is-invalid @enderror"
                          placeholder="e.g. M Sport">

                        @error('variant')

                          <span class="invalid-feedback">
                            {{ $message }}
                          </span>

                        @enderror

                      </div>

                    </div>


                    {{-- Stock --}}
                    <div class="col-md-4">

                      <div class="form-group">

                        <label for="stock_number">
                          Stock Number
                        </label>

                        <input
                          type="text"
                          name="stock_number"
                          id="stock_number"
                          value="{{ old('stock_number') }}"
                          class="form-control @error('stock_number') is-invalid @enderror"
                          placeholder="e.g. AH-10025">

                        @error('stock_number')

                          <span class="invalid-feedback">
                            {{ $message }}
                          </span>

                        @enderror

                      </div>

                    </div>


                    {{-- VIN --}}
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
                          value="{{ old('vin') }}"
                          class="form-control @error('vin') is-invalid @enderror"
                          placeholder="17-character VIN">

                        @error('vin')

                          <span class="invalid-feedback">
                            {{ $message }}
                          </span>

                        @enderror

                      </div>

                    </div>


                    {{-- Body Type --}}
                    <div class="col-md-4">

                      <div class="form-group">

                        <label for="body_type_id">
                          Body Type
                        </label>

                        <select
                          name="body_type_id"
                          id="body_type_id"
                          class="form-control my-select @error('body_type_id') is-invalid @enderror">

                          <option value="">
                            Select Body Type
                          </option>

                          @foreach($bodyTypes as $item)

                            <option
                              value="{{ $item->id }}"
                              {{ old('body_type_id') == $item->id ? 'selected' : '' }}>

                              {{ $item->name }}

                            </option>

                          @endforeach

                        </select>

                        @error('body_type_id')

                          <span class="invalid-feedback">
                            {{ $message }}
                          </span>

                        @enderror

                      </div>

                    </div>


                    {{-- Fuel --}}
                    <div class="col-md-4">

                      <div class="form-group">

                        <label for="fuel_type_id">
                          Fuel Type
                        </label>

                        <select
                          name="fuel_type_id"
                          id="fuel_type_id"
                          class="form-control my-select @error('fuel_type_id') is-invalid @enderror">

                          <option value="">
                            Select Fuel Type
                          </option>

                          @foreach($fuelTypes as $item)

                            <option
                              value="{{ $item->id }}"
                              {{ old('fuel_type_id') == $item->id ? 'selected' : '' }}>

                              {{ $item->name }}

                            </option>

                          @endforeach

                        </select>

                        @error('fuel_type_id')

                          <span class="invalid-feedback">
                            {{ $message }}
                          </span>

                        @enderror

                      </div>

                    </div>


                    {{-- Transmission --}}
                    <div class="col-md-4">

                      <div class="form-group">

                        <label for="transmission_id">
                          Transmission
                        </label>

                        <select
                          name="transmission_id"
                          id="transmission_id"
                          class="form-control my-select @error('transmission_id') is-invalid @enderror">

                          <option value="">
                            Select Transmission
                          </option>

                          @foreach($transmissions as $item)

                            <option
                              value="{{ $item->id }}"
                              {{ old('transmission_id') == $item->id ? 'selected' : '' }}>

                              {{ $item->name }}

                            </option>

                          @endforeach

                        </select>

                        @error('transmission_id')

                          <span class="invalid-feedback">
                            {{ $message }}
                          </span>

                        @enderror

                      </div>

                    </div>


                    {{-- Color --}}
                    <div class="col-md-4">

                      <div class="form-group">

                        <label for="color_id">
                          Exterior Color
                        </label>

                        <select
                          name="color_id"
                          id="color_id"
                          class="form-control my-select @error('color_id') is-invalid @enderror">

                          <option value="">
                            Select Color
                          </option>

                          @foreach($colors as $item)

                            <option
                              value="{{ $item->id }}"
                              {{ old('color_id') == $item->id ? 'selected' : '' }}>

                              {{ $item->name }}

                            </option>

                          @endforeach

                        </select>

                        @error('color_id')

                          <span class="invalid-feedback">
                            {{ $message }}
                          </span>

                        @enderror

                      </div>

                    </div>


                    {{-- Condition --}}
                    <div class="col-md-4">

                      <div class="form-group">

                        <label for="condition_id">
                          Vehicle Condition
                        </label>

                        <select
                          name="condition_id"
                          id="condition_id"
                          class="form-control my-select @error('condition_id') is-invalid @enderror">

                          <option value="">
                            Select Condition
                          </option>

                          @foreach($conditions as $item)

                            <option
                              value="{{ $item->id }}"
                              {{ old('condition_id') == $item->id ? 'selected' : '' }}>

                              {{ $item->name }}

                            </option>

                          @endforeach

                        </select>

                        @error('condition_id')

                          <span class="invalid-feedback">
                            {{ $message }}
                          </span>

                        @enderror

                      </div>

                    </div>


                    {{-- Emission --}}
                    <div class="col-md-4">

                      <div class="form-group">

                        <label for="emission_class_id">
                          Emission Class
                        </label>

                        <select
                          name="emission_class_id"
                          id="emission_class_id"
                          class="form-control my-select @error('emission_class_id') is-invalid @enderror">

                          <option value="">
                            Select Emission Class
                          </option>

                          @foreach($emissionClasses as $item)

                            <option
                              value="{{ $item->id }}"
                              {{ old('emission_class_id') == $item->id ? 'selected' : '' }}>

                              {{ $item->name }}

                            </option>

                          @endforeach

                        </select>

                        @error('emission_class_id')

                          <span class="invalid-feedback">
                            {{ $message }}
                          </span>

                        @enderror

                      </div>

                    </div>

                  </div>


                  <hr>


                  {{-- =====================================================
                       PRICE
                  ====================================================== --}}

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
                          value="{{ old('price') }}"
                          class="form-control @error('price') is-invalid @enderror"
                          placeholder="0.00"
                          required>

                        @error('price')

                          <span class="invalid-feedback">
                            {{ $message }}
                          </span>

                        @enderror

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
                          value="{{ old('currency', 'EUR') }}"
                          class="form-control @error('currency') is-invalid @enderror">

                        @error('currency')

                          <span class="invalid-feedback">
                            {{ $message }}
                          </span>

                        @enderror

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
                          value="{{ old('mileage', 0) }}"
                          class="form-control @error('mileage') is-invalid @enderror"
                          required>

                        @error('mileage')

                          <span class="invalid-feedback">
                            {{ $message }}
                          </span>

                        @enderror

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
                          class="form-control my-select @error('mileage_unit') is-invalid @enderror">

                          <option
                            value="km"
                            {{ old('mileage_unit', 'km') === 'km' ? 'selected' : '' }}>

                            km

                          </option>

                          <option
                            value="mi"
                            {{ old('mileage_unit') === 'mi' ? 'selected' : '' }}>

                            mi

                          </option>

                        </select>

                        @error('mileage_unit')

                          <span class="invalid-feedback">
                            {{ $message }}
                          </span>

                        @enderror

                      </div>

                    </div>

                  </div>


                  <hr>


                  {{-- =====================================================
                       DATES
                  ====================================================== --}}

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
                          value="{{ old('first_registration') }}"
                          class="form-control @error('first_registration') is-invalid @enderror">

                        @error('first_registration')

                          <span class="invalid-feedback">
                            {{ $message }}
                          </span>

                        @enderror

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
                          value="{{ old('inspection_date') }}"
                          class="form-control @error('inspection_date') is-invalid @enderror">

                        @error('inspection_date')

                          <span class="invalid-feedback">
                            {{ $message }}
                          </span>

                        @enderror

                      </div>

                    </div>

                  </div>


                  <hr>


                  {{-- =====================================================
                       ENGINE
                  ====================================================== --}}

                  <div class="section-title">

                    <i class="fas fa-cogs"></i>

                    Engine & Performance

                  </div>


                  <div class="row">


                    <div class="col-md-3">

                      <div class="form-group">

                        <label for="engine_cc">
                          Engine CC
                        </label>

                        <input
                          type="number"
                          name="engine_cc"
                          id="engine_cc"
                          min="0"
                          value="{{ old('engine_cc') }}"
                          class="form-control @error('engine_cc') is-invalid @enderror">

                        @error('engine_cc')

                          <span class="invalid-feedback">
                            {{ $message }}
                          </span>

                        @enderror

                      </div>

                    </div>


                    <div class="col-md-3">

                      <div class="form-group">

                        <label for="engine_size">
                          Engine Size
                        </label>

                        <input
                          type="text"
                          name="engine_size"
                          id="engine_size"
                          value="{{ old('engine_size') }}"
                          class="form-control @error('engine_size') is-invalid @enderror"
                          placeholder="e.g. 2.0 L">

                        @error('engine_size')

                          <span class="invalid-feedback">
                            {{ $message }}
                          </span>

                        @enderror

                      </div>

                    </div>


                    <div class="col-md-3">

                      <div class="form-group">

                        <label for="power_hp">
                          Power HP
                        </label>

                        <input
                          type="number"
                          name="power_hp"
                          id="power_hp"
                          min="0"
                          value="{{ old('power_hp') }}"
                          class="form-control @error('power_hp') is-invalid @enderror">

                        @error('power_hp')

                          <span class="invalid-feedback">
                            {{ $message }}
                          </span>

                        @enderror

                      </div>

                    </div>


                    <div class="col-md-3">

                      <div class="form-group">

                        <label for="power_kw">
                          Power kW
                        </label>

                        <input
                          type="number"
                          name="power_kw"
                          id="power_kw"
                          min="0"
                          value="{{ old('power_kw') }}"
                          class="form-control @error('power_kw') is-invalid @enderror">

                        @error('power_kw')

                          <span class="invalid-feedback">
                            {{ $message }}
                          </span>

                        @enderror

                      </div>

                    </div>


                    <div class="col-md-3">

                      <div class="form-group">

                        <label for="gears">
                          Gears
                        </label>

                        <input
                          type="number"
                          name="gears"
                          id="gears"
                          min="0"
                          value="{{ old('gears') }}"
                          class="form-control @error('gears') is-invalid @enderror">

                        @error('gears')

                          <span class="invalid-feedback">
                            {{ $message }}
                          </span>

                        @enderror

                      </div>

                    </div>


                    <div class="col-md-5">

                      <div class="form-group">

                        <label for="drivetrain">
                          Drivetrain
                        </label>

                        <input
                          type="text"
                          name="drivetrain"
                          id="drivetrain"
                          value="{{ old('drivetrain') }}"
                          class="form-control @error('drivetrain') is-invalid @enderror"
                          placeholder="e.g. Front Wheel Drive">

                        @error('drivetrain')

                          <span class="invalid-feedback">
                            {{ $message }}
                          </span>

                        @enderror

                      </div>

                    </div>


                    <div class="col-md-4">

                      <div class="form-group">

                        <label for="co2_emissions">
                          CO₂ Emissions
                        </label>

                        <input
                          type="number"
                          name="co2_emissions"
                          id="co2_emissions"
                          min="0"
                          value="{{ old('co2_emissions') }}"
                          class="form-control @error('co2_emissions') is-invalid @enderror"
                          placeholder="g/km">

                        @error('co2_emissions')

                          <span class="invalid-feedback">
                            {{ $message }}
                          </span>

                        @enderror

                      </div>

                    </div>

                  </div>


                  <hr>


                  {{-- =====================================================
                       GENERAL
                  ====================================================== --}}

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
                          min="1"
                          max="20"
                          value="{{ old('doors') }}"
                          class="form-control @error('doors') is-invalid @enderror">

                        @error('doors')

                          <span class="invalid-feedback">
                            {{ $message }}
                          </span>

                        @enderror

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
                          min="1"
                          max="50"
                          value="{{ old('seats') }}"
                          class="form-control @error('seats') is-invalid @enderror">

                        @error('seats')

                          <span class="invalid-feedback">
                            {{ $message }}
                          </span>

                        @enderror

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
                          value="{{ old('interior_color') }}"
                          class="form-control @error('interior_color') is-invalid @enderror">

                        @error('interior_color')

                          <span class="invalid-feedback">
                            {{ $message }}
                          </span>

                        @enderror

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
                          min="0"
                          value="{{ old('previous_owners') }}"
                          class="form-control @error('previous_owners') is-invalid @enderror">

                        @error('previous_owners')

                          <span class="invalid-feedback">
                            {{ $message }}
                          </span>

                        @enderror

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

            <option value="">Select</option>

            <option value="1"
                {{ old('accident_free') == '1' ? 'selected' : '' }}>
                Yes
            </option>

            <option value="0"
                {{ old('accident_free') == '0' ? 'selected' : '' }}>
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


{{-- VAT --}}
<div class="col-md-4">

    <div class="form-group">

        <label for="vat_deductible">
            VAT Deductible
        </label>

        <select
            name="vat_deductible"
            id="vat_deductible"
            class="form-control my-select @error('vat_deductible') is-invalid @enderror">

            <option value="">Select</option>

            <option value="1"
                {{ old('vat_deductible') == '1' ? 'selected' : '' }}>
                Yes
            </option>

            <option value="0"
                {{ old('vat_deductible') == '0' ? 'selected' : '' }}>
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

{{-- =====================================================
     VEHICLE IMAGES
====================================================== --}}

<div class="section-title">

    <i class="fas fa-images"></i>

    Vehicle Images

</div>

<div class="form-group">

    <label for="images">

        Vehicle Photos

        <span class="text-danger">*</span>

    </label>

<div class="image-upload-box">

    <input
        type="file"
        name="images[]"
        id="images"
        class="d-none @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror"
        accept="image/jpeg,image/png,image/webp"
        multiple>

    <label
        for="images"
        class="image-upload-label">

        <i class="fas fa-cloud-upload-alt"></i>

        <strong>Select Vehicle Images</strong>

        <span>
            Click here to select multiple photos
        </span>

        <small>
            JPG, PNG or WebP — Maximum 5 MB per image
        </small>

    </label>

</div>

<div
    id="image-error"
    class="alert alert-danger mt-3"
    style="display: none;">
</div>

    @error('images')

        <span class="d-block text-danger mt-2">
            {{ $message }}
        </span>

    @enderror

    @error('images.*')

        <span class="d-block text-danger mt-2">
            {{ $message }}
        </span>

    @enderror

</div>

<div
    id="image-preview"
    class="row"
    style="display:none;">
</div>

<div class="alert alert-info mt-3">

    <i class="fas fa-info-circle"></i>

    <strong>Tip:</strong>
    The first selected image will automatically become the
    primary vehicle image.

</div>
 <hr>

                  {{-- =====================================================
                       DESCRIPTION
                  ====================================================== --}}

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
                      class="form-control @error('description') is-invalid @enderror"
                      placeholder="Enter the complete vehicle description...">{{ old('description') }}</textarea>

                    @error('description')

                      <span class="invalid-feedback">
                        {{ $message }}
                      </span>

                    @enderror

                  </div>


                  <hr>


                  {{-- =====================================================
                       FEATURES
                  ====================================================== --}}

                  <div class="section-title">

                    <i class="fas fa-list-check"></i>

                    Equipment & Features

                  </div>


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
                                  {{ in_array(
                                      $feature->id,
                                      old('features', [])
                                  ) ? 'checked' : '' }}>

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


                  @error('features')

                    <div class="feature-error">

                      <i class="fas fa-exclamation-circle"></i>

                      {{ $message }}

                    </div>

                  @enderror


                  @error('features.*')

                    <div class="feature-error">

                      <i class="fas fa-exclamation-circle"></i>

                      {{ $message }}

                    </div>

                  @enderror


                  <hr>


                  {{-- =====================================================
                       SEO / STATUS
                  ====================================================== --}}

                  <div class="section-title">

                    <i class="fas fa-globe"></i>

                    SEO & Publishing

                  </div>


                  <div class="row">


                    {{-- Slug --}}
                    <div class="col-md-8">

                      <div class="form-group">

                        <label for="slug">
                          URL Slug
                        </label>

                        <input
                          type="text"
                          name="slug"
                          id="slug"
                          value="{{ old('slug') }}"
                          class="form-control @error('slug') is-invalid @enderror"
                          placeholder="Leave empty to generate automatically">

                        @error('slug')

                          <span class="invalid-feedback">
                            {{ $message }}
                          </span>

                        @enderror

                      </div>

                    </div>


                    {{-- Status --}}
                    <div class="col-md-4">

                      <div class="form-group">

                        <label for="status">

                          Status
                          <span class="text-danger">*</span>

                        </label>

                        <select
                          name="status"
                          id="status"
                          class="form-control my-select @error('status') is-invalid @enderror"
                          required>

                          <option
                            value="draft"
                            {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>

                            Draft

                          </option>

                          <option
                            value="published"
                            {{ old('status') === 'published' ? 'selected' : '' }}>

                            Published

                          </option>

                          <option
                            value="inactive"
                            {{ old('status') === 'inactive' ? 'selected' : '' }}>

                            Inactive

                          </option>

                          <option
                            value="sold"
                            {{ old('status') === 'sold' ? 'selected' : '' }}>

                            Sold

                          </option>

                        </select>

                        @error('status')

                          <span class="invalid-feedback">
                            {{ $message }}
                          </span>

                        @enderror

                      </div>

                    </div>


{{-- Visibility --}}
<div class="col-md-6">

    <div class="form-group">

        <label for="is_visible">
            Public Visibility
        </label>

        <select
            name="is_visible"
            id="is_visibleXX"
            class="form-control my-select @error('is_visible') is-invalid @enderror">

            <option value="">Select</option>

            <option value="1"
                {{ old('is_visible') == '1' ? 'selected' : '' }}>
                Yes
            </option>

            <option value="0"
                {{ old('is_visible') == '0' ? 'selected' : '' }}>
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


{{-- Featured --}}
<div class="col-md-6">

    <div class="form-group">

        <label for="is_featured">
            Featured Vehicle
        </label>

        <select
            name="is_featured"
            id="is_featured"
            class="form-control my-select  @error('is_featured') is-invalid @enderror">

            <option value="">Select</option>

            <option value="1"
                {{ old('is_featured') == '1' ? 'selected' : '' }}>
                Yes
            </option>

            <option value="0"
                {{ old('is_featured') == '0' ? 'selected' : '' }}>
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

                        <label for="brand_id">

                          SEO Meta Title
                          <span class="text-danger">*</span>

                        </label>
                          
                            <input
                                type="text"
                                name="meta_title"
                                id="meta_title"
                                class="form-control @error('meta_title') is-invalid @enderror"
                                value="{{ old('meta_title', $auto->meta_title ?? '') }}"
                                maxlength="255"
                            >

                            @error('meta_title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                      
                      </div>
                    </div>
                   </div>
                  
                  
                     <div class="row">
                      
                     <div class="col-md-12">

                      <div class="form-group">

                        <label for="brand_id">

                          SEO Meta Description
                          <span class="text-danger">*</span>

                        </label>
                          
                            <textarea
                                name="meta_description"
                                id="meta_description"
                                class="form-control @error('meta_description') is-invalid @enderror"
                                rows="4"
                                maxlength="160"
                            >{{ old('meta_description', $auto->meta_description ?? '') }}</textarea>

                            @error('meta_description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                      
                      </div>
                    </div>
                   </div>

                  
                  
                  
                  
                  
                  
                  

                </div>
                   


                <div class="card-footer">

                    <button
                        type="submit"
                        id="create-auto-button"
                        class="btn btn-primary">

                        <i class="fas fa-save"></i>

                        Create Auto Post

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
    | Brand / Model Filter
    |--------------------------------------------------------------------------
    */

    const brand =
        document.getElementById('brand_id');

    const model =
        document.getElementById('vehicle_model_id');

    if (brand && model) {

        function filterModels() {

            const brandId =
                brand.value;

            Array.from(
                model.options
            ).forEach(function (option) {

                if (!option.value) {

                    option.hidden = false;

                    return;
                }

                option.hidden =
                    option.dataset.brand !== brandId;

            });


            const selected =
                model.options[model.selectedIndex];


            if (
                selected &&
                selected.hidden
            ) {

                model.value = '';

            }

        }


        brand.addEventListener(
            'change',
            filterModels
        );

        filterModels();
    }


    /*
    |--------------------------------------------------------------------------
    | Draft / Inactive Visibility
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
        document.getElementById('create-auto-button');

    const autoForm =
        imageInput
            ? imageInput.closest('form')
            : null;


    /*
    |--------------------------------------------------------------------------
    | Image Rules
    |--------------------------------------------------------------------------
    */

    const MAX_FILE_SIZE =
        5 * 1024 * 1024; // 5 MB

    const ALLOWED_TYPES = [
        'image/jpeg',
        'image/png',
        'image/webp'
    ];


    /*
    |--------------------------------------------------------------------------
    | Submit Button
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
    | Image Error
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
    | Validate Images
    |--------------------------------------------------------------------------
    */

    function validateImages() {

        if (!imageInput) {
            return true;
        }


        const files =
            Array.from(imageInput.files);


        /*
         * No files selected
         *
         * Create page normally requires images
         * through Laravel validation.
         */
        if (files.length === 0) {

            hideImageError();

            enableSubmitButton();

            return true;
        }


        /*
         * Validate every selected image
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


                disableSubmitButton();

                return false;
            }


            /*
             * Check file type
             */
            if (
                !ALLOWED_TYPES.includes(
                    file.type
                )
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

        if (
            !imagePreview ||
            !imageInput
        ) {
            return;
        }


        imagePreview.innerHTML = '';


        const files =
            Array.from(imageInput.files);


        if (!files.length) {

            imagePreview.style.display =
                'none';

            return;
        }


        imagePreview.style.display =
            'flex';


        files.forEach(function (file, index) {

            if (
                !ALLOWED_TYPES.includes(
                    file.type
                )
            ) {
                return;
            }


            const reader =
                new FileReader();


            reader.onload =
                function (event) {

                    const col =
                        document.createElement('div');


                    col.className =
                        'col-md-3 image-preview-item';


                    col.innerHTML = `

                        <div class="image-preview-card">

                            <img
                                src="${event.target.result}"
                                alt="Vehicle image">

                            ${
                                index === 0
                                    ? `
                                        <span class="image-preview-primary">
                                            <i class="fas fa-star"></i>
                                            Primary
                                        </span>
                                      `
                                    : ''
                            }

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
    | Image Selection
    |--------------------------------------------------------------------------
    */

    if (imageInput) {

        imageInput.addEventListener(
            'change',
            function () {

                /*
                 * Validate first
                 */
                const valid =
                    validateImages();


                /*
                 * Invalid image
                 */
                if (!valid) {

                    if (imagePreview) {

                        imagePreview.innerHTML = '';

                        imagePreview.style.display =
                            'none';
                    }

                    return;
                }


                /*
                 * Valid images
                 */
                showImagePreview();

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Prevent Submit If Image Is Invalid
    |--------------------------------------------------------------------------
    */

    if (autoForm) {

        autoForm.addEventListener(
            'submit',
            function (event) {

                /*
                 * Validate images again
                 */
                if (!validateImages()) {

                    event.preventDefault();


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
    | Initial Button State
    |--------------------------------------------------------------------------
    */

    enableSubmitButton();


    /*
    |--------------------------------------------------------------------------
    | Scroll To First Laravel Error
    |--------------------------------------------------------------------------
    */

    const firstError =
        document.querySelector(
            '.is-invalid'
        );


    if (firstError) {

        setTimeout(function () {

            firstError.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });

        }, 200);

    }

});

</script>

@endsection
