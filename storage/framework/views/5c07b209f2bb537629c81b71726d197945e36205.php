<?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr class="<?php echo e($this->setTableDataClass()); ?>">
        <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <td class="<?php echo e($this->setTableDataColumnClass($column)); ?>">
                <?php if($column->isFormatted()): ?>
                    <?php echo e($column->formatted($model, $column)); ?>

                <?php else: ?>
                    <?php echo e(data_get($model, $column->getAlias())); ?>

                <?php endif; ?>
            </td>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /var/www/moco/fassicms/resources/views/livewire/data-table/tbody.blade.php ENDPATH**/ ?>