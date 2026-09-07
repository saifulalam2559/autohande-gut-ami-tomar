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

                    <i class="fas fa-edit"></i>

                    Edit Vehicle Model

                </h3>

                <a
                    href="<?php echo e(route('modell.index')); ?>"
                    class="btn btn-danger btn-sm float-right">

                    <i class="fas fa-list"></i>

                    Model List

                </a>

            </div>


            <form
                action="<?php echo e(route('modell.update', $modell)); ?>"
                method="POST"
                autocomplete="off">

                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="card-body">

                    <div class="row">

                        
                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="brand_id">
                                    Brand
                                    <span class="text-danger">*</span>
                                </label>

                                <select
                                    name="brand_id"
                                    id="brand_id"
                                    class="form-control my-select  <?php $__errorArgs = ['brand_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    required>

                                    <option value="">
                                        -- Select Brand --
                                    </option>

                                    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <option
                                            value="<?php echo e($brand->id); ?>"
                                            <?php echo e(old('brand_id', $modell->brand_id) == $brand->id ? 'selected' : ''); ?>>

                                            <?php echo e($brand->name); ?>


                                        </option>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </select>

                                <?php $__errorArgs = ['brand_id'];
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

                            </div>

                        </div>


                        
                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="name">
                                    Model Name
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    value="<?php echo e(old('name', $modell->name)); ?>"
                                    class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    required>

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

                            </div>

                        </div>


                        
                        <div class="col-md-8">

                            <div class="form-group">

                                <label for="slug">
                                    URL Slug
                                </label>

                                <input
                                    type="text"
                                    name="slug"
                                    id="slug"
                                    value="<?php echo e(old('slug', $modell->slug)); ?>"
                                    class="form-control <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

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
                                    <code>3-series</code>
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
                                    value="<?php echo e(old('sort_order', $modell->sort_order)); ?>"
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
                                            <?php echo e(old('is_active', $modell->is_active) ? 'checked' : ''); ?>>

                                        <label
                                            class="custom-control-label"
                                            for="is_active">
                                        </label>

                                    </div>

                                    
                                    <label
                                        for="is_active"
                                        id="active-status-text"
                                        class="auto-switch-label mb-0 ml-3">

                                        <?php echo e(old('is_active', $modell->is_active) ? 'Active' : 'Inactive'); ?>


                                    </label>

                                </div>

                                <small class="form-text text-muted mt-2">
                                    Inactive models will not be available
                                    for new vehicle entries.
                                </small>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="card-footer">

                    <a
                        href="<?php echo e(route('modell.index')); ?>"
                        class="btn btn-secondary">

                        <i class="fas fa-arrow-left"></i>

                        Cancel

                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary float-right">

                        <i class="fas fa-save"></i>

                        Update Model

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

<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>

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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/projects/autohande/resources/views/backend/admin/model/edit.blade.php ENDPATH**/ ?>