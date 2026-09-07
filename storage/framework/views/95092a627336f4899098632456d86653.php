<?php $__env->startSection('content'); ?>












<form action="" method="post"> 
    <?php echo csrf_field(); ?>
        <!-- page-title -->
        <div class="tf-page-title" style="margin-top:100px;">
            <div class="container-full">
                <div class="row">
                    <div class="col-12">
                        <h1 class="heading text-center">404 Error  </h1>
                        <p class="text-center text-2 text_black-2 mt_5">Sorry, that page does not exist</p> 
                       
                    </div>
                </div>
            </div>
        </div>
        <!-- /page-title -->
        <section class="flat-spacing-1">
            <div class="container">
               
                <div class="row">
                    
                    <div class="col-md-12">
                       Sorry, that page does not exist
                    </div>
                    
                    
                </div>
                
            </div>
        </section>
        <div class="btn-sidebar-style2">
            <button data-bs-toggle="offcanvas" data-bs-target="#sidebarmobile" aria-controls="offcanvas"><i class="icon icon-sidebar-2"></i></button>
        </div>


    </form>
 <style>

     
   


 </style>

 <?php $__env->stopSection(); ?>
 
 

 
 
 <?php $__env->startSection('scripts'); ?>
 




 

 
 <?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/projects/autohande/resources/views/errors/404.blade.php ENDPATH**/ ?>