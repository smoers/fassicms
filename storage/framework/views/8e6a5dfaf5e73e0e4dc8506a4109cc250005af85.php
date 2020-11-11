<?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr
        class="<?php echo e($this->setTableRowClass($model)); ?>"
        id="<?php echo e($this->setTableRowId($model)); ?>"
        <?php $__currentLoopData = $this->setTableRowAttributes($model); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo e($key); ?>="<?php echo e($value); ?>"
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if($this->getTableRowUrl($model)): ?>
            onclick="window.location='<?php echo e($this->getTableRowUrl($model)); ?>';"
            style="cursor:pointer"
        <?php endif; ?>
    >
        <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($column->isVisible()): ?>
                <td
                    class="<?php echo e($this->setTableDataClass($column->getAttribute(), data_get($model, $column->getAttribute()))); ?>"
                    id="<?php echo e($this->setTableDataId($column->getAttribute(), data_get($model, $column->getAttribute()))); ?>"
                    <?php $__currentLoopData = $this->setTableDataAttributes($column->getAttribute(), data_get($model, $column->getAttribute())); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($key); ?>="<?php echo e($value); ?>"
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                >
                    <?php if($column->isFormatted()): ?>
                        <?php if($column->isRaw()): ?>
                            <?php echo $column->formatted($model, $column); ?>

                        <?php else: ?>
                            <?php echo e($column->formatted($model, $column)); ?>

                        <?php endif; ?>
                    <?php else: ?>
                        <?php if($column->isRaw()): ?>
                            <?php echo data_get($model, $column->getAttribute()); ?>

                        <?php else: ?>
                            <?php echo e(data_get($model, $column->getAttribute())); ?>

                        <?php endif; ?>
                    <?php endif; ?>
                </td>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /var/www/Moco/fassicms/vendor/rappasoft/laravel-livewire-tables/src/../resources/views/bootstrap-4/includes/data.blade.php ENDPATH**/ ?>
