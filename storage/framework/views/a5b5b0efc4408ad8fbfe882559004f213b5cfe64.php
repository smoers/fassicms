<?php $__env->startSection('content'); ?>
    <div class="container p-5 h-100 moco-layout-height">
    <?php if($asReassort && auth()->user()->can('show reassort list')): ?>
        <?php echo $__env->make('store.reassort-level-list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="card">
                <div class="card-body">
            <div class="d-flex justify-content-between">
                <p>Fassi Belgium - Store Management System</p>
                <p>Version 2.0</p>
            </div>
                </div>
            </div>
    <?php else: ?>
            <div class="jumbotron">
                <p class="display-4">
                    Fassi Store Management System
                </p>
                <p>Version 2.0</p>
            </div>
    <?php endif; ?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/root/dashboard.blade.php ENDPATH**/ ?>