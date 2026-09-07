


<?php if(session('success')): ?>

<div id="error-message">
<div class="alert alert-success alert-dismissible fade show" role="alert" id="alert" style="margin-top: 30px;">
  <?php echo e(session('success')); ?>

  <button type="button" class="close btn btn-danger " data-dismiss="alert" aria-label="Close" style="float: right;">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
</div>
<?php elseif(session('error')): ?>
<div id="error-message">
<div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert">
  <?php echo e(session('error')); ?>

  <button type="button"  class="close btn btn-danger " data-dismiss="alert" aria-label="Close" style="float: right;">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
</div>

<?php endif; ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/projects/autohande/resources/views/backend/layouts/notification.blade.php ENDPATH**/ ?>