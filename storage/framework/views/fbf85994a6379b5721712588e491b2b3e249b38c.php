<?php $__env->startSection('body'); ?>
<div class="d-flex flex-sm-row">
    <div class="d-flex flex-sm-column mr-2">
        <img src="<?php echo e(asset('images/stock-48.png')); ?>">
    </div>
    <div class="d-flex flex-sm-column">
        <div><?php echo e(__('Spares to restock')); ?>: <?php echo e($config['count']); ?></div>
        <a href="<?php echo e($config['report']); ?>" class="btn btn-success moco-btn-sm"><?php echo e(__('Show report')); ?></a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('widgets.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/widgets/stock_info.blade.php ENDPATH**/ ?>