<!DOCTYPE html>
<html lang="en">

  <!--Start Head -->

  <?php echo $__env->make('backend.layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <!-- End Head -->

<body>

<div id="wrapper">
    
    
    
     <!-- Main Sidebar Container -->
  <?php if(Auth::check() && Auth::user()->yesAdmin()): ?>
  
       <?php echo $__env->make('backend.layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  
  <?php elseif(Auth::check() && Auth::user()->yesCustomer()): ?>
  
        <?php echo $__env->make('backend.layouts.sidebarcustomer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        
  <?php elseif(Auth::check() && Auth::user()->yesSeller()): ?>
  
        <?php echo $__env->make('backend.layouts.sidebarseller', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        
  
  <?php endif; ?>
  
    <!-- end Sidebar -->

    

    <!-- /#sidebar-wrapper -->

    <!-- Page Content tag and nav-->
    <div id="page-content-wrapper">
        <?php echo $__env->make('backend.layouts.nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

          <!-- Content Wrapper. Contains page content -->
         <?php echo $__env->yieldContent('content'); ?>
         <!-- /.content-wrapper -->

    </div>
    <!-- /#page-content-wrapper -->

    <!-- Footer -->
    <?php echo $__env->make('backend.layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

   
</body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/projects/autohande/resources/views/backend/layouts/master.blade.php ENDPATH**/ ?>