<tr>
    <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($column->isVisible()): ?>
            <?php if($column->isSortable()): ?>
                <th
                    class="<?php echo e($this->setTableHeadClass($column->getAttribute())); ?>"
                    id="<?php echo e($this->setTableHeadId($column->getAttribute())); ?>"
                    <?php $__currentLoopData = $this->setTableHeadAttributes($column->getAttribute()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($key); ?>="<?php echo e($value); ?>"
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    wire:click="sort('<?php echo e($column->getAttribute()); ?>')"
                    style="cursor:pointer;"
                >
                    <?php echo e($column->getText()); ?>


                    <?php if($sortField !== $column->getAttribute()): ?>
                        <?php echo e(new \Illuminate\Support\HtmlString($sortDefaultIcon)); ?>

                    <?php elseif($sortDirection === 'asc'): ?>
                        <?php echo e(new \Illuminate\Support\HtmlString($ascSortIcon)); ?>

                    <?php else: ?>
                        <?php echo e(new \Illuminate\Support\HtmlString($descSortIcon)); ?>

                    <?php endif; ?>
                </th>
            <?php else: ?>
                <th
                    class="<?php echo e($this->setTableHeadClass($column->getAttribute())); ?>"
                    id="<?php echo e($this->setTableHeadId($column->getAttribute())); ?>"
                    <?php $__currentLoopData = $this->setTableHeadAttributes($column->getAttribute()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($key); ?>="<?php echo e($value); ?>"
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                >
                    <?php echo e($column->getText()); ?>

                </th>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tr>
<?php /**PATH /var/www/Moco/fassicms/vendor/rappasoft/laravel-livewire-tables/src/../resources/views/bootstrap-4/includes/columns.blade.php ENDPATH**/ ?>
