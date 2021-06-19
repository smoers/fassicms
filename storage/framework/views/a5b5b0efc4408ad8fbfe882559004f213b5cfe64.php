<?php $__env->startSection('content'); ?>
    <div class="container p-5 h-100 moco-layout-height">
    <?php if($asReassort && auth()->user()->can('show reassort list')): ?>
        <?php echo $__env->make('store.reassort-level-list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="card">
                <div class="card-body">
            <div class="d-flex justify-content-between">
                <p>Fassi Belgium - Store Management System</p>
                <p><?php echo e(config('moco.app.version')); ?></p>
            </div>
                </div>
            </div>
    <?php else: ?>
            <div class="jumbotron">
                <p class="display-4">
                    Fassi Store Management System
                </p>
                <p><?php echo config('moco.app.version'); ?></p>
                <p class="text text-info" style="font-style: italic;font-weight: bold;font-size: 10px">Release note :</p>
                <p class="text text-info" style="font-style: italic; font-size: 10px"><?php echo config('moco.app.release'); ?></p>
            </div>
    <?php endif; ?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/root/dashboard.blade.php ENDPATH**/ ?>