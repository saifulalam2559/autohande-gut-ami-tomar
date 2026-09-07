@extends('backend.layouts.master')

@section('content')

<style>

.form-control {
    border: 1px solid #333 !important;
    box-shadow: none !important;
}

.form-control:focus {
    border-color: #333 !important;
    box-shadow: 0 0 0 0.1rem rgba(0,0,0,.08) !important;
}

.auto-thumb {
    width: 105px;
    height: 75px;
    object-fit: cover;
    border-radius: 5px;
    border: 1px solid #ddd;
}

.vehicle-title {
    font-weight: 700;
}

.filter-title {
    font-size: 15px;
    font-weight: 700;
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


              {{-- =====================================================
                   HEADER
              ====================================================== --}}

              <div class="card-header">

                <h3 class="card-title">

                  <i class="fas fa-car"></i>

                  Auto Posts

                </h3>


                <a
                  href="{{ route('auto.create') }}"
                  class="btn btn-success btn-sm float-right">

                  <i class="fas fa-plus"></i>

                  Create Auto Post

                </a>

              </div>


              {{-- =====================================================
                   FILTERS
              ====================================================== --}}

              <div class="card-body border-bottom">

                <div class="filter-title mb-3">

                  <i class="fas fa-filter"></i>

                  Search & Filter Inventory

                </div>


                <form
                  action="{{ route('auto.index') }}"
                  method="GET">

                  <div class="row">


                    {{-- Search --}}
                    <div class="col-md-4">

                      <div class="form-group">

                        <label>

                          Search

                        </label>

                        <input
                          type="text"
                          name="search"
                          value="{{ $search }}"
                          class="form-control"
                          placeholder="Stock, VIN, brand, model, variant...">

                      </div>

                    </div>


                    {{-- Brand --}}
                    <div class="col-md-4">

                      <div class="form-group">

                        <label>

                          Brand

                        </label>

                        <select
                          name="brand_id"
                          id="filter_brand"
                          class="form-control">

                          <option value="">
                            All Brands
                          </option>

                          @foreach($brands as $item)

                            <option
                              value="{{ $item->id }}"
                              {{ (string)$brandId === (string)$item->id ? 'selected' : '' }}>

                              {{ $item->name }}

                            </option>

                          @endforeach

                        </select>

                      </div>

                    </div>


                    {{-- Model --}}
                    <div class="col-md-4">

                      <div class="form-group">

                        <label>

                          Vehicle Model

                        </label>

                        <select
                          name="vehicle_model_id"
                          id="filter_model"
                          class="form-control">

                          <option value="">
                            All Models
                          </option>

                          @foreach($models as $item)

                            <option
                              value="{{ $item->id }}"
                              data-brand="{{ $item->brand_id }}"
                              {{ (string)$modelId === (string)$item->id ? 'selected' : '' }}>

                              {{ $item->brand->name ?? '' }}
                              -
                              {{ $item->name }}

                            </option>

                          @endforeach

                        </select>

                      </div>

                    </div>


                    {{-- Body --}}
                    <div class="col-md-4">

                      <div class="form-group">

                        <label>Body Type</label>

                        <select
                          name="body_type_id"
                          class="form-control">

                          <option value="">
                            All Body Types
                          </option>

                          @foreach($bodyTypes as $item)

                            <option
                              value="{{ $item->id }}"
                              {{ (string)$bodyTypeId === (string)$item->id ? 'selected' : '' }}>

                              {{ $item->name }}

                            </option>

                          @endforeach

                        </select>

                      </div>

                    </div>


                    {{-- Fuel --}}
                    <div class="col-md-4">

                      <div class="form-group">

                        <label>Fuel Type</label>

                        <select
                          name="fuel_type_id"
                          class="form-control">

                          <option value="">
                            All Fuel Types
                          </option>

                          @foreach($fuelTypes as $item)

                            <option
                              value="{{ $item->id }}"
                              {{ (string)$fuelTypeId === (string)$item->id ? 'selected' : '' }}>

                              {{ $item->name }}

                            </option>

                          @endforeach

                        </select>

                      </div>

                    </div>


                    {{-- Transmission --}}
                    <div class="col-md-4">

                      <div class="form-group">

                        <label>Transmission</label>

                        <select
                          name="transmission_id"
                          class="form-control">

                          <option value="">
                            All Transmissions
                          </option>

                          @foreach($transmissions as $item)

                            <option
                              value="{{ $item->id }}"
                              {{ (string)$transmissionId === (string)$item->id ? 'selected' : '' }}>

                              {{ $item->name }}

                            </option>

                          @endforeach

                        </select>

                      </div>

                    </div>


                    {{-- Condition --}}
                    <div class="col-md-4">

                      <div class="form-group">

                        <label>Condition</label>

                        <select
                          name="condition_id"
                          class="form-control">

                          <option value="">
                            All Conditions
                          </option>

                          @foreach($conditions as $item)

                            <option
                              value="{{ $item->id }}"
                              {{ (string)$conditionId === (string)$item->id ? 'selected' : '' }}>

                              {{ $item->name }}

                            </option>

                          @endforeach

                        </select>

                      </div>

                    </div>


                    {{-- Emission --}}
                    <div class="col-md-4">

                      <div class="form-group">

                        <label>Emission Class</label>

                        <select
                          name="emission_class_id"
                          class="form-control">

                          <option value="">
                            All Emission Classes
                          </option>

                          @foreach($emissionClasses as $item)

                            <option
                              value="{{ $item->id }}"
                              {{ (string)$emissionClassId === (string)$item->id ? 'selected' : '' }}>

                              {{ $item->name }}

                            </option>

                          @endforeach

                        </select>

                      </div>

                    </div>


                    {{-- Status --}}
                    <div class="col-md-4">

                      <div class="form-group">

                        <label>Status</label>

                        <select
                          name="status"
                          class="form-control">

                          <option value="">
                            All Statuses
                          </option>

                          @foreach([
                            'draft' => 'Draft',
                            'published' => 'Published',
                            'inactive' => 'Inactive',
                            'sold' => 'Sold'
                          ] as $value => $label)

                            <option
                              value="{{ $value }}"
                              {{ $status === $value ? 'selected' : '' }}>

                              {{ $label }}

                            </option>

                          @endforeach

                        </select>

                      </div>

                    </div>


                    {{-- Visibility --}}
                    <div class="col-md-3">

                      <div class="form-group">

                        <label>Visibility</label>

                        <select
                          name="visibility"
                          class="form-control">

                          <option value="">
                            All
                          </option>

                          <option
                            value="1"
                            {{ (string)$visibility === '1' ? 'selected' : '' }}>

                            Visible

                          </option>

                          <option
                            value="0"
                            {{ (string)$visibility === '0' ? 'selected' : '' }}>

                            Hidden

                          </option>

                        </select>

                      </div>

                    </div>


                    {{-- Featured --}}
                    <div class="col-md-3">

                      <div class="form-group">

                        <label>Featured</label>

                        <select
                          name="featured"
                          class="form-control">

                          <option value="">
                            All
                          </option>

                          <option
                            value="1"
                            {{ (string)$featured === '1' ? 'selected' : '' }}>

                            Featured

                          </option>

                          <option
                            value="0"
                            {{ (string)$featured === '0' ? 'selected' : '' }}>

                            Not Featured

                          </option>

                        </select>

                      </div>

                    </div>


                    {{-- Price Min --}}
                    <div class="col-md-3">

                      <div class="form-group">

                        <label>Min Price</label>

                        <input
                          type="number"
                          step="0.01"
                          min="0"
                          name="price_min"
                          value="{{ $priceMin }}"
                          class="form-control"
                          placeholder="€ Min">

                      </div>

                    </div>


                    {{-- Price Max --}}
                    <div class="col-md-3">

                      <div class="form-group">

                        <label>Max Price</label>

                        <input
                          type="number"
                          step="0.01"
                          min="0"
                          name="price_max"
                          value="{{ $priceMax }}"
                          class="form-control"
                          placeholder="€ Max">

                      </div>

                    </div>


                    {{-- Sort --}}
                    <div class="col-md-3">

                      <div class="form-group">

                        <label>Sort By</label>

                        <select
                          name="sort"
                          class="form-control">

                          @foreach([
                            'id' => 'ID',
                            'stock_number' => 'Stock Number',
                            'price' => 'Price',
                            'mileage' => 'Mileage',
                            'first_registration' => 'Registration',
                            'status' => 'Status',
                            'is_visible' => 'Visibility',
                            'is_featured' => 'Featured',
                            'published_at' => 'Published',
                            'created_at' => 'Created'
                          ] as $value => $label)

                            <option
                              value="{{ $value }}"
                              {{ $sort === $value ? 'selected' : '' }}>

                              {{ $label }}

                            </option>

                          @endforeach

                        </select>

                      </div>

                    </div>


                    {{-- Direction --}}
                    <div class="col-md-3">

                      <div class="form-group">

                        <label>Direction</label>

                        <select
                          name="direction"
                          class="form-control">

                          <option
                            value="desc"
                            {{ $direction === 'desc' ? 'selected' : '' }}>

                            Descending

                          </option>

                          <option
                            value="asc"
                            {{ $direction === 'asc' ? 'selected' : '' }}>

                            Ascending

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
                        href="{{ route('auto.index') }}"
                        class="btn btn-secondary">

                        <i class="fas fa-redo"></i>

                        Reset

                      </a>

                    </div>

                  </div>

                </form>

              </div>


              {{-- =====================================================
                   TABLE
              ====================================================== --}}

              <div class="card-body p-0">

                <div class="table-responsive">

                  <table class="table table-bordered table-hover mb-0">

                    <thead class="thead-light">

                      <tr>

                        <th width="60">
                          #
                        </th>

                        <th width="130">
                          Image
                        </th>

                        <th>
                          Vehicle
                        </th>

                        <th>
                          Price
                        </th>

                        <th>
                          Mileage
                        </th>

                        <th>
                          Status
                        </th>

                        <th>
                          Features
                        </th>

                        <th width="190">
                          Actions
                        </th>

                      </tr>

                    </thead>


                    <tbody>

                    @forelse($autos as $auto)

                      <tr>


                        <td>

                          {{ $autos->firstItem() + $loop->index }}

                        </td>


                        <td>

                          @if($auto->primaryImage)

                            <img
                              src="{{ asset('autoimages/' . $auto->primaryImage->image_path) }}"
                              alt="{{ $auto->primaryImage->alt_text ?? 'Vehicle Image' }}"
                              class="auto-thumb">

                          @else

                            <div
                              class="text-center text-muted">

                              <i class="fas fa-car fa-2x"></i>

                              <br>

                              No Image

                            </div>

                          @endif

                        </td>


                        <td>

                          <div class="vehicle-title">

                            {{ $auto->brand->name ?? '' }}

                            {{ $auto->model->name ?? '' }}

                          </div>


                          @if($auto->variant)

                            <small class="text-muted">

                              {{ $auto->variant }}

                            </small>

                          @endif


                          @if($auto->stock_number)

                            <br>

                            <small>

                              Stock:
                              {{ $auto->stock_number }}

                            </small>

                          @endif

                        </td>


                        <td>

                          <strong>

                            {{ number_format((float)$auto->price, 2) }}
                            {{ $auto->currency }}

                          </strong>

                        </td>


                        <td>

                          {{ number_format($auto->mileage) }}
                          {{ $auto->mileage_unit }}

                        </td>


                        <td>

                          @switch($auto->status)

                            @case('published')

                              <span class="badge badge-success">

                                Published

                              </span>

                              @break

                            @case('draft')

                              <span class="badge badge-secondary">

                                Draft

                              </span>

                              @break

                            @case('inactive')

                              <span class="badge badge-warning">

                                Inactive

                              </span>

                              @break

                            @case('sold')

                              <span class="badge badge-danger">

                                Sold

                              </span>

                              @break

                          @endswitch


                          <br>


                          @if($auto->is_visible)

                            <small class="text-success">

                              <i class="fas fa-eye"></i>

                              Visible

                            </small>

                          @else

                            <small class="text-muted">

                              <i class="fas fa-eye-slash"></i>

                              Hidden

                            </small>

                          @endif


                          @if($auto->is_featured)

                            <br>

                            <small class="text-primary">

                              <i class="fas fa-star"></i>

                              Featured

                            </small>

                          @endif

                        </td>


                        <td>

                          <span class="badge badge-info">

                            {{ $auto->features_count }}

                            Features

                          </span>

                          <br>

                          <span class="badge badge-secondary mt-1">

                            {{ $auto->images_count }}

                            Images

                          </span>

                        </td>


                        <td>

                          <a
                            href="{{ route('auto.show', $auto->id) }}"
                            class="btn btn-info btn-sm"
                            title="View">

                            <i class="fas fa-eye"></i>

                          </a>


                          <a
                            href="{{ route('auto.edit', $auto->id) }}"
                            class="btn btn-primary btn-sm"
                            title="Edit">

                            <i class="fas fa-edit"></i>

                          </a>


                          <a
                            href="{{ route('autobilder.index', ['auto_id' => $auto->id]) }}"
                            class="btn btn-warning btn-sm"
                            title="Vehicle Images">

                            <i class="fas fa-images"></i>

                          </a>


                            <form
                                action="{{ route('auto.destroy', $auto->id) }}"
                                method="POST"
                                class="d-inline delete-auto-form">

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
                          colspan="8"
                          class="text-center py-5">

                          <i
                            class="fas fa-car fa-3x text-muted"></i>

                          <br><br>

                          No auto posts found.

                        </td>

                      </tr>

                    @endforelse

                    </tbody>

                  </table>

                </div>

              </div>


              @if($autos->hasPages())

                <div class="card-footer">

                 {{ $autos->appends(request()->query())->links('pagination-links') }}

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

    const brand =
        document.getElementById('filter_brand');

    const model =
        document.getElementById('filter_model');

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

    }

    brand.addEventListener(
        'change',
        filterModels
    );

    filterModels();

});

</script>



<script>

document.addEventListener('DOMContentLoaded', function () {

    const brand =
        document.getElementById('filter_brand');

    const model =
        document.getElementById('filter_model');

    function filterModels() {

        const brandId =
            brand.value;

        Array.from(model.options).forEach(function (option) {

            if (!option.value) {
                option.hidden = false;
                return;
            }

            option.hidden =
                option.dataset.brand !== brandId;

        });

    }

    brand.addEventListener(
        'change',
        filterModels
    );

    filterModels();


    // Delete confirmation
    document.querySelectorAll('.delete-auto-form').forEach(function (form) {

        form.addEventListener('submit', function (e) {

            e.preventDefault();

            Swal.fire({
                title: 'Delete this auto?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete',
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