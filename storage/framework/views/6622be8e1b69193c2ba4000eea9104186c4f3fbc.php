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
                        <h4 class="blue-grey-darker-hover"><?php echo e(__('Collecting spare parts')); ?></h4>
                        <p class="info-lighter-hover" style="font-size: small"><?php echo e(__('Now, you can collect the parts in the bins and scan the barcode available on this bins.')); ?></p>
                        <p class="red-darker-hover"><?php echo e(__('Worksheet').' : '.$number); ?></p>
                        <form name="outworksheet-form" id="outworksheet-form" method="post" action="<?php echo e(route('outworksheet.treatment')); ?>">
                        <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <input name="number" value="<?php echo e($number); ?>" hidden>
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
        <?php elseif($step == 30): ?>
            <div class="card">
                <div class="card-header text-center font-weight-bold">
                    <h2 class="blue-grey-darker-hover"><?php echo e(__('Out of stock validation')); ?></h2>
                </div>
                <div class="card-body">
                    <form name="part-form" id="part-form" method="post" action="<?php echo e(route('outworksheet.validation')); ?>" moco-validation-table>
                        <?php echo csrf_field(); ?>
                        <div class="moco-table-wrapper-scroll-y moco-scrollbar">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th><?php echo e(__('Part number')); ?></th>
                                    <th><?php echo e(__('Qty')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php  $index = 0; ?>
                                <?php $__currentLoopData = $parts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <input type="text" id="part_number<?php echo e($index); ?>"  name="part_number[]" class="form-control" value="<?php echo e(old('part_number',$part->part_number)); ?>" moco-validation-table>
                                            <div class="moco-error-small danger-darker-hover" id="part_number<?php echo e($index); ?>Error"></div>
                                        </td>
                                        <td>
                                            <input type="number" id="qty<?php echo e($index); ?>" name="qty[]" class="form-control" value="<?php echo e(old('qty',$part->qty)); ?>" moco-validation-table>
                                            <div class="moco-error-small danger-darker-hover" id="qty<?php echo e($index); ?>Error"></div>
                                        </td>
                                    </tr>
                                    <?php  $index++; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <button type="submit" class="btn btn-primary"><?php echo e(__('Validate')); ?></button>
                            </div>
                            <div>
                                <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-primary"><?php echo e(__('Cancel')); ?></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <script type="text/javascript" src="<?php echo e(asset('js/moco.ajax.validation.js')); ?>"></script>
        <?php endif; ?>
    </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/outworksheet/outworksheet-form.blade.php ENDPATH**/ ?>