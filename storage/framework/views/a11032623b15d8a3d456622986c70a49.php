<?php $__env->startSection('content'); ?>

<style>

.form-control {
    border: 1px solid #333 !important;
    box-shadow: none !important;
}

.form-control:focus {
    border-color: #333 !important;
    box-shadow: 0 0 0 0.1rem rgba(0, 0, 0, 0.08) !important;
}

.auto-image-thumb {
    width: 90px;
    height: 65px;
    object-fit: cover;
    border-radius: 5px;
    border: 1px solid #ddd;
}

.primary-badge {
    font-size: 12px;
}

</style>


<div class="wrapper">

    <div class="content-wrapper">

        <section class="content">

            <div class="container-fluid">


                <div class="row">

                    <div class="col-md-12">

                        <?php echo $__env->make('backend.layouts.notification', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


                        <div class="card card-primary">

                            

                            <div class="card-header">

                                <h3 class="card-title">

                                    <i class="fas fa-images"></i>

                                    Auto Images

                                </h3>


                                <a
                                    href="<?php echo e(route('autobilder.create')); ?>"
                                    class="btn btn-success btn-sm float-right">

                                    <i class="fas fa-plus"></i>

                                    Add Auto Image

                                </a>

                            </div>


                            

                            <div class="card-body border-bottom">

                                <form
                                    method="GET"
                                    action="<?php echo e(route('autobilder.index')); ?>">

                                    <div class="row">


                                        
                                        <div class="col-md-3">

                                            <div class="form-group mb-2">

                                                <label for="search">

                                                    Search

                                                </label>

                                                <input
                                                    type="text"
                                                    name="search"
                                                    id="search"
                                                    value="<?php echo e($search); ?>"
                                                    class="form-control"
                                                    placeholder="Vehicle, stock no., alt text...">

                                            </div>

                                        </div>


                                        
                                        <div class="col-md-3">

                                            <div class="form-group mb-2">

                                                <label for="auto_id">

                                                    Vehicle

                                                </label>

                                                <select
                                                    name="auto_id"
                                                    id="auto_id"
                                                    class="form-control my-select">

                                                    <option value="">

                                                        All Vehicles

                                                    </option>

                                                    <?php $__currentLoopData = $autos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $auto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                        <option
                                                            value="<?php echo e($auto->id); ?>"
                                                            <?php echo e((string)$autoId === (string)$auto->id ? 'selected' : ''); ?>>

                                                            <?php echo e($auto->brand->name ?? ''); ?>

                                                            <?php echo e($auto->model->name ?? ''); ?>


                                                            <?php if($auto->variant): ?>
                                                                - <?php echo e($auto->variant); ?>

                                                            <?php endif; ?>

                                                            <?php if($auto->stock_number): ?>
                                                                | <?php echo e($auto->stock_number); ?>

                                                            <?php endif; ?>

                                                        </option>

                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                </select>

                                            </div>

                                        </div>


                                        
                                        <div class="col-md-2">

                                            <div class="form-group mb-2">

                                                <label for="primary">

                                                    Image Type

                                                </label>

                                                <select
                                                    name="primary"
                                                    id="primary"
                                                    class="form-control my-select">

                                                    <option
                                                        value=""
                                                        <?php echo e($primary === null || $primary === '' ? 'selected' : ''); ?>>

                                                        All Images

                                                    </option>

                                                    <option
                                                        value="1"
                                                        <?php echo e((string)$primary === '1' ? 'selected' : ''); ?>>

                                                        Primary

                                                    </option>

                                                    <option
                                                        value="0"
                                                        <?php echo e((string)$primary === '0' ? 'selected' : ''); ?>>

                                                        Secondary

                                                    </option>

                                                </select>

                                            </div>

                                        </div>


                                        
                                        <div class="col-md-2">

                                            <div class="form-group mb-2">

                                                <label for="sort">

                                                    Sort By

                                                </label>

                                                <select
                                                    name="sort"
                                                    id="sort"
                                                    class="form-control my-select">

                                                    <option
                                                        value="sort_order"
                                                        <?php echo e($sort === 'sort_order' ? 'selected' : ''); ?>>

                                                        Sort Order

                                                    </option>

                                                    <option
                                                        value="id"
                                                        <?php echo e($sort === 'id' ? 'selected' : ''); ?>>

                                                        ID

                                                    </option>

                                                    <option
                                                        value="created_at"
                                                        <?php echo e($sort === 'created_at' ? 'selected' : ''); ?>>

                                                        Created

                                                    </option>

                                                    <option
                                                        value="is_primary"
                                                        <?php echo e($sort === 'is_primary' ? 'selected' : ''); ?>>

                                                        Primary

                                                    </option>

                                                </select>

                                            </div>

                                        </div>


                                        
                                        <div class="col-md-2">

                                            <div class="form-group mb-2">

                                                <label for="direction">

                                                    Direction

                                                </label>

                                                <select
                                                    name="direction"
                                                    id="direction"
                                                    class="form-control my-select">

                                                    <option
                                                        value="asc"
                                                        <?php echo e($direction === 'asc' ? 'selected' : ''); ?>>

                                                        Ascending

                                                    </option>

                                                    <option
                                                        value="desc"
                                                        <?php echo e($direction === 'desc' ? 'selected' : ''); ?>>

                                                        Descending

                                                    </option>

                                                </select>

                                            </div>

                                        </div>


                                        
                                        <div class="col-md-12">

                                            <button
                                                type="submit"
                                                class="btn btn-primary">

                                                <i class="fas fa-search"></i>

                                                Search / Filter

                                            </button>


                                            <a
                                                href="<?php echo e(route('autobilder.index')); ?>"
                                                class="btn btn-secondary">

                                                <i class="fas fa-redo"></i>

                                                Reset

                                            </a>

                                        </div>


                                    </div>

                                </form>

                            </div>


                            

                            <div class="card-body p-0">

                                <div class="table-responsive">

                                    <table class="table table-bordered table-hover mb-0">

                                        <thead class="thead-light">

                                            <tr>

                                                <th width="60">
                                                    #
                                                </th>

                                                <th width="120">
                                                    Image
                                                </th>

                                                <th>
                                                    Vehicle
                                                </th>

                                                <th>
                                                    Alt Text
                                                </th>

                                                <th width="100">
                                                    Position
                                                </th>

                                                <th width="120">
                                                    Type
                                                </th>

                                                <th width="180">
                                                    Actions
                                                </th>

                                            </tr>

                                        </thead>


                                        <tbody>

                                            <?php $__empty_1 = true; $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                                <tr>

                                                    <td>

                                                        <?php echo e($images->firstItem() + $loop->index); ?>


                                                    </td>


                                                    <td>

                                                        <img
                                                            src="<?php echo e(asset('autoimages/' . $image->image_path)); ?>"
                                                            alt="<?php echo e($image->alt_text ?? 'Vehicle Image'); ?>"
                                                            class="auto-image-thumb">

                                                    </td>


                                                <td>
                                                    <?php if($image->auto): ?>

                                                        <strong>
                                                            <?php echo e($image->auto->brand->name ?? ''); ?>

                                                            <?php echo e($image->auto->model->name ?? ''); ?>

                                                        </strong>

                                                        <?php if($image->auto->variant): ?>
                                                            <br>

                                                            <small class="text-muted">
                                                                <?php echo e($image->auto->variant); ?>

                                                            </small>
                                                        <?php endif; ?>

                                                        <?php if($image->auto->stock_number): ?>
                                                            <br>

                                                            <small>
                                                                Stock: <?php echo e($image->auto->stock_number); ?>

                                                            </small>
                                                        <?php endif; ?>

                                                    <?php else: ?>

                                                        <span class="text-muted">
                                                            Vehicle no longer exists
                                                        </span>

                                                    <?php endif; ?>
                                                </td>


                                                    <td>

                                                        <?php echo e($image->alt_text ?: '—'); ?>


                                                    </td>


                                                    <td>

                                                        <?php echo e($image->sort_order); ?>


                                                    </td>


                                                    <td>

                                                        <?php if($image->is_primary): ?>

                                                            <span class="badge badge-success primary-badge">

                                                                <i class="fas fa-star"></i>

                                                                Primary

                                                            </span>

                                                        <?php else: ?>

                                                            <span class="badge badge-secondary">

                                                                Secondary

                                                            </span>

                                                        <?php endif; ?>

                                                    </td>


                                                    <td>

                                                        <a
                                                            href="<?php echo e(route('autobilder.show', $image->id)); ?>"
                                                            class="btn btn-info btn-sm"
                                                            title="View">

                                                            <i class="fas fa-eye"></i>

                                                        </a>


                                                        <a
                                                            href="<?php echo e(route('autobilder.edit', $image->id)); ?>"
                                                            class="btn btn-primary btn-sm"
                                                            title="Edit">

                                                            <i class="fas fa-edit"></i>

                                                        </a>


                                                        <form
                                                            action="<?php echo e(route('autobilder.destroy', $image->id)); ?>"
                                                            method="POST"
                                                            class="d-inline delete-image-form">

                                                            <?php echo csrf_field(); ?>

                                                            <?php echo method_field('DELETE'); ?>

                                                            <button
                                                                type="submit"
                                                                class="btn btn-danger btn-sm"
                                                                title="Delete">

                                                                <i class="fas fa-trash"></i>

                                                            </button>

                                                        </form>

                                                    </td>

                                                </tr>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                                <tr>

                                                    <td
                                                        colspan="7"
                                                        class="text-center py-4">

                                                        <i class="fas fa-images fa-2x text-muted"></i>

                                                        <br><br>

                                                        No vehicle images found.

                                                    </td>

                                                </tr>

                                            <?php endif; ?>

                                        </tbody>

                                    </table>

                                </div>

                            </div>


                            

                            <?php if($images->hasPages()): ?>

                                <div class="card-footer">

                               
                                    
    <?php echo e($images->appends(request()->query())->links('pagination-links')); ?>


                                </div>

                            <?php endif; ?>


                        </div>

                    </div>

                </div>


            </div>

        </section>

    </div>

</div>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('scripts'); ?>

<script>

document.addEventListener('DOMContentLoaded', function () {

    // Your existing JavaScript...


    // Delete image confirmation
    document.querySelectorAll('.delete-image-form').forEach(function (form) {

        form.addEventListener('submit', function (e) {

            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/projects/autohande/resources/views/backend/admin/autoimage/index.blade.php ENDPATH**/ ?>