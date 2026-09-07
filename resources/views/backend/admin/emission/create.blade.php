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

                    <i class="fas fa-leaf"></i>

                    Add Emission Class

                </h3>


                <a
                    href="{{ route('schadstoffklasse.index') }}"
                    class="btn btn-danger btn-sm float-right">

                    <i class="fas fa-list"></i>

                    Emission Class List

                </a>

            </div>


            {{-- ==========================================================
                 FORM
            =========================================================== --}}

            <form
                action="{{ route('schadstoffklasse.store') }}"
                method="POST"
                autocomplete="off">

                @csrf

                <div class="card-body">

                    <div class="row">

                        {{-- Emission Class Name --}}
                        <div class="col-md-8">

                            <div class="form-group">

                                <label for="name">

                                    Emission Class Name

                                    <span class="text-danger">*</span>

                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    value="{{ old('name') }}"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="e.g. Euro 6d"
                                    required
                                    autofocus>

                                @error('name')

                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>

                                @enderror

                                <small class="form-text text-muted">
                                    Example: Euro 5, Euro 6, Euro 6d,
                                    Euro 6d-TEMP.
                                </small>

                            </div>

                        </div>


                        {{-- Sort Order --}}
                        <div class="col-md-4">

                            <div class="form-group">

                                <label for="sort_order">

                                    Sort Order

                                </label>

                                <input
                                    type="number"
                                    name="sort_order"
                                    id="sort_order"
                                    value="{{ old('sort_order', 0) }}"
                                    class="form-control @error('sort_order') is-invalid @enderror"
                                    min="0"
                                    step="1">

                                @error('sort_order')

                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>

                                @enderror

                                <small class="form-text text-muted">
                                    Lower numbers appear first.
                                </small>

                            </div>

                        </div>


                        {{-- Slug --}}
                        <div class="col-md-12">

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

                                <small class="form-text text-muted">
                                    Example:
                                    <code>euro-6d</code>
                                </small>

                            </div>

                        </div>


                        {{-- Status --}}
                        <div class="col-md-12">

                            <div class="form-group mb-0">

                                <div class="d-flex align-items-center">

                                    {{-- Toggle --}}
                                    <div class="custom-control custom-switch auto-switch">

                                        <input
                                            type="checkbox"
                                            class="custom-control-input"
                                            id="is_active"
                                            name="is_active"
                                            value="1"
                                            {{ old('is_active', true) ? 'checked' : '' }}>

                                        <label
                                            class="custom-control-label"
                                            for="is_active">
                                        </label>

                                    </div>

                                    {{-- Status Text --}}
                                    <label
                                        for="is_active"
                                        id="active-status-text"
                                        class="auto-switch-label mb-0 ml-3">

                                        {{ old('is_active', true) ? 'Active' : 'Inactive' }}

                                    </label>

                                </div>

                                <small class="form-text text-muted mt-2">
                                    Inactive emission classes will not be
                                    available for new vehicle entries.
                                </small>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ==========================================================
                     FOOTER
                =========================================================== --}}

                <div class="card-footer">

                    <a
                        href="{{ route('schadstoffklasse.index') }}"
                        class="btn btn-secondary">

                        <i class="fas fa-times"></i>

                        Cancel

                    </a>


                    <button
                        type="submit"
                        class="btn btn-primary float-right">

                        <i class="fas fa-save"></i>

                        Save Emission Class

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


</div>
   
</div>
 </section>
</div>



@endsection


@section('scripts')

<style>

/* ==========================================================
   AutoHouse Professional Toggle
   ========================================================== */

.auto-switch {
    padding-left: 0 !important;
    min-height: 30px;
}

/* Toggle track */
.auto-switch .custom-control-label::before {
    width: 58px;
    height: 30px;

    top: 0;
    left: 0;

    border-radius: 30px;
    cursor: pointer;
}

/* Toggle knob */
.auto-switch .custom-control-label::after {
    width: 24px;
    height: 24px;

    top: 3px;
    left: 3px;

    border-radius: 50%;
    cursor: pointer;
}

/* Knob position when ON */
.auto-switch
.custom-control-input:checked
~ .custom-control-label::after {
    transform: translateX(28px);
}

/* Status text */
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

</style>


<script>
    document.addEventListener('DOMContentLoaded', function () {

        const checkbox = document.getElementById('is_active');
        const statusText = document.getElementById('active-status-text');

        function updateStatusText() {
            statusText.textContent = checkbox.checked
                ? 'Active'
                : 'Inactive';
        }

        checkbox.addEventListener('change', updateStatusText);

        updateStatusText();
    });
</script>

@endsection