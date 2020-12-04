<?php $__env->startSection('content'); ?>
    <div class="container p-5 h-100 moco-layout-height">
        <?php if($step == 10): ?>
            <div class="d-flex justify-content-center">
                <div class="card" style="width: 30rem;">
                    <img class="card-img-top" src="<?php echo e(asset('images/barcode-scanner.jpg')); ?>" alt="Card image cap">
                    <div class="card-body">
                        <h2 class="blue-grey-darker-hover"><?php echo e(__('Out on worksheet')); ?></h2>
                        <p class="card-text"><?php echo e(__('Please scan the barcode available on your worksheet !')); ?></p>
                        <form name="outworksheet-form" id="outworksheet-form" method="post" action="<?php echo e(route('outworksheet.out')); ?>">
                        <?php echo csrf_field(); ?>

                        <!-- Name -->
                            <div class="form-group">
                                <input type="text" id="number" name="number" class="form-control" value="<?php echo e(old('number')); ?>">
                                <div class="moco-error-small danger-darker-hover" id="numberError"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $(function () {
                    $('#number').focus();
                });
            </script>
        <?php elseif($step == 20): ?>
            <div class="d-flex justify-content-center">
                <div class="card" style="width: 30rem;">
                    <img class="card-img-top" src="<?php echo e(asset('images/barcode-scanner.jpg')); ?>" alt="Card image cap">
                    <div class="card-body">
                        <h2 class="blue-grey-darker-hover"><?php echo e(__('Collecting spare parts')); ?></h2>
                        <p class="card-text"><?php echo e(__('Now, you can collect the parts in the bins and scan the barcode available on this bins.')); ?></p>
                        <form name="outworksheet-form" id="outworksheet-form" method="post" action="<?php echo e(route('outworksheet.treatment')); ?>">
                        <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <textarea id="parts" name="parts" class="form-control" value="<?php echo e(old('parts')); ?>" rows="5"></textarea>
                                <div class="moco-error-small danger-darker-hover" id="numberError"></div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <button type="submit" class="btn btn-primary"><?php echo e(__('Treatment')); ?></button>
                                </div>
                                <div>
                                    <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-primary"><?php echo e(__('Cancel')); ?></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $(function () {
                    $('#parts').focus();
                });
            </script>
        <?php endif; ?>
    </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/outworksheet/outworksheet-form.blade.php ENDPATH**/ ?>