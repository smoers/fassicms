<?php $__env->startSection('content'); ?>
    <div class="container p-5 h-100 moco-layout-height">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <?php echo e($title); ?>

            </div>
            <div class="card-body">
                <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="<?php echo e($action); ?>" moco-validation>
                    <?php echo csrf_field(); ?>
                    <input id="id" name="id" type="hidden" value="<?php echo e($crane->id); ?>">
                    <div class="form-group">
                        <label for="serial"><?php echo e(__('Serial number')); ?></label>
                        <input type="text" id="serial" name="serial" class="form-control" autocomplete="off" value="<?php echo e(old('serial',$crane->serial)); ?>" moco-validation>
                        <div class="moco-error-small danger-darker-hover" id="serialError"></div>
                    </div>
                    <div class="form-group">
                        <label for="model"><?php echo e(__('Model')); ?></label>
                        <input type="text" id="model" name="model" class="form-control" autocomplete="off" value="<?php echo e(old('model', $crane->model)); ?>" moco-validation />
                        <div class="moco-error-small danger-darker-hover" id="modelError"></div>
                    </div>
                    <div class="form-group">
                        <label for="plate"><?php echo e(__('Numberplate')); ?></label>
                        <input type="text" id="plate" name="plate" class="form-control" autocomplete="off" value="<?php echo e(old('plate', $crane->plate)); ?>" moco-validation />
                        <div class="moco-error-small danger-darker-hover" id="plateError"></div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <button type="submit" class="btn btn-primary"><?php echo e(__('Save')); ?></button>
                        </div>
                        <div>
                            <a id="_expert" href="" class="btn btn-warning"><?php echo e(__('Expert mode')); ?></a>
                        </div>
                        <div>
                            <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-primary"><?php echo e(__('Cancel')); ?></a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo e(asset('js/moco.ajax.validation.js')); ?>"></script>
    <script type="text/javascript">
        $(function (){
            /**
             * Expert mode
             */
            if($('#id').val() != ''){
                $('#_expert').show();
                $('#serial').attr('readonly','readonly');
                $('#plate').attr('readonly','readonly');
                $('#_expert').on('click', function (event) {
                    event.preventDefault();
                    $('#serial').removeAttr('readonly');
                    $('#plate').removeAttr('readonly');
                })
            } else {
                $('#_expert').hide();
            }

        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/crane/crane.blade.php ENDPATH**/ ?>