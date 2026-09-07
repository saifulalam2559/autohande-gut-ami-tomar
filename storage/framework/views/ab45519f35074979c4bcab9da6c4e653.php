<div style="padding:15px 15px 15px 2px;">
    
<?php if($paginator->hasPages()): ?>
    <ul class="pagination">
       
        <?php if($paginator->onFirstPage()): ?>
            <li class="page-link"><span>← Zurück</span></li>
        <?php else: ?>
            <li><a class="page-link" href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev">← Zurück</a></li>
        <?php endif; ?>


      
        <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           
            <?php if(is_string($element)): ?>
                <li class="page-link"><span><?php echo e($element); ?></span></li>
            <?php endif; ?>


           
            <?php if(is_array($element)): ?>
                <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($page == $paginator->currentPage()): ?>
                        <li class="page-link active"><span><?php echo e($page); ?></span></li>
                    <?php else: ?>
                        <li><a class="page-link" href="<?php echo e($url); ?>"><?php echo e($page); ?></a></li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        
        <?php if($paginator->hasMorePages()): ?>
            <li><a class="page-link" href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next">Weiter →</a></li>
        <?php else: ?>
            <li class="page-link"><span>Weiter →</span></li>
        <?php endif; ?>
    </ul>
<?php endif; ?> 


</div><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/projects/autohande/resources/views/pagination-links.blade.php ENDPATH**/ ?>