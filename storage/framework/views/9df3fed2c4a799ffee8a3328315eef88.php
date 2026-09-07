```blade


<?php $__env->startSection('content'); ?>

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

            <?php echo $__env->make('backend.layouts.notification', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            
            
            <?php if(session('error')): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>


            <div class="card card-primary">

              

              <div class="card-header">

                <h3 class="card-title">

                  <i class="fas fa-car"></i>

                  Create Auto Post

                </h3>


                <a
                  href="<?php echo e(route('auto.index')); ?>"
                  class="btn btn-danger btn-sm float-right">

                  <i class="fas fa-list"></i>

                  Auto Post List

                </a>

              </div>


              

              <?php if($errors->any()): ?>

                <div class="card-body pb-0">

                  <div class="alert alert-danger validation-summary">

                    <h5 class="mb-2">

                      <i class="fas fa-exclamation-triangle"></i>

                      Please correct the following errors:

                    </h5>

                    <ul>

                      <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <li>
                          <?php echo e($error); ?>

                        </li>

                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </ul>

                  </div>

                </div>

              <?php endif; ?>


            <form
                action="<?php echo e(route('auto.store')); ?>"
                method="POST"
                enctype="multipart/form-data">

                <?php echo csrf_field(); ?>


                <div class="card-body">


                  

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
                          value="<?php echo e(old('title')); ?>"
                          class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                          placeholder="e.g. Title">

                        <?php $__errorArgs = ['title'];
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
                          class="form-control my-select <?php $__errorArgs = ['brand_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                          required>

                          <option value="">
                            Select Brand
                          </option>

                          <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <option
                              value="<?php echo e($brand->id); ?>"
                              <?php echo e(old('brand_id') == $brand->id ? 'selected' : ''); ?>>

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


                    
                    <div class="col-md-4">

                      <div class="form-group">

                        <label for="vehicle_model_id">

                          Vehicle Model
                          <span class="text-danger">*</span>

                        </label>

                        <select
                          name="vehicle_model_id"
                          id="vehicle_model_id"
                          class="form-control my-select <?php $__errorArgs = ['vehicle_model_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                          required>

                          <option value="">
                            Select Model
                          </option>

                          <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <option
                              value="<?php echo e($model->id); ?>"
                              data-brand="<?php echo e($model->brand_id); ?>"
                              <?php echo e(old('vehicle_model_id') == $model->id ? 'selected' : ''); ?>>

                              <?php echo e($model->brand->name ?? ''); ?>

                              -
                              <?php echo e($model->name); ?>


                            </option>

                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>

                        <?php $__errorArgs = ['vehicle_model_id'];
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


                    
                    <div class="col-md-4">

                      <div class="form-group">

                        <label for="variant">
                          Variant
                        </label>

                        <input
                          type="text"
                          name="variant"
                          id="variant"
                          value="<?php echo e(old('variant')); ?>"
                          class="form-control <?php $__errorArgs = ['variant'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                          placeholder="e.g. M Sport">

                        <?php $__errorArgs = ['variant'];
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


                    
                    <div class="col-md-4">

                      <div class="form-group">

                        <label for="stock_number">
                          Stock Number
                        </label>

                        <input
                          type="text"
                          name="stock_number"
                          id="stock_number"
                          value="<?php echo e(old('stock_number')); ?>"
                          class="form-control <?php $__errorArgs = ['stock_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                          placeholder="e.g. AH-10025">

                        <?php $__errorArgs = ['stock_number'];
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
                          value="<?php echo e(old('vin')); ?>"
                          class="form-control <?php $__errorArgs = ['vin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                          placeholder="17-character VIN">

                        <?php $__errorArgs = ['vin'];
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


                    
                    <div class="col-md-4">

                      <div class="form-group">

                        <label for="body_type_id">
                          Body Type
                        </label>

                        <select
                          name="body_type_id"
                          id="body_type_id"
                          class="form-control my-select <?php $__errorArgs = ['body_type_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                          <option value="">
                            Select Body Type
                          </option>

                          <?php $__currentLoopData = $bodyTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <option
                              value="<?php echo e($item->id); ?>"
                              <?php echo e(old('body_type_id') == $item->id ? 'selected' : ''); ?>>

                              <?php echo e($item->name); ?>


                            </option>

                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>

                        <?php $__errorArgs = ['body_type_id'];
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


                    
                    <div class="col-md-4">

                      <div class="form-group">

                        <label for="fuel_type_id">
                          Fuel Type
                        </label>

                        <select
                          name="fuel_type_id"
                          id="fuel_type_id"
                          class="form-control my-select <?php $__errorArgs = ['fuel_type_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                          <option value="">
                            Select Fuel Type
                          </option>

                          <?php $__currentLoopData = $fuelTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <option
                              value="<?php echo e($item->id); ?>"
                              <?php echo e(old('fuel_type_id') == $item->id ? 'selected' : ''); ?>>

                              <?php echo e($item->name); ?>


                            </option>

                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>

                        <?php $__errorArgs = ['fuel_type_id'];
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


                    
                    <div class="col-md-4">

                      <div class="form-group">

                        <label for="transmission_id">
                          Transmission
                        </label>

                        <select
                          name="transmission_id"
                          id="transmission_id"
                          class="form-control my-select <?php $__errorArgs = ['transmission_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                          <option value="">
                            Select Transmission
                          </option>

                          <?php $__currentLoopData = $transmissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <option
                              value="<?php echo e($item->id); ?>"
                              <?php echo e(old('transmission_id') == $item->id ? 'selected' : ''); ?>>

                              <?php echo e($item->name); ?>


                            </option>

                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>

                        <?php $__errorArgs = ['transmission_id'];
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


                    
                    <div class="col-md-4">

                      <div class="form-group">

                        <label for="color_id">
                          Exterior Color
                        </label>

                        <select
                          name="color_id"
                          id="color_id"
                          class="form-control my-select <?php $__errorArgs = ['color_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                          <option value="">
                            Select Color
                          </option>

                          <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <option
                              value="<?php echo e($item->id); ?>"
                              <?php echo e(old('color_id') == $item->id ? 'selected' : ''); ?>>

                              <?php echo e($item->name); ?>


                            </option>

                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>

                        <?php $__errorArgs = ['color_id'];
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


                    
                    <div class="col-md-4">

                      <div class="form-group">

                        <label for="condition_id">
                          Vehicle Condition
                        </label>

                        <select
                          name="condition_id"
                          id="condition_id"
                          class="form-control my-select <?php $__errorArgs = ['condition_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                          <option value="">
                            Select Condition
                          </option>

                          <?php $__currentLoopData = $conditions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <option
                              value="<?php echo e($item->id); ?>"
                              <?php echo e(old('condition_id') == $item->id ? 'selected' : ''); ?>>

                              <?php echo e($item->name); ?>


                            </option>

                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>

                        <?php $__errorArgs = ['condition_id'];
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


                    
                    <div class="col-md-4">

                      <div class="form-group">

                        <label for="emission_class_id">
                          Emission Class
                        </label>

                        <select
                          name="emission_class_id"
                          id="emission_class_id"
                          class="form-control my-select <?php $__errorArgs = ['emission_class_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                          <option value="">
                            Select Emission Class
                          </option>

                          <?php $__currentLoopData = $emissionClasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <option
                              value="<?php echo e($item->id); ?>"
                              <?php echo e(old('emission_class_id') == $item->id ? 'selected' : ''); ?>>

                              <?php echo e($item->name); ?>


                            </option>

                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>

                        <?php $__errorArgs = ['emission_class_id'];
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

                  </div>


                  <hr>


                  

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
                          value="<?php echo e(old('price')); ?>"
                          class="form-control <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                          placeholder="0.00"
                          required>

                        <?php $__errorArgs = ['price'];
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
                          value="<?php echo e(old('currency', 'EUR')); ?>"
                          class="form-control <?php $__errorArgs = ['currency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                        <?php $__errorArgs = ['currency'];
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
                          value="<?php echo e(old('mileage', 0)); ?>"
                          class="form-control <?php $__errorArgs = ['mileage'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                          required>

                        <?php $__errorArgs = ['mileage'];
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


                    <div class="col-md-2">

                      <div class="form-group">

                        <label for="mileage_unit">
                          Unit
                        </label>

                        <select
                          name="mileage_unit"
                          id="mileage_unit"
                          class="form-control my-select <?php $__errorArgs = ['mileage_unit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                          <option
                            value="km"
                            <?php echo e(old('mileage_unit', 'km') === 'km' ? 'selected' : ''); ?>>

                            km

                          </option>

                          <option
                            value="mi"
                            <?php echo e(old('mileage_unit') === 'mi' ? 'selected' : ''); ?>>

                            mi

                          </option>

                        </select>

                        <?php $__errorArgs = ['mileage_unit'];
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

                  </div>


                  <hr>


                  

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
                          value="<?php echo e(old('first_registration')); ?>"
                          class="form-control <?php $__errorArgs = ['first_registration'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                        <?php $__errorArgs = ['first_registration'];
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

                        <label for="inspection_date">
                          Inspection / HU-AU Date
                        </label>

                        <input
                          type="date"
                          name="inspection_date"
                          id="inspection_date"
                          value="<?php echo e(old('inspection_date')); ?>"
                          class="form-control <?php $__errorArgs = ['inspection_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                        <?php $__errorArgs = ['inspection_date'];
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

                  </div>


                  <hr>


                  

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
                          value="<?php echo e(old('engine_cc')); ?>"
                          class="form-control <?php $__errorArgs = ['engine_cc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                        <?php $__errorArgs = ['engine_cc'];
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


                    <div class="col-md-3">

                      <div class="form-group">

                        <label for="engine_size">
                          Engine Size
                        </label>

                        <input
                          type="text"
                          name="engine_size"
                          id="engine_size"
                          value="<?php echo e(old('engine_size')); ?>"
                          class="form-control <?php $__errorArgs = ['engine_size'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                          placeholder="e.g. 2.0 L">

                        <?php $__errorArgs = ['engine_size'];
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
                          value="<?php echo e(old('power_hp')); ?>"
                          class="form-control <?php $__errorArgs = ['power_hp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                        <?php $__errorArgs = ['power_hp'];
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
                          value="<?php echo e(old('power_kw')); ?>"
                          class="form-control <?php $__errorArgs = ['power_kw'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                        <?php $__errorArgs = ['power_kw'];
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
                          value="<?php echo e(old('gears')); ?>"
                          class="form-control <?php $__errorArgs = ['gears'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                        <?php $__errorArgs = ['gears'];
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


                    <div class="col-md-5">

                      <div class="form-group">

                        <label for="drivetrain">
                          Drivetrain
                        </label>

                        <input
                          type="text"
                          name="drivetrain"
                          id="drivetrain"
                          value="<?php echo e(old('drivetrain')); ?>"
                          class="form-control <?php $__errorArgs = ['drivetrain'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                          placeholder="e.g. Front Wheel Drive">

                        <?php $__errorArgs = ['drivetrain'];
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
                          value="<?php echo e(old('co2_emissions')); ?>"
                          class="form-control <?php $__errorArgs = ['co2_emissions'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                          placeholder="g/km">

                        <?php $__errorArgs = ['co2_emissions'];
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

                  </div>


                  <hr>


                  

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
                          value="<?php echo e(old('doors')); ?>"
                          class="form-control <?php $__errorArgs = ['doors'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                        <?php $__errorArgs = ['doors'];
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
                          value="<?php echo e(old('seats')); ?>"
                          class="form-control <?php $__errorArgs = ['seats'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                        <?php $__errorArgs = ['seats'];
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

                        <label for="interior_color">
                          Interior Color
                        </label>

                        <input
                          type="text"
                          name="interior_color"
                          id="interior_color"
                          value="<?php echo e(old('interior_color')); ?>"
                          class="form-control <?php $__errorArgs = ['interior_color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                        <?php $__errorArgs = ['interior_color'];
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
                          value="<?php echo e(old('previous_owners')); ?>"
                          class="form-control <?php $__errorArgs = ['previous_owners'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                        <?php $__errorArgs = ['previous_owners'];
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



<div class="col-md-4">

    <div class="form-group">

        <label for="accident_free">
            Accident Free
        </label>

        <select
            name="accident_free"
            id="accident_free"
            class="form-control my-select <?php $__errorArgs = ['accident_free'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

            <option value="">Select</option>

            <option value="1"
                <?php echo e(old('accident_free') == '1' ? 'selected' : ''); ?>>
                Yes
            </option>

            <option value="0"
                <?php echo e(old('accident_free') == '0' ? 'selected' : ''); ?>>
                No
            </option>

        </select>

        <?php $__errorArgs = ['accident_free'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="d-block text-danger mt-1">
                <?php echo e($message); ?>

            </span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    </div>

</div>



<div class="col-md-4">

    <div class="form-group">

        <label for="vat_deductible">
            VAT Deductible
        </label>

        <select
            name="vat_deductible"
            id="vat_deductible"
            class="form-control my-select <?php $__errorArgs = ['vat_deductible'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

            <option value="">Select</option>

            <option value="1"
                <?php echo e(old('vat_deductible') == '1' ? 'selected' : ''); ?>>
                Yes
            </option>

            <option value="0"
                <?php echo e(old('vat_deductible') == '0' ? 'selected' : ''); ?>>
                No
            </option>

        </select>

        <?php $__errorArgs = ['vat_deductible'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="d-block text-danger mt-1">
                <?php echo e($message); ?>

            </span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    </div>

</div>

                  </div>


           <hr>



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
        class="d-none <?php $__errorArgs = ['images'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> <?php $__errorArgs = ['images.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
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

    <?php $__errorArgs = ['images'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

        <span class="d-block text-danger mt-2">
            <?php echo e($message); ?>

        </span>

    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <?php $__errorArgs = ['images.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

        <span class="d-block text-danger mt-2">
            <?php echo e($message); ?>

        </span>

    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

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
                      class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                      placeholder="Enter the complete vehicle description..."><?php echo e(old('description')); ?></textarea>

                    <?php $__errorArgs = ['description'];
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


                  <hr>


                  

                  <div class="section-title">

                    <i class="fas fa-list-check"></i>

                    Equipment & Features

                  </div>


                  <?php $__currentLoopData = $featureCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <?php if($category->features->count()): ?>

                      <div class="feature-group">

                        <div class="feature-group-title">

                          <i class="fas fa-folder-open"></i>

                          <?php echo e($category->name); ?>


                        </div>


                        <div class="row">

                          <?php $__currentLoopData = $category->features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <div class="col-md-4 mb-2">

                              <div class="custom-control custom-checkbox">

                                <input
                                  type="checkbox"
                                  name="features[]"
                                  value="<?php echo e($feature->id); ?>"
                                  id="feature_<?php echo e($feature->id); ?>"
                                  class="custom-control-input"
                                  <?php echo e(in_array(
                                      $feature->id,
                                      old('features', [])
                                  ) ? 'checked' : ''); ?>>

                                <label
                                  class="custom-control-label"
                                  for="feature_<?php echo e($feature->id); ?>">

                                  <?php echo e($feature->name); ?>


                                </label>

                              </div>

                            </div>

                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>

                      </div>

                    <?php endif; ?>

                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                  <?php $__errorArgs = ['features'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                    <div class="feature-error">

                      <i class="fas fa-exclamation-circle"></i>

                      <?php echo e($message); ?>


                    </div>

                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>


                  <?php $__errorArgs = ['features.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                    <div class="feature-error">

                      <i class="fas fa-exclamation-circle"></i>

                      <?php echo e($message); ?>


                    </div>

                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>


                  <hr>


                  

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
                          class="form-control my-select <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                          required>

                          <option
                            value="draft"
                            <?php echo e(old('status', 'draft') === 'draft' ? 'selected' : ''); ?>>

                            Draft

                          </option>

                          <option
                            value="published"
                            <?php echo e(old('status') === 'published' ? 'selected' : ''); ?>>

                            Published

                          </option>

                          <option
                            value="inactive"
                            <?php echo e(old('status') === 'inactive' ? 'selected' : ''); ?>>

                            Inactive

                          </option>

                          <option
                            value="sold"
                            <?php echo e(old('status') === 'sold' ? 'selected' : ''); ?>>

                            Sold

                          </option>

                        </select>

                        <?php $__errorArgs = ['status'];
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

        <label for="is_visible">
            Public Visibility
        </label>

        <select
            name="is_visible"
            id="is_visibleXX"
            class="form-control my-select <?php $__errorArgs = ['is_visible'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

            <option value="">Select</option>

            <option value="1"
                <?php echo e(old('is_visible') == '1' ? 'selected' : ''); ?>>
                Yes
            </option>

            <option value="0"
                <?php echo e(old('is_visible') == '0' ? 'selected' : ''); ?>>
                No
            </option>

        </select>

        <?php $__errorArgs = ['is_visible'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="d-block text-danger mt-1">
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

        <label for="is_featured">
            Featured Vehicle
        </label>

        <select
            name="is_featured"
            id="is_featured"
            class="form-control my-select  <?php $__errorArgs = ['is_featured'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

            <option value="">Select</option>

            <option value="1"
                <?php echo e(old('is_featured') == '1' ? 'selected' : ''); ?>>
                Yes
            </option>

            <option value="0"
                <?php echo e(old('is_featured') == '0' ? 'selected' : ''); ?>>
                No
            </option>

        </select>

        <?php $__errorArgs = ['is_featured'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="d-block text-danger mt-1">
                <?php echo e($message); ?>

            </span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

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
                                class="form-control <?php $__errorArgs = ['meta_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('meta_title', $auto->meta_title ?? '')); ?>"
                                maxlength="255"
                            >

                            <?php $__errorArgs = ['meta_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback">
                                    <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                      
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
                                class="form-control <?php $__errorArgs = ['meta_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                rows="4"
                                maxlength="160"
                            ><?php echo e(old('meta_description', $auto->meta_description ?? '')); ?></textarea>

                            <?php $__errorArgs = ['meta_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback">
                                    <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                      
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
                    href="<?php echo e(route('auto.index')); ?>"
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

<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>

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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/projects/autohande/resources/views/backend/admin/auto/create.blade.php ENDPATH**/ ?>