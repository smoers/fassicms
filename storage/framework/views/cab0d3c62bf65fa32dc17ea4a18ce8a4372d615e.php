<?php $__env->startSection('content'); ?>
    <div class="container p-5 h-100 moco-layout-height" style="min-width: 50vw">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2 class="blue-grey-darker-hover"><?php echo e($title); ?></h2>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-around">
                    <div class="d-flex justify-content-center">
                    <div><?php echo e(__('Number of worksheet')); ?> : </div>
                    <div><input type="number" id="nbr" name="nbr" class="form-control ml-3" value="0"></div></div>
                    <div><a href="#" class="btn btn-danger"><?php echo e(__('Launch')); ?></a> </div>
                </div>

            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/worksheet/worksheet-mass-create.blade.php ENDPATH**/ ?>