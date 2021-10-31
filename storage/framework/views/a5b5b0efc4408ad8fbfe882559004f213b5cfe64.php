<?php $__env->startSection('content'); ?>
    <div class="container p-5 h-100 moco-layout-height">
        <div class="d-flex flex-wrap">
            <?php echo app('arrilot.widget')->run('VersionInfo'); ?>
            <?php if($asReassort && auth()->user()->can('show reassort list')): ?>
                <?php echo app('arrilot.async-widget')->run('StockInfo'); ?>
            <?php endif; ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/root/dashboard.blade.php ENDPATH**/ ?>