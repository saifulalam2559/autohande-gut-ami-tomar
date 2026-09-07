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

.form-control {
    border: 1px solid #333 !important;
    box-shadow: none !important;
}

.form-control:focus {
    border-color: #333 !important;
    box-shadow: 0 0 0 0.1rem rgba(0, 0, 0, 0.08) !important;
}

.current-image {
    max-width: 320px;
    max-height: 220px;
    border-radius: 6px;
    border: 1px solid #ddd;
    padding: 4px;
    background: #fff;
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


                        <div class="card card-primary">

                            <div class="card-header">

                                <h3 class="card-title">

                                    <i class="fas fa-edit"></i>

                                    Edit Auto Image

                                </h3>


                                <a
                                    href="{{ route('autobilder.index') }}"
                                    class="btn btn-danger btn-sm float-right">

                                    <i class="fas fa-list"></i>

                                    Auto Image List

                                </a>

                            </div>


                            <form
                                action="{{ route('autobilder.update', $autobilder->id) }}"
                                method="POST"
                                enctype="multipart/form-data">

                                @csrf

                                @method('PUT')


                                <div class="card-body">

                                    <div class="row">


                                        {{-- Current Image --}}
                                        <div class="col-md-12 mb-4">

                                            <label>

                                                Current Image

                                            </label>

                                            <div>

                                                <img
                                                    src="{{ asset('autoimages/' . $autobilder->image_path) }}"
                                                    alt="{{ $autobilder->alt_text ?? 'Vehicle Image' }}"
                                                    class="current-image">

                                            </div>

                                        </div>


                                        {{-- Vehicle --}}
                                        <div class="col-md-8">

                                            <div class="form-group">

                                                <label for="auto_id">

                                                    Vehicle
                                                    <span class="text-danger">*</span>

                                                </label>

                                                <select
                                                    name="auto_id"
                                                    id="auto_id"
                                                    class="form-control my-select @error('auto_id') is-invalid @enderror"
                                                    required>

                                                    <option value="">
                                                        Select Vehicle
                                                    </option>

                                                    @foreach($autos as $auto)

                                                        <option
                                                            value="{{ $auto->id }}"
                                                            {{ old('auto_id', $autobilder->auto_id) == $auto->id ? 'selected' : '' }}>

                                                            {{ $auto->brand->name ?? '' }}
                                                            {{ $auto->model->name ?? '' }}

                                                            @if($auto->variant)
                                                                - {{ $auto->variant }}
                                                            @endif

                                                            @if($auto->stock_number)
                                                                | Stock: {{ $auto->stock_number }}
                                                            @endif

                                                        </option>

                                                    @endforeach

                                                </select>

                                                @error('auto_id')
                                                    <span class="invalid-feedback">
                                                        {{ $message }}
                                                    </span>
                                                @enderror

                                            </div>

                                        </div>


                                        {{-- Sort --}}
                                        <div class="col-md-4">

                                            <div class="form-group">

                                                <label for="sort_order">

                                                    Sort Order

                                                </label>

                                                <input
                                                    type="number"
                                                    name="sort_order"
                                                    id="sort_order"
                                                    min="0"
                                                    max="255"
                                                    value="{{ old('sort_order', $autobilder->sort_order) }}"
                                                    class="form-control @error('sort_order') is-invalid @enderror">

                                                @error('sort_order')
                                                    <span class="invalid-feedback">
                                                        {{ $message }}
                                                    </span>
                                                @enderror

                                            </div>

                                        </div>


                                        {{-- Replace Image --}}
                                        <div class="col-md-8">

                                            <div class="form-group">

                                                <label for="image">

                                                    Replace Image

                                                </label>

                                                <input
                                                    type="file"
                                                    name="image"
                                                    id="image"
                                                    accept=".jpg,.jpeg,.png,.webp"
                                                    class="form-control-file @error('image') is-invalid @enderror">

                                                <small class="form-text text-muted">

                                                    Leave empty to keep the current image.
                                                    JPG, JPEG, PNG or WEBP. Maximum 5 MB.

                                                </small>

                                                @error('image')
                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>
                                                @enderror

                                            </div>

                                        </div>


                                        {{-- Primary --}}
                                        <div class="col-md-4">

                                            <div class="form-group">

                                                <label class="d-block">

                                                    Primary Image

                                                </label>

                                                <div class="custom-control custom-switch auto-switch">

                                                    <input
                                                        type="checkbox"
                                                        name="is_primary"
                                                        value="1"
                                                        class="custom-control-input"
                                                        id="is_primary"
                                                        {{ old('is_primary', $autobilder->is_primary) ? 'checked' : '' }}>

                                                    <label
                                                        class="custom-control-label"
                                                        for="is_primary">

                                                        <span
                                                            class="auto-switch-label"
                                                            id="primary-status-text">

                                                            Inactive

                                                        </span>

                                                    </label>

                                                </div>

                                                <small class="text-muted">

                                                    Setting this image as primary will
                                                    remove primary status from the other
                                                    vehicle images.

                                                </small>

                                            </div>

                                        </div>


                                        {{-- Alt Text --}}
                                        <div class="col-md-12">

                                            <div class="form-group">

                                                <label for="alt_text">

                                                    Image Alt Text

                                                </label>

                                                <input
                                                    type="text"
                                                    name="alt_text"
                                                    id="alt_text"
                                                    maxlength="255"
                                                    value="{{ old('alt_text', $autobilder->alt_text) }}"
                                                    class="form-control @error('alt_text') is-invalid @enderror"
                                                    placeholder="Example: Front view of BMW 320d">

                                                @error('alt_text')
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
                                        class="btn btn-primary">

                                        <i class="fas fa-save"></i>

                                        Update Image

                                    </button>

                                    <a
                                        href="{{ route('autobilder.index') }}"
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

    const checkbox = document.getElementById('is_primary');
    const statusText = document.getElementById('primary-status-text');

    function updateStatusText() {

        statusText.textContent =
            checkbox.checked
                ? 'Active'
                : 'Inactive';
    }

    checkbox.addEventListener(
        'change',
        updateStatusText
    );

    updateStatusText();

});

</script>

@endsection