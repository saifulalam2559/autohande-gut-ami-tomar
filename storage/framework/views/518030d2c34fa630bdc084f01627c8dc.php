<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

  <!--Start Head -->

  <?php echo $__env->make('frontend.layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <!-- End Head -->

<body class="body header-fixed">
    
    

    <div class="preload preload-container">
        <div class="middle">
        </div>
    </div>

    <!-- /preload -->

    <div id="wrapper">
        <div id="pagee" class="clearfix">
            
            

            <!-- Main Header 3-->
           <?php echo $__env->make('frontend.layouts.nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <!-- End Main Header 3-->
            
            
            


            
             <!-- main part  -->
              <?php echo $__env->yieldContent('content'); ?>  
            <!-- end main part  -->


            <!-- Footer -->
              <?php echo $__env->make('frontend.layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <!-- end Footer -->
    
    
     <?php echo $__env->make('frontend.layouts.footerjs', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</body>

</html><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/projects/autohande/resources/views/frontend/layouts/master.blade.php ENDPATH**/ ?>