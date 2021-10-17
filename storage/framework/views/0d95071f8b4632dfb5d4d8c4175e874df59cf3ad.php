<div class="card mr-3 mb-3 moco-widget" style="width: <?php echo e($config['width']); ?>;height: <?php echo e($config['height']); ?>">
    <div class="card-body">
        <div class="card-title moco-title-table"><?php echo e($config['title']); ?></div>
        <div class="card-body">
            <?php echo $__env->yieldContent('body'); ?>
        </div>
    </div>
</div>
<?php /**PATH /var/www/moco/fassicms/resources/views/widgets/template.blade.php ENDPATH**/ ?>