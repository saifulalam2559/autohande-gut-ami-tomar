<?php $__env->startSection('content'); ?>


<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

<div class="row">

    <div class="col-md-12">

        <?php echo $__env->make('backend.layouts.notification', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


        <div class="card card-primary">

            

            <div class="card-header">

                <h3 class="card-title">

                    <i class="fas fa-palette"></i>

                    Add Auto Color

                </h3>


                <a
                    href="<?php echo e(route('color.index')); ?>"
                    class="btn btn-danger btn-sm float-right">

                    <i class="fas fa-list"></i>

                    Auto Color List

                </a>

            </div>


            

            <form
                action="<?php echo e(route('color.store')); ?>"
                method="POST"
                autocomplete="off">

                <?php echo csrf_field(); ?>

                <div class="card-body">

                    <div class="row">

                        
                        <div class="col-md-8">

                            <div class="form-group">

                                <label for="name">

                                    Color Name

                                    <span class="text-danger">*</span>

                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    value="<?php echo e(old('name')); ?>"
                                    class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    placeholder="e.g. Black"
                                    required
                                    autofocus>

                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                                    <span class="invalid-feedback">
                                        <?php echo e($message); ?>

                                    </span>

                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                <small class="form-text text-muted">
                                    Example: Black, White, Silver, Red,
                                    Metallic Blue.
                                </small>

                            </div>

                        </div>


                        
                        <div class="col-md-4">

                            <div class="form-group">

                                <label for="sort_order">

                                    Sort Order

                                </label>

                                <input
                                    type="number"
                                    name="sort_order"
                                    id="sort_order"
                                    value="<?php echo e(old('sort_order', 0)); ?>"
                                    class="form-control <?php $__errorArgs = ['sort_order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    min="0"
                                    step="1">

                                <?php $__errorArgs = ['sort_order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                                    <span class="invalid-feedback">
                                        <?php echo e($message); ?>

                                    </span>

                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                <small class="form-text text-muted">
                                    Lower numbers appear first.
                                </small>

                            </div>

                        </div>


                        
                        <div class="col-md-8">

                            <div class="form-group">

                                <label for="hex_code">
                                    HEX Color Code
                                </label>

                                <div class="input-group">

                                    <div class="input-group-prepend">

                                        <input
                                            type="color"
                                            id="color_picker"
                                            value="<?php echo e(old('hex_code', '#000000')); ?>"
                                            class="form-control"
                                            style="width: 55px; padding: 3px;">

                                    </div>

                                    <input
                                        type="text"
                                        name="hex_code"
                                        id="hex_code"
                                        value="<?php echo e(old('hex_code')); ?>"
                                        class="form-control <?php $__errorArgs = ['hex_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        placeholder="#000000"
                                        maxlength="7">

                                </div>

                                <?php $__errorArgs = ['hex_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                                    <span class="invalid-feedback d-block">
                                        <?php echo e($message); ?>

                                    </span>

                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                <small class="form-text text-muted">
                                    Optional. Example:
                                    <code>#000000</code>
                                </small>

                            </div>

                        </div>


                        
                        <div class="col-md-4">

                            <div class="form-group">

                                <label>
                                    Color Preview
                                </label>

                                <div
                                    id="color-preview"
                                    style="
                                        width: 100%;
                                        height: 38px;
                                        border: 1px solid #333;
                                        border-radius: 4px;
                                        background-color: <?php echo e(old('hex_code', '#ffffff')); ?>;
                                    ">
                                </div>

                            </div>

                        </div>


                        
                        <div class="col-md-12">

                            <div class="form-group">

                                <label for="slug">

                                    URL Slug

                                </label>

                                <input
                                    type="text"
                                    name="slug"
                                    id="slug"
                                    value="<?php echo e(old('slug')); ?>"
                                    class="form-control <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    placeholder="Leave empty to generate automatically">

                                <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                                    <span class="invalid-feedback">
                                        <?php echo e($message); ?>

                                    </span>

                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                <small class="form-text text-muted">
                                    Example:
                                    <code>metallic-blue</code>
                                </small>

                            </div>

                        </div>


                        
                        <div class="col-md-12">

                            <div class="form-group mb-0">

                                <div class="d-flex align-items-center">

                                    
                                    <div class="custom-control custom-switch auto-switch">

                                        <input
                                            type="checkbox"
                                            class="custom-control-input"
                                            id="is_active"
                                            name="is_active"
                                            value="1"
                                            <?php echo e(old('is_active', true) ? 'checked' : ''); ?>>

                                        <label
                                            class="custom-control-label"
                                            for="is_active">
                                        </label>

                                    </div>

                                    
                                    <label
                                        for="is_active"
                                        id="active-status-text"
                                        class="auto-switch-label mb-0 ml-3">

                                        <?php echo e(old('is_active', true) ? 'Active' : 'Inactive'); ?>


                                    </label>

                                </div>

                                <small class="form-text text-muted mt-2">
                                    Inactive colors will not be available
                                    for new vehicle entries.
                                </small>

                            </div>

                        </div>

                    </div>

                </div>


                

                <div class="card-footer">

                    <a
                        href="<?php echo e(route('color.index')); ?>"
                        class="btn btn-secondary">

                        <i class="fas fa-times"></i>

                        Cancel

                    </a>


                    <button
                        type="submit"
                        class="btn btn-primary float-right">

                        <i class="fas fa-save"></i>

                        Save Auto Color

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


<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>

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

    /*
     * ---------------------------------------------------------
     * Active / Inactive Toggle
     * ---------------------------------------------------------
     */

    const checkbox = document.getElementById('is_active');
    const statusText = document.getElementById('active-status-text');

    function updateStatusText() {

        statusText.textContent = checkbox.checked
            ? 'Active'
            : 'Inactive';

    }

    checkbox.addEventListener('change', updateStatusText);

    updateStatusText();


    /*
     * ---------------------------------------------------------
     * Color Picker
     * ---------------------------------------------------------
     */

    const colorPicker = document.getElementById('color_picker');
    const hexInput = document.getElementById('hex_code');
    const colorPreview = document.getElementById('color-preview');

    function updateColorPreview(value) {

        if (/^#[0-9A-Fa-f]{6}$/.test(value)) {
            colorPreview.style.backgroundColor = value;
        }

    }

    colorPicker.addEventListener('input', function () {

        hexInput.value = this.value.toUpperCase();

        updateColorPreview(this.value);

    });

    hexInput.addEventListener('input', function () {

        let value = this.value.trim();

        if (
            value.length > 0 &&
            value.charAt(0) !== '#'
        ) {
            value = '#' + value;
            this.value = value;
        }

        if (/^#[0-9A-Fa-f]{6}$/.test(value)) {

            colorPicker.value = value;
            updateColorPreview(value);

        }

    });

});

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/projects/autohande/resources/views/backend/admin/color/create.blade.php ENDPATH**/ ?>