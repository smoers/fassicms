<?php if($this->tableIsFiltered): ?>
    <tr>
        <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <td>
                <?php if($column->isFiltered()): ?>
                    <?php echo e($column->getFilter()->show()); ?>

                <?php endif; ?>
            </td>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tr>
<?php endif; ?>
<?php /**PATH /var/www/moco/fassicms/resources/views/livewire/data-table/filter.blade.php ENDPATH**/ ?>