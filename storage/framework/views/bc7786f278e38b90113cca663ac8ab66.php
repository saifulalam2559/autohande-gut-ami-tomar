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
    box-shadow:
        0 0 0 0.1rem rgba(0, 0, 0, 0.08) !important;
}


/* ==========================================================
   Upload Area
   ========================================================== */

.upload-zone {
    border: 2px dashed #999;
    border-radius: 10px;
    padding: 35px 20px;
    text-align: center;
    background: #fafafa;
    cursor: pointer;
    transition: all .2s ease;
}

.upload-zone:hover {
    border-color: #007bff;
    background: #f5f9ff;
}

.upload-zone.dragover {
    border-color: #007bff;
    background: #eef6ff;
}

.upload-zone-icon {
    font-size: 48px;
    color: #6c757d;
    margin-bottom: 12px;
}

.upload-zone-title {
    font-size: 19px;
    font-weight: 700;
    margin-bottom: 6px;
}

.upload-zone-text {
    color: #6c757d;
    margin-bottom: 16px;
}


/* ==========================================================
   Image Grid
   ========================================================== */

.image-grid {
    display: grid;
    grid-template-columns: repeat(
        auto-fill,
        minmax(260px, 1fr)
    );
    gap: 18px;
    margin-top: 20px;
}

.image-card {
    position: relative;
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, .06);
}

.image-preview {
    width: 100%;
    height: 190px;
    object-fit: cover;
    display: block;
    background: #f5f5f5;
}

.image-card-body {
    padding: 12px;
}

.image-card-filename {
    font-size: 13px;
    font-weight: 600;
    word-break: break-word;
    margin-bottom: 4px;
}

.image-card-size {
    font-size: 12px;
    color: #6c757d;
}

.image-card-actions {
    padding: 10px 12px;
    border-top: 1px solid #eee;
    background: #fafafa;
}

.image-status {
    font-size: 12px;
    font-weight: 600;
}

.status-pending {
    color: #6c757d;
}

.status-uploading {
    color: #007bff;
}

.status-success {
    color: #28a745;
}

.status-error {
    color: #dc3545;
}

.upload-progress {
    height: 5px;
    margin-top: 7px;
    overflow: hidden;
    border-radius: 4px;
    background: #e9ecef;
}

.upload-progress-bar {
    width: 0;
    height: 100%;
    background: #007bff;
    transition: width .2s ease;
}

.primary-indicator {
    position: absolute;
    top: 10px;
    left: 10px;
    background: #28a745;
    color: #fff;
    padding: 4px 9px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 700;
}

.remove-image {
    position: absolute;
    top: 8px;
    right: 8px;
    width: 32px;
    height: 32px;
    border: 0;
    border-radius: 50%;
    background: rgba(220, 53, 69, .95);
    color: #fff;
    cursor: pointer;
}

.uploaded-check {
    color: #28a745;
}


/* ==========================================================
   Counter
   ========================================================== */

.image-counter {
    font-size: 15px;
    font-weight: 700;
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


                        <div class="card card-primary">

                            

                            <div class="card-header">

                                <h3 class="card-title">

                                    <i class="fas fa-images"></i>

                                    Add Vehicle Images

                                </h3>


                                <a
                                    href="<?php echo e(route('autobilder.index')); ?>"
                                    class="btn btn-danger btn-sm float-right">

                                    <i class="fas fa-list"></i>

                                    Auto Image List

                                </a>

                            </div>


                            

                            <?php if($errors->any()): ?>

                                <div class="card-body pb-0">

                                    <div class="alert alert-danger">

                                        <strong>

                                            <i class="fas fa-exclamation-triangle"></i>

                                            Please correct the following errors:

                                        </strong>

                                        <ul class="mb-0 mt-2">

                                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <li>
                                                    <?php echo e($error); ?>

                                                </li>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </ul>

                                    </div>

                                </div>

                            <?php endif; ?>


                            <div class="card-body">


                                

                                <div class="form-group">

                                    <label for="auto_id">

                                        Vehicle
                                        <span class="text-danger">*</span>

                                    </label>


                                    <select
                                        name="auto_id"
                                        id="auto_id"
                                        class="form-control <?php $__errorArgs = ['auto_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                                        <option value="">

                                            Select Vehicle

                                        </option>


                                        <?php $__currentLoopData = $autos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $auto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <option
                                                value="<?php echo e($auto->id); ?>"
                                                data-image-count="<?php echo e($auto->images_count); ?>"
                                                <?php echo e(old(
                                                    'auto_id',
                                                    $selectedAutoId ?? ''
                                                ) == $auto->id ? 'selected' : ''); ?>>

                                                <?php echo e($auto->brand->name ?? ''); ?>

                                                <?php echo e($auto->model->name ?? ''); ?>


                                                <?php if($auto->variant): ?>

                                                    -
                                                    <?php echo e($auto->variant); ?>


                                                <?php endif; ?>

                                                <?php if($auto->stock_number): ?>

                                                    |
                                                    Stock:
                                                    <?php echo e($auto->stock_number); ?>


                                                <?php endif; ?>

                                            </option>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </select>


                                    <?php $__errorArgs = ['auto_id'];
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


                                

                                <div
                                    id="image-counter-box"
                                    class="alert alert-info"
                                    style="display:none;">

                                    <i class="fas fa-images"></i>

                                    <span
                                        class="image-counter"
                                        id="image-counter">

                                    </span>

                                </div>


                                

                                <div
                                    class="upload-zone"
                                    id="upload-zone">

                                    <div class="upload-zone-icon">

                                        <i class="fas fa-cloud-upload-alt"></i>

                                    </div>


                                    <div class="upload-zone-title">

                                        Select Vehicle Images

                                    </div>


                                    <div class="upload-zone-text">

                                        Drag & drop images here or click to browse.

                                    </div>


                                    <button
                                        type="button"
                                        class="btn btn-primary"
                                        id="choose-images-btn">

                                        <i class="fas fa-folder-open"></i>

                                        Choose Images

                                    </button>


                                    <input
                                        type="file"
                                        id="image"
                                        name="image[]"
                                        accept=".jpg,.jpeg,.png,.webp"
                                        multiple
                                        hidden>

                                    <div class="mt-3 text-muted">

                                        JPG, JPEG, PNG or WEBP.
                                        Maximum 5 MB per image.
                                        Maximum 15 images per vehicle.

                                    </div>

                                </div>


                                

                                <div
                                    id="selected-counter"
                                    class="mt-3"
                                    style="display:none;">

                                    <strong>

                                        <i class="fas fa-images"></i>

                                        Selected Images:

                                    </strong>

                                    <span id="selected-count">

                                        0

                                    </span>

                                </div>


                                

                                <div
                                    id="image-grid"
                                    class="image-grid">
                                </div>


                                

                                <div
                                    id="upload-actions"
                                    class="mt-4"
                                    style="display:none;">

                                    <button
                                        type="button"
                                        id="upload-all-btn"
                                        class="btn btn-primary btn-lg">

                                        <i class="fas fa-cloud-upload-alt"></i>

                                        Upload Images

                                    </button>


                                    <button
                                        type="button"
                                        id="clear-all-btn"
                                        class="btn btn-secondary btn-lg">

                                        <i class="fas fa-trash"></i>

                                        Clear Selection

                                    </button>

                                </div>


                                

                                <div
                                    id="upload-result"
                                    class="mt-4">
                                </div>


                            </div>


                            <div class="card-footer">

                                <a
                                    href="<?php echo e(route('autobilder.index')); ?>"
                                    class="btn btn-secondary">

                                    <i class="fas fa-arrow-left"></i>

                                    Back to Image List

                                </a>

                            </div>


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
    | Elements
    |--------------------------------------------------------------------------
    */

    const autoSelect =
        document.getElementById('auto_id');

    const uploadZone =
        document.getElementById('upload-zone');

    const chooseButton =
        document.getElementById('choose-images-btn');

    const fileInput =
        document.getElementById('image');

    const imageGrid =
        document.getElementById('image-grid');

    const selectedCounter =
        document.getElementById('selected-counter');

    const selectedCount =
        document.getElementById('selected-count');

    const uploadActions =
        document.getElementById('upload-actions');

    const uploadAllButton =
        document.getElementById('upload-all-btn');

    const clearAllButton =
        document.getElementById('clear-all-btn');

    const imageCounterBox =
        document.getElementById('image-counter-box');

    const imageCounter =
        document.getElementById('image-counter');

    const uploadResult =
        document.getElementById('upload-result');


    /*
    |--------------------------------------------------------------------------
    | State
    |--------------------------------------------------------------------------
    */

    let selectedFiles = [];

    let existingImageCount = 0;

    let uploadedCount = 0;


    /*
    |--------------------------------------------------------------------------
    | Vehicle Image Count
    |--------------------------------------------------------------------------
    */

    function updateVehicleCounter() {

        const option =
            autoSelect.options[
                autoSelect.selectedIndex
            ];


        if (
            !option ||
            !option.value
        ) {

            imageCounterBox.style.display =
                'none';

            existingImageCount = 0;

            return;
        }


        existingImageCount =
            parseInt(
                option.dataset.imageCount || '0',
                10
            );


        const remaining =
            Math.max(
                0,
                15 - existingImageCount
            );


        imageCounterBox.style.display =
            'block';


        imageCounter.innerHTML =
            '<strong>' +
            option.text.trim() +
            '</strong>' +
            ' has <strong>' +
            existingImageCount +
            ' / 15</strong> images. ' +
            '<strong>' +
            remaining +
            '</strong> image slot(s) remaining.';


        updateFileInputState();
    }


    autoSelect.addEventListener(
        'change',
        function () {

            selectedFiles = [];

            imageGrid.innerHTML = '';

            uploadedCount = 0;

            uploadResult.innerHTML = '';

            updateVehicleCounter();

            updateCounters();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Disable Selection When 15 Reached
    |--------------------------------------------------------------------------
    */

    function updateFileInputState() {

        const remaining =
            15 - existingImageCount;


        if (remaining <= 0) {

            fileInput.disabled = true;

            chooseButton.disabled = true;

            uploadZone.style.opacity =
                '0.6';

        } else {

            fileInput.disabled = false;

            chooseButton.disabled = false;

            uploadZone.style.opacity =
                '1';

        }
    }


    /*
    |--------------------------------------------------------------------------
    | File Picker
    |--------------------------------------------------------------------------
    */

    chooseButton.addEventListener(
        'click',
        function () {

            if (!autoSelect.value) {

                alert(
                    'Please select a vehicle first.'
                );

                return;
            }

            fileInput.click();

        }
    );


    uploadZone.addEventListener(
        'click',
        function (event) {

            if (
                event.target ===
                chooseButton
            ) {

                return;
            }


            if (!autoSelect.value) {

                alert(
                    'Please select a vehicle first.'
                );

                return;
            }


            if (!fileInput.disabled) {

                fileInput.click();

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Drag & Drop
    |--------------------------------------------------------------------------
    */

    uploadZone.addEventListener(
        'dragover',
        function (event) {

            event.preventDefault();

            uploadZone.classList.add(
                'dragover'
            );

        }
    );


    uploadZone.addEventListener(
        'dragleave',
        function () {

            uploadZone.classList.remove(
                'dragover'
            );

        }
    );


    uploadZone.addEventListener(
        'drop',
        function (event) {

            event.preventDefault();

            uploadZone.classList.remove(
                'dragover'
            );


            if (!autoSelect.value) {

                alert(
                    'Please select a vehicle first.'
                );

                return;
            }


            if (fileInput.disabled) {

                return;

            }


            addFiles(
                Array.from(
                    event.dataTransfer.files
                )
            );

        }
    );


    /*
    |--------------------------------------------------------------------------
    | File Selection
    |--------------------------------------------------------------------------
    */

    fileInput.addEventListener(
        'change',
        function () {

            addFiles(
                Array.from(
                    fileInput.files
                )
            );

            fileInput.value = '';

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Add Files
    |--------------------------------------------------------------------------
    */

    function addFiles(files) {

        const remainingSlots =
            15 -
            existingImageCount -
            selectedFiles.length;


        if (remainingSlots <= 0) {

            showResult(
                'warning',
                'This vehicle already has 15 images.'
            );

            return;

        }


        const allowedFiles =
            files.slice(
                0,
                remainingSlots
            );


        if (
            files.length >
            allowedFiles.length
        ) {

            showResult(
                'warning',
                'Only ' +
                remainingSlots +
                ' more image(s) can be selected for this vehicle.'
            );

        }


        allowedFiles.forEach(
            function (file) {

                if (
                    ![
                        'image/jpeg',
                        'image/png',
                        'image/webp'
                    ].includes(
                        file.type
                    )
                ) {

                    showResult(
                        'danger',
                        file.name +
                        ' is not a supported image format.'
                    );

                    return;
                }


                if (
                    file.size >
                    5 * 1024 * 1024
                ) {

                    showResult(
                        'danger',
                        file.name +
                        ' is larger than 5 MB.'
                    );

                    return;
                }


                const duplicate =
                    selectedFiles.some(
                        function (item) {

                            return (
                                item.file.name ===
                                    file.name
                                &&
                                item.file.size ===
                                    file.size
                            );

                        }
                    );


                if (duplicate) {

                    return;

                }


                selectedFiles.push({

                    file: file,

                    id:
                        'image_' +
                        Date.now() +
                        '_' +
                        Math.random()
                            .toString(36)
                            .substring(2),

                    uploaded: false,

                    uploading: false,

                    failed: false,

                    serverId: null,

                    primary: false

                });

            }
        );


        /*
        |--------------------------------------------------------------------------
        | First Selected Image As Default Primary
        |--------------------------------------------------------------------------
        */

        const hasPrimary =
            selectedFiles.some(
                function (item) {
                    return item.primary;
                }
            );


        if (
            !hasPrimary &&
            selectedFiles.length > 0 &&
            existingImageCount === 0
        ) {

            selectedFiles[0].primary = true;

        }


        renderGrid();

        updateCounters();

    }


    /*
    |--------------------------------------------------------------------------
    | Render Grid
    |--------------------------------------------------------------------------
    */

    function renderGrid() {

        imageGrid.innerHTML = '';


        selectedFiles.forEach(
            function (item, index) {

                const reader =
                    new FileReader();


                reader.onload =
                    function (event) {

                        const card =
                            document.createElement(
                                'div'
                            );

                        card.className =
                            'image-card';


                        card.dataset.id =
                            item.id;


                        card.innerHTML = `

                            ${
                                item.primary
                                    ? `
                                        <div class="primary-indicator">
                                            <i class="fas fa-star"></i>
                                            PRIMARY
                                        </div>
                                      `
                                    : ''
                            }

                            ${
                                item.uploaded
                                    ? `
                                        <div class="primary-indicator"
                                             style="background:#28a745; left:auto; right:10px;">
                                            <i class="fas fa-check"></i>
                                            UPLOADED
                                        </div>
                                      `
                                    : ''
                            }

                            <button
                                type="button"
                                class="remove-image"
                                data-id="${item.id}"
                                ${
                                    item.uploading
                                        ? 'disabled'
                                        : ''
                                }>

                                <i class="fas fa-times"></i>

                            </button>


                            <img
                                src="${event.target.result}"
                                class="image-preview"
                                alt="${escapeHtml(item.file.name)}">


                            <div class="image-card-body">

                                <div class="image-card-filename">

                                    ${escapeHtml(item.file.name)}

                                </div>


                                <div class="image-card-size">

                                    ${formatBytes(item.file.size)}

                                </div>


                                <div class="form-group mt-2 mb-2">

                                    <label class="small font-weight-bold">

                                        Alt Text

                                    </label>

                                    <input
                                        type="text"
                                        class="form-control form-control-sm alt-input"
                                        data-id="${item.id}"
                                        placeholder="e.g. Front view of BMW 320d"
                                        ${
                                            item.uploaded ||
                                            item.uploading
                                                ? 'disabled'
                                                : ''
                                        }>

                                </div>


                                <div class="custom-control custom-radio">

                                    <input
                                        type="radio"
                                        name="primary_image"
                                        id="primary_${item.id}"
                                        class="custom-control-input primary-radio"
                                        data-id="${item.id}"
                                        ${
                                            item.primary
                                                ? 'checked'
                                                : ''
                                        }
                                        ${
                                            item.uploaded ||
                                            item.uploading
                                                ? 'disabled'
                                                : ''
                                        }>

                                    <label
                                        class="custom-control-label"
                                        for="primary_${item.id}">

                                        Primary Image

                                    </label>

                                </div>


                            </div>


                            <div class="image-card-actions">

                                <div class="image-status
                                    ${
                                        item.uploaded
                                            ? 'status-success'
                                            : item.uploading
                                                ? 'status-uploading'
                                                : item.failed
                                                    ? 'status-error'
                                                    : 'status-pending'
                                    }">

                                    ${
                                        item.uploaded
                                            ? '<i class="fas fa-check"></i> Uploaded'
                                            : item.uploading
                                                ? '<i class="fas fa-spinner fa-spin"></i> Uploading...'
                                                : item.failed
                                                    ? '<i class="fas fa-exclamation-circle"></i> Upload Failed'
                                                    : '<i class="fas fa-clock"></i> Ready'
                                    }

                                </div>


                                <div class="upload-progress">

                                    <div
                                        class="upload-progress-bar"
                                        data-progress-id="${item.id}">
                                    </div>

                                </div>

                            </div>

                        `;


                        imageGrid.appendChild(
                            card
                        );

                    };


                reader.readAsDataURL(
                    item.file
                );

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Bind Remove Buttons
        |--------------------------------------------------------------------------
        */

        setTimeout(
            bindGridEvents,
            100
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Grid Events
    |--------------------------------------------------------------------------
    */

    function bindGridEvents() {

        document
            .querySelectorAll(
                '.remove-image'
            )
            .forEach(
                function (button) {

                    button.onclick =
                        function () {

                            const id =
                                this.dataset.id;


                            selectedFiles =
                                selectedFiles.filter(
                                    function (item) {
                                        return (
                                            item.id !==
                                            id
                                        );
                                    }
                                );


                            renderGrid();

                            updateCounters();

                        };

                }
            );


        document
            .querySelectorAll(
                '.primary-radio'
            )
            .forEach(
                function (radio) {

                    radio.onchange =
                        function () {

                            const id =
                                this.dataset.id;


                            selectedFiles.forEach(
                                function (item) {

                                    item.primary =
                                        item.id === id;

                                }
                            );


                            renderGrid();

                        };

                }
            );


        document
            .querySelectorAll(
                '.alt-input'
            )
            .forEach(
                function (input) {

                    input.oninput =
                        function () {

                            const id =
                                this.dataset.id;


                            const item =
                                selectedFiles.find(
                                    function (item) {
                                        return (
                                            item.id === id
                                        );
                                    }
                                );


                            if (item) {

                                item.altText =
                                    this.value;

                            }

                        };

                }
            );

    }


    /*
    |--------------------------------------------------------------------------
    | Counters
    |--------------------------------------------------------------------------
    */

    function updateCounters() {

        const count =
            selectedFiles.length;


        if (count > 0) {

            selectedCounter.style.display =
                'block';

            uploadActions.style.display =
                'block';

        } else {

            selectedCounter.style.display =
                'none';

            uploadActions.style.display =
                'none';

        }


        selectedCount.textContent =
            count;

    }


    /*
    |--------------------------------------------------------------------------
    | Upload All
    |--------------------------------------------------------------------------
    */

    uploadAllButton.addEventListener(
        'click',
        async function () {

            if (!autoSelect.value) {

                showResult(
                    'danger',
                    'Please select a vehicle first.'
                );

                return;

            }


            const pending =
                selectedFiles.filter(
                    function (item) {

                        return (
                            !item.uploaded &&
                            !item.uploading
                        );

                    }
                );


            if (!pending.length) {

                showResult(
                    'success',
                    'All selected images have already been uploaded.'
                );

                return;

            }


            /*
            |--------------------------------------------------------------------------
            | Protect 15 Image Limit
            |--------------------------------------------------------------------------
            */

            const availableSlots =
                15 -
                existingImageCount;


            if (
                pending.length >
                availableSlots
            ) {

                showResult(
                    'danger',
                    'Only ' +
                    availableSlots +
                    ' image slot(s) remain for this vehicle.'
                );

                return;

            }


            uploadAllButton.disabled = true;

            clearAllButton.disabled = true;


            let successCount = 0;

            let failCount = 0;


            /*
            |--------------------------------------------------------------------------
            | Upload Sequentially
            |--------------------------------------------------------------------------
            |
            | We intentionally upload one request at a time.
            | This is reliable and preserves image order.
            |
            |--------------------------------------------------------------------------
            */

            for (
                const item of pending
            ) {

                const success =
                    await uploadSingleImage(
                        item
                    );


                if (success) {

                    successCount++;

                } else {

                    failCount++;

                }

            }


            uploadAllButton.disabled = false;

            clearAllButton.disabled = false;


            if (failCount === 0) {

                showResult(
                    'success',
                    successCount +
                    ' image(s) uploaded successfully.'
                );

            } else {

                showResult(
                    'warning',
                    successCount +
                    ' image(s) uploaded successfully. ' +
                    failCount +
                    ' image(s) failed.'
                );

            }


            renderGrid();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Upload Single Image
    |--------------------------------------------------------------------------
    */

    async function uploadSingleImage(
        item
    ) {

        item.uploading = true;

        item.failed = false;

        renderGrid();


        const formData =
            new FormData();


        formData.append(
            'auto_id',
            autoSelect.value
        );


        formData.append(
            'image',
            item.file
        );


        formData.append(
            'alt_text',
            item.altText || ''
        );


        formData.append(
            'sort_order',
            selectedFiles.indexOf(
                item
            )
        );


        if (item.primary) {

            formData.append(
                'is_primary',
                '1'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | CSRF
        |--------------------------------------------------------------------------
        */

        const csrfToken =
            document
                .querySelector(
                    'meta[name="csrf-token"]'
                );


        try {

            const response =
                await fetch(
                    "<?php echo e(route('autobilder.store')); ?>",
                    {
                        method: 'POST',

                        headers: {

                            'X-CSRF-TOKEN':
                                csrfToken
                                    ? csrfToken
                                        .getAttribute('content')
                                    : "<?php echo e(csrf_token()); ?>",

                            'Accept':
                                'application/json',

                            'X-Requested-With':
                                'XMLHttpRequest'

                        },

                        body: formData

                    }
                );


            const data =
                await response.json();


            if (!response.ok) {

                throw new Error(
                    data.message ||
                    'The image upload failed.'
                );

            }


            if (!data.success) {

                throw new Error(
                    data.message ||
                    'The image upload failed.'
                );

            }


            item.uploaded =
                true;

            item.uploading =
                false;

            item.failed =
                false;

            item.serverId =
                data.image.id;


            uploadedCount++;


            /*
            |--------------------------------------------------------------------------
            | Once Uploaded, Prevent It From Being
            | Selected As Another Primary
            |--------------------------------------------------------------------------
            */

            if (
                data.image.is_primary
            ) {

                selectedFiles.forEach(
                    function (other) {

                        if (
                            other.id !==
                            item.id
                        ) {

                            other.primary =
                                false;

                        }

                    }
                );

            }


            /*
            |--------------------------------------------------------------------------
            | Update Remaining Count
            |--------------------------------------------------------------------------
            */

            existingImageCount++;


            /*
            |--------------------------------------------------------------------------
            | Current Item No Longer Counts As Pending
            |--------------------------------------------------------------------------
            */


            return true;


        } catch (error) {

            console.error(
                error
            );


            item.uploaded =
                false;

            item.uploading =
                false;

            item.failed =
                true;


            item.errorMessage =
                error.message;


            return false;

        } finally {

            renderGrid();

            updateVehicleCounter();

            updateCounters();

        }

    }


    /*
    |--------------------------------------------------------------------------
    | Clear
    |--------------------------------------------------------------------------
    */

    clearAllButton.addEventListener(
        'click',
        function () {

            const hasUploaded =
                selectedFiles.some(
                    function (item) {
                        return item.uploaded;
                    }
                );


            if (hasUploaded) {

                showResult(
                    'warning',
                    'Uploaded images are already saved. Only pending images can be removed individually.'
                );

                return;

            }


            selectedFiles = [];

            imageGrid.innerHTML = '';

            uploadResult.innerHTML = '';

            updateCounters();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Result Message
    |--------------------------------------------------------------------------
    */

    function showResult(
        type,
        message
    ) {

        uploadResult.innerHTML = `

            <div class="alert alert-${type}">

                <i class="fas fa-info-circle"></i>

                ${escapeHtml(message)}

            </div>

        `;

    }


    /*
    |--------------------------------------------------------------------------
    | Format Bytes
    |--------------------------------------------------------------------------
    */

    function formatBytes(
        bytes
    ) {

        if (
            bytes === 0
        ) {

            return '0 Bytes';

        }


        const units = [
            'Bytes',
            'KB',
            'MB',
            'GB'
        ];


        const index =
            Math.floor(
                Math.log(bytes) /
                Math.log(1024)
            );


        return (
            parseFloat(
                (
                    bytes /
                    Math.pow(
                        1024,
                        index
                    )
                ).toFixed(2)
            ) +
            ' ' +
            units[index]
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Escape HTML
    |--------------------------------------------------------------------------
    */

    function escapeHtml(
        value
    ) {

        return String(value)
            .replace(
                /&/g,
                '&amp;'
            )
            .replace(
                /</g,
                '&lt;'
            )
            .replace(
                />/g,
                '&gt;'
            )
            .replace(
                /"/g,
                '&quot;'
            )
            .replace(
                /'/g,
                '&#039;'
            );

    }


    /*
    |--------------------------------------------------------------------------
    | Initialize
    |--------------------------------------------------------------------------
    */

    updateVehicleCounter();

    updateCounters();

});

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/projects/autohande/resources/views/backend/admin/autoimage/create.blade.php ENDPATH**/ ?>