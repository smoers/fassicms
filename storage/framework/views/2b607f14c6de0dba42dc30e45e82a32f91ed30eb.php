<div class="m-1 p-2 border border-1">
        <div class="border-bottom moco-title-table"><?php echo e($config['title']); ?></div>
        <div class="mt-2">
            <?php echo $__env->make($widget, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
</div>
<?php /**PATH /var/www/moco/fassicms/resources/views/widgets/widget-core.blade.php ENDPATH**/ ?>