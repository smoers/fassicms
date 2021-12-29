<?php $__env->startSection('content'); ?>
    <div class="container p-5 h-100 moco-layout-height">
        <a href="<?php echo e($return); ?>" class="btn moco-btn-sm btn-info"><i class="fas fa-arrow-alt-circle-left"></i> <?php echo e(__('Return')); ?></a>
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <?php echo e($title); ?>

            </div>
            <div class="card-body">
                <?php echo $consult; ?>

            </div>
        </div>
        <a href="<?php echo e($return); ?>" class="btn moco-btn-sm btn-info"><i class="fas fa-arrow-alt-circle-left"></i> <?php echo e(__('Return')); ?></a>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/consult/consult.blade.php ENDPATH**/ ?>