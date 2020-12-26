<?php $__env->startSection('content'); ?>
    <div class="container p-5 h-100 moco-layout-height">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <?php echo e(__('Add a crane')); ?>

            </div>
            <div class="card-body">
                <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="<?php echo e(route('crane.store')); ?>" moco-validation>
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="serial"><?php echo e(__('Serial number')); ?></label>
                        <input type="text" id="serial" name="serial" class="form-control" autocomplete="off" value="<?php echo e(old('serial')); ?>" moco-validation>
                        <div class="moco-error-small danger-darker-hover" id="serialError"></div>
                    </div>
                    <div class="form-group">
                        <label for="model"><?php echo e(__('Model')); ?></label>
                        <input type="text" id="model" name="model" class="form-control" autocomplete="off" value="<?php echo e(old('model')); ?>" moco-validation />
                        <div class="moco-error-small danger-darker-hover" id="modelError"></div>
                    </div>
                    <div class="form-group">
                        <label for="plate"><?php echo e(__('Numberplate')); ?></label>
                        <input type="text" id="plate" name="plate" class="form-control" autocomplete="off" value="<?php echo e(old('plate')); ?>" moco-validation />
                        <div class="moco-error-small danger-darker-hover" id="plateError"></div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary"><?php echo e(__('Save')); ?></button>
                        </div>
                        <div class="col-10">
                            <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-primary"><?php echo e(__('Cancel')); ?></a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo e(asset('js/moco.ajax.validation.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/forms/crane.blade.php ENDPATH**/ ?>