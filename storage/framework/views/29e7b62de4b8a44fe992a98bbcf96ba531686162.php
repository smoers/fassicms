<?php $__env->startSection('content'); ?>
    <div class="container p-5 h-100 fassi-layout-height">
        <?php if(session('status')): ?>
            <div class="alert alert-success">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <?php echo e(__('Add a crane')); ?>

            </div>
            <div class="card-body">
                <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="<?php echo e(url('store-form')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="serial"><?php echo e(__('Serial number')); ?></label>
                        <input type="text" id="serial" name="serial" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label for="model"><?php echo e(__('Model')); ?></label>
                        <input type="text" id="model "name="model" class="form-control" required=""></input>
                    </div>
                    <div class="form-group">
                        <label for="plate"><?php echo e(__('Numberplate')); ?></label>
                        <input type="text" id="plate "name="plate" class="form-control" required=""></input>
                    </div>
                    <div class="row">
                        <div class="col-1">
                            <button type="submit" class="btn btn-primary"><?php echo e(__('Save')); ?></button>
                        </div>
                        <div class="col-11">
                            <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-primary"><?php echo e(__('Cancel')); ?></a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/forms/crane.blade.php ENDPATH**/ ?>