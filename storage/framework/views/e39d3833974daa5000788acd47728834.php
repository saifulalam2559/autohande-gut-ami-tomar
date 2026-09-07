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

                    <i class="fas fa-car-side"></i>

                    Vehicle Models

                </h3>

                <a
                    href="<?php echo e(route('modell.create')); ?>"
                    class="btn btn-success btn-sm float-right">

                    <i class="fas fa-plus"></i>

                    Add Model

                </a>

            </div>


            

            <div class="card-body">

                <form
                    method="GET"
                    action="<?php echo e(route('modell.index')); ?>">

                    <div class="row">

                        
                        <div class="col-md-4">

                            <div class="form-group">

                                <label for="search">
                                    Search Model
                                </label>

                                <input
                                    type="text"
                                    name="search"
                                    id="search"
                                    value="<?php echo e($search); ?>"
                                    class="form-control"
                                    placeholder="Search model name...">

                            </div>

                        </div>


                        
                        <div class="col-md-3">

                            <div class="form-group">

                                <label for="brand_id">
                                    Brand
                                </label>

                                <select
                                    name="brand_id"
                                    id="brand_id"
                                    class="form-control my-select">

                                    <option value="">
                                        All Brands
                                    </option>

                                    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <option
                                            value="<?php echo e($brand->id); ?>"
                                            <?php echo e($brandId == $brand->id ? 'selected' : ''); ?>>

                                            <?php echo e($brand->name); ?>


                                        </option>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </select>

                            </div>

                        </div>


                        
                        <div class="col-md-2">

                            <div class="form-group">

                                <label for="status">
                                    Status
                                </label>

                                <select
                                    name="status"
                                    id="status"
                                    class="form-control my-select">

                                    <option value="">
                                        All
                                    </option>

                                    <option
                                        value="active"
                                        <?php echo e($status === 'active' ? 'selected' : ''); ?>>

                                        Active

                                    </option>

                                    <option
                                        value="inactive"
                                        <?php echo e($status === 'inactive' ? 'selected' : ''); ?>>

                                        Inactive

                                    </option>

                                </select>

                            </div>

                        </div>


                        
                        <div class="col-md-2">

                            <div class="form-group">

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
                                        value="name"
                                        <?php echo e($sort === 'name' ? 'selected' : ''); ?>>

                                        Name

                                    </option>

                                    <option
                                        value="created_at"
                                        <?php echo e($sort === 'created_at' ? 'selected' : ''); ?>>

                                        Created

                                    </option>

                                </select>

                            </div>

                        </div>


                        
                        <div class="col-md-1">

                            <div class="form-group">

                                <label for="direction">
                                    Order
                                </label>

                                <select
                                    name="direction"
                                    id="direction"
                                    class="form-control my-select">

                                    <option
                                        value="asc"
                                        <?php echo e($direction === 'asc' ? 'selected' : ''); ?>>

                                        ↑

                                    </option>

                                    <option
                                        value="desc"
                                        <?php echo e($direction === 'desc' ? 'selected' : ''); ?>>

                                        ↓

                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>


                    
                    <div class="row">

                        <div class="col-md-12">

                            <button
                                type="submit"
                                class="btn btn-primary">

                                <i class="fas fa-search"></i>

                                Search

                            </button>

                            <a
                                href="<?php echo e(route('modell.index')); ?>"
                                class="btn btn-secondary">

                                <i class="fas fa-redo"></i>

                                Reset

                            </a>

                        </div>

                    </div>

                </form>

            </div>


            

            <div class="card-body table-responsive p-0">

                <table class="table table-hover text-nowrap">

                    <thead>

                        <tr>

                            <th width="60">
                                #
                            </th>

                            <th>
                                Brand
                            </th>

                            <th>
                                Model
                            </th>

                            <th>
                                Slug
                            </th>

                            <th>
                                Vehicles
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Sort Order
                            </th>

                            <th width="150">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php $__empty_1 = true; $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                            <tr>

                                <td>
                                    <?php echo e($models->firstItem() + $loop->index); ?>

                                </td>

                                <td>

                                    <span class="badge badge-info">
                                        <?php echo e($model->brand->name); ?>

                                    </span>

                                </td>

                                <td>

                                    <strong>
                                        <?php echo e($model->name); ?>

                                    </strong>

                                </td>

                                <td>

                                    <code>
                                        <?php echo e($model->slug); ?>

                                    </code>

                                </td>

                                <td>

                                    <span class="badge badge-secondary">
                                        <?php echo e($model->autos_count); ?>

                                    </span>

                                </td>

                                <td>

                                    <?php if($model->is_active): ?>

                                        <span class="badge badge-success">
                                            Active
                                        </span>

                                    <?php else: ?>

                                        <span class="badge badge-danger">
                                            Inactive
                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td>
                                    <?php echo e($model->sort_order); ?>

                                </td>

                                <td>

                                    <a
                                        href="<?php echo e(route('modell.edit', $model)); ?>"
                                        class="btn btn-sm btn-primary"
                                        title="Edit Model">

                                        <i class="fas fa-edit"></i>

                                    </a>

                                    <form
                                        action="<?php echo e(route('modell.destroy', $model)); ?>"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this vehicle model?');">

                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-danger"
                                            title="Delete Model">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            <tr>

                                <td
                                    colspan="8"
                                    class="text-center py-4">

                                    <i class="fas fa-car-side fa-2x text-muted mb-2"></i>

                                    <p class="mb-0">
                                        No vehicle models found.
                                    </p>

                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>


            

            <?php if($models->hasPages()): ?>

                <div class="card-footer">

                
                    
                    
    <?php echo e($models->appends(request()->query())->links('pagination-links')); ?>


                </div>

            <?php endif; ?>

        </div>

    </div>

</div>
          
           
</div>
   
</div>
   </section>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/projects/autohande/resources/views/backend/admin/model/index.blade.php ENDPATH**/ ?>