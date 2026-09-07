<?php $__env->startSection('content'); ?>

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

            <?php echo $__env->make('backend.layouts.notification', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


            <div class="card card-primary">


              

              <div class="card-header">

                <h3 class="card-title">

                  <i class="fas fa-car"></i>

                  Auto Posts

                </h3>


                <a
                  href="<?php echo e(route('auto.create')); ?>"
                  class="btn btn-success btn-sm float-right">

                  <i class="fas fa-plus"></i>

                  Create Auto Post

                </a>

              </div>


              

              <div class="card-body border-bottom">

                <div class="filter-title mb-3">

                  <i class="fas fa-filter"></i>

                  Search & Filter Inventory

                </div>


                <form
                  action="<?php echo e(route('auto.index')); ?>"
                  method="GET">

                  <div class="row">


                    
                    <div class="col-md-4">

                      <div class="form-group">

                        <label>

                          Search

                        </label>

                        <input
                          type="text"
                          name="search"
                          value="<?php echo e($search); ?>"
                          class="form-control"
                          placeholder="Stock, VIN, brand, model, variant...">

                      </div>

                    </div>


                    
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

                          <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <option
                              value="<?php echo e($item->id); ?>"
                              <?php echo e((string)$brandId === (string)$item->id ? 'selected' : ''); ?>>

                              <?php echo e($item->name); ?>


                            </option>

                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>

                      </div>

                    </div>


                    
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

                          <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <option
                              value="<?php echo e($item->id); ?>"
                              data-brand="<?php echo e($item->brand_id); ?>"
                              <?php echo e((string)$modelId === (string)$item->id ? 'selected' : ''); ?>>

                              <?php echo e($item->brand->name ?? ''); ?>

                              -
                              <?php echo e($item->name); ?>


                            </option>

                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>

                      </div>

                    </div>


                    
                    <div class="col-md-4">

                      <div class="form-group">

                        <label>Body Type</label>

                        <select
                          name="body_type_id"
                          class="form-control">

                          <option value="">
                            All Body Types
                          </option>

                          <?php $__currentLoopData = $bodyTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <option
                              value="<?php echo e($item->id); ?>"
                              <?php echo e((string)$bodyTypeId === (string)$item->id ? 'selected' : ''); ?>>

                              <?php echo e($item->name); ?>


                            </option>

                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>

                      </div>

                    </div>


                    
                    <div class="col-md-4">

                      <div class="form-group">

                        <label>Fuel Type</label>

                        <select
                          name="fuel_type_id"
                          class="form-control">

                          <option value="">
                            All Fuel Types
                          </option>

                          <?php $__currentLoopData = $fuelTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <option
                              value="<?php echo e($item->id); ?>"
                              <?php echo e((string)$fuelTypeId === (string)$item->id ? 'selected' : ''); ?>>

                              <?php echo e($item->name); ?>


                            </option>

                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>

                      </div>

                    </div>


                    
                    <div class="col-md-4">

                      <div class="form-group">

                        <label>Transmission</label>

                        <select
                          name="transmission_id"
                          class="form-control">

                          <option value="">
                            All Transmissions
                          </option>

                          <?php $__currentLoopData = $transmissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <option
                              value="<?php echo e($item->id); ?>"
                              <?php echo e((string)$transmissionId === (string)$item->id ? 'selected' : ''); ?>>

                              <?php echo e($item->name); ?>


                            </option>

                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>

                      </div>

                    </div>


                    
                    <div class="col-md-4">

                      <div class="form-group">

                        <label>Condition</label>

                        <select
                          name="condition_id"
                          class="form-control">

                          <option value="">
                            All Conditions
                          </option>

                          <?php $__currentLoopData = $conditions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <option
                              value="<?php echo e($item->id); ?>"
                              <?php echo e((string)$conditionId === (string)$item->id ? 'selected' : ''); ?>>

                              <?php echo e($item->name); ?>


                            </option>

                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>

                      </div>

                    </div>


                    
                    <div class="col-md-4">

                      <div class="form-group">

                        <label>Emission Class</label>

                        <select
                          name="emission_class_id"
                          class="form-control">

                          <option value="">
                            All Emission Classes
                          </option>

                          <?php $__currentLoopData = $emissionClasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <option
                              value="<?php echo e($item->id); ?>"
                              <?php echo e((string)$emissionClassId === (string)$item->id ? 'selected' : ''); ?>>

                              <?php echo e($item->name); ?>


                            </option>

                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>

                      </div>

                    </div>


                    
                    <div class="col-md-4">

                      <div class="form-group">

                        <label>Status</label>

                        <select
                          name="status"
                          class="form-control">

                          <option value="">
                            All Statuses
                          </option>

                          <?php $__currentLoopData = [
                            'draft' => 'Draft',
                            'published' => 'Published',
                            'inactive' => 'Inactive',
                            'sold' => 'Sold'
                          ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <option
                              value="<?php echo e($value); ?>"
                              <?php echo e($status === $value ? 'selected' : ''); ?>>

                              <?php echo e($label); ?>


                            </option>

                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>

                      </div>

                    </div>


                    
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
                            <?php echo e((string)$visibility === '1' ? 'selected' : ''); ?>>

                            Visible

                          </option>

                          <option
                            value="0"
                            <?php echo e((string)$visibility === '0' ? 'selected' : ''); ?>>

                            Hidden

                          </option>

                        </select>

                      </div>

                    </div>


                    
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
                            <?php echo e((string)$featured === '1' ? 'selected' : ''); ?>>

                            Featured

                          </option>

                          <option
                            value="0"
                            <?php echo e((string)$featured === '0' ? 'selected' : ''); ?>>

                            Not Featured

                          </option>

                        </select>

                      </div>

                    </div>


                    
                    <div class="col-md-3">

                      <div class="form-group">

                        <label>Min Price</label>

                        <input
                          type="number"
                          step="0.01"
                          min="0"
                          name="price_min"
                          value="<?php echo e($priceMin); ?>"
                          class="form-control"
                          placeholder="€ Min">

                      </div>

                    </div>


                    
                    <div class="col-md-3">

                      <div class="form-group">

                        <label>Max Price</label>

                        <input
                          type="number"
                          step="0.01"
                          min="0"
                          name="price_max"
                          value="<?php echo e($priceMax); ?>"
                          class="form-control"
                          placeholder="€ Max">

                      </div>

                    </div>


                    
                    <div class="col-md-3">

                      <div class="form-group">

                        <label>Sort By</label>

                        <select
                          name="sort"
                          class="form-control">

                          <?php $__currentLoopData = [
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
                          ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <option
                              value="<?php echo e($value); ?>"
                              <?php echo e($sort === $value ? 'selected' : ''); ?>>

                              <?php echo e($label); ?>


                            </option>

                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>

                      </div>

                    </div>


                    
                    <div class="col-md-3">

                      <div class="form-group">

                        <label>Direction</label>

                        <select
                          name="direction"
                          class="form-control">

                          <option
                            value="desc"
                            <?php echo e($direction === 'desc' ? 'selected' : ''); ?>>

                            Descending

                          </option>

                          <option
                            value="asc"
                            <?php echo e($direction === 'asc' ? 'selected' : ''); ?>>

                            Ascending

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
                        href="<?php echo e(route('auto.index')); ?>"
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

                    <?php $__empty_1 = true; $__currentLoopData = $autos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $auto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                      <tr>


                        <td>

                          <?php echo e($autos->firstItem() + $loop->index); ?>


                        </td>


                        <td>

                          <?php if($auto->primaryImage): ?>

                            <img
                              src="<?php echo e(asset('autoimages/' . $auto->primaryImage->image_path)); ?>"
                              alt="<?php echo e($auto->primaryImage->alt_text ?? 'Vehicle Image'); ?>"
                              class="auto-thumb">

                          <?php else: ?>

                            <div
                              class="text-center text-muted">

                              <i class="fas fa-car fa-2x"></i>

                              <br>

                              No Image

                            </div>

                          <?php endif; ?>

                        </td>


                        <td>

                          <div class="vehicle-title">

                            <?php echo e($auto->brand->name ?? ''); ?>


                            <?php echo e($auto->model->name ?? ''); ?>


                          </div>


                          <?php if($auto->variant): ?>

                            <small class="text-muted">

                              <?php echo e($auto->variant); ?>


                            </small>

                          <?php endif; ?>


                          <?php if($auto->stock_number): ?>

                            <br>

                            <small>

                              Stock:
                              <?php echo e($auto->stock_number); ?>


                            </small>

                          <?php endif; ?>

                        </td>


                        <td>

                          <strong>

                            <?php echo e(number_format((float)$auto->price, 2)); ?>

                            <?php echo e($auto->currency); ?>


                          </strong>

                        </td>


                        <td>

                          <?php echo e(number_format($auto->mileage)); ?>

                          <?php echo e($auto->mileage_unit); ?>


                        </td>


                        <td>

                          <?php switch($auto->status):

                            case ('published'): ?>

                              <span class="badge badge-success">

                                Published

                              </span>

                              <?php break; ?>

                            <?php case ('draft'): ?>

                              <span class="badge badge-secondary">

                                Draft

                              </span>

                              <?php break; ?>

                            <?php case ('inactive'): ?>

                              <span class="badge badge-warning">

                                Inactive

                              </span>

                              <?php break; ?>

                            <?php case ('sold'): ?>

                              <span class="badge badge-danger">

                                Sold

                              </span>

                              <?php break; ?>

                          <?php endswitch; ?>


                          <br>


                          <?php if($auto->is_visible): ?>

                            <small class="text-success">

                              <i class="fas fa-eye"></i>

                              Visible

                            </small>

                          <?php else: ?>

                            <small class="text-muted">

                              <i class="fas fa-eye-slash"></i>

                              Hidden

                            </small>

                          <?php endif; ?>


                          <?php if($auto->is_featured): ?>

                            <br>

                            <small class="text-primary">

                              <i class="fas fa-star"></i>

                              Featured

                            </small>

                          <?php endif; ?>

                        </td>


                        <td>

                          <span class="badge badge-info">

                            <?php echo e($auto->features_count); ?>


                            Features

                          </span>

                          <br>

                          <span class="badge badge-secondary mt-1">

                            <?php echo e($auto->images_count); ?>


                            Images

                          </span>

                        </td>


                        <td>

                          <a
                            href="<?php echo e(route('auto.show', $auto->id)); ?>"
                            class="btn btn-info btn-sm"
                            title="View">

                            <i class="fas fa-eye"></i>

                          </a>


                          <a
                            href="<?php echo e(route('auto.edit', $auto->id)); ?>"
                            class="btn btn-primary btn-sm"
                            title="Edit">

                            <i class="fas fa-edit"></i>

                          </a>


                          <a
                            href="<?php echo e(route('autobilder.index', ['auto_id' => $auto->id])); ?>"
                            class="btn btn-warning btn-sm"
                            title="Vehicle Images">

                            <i class="fas fa-images"></i>

                          </a>


                            <form
                                action="<?php echo e(route('auto.destroy', $auto->id)); ?>"
                                method="POST"
                                class="d-inline delete-auto-form">

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
                          colspan="8"
                          class="text-center py-5">

                          <i
                            class="fas fa-car fa-3x text-muted"></i>

                          <br><br>

                          No auto posts found.

                        </td>

                      </tr>

                    <?php endif; ?>

                    </tbody>

                  </table>

                </div>

              </div>


              <?php if($autos->hasPages()): ?>

                <div class="card-footer">

                 <?php echo e($autos->appends(request()->query())->links('pagination-links')); ?>


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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/projects/autohande/resources/views/backend/admin/auto/index.blade.php ENDPATH**/ ?>