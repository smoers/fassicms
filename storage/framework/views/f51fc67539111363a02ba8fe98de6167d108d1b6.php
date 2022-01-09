<?php $__env->startSection('content'); ?>
    <div class="container p-5 h-100 moco-layout-height" style="min-width: 50vw">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2 class="blue-grey-darker-hover"><?php echo e(__('Parts list')); ?></h2>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <div class="d-flex flex-row">
                        <div class="mr-2"><?php echo e(_('Date')); ?> :</div>
                        <div class="mr-2"><?php echo e($worksheet->date); ?></div>
                    </div>
                    <div class="d-flex flex-row">
                        <div class="mr-2"><?php echo e(_('Number')); ?> :</div>
                        <div class="mr-2 moco-color-error"><?php echo e($worksheet->number); ?></div>
                    </div>
                    <div class="d-flex flex-row">
                        <div class="mr-2"><?php echo e(_('Total')); ?> :</div>
                        <div class="mr-2 moco-color-error" style="font-weight: bold"><?php echo e(number_format(intval($_total['O'])+intval($_total['R']),2,',','.')); ?></div>
                    </div>
                </div>
                <ul class="nav nav-tabs nav-fill mb-3" >
                    <li class="nav-item" >
                        <a href="#out" class="nav-link active" data-toggle="tab"><?php echo e(__('Parts Out')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a href="#in" class="nav-link" data-toggle="tab"><?php echo e(__('Parts Return')); ?></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <!-- TAB OUT-->
                    <div class="tab-pane fade show active" id="out">
                        <table class="table table-sm table-striped table-bordered mt-2">
                            <thead class="moco-title-table">
                            <tr>
                                <th class="moco-row-table-font-small"><?php echo e(__('Part Number')); ?></th>
                                <th class="moco-row-table-font-small"><?php echo e(__('Description')); ?></th>
                                <th class="moco-row-table-font-small"><?php echo e(__('Quantity')); ?></th>
                                <th class="moco-row-table-font-small"><?php echo e(__('Unit Price')); ?></th>
                                <th class="moco-row-table-font-small"><?php echo e(__('Total Price')); ?></th>
                                <th class="moco-row-table-font-small"><?php echo e(__('Year')); ?></th>
                                <th class="moco-row-table-font-small"><?php echo e(__('Date')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $_outs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $_out): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="moco-row-table-font-small"><?php echo e($_out->part_number); ?></td>
                                    <td class="moco-row-table-font-small"><?php echo e($_out->description); ?></td>
                                    <td class="moco-row-table-font-small text-right"><?php echo e($_out->qty_signed); ?></td>
                                    <td class="moco-row-table-font-small text-right"><?php echo e($_out->unit_price_signed); ?></td>
                                    <td class="moco-row-table-font-small text-right"><?php echo e($_out->total_price_signed); ?></td>
                                    <td class="moco-row-table-font-small text-right"><?php echo e($_out->year); ?></td>
                                    <td class="moco-row-table-font-small text-right"><?php echo e($_out->updated_at); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td colspan="4" class="moco-row-table-font-small text-right moco-color-error" style="font-weight: bold">Total :</td>
                                    <td class="moco-row-table-font-small text-right moco-color-error" style="font-weight: bold"><?php echo e(number_format(intval($_total['O']),2,',','.')); ?></td>
                                    <td colspan="2"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade show" id="in">
                        <table class="table table-sm table-striped table-bordered table-dark mt-2">
                            <thead class="moco-title-table">
                            <tr>
                                <th class="moco-row-table-font-small"><?php echo e(__('Part Number')); ?></th>
                                <th class="moco-row-table-font-small"><?php echo e(__('Description')); ?></th>
                                <th class="moco-row-table-font-small"><?php echo e(__('Quantity')); ?></th>
                                <th class="moco-row-table-font-small"><?php echo e(__('Unit Price')); ?></th>
                                <th class="moco-row-table-font-small"><?php echo e(__('Total Price')); ?></th>
                                <th class="moco-row-table-font-small"><?php echo e(__('Year')); ?></th>
                                <th class="moco-row-table-font-small"><?php echo e(__('Date')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $_reassorts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $_reassort): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="moco-row-table-font-small"><?php echo e($_reassort->part_number); ?></td>
                                    <td class="moco-row-table-font-small"><?php echo e($_reassort->description); ?></td>
                                    <td class="moco-row-table-font-small text-right"><?php echo e($_reassort->qty_signed); ?></td>
                                    <td class="moco-row-table-font-small text-right"><?php echo e($_reassort->unit_price_signed); ?></td>
                                    <td class="moco-row-table-font-small text-right"><?php echo e($_reassort->total_price_signed); ?></td>
                                    <td class="moco-row-table-font-small text-right"><?php echo e($_reassort->year); ?></td>
                                    <td class="moco-row-table-font-small text-right"><?php echo e($_reassort->updated_at); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td colspan="4" class="moco-row-table-font-small text-right moco-color-error" style="font-weight: bold">Total :</td>
                                <td class="moco-row-table-font-small text-right moco-color-error" style="font-weight: bold"><?php echo e(number_format(intval($_total['R']),2,',','.')); ?></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/worksheet/part-consult.blade.php ENDPATH**/ ?>