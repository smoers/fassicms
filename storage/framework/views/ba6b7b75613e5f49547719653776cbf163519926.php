
<div class="d-flex flex-sm-row">
    <div class="d-flex flex-sm-column mr-2">
        <img src="<?php echo e(asset('images/stock-48.png')); ?>">
    </div>
    <div class="d-flex flex-sm-column">
        <div style="font-size: 12px"><?php echo e(__('Spares to restock')); ?>: <?php echo e($config['count']); ?></div>
        <a href="<?php echo e(route('reporting.from',3)); ?>" class="btn btn-success moco-btn-sm"><?php echo e(__('Show report')); ?></a>
    </div>
</div>
<?php /**PATH /var/www/moco/fassicms/resources/views/widgets/stock-info.blade.php ENDPATH**/ ?>