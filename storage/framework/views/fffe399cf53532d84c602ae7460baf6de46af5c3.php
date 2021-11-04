<thead class="">
<tr class="<?php echo e($this->setTableHeadClass()); ?>">
    <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($column->isSortable()): ?>
            <th scope="col" class="<?php echo e($this->setTableHeadColumnClass($column)); ?>" wire:click="sort('<?php echo e($column->getAttribute()); ?>')" style="cursor: pointer;">
                <?php echo e($column->getName()); ?>

                <?php if($sortField !== $column->getAttribute()): ?>
                    <?php echo e(new \Illuminate\Support\HtmlString($sortDefaultIcon)); ?>

                <?php elseif($sortDirection === 'asc'): ?>
                    <?php echo e(new \Illuminate\Support\HtmlString($ascSortIcon)); ?>

                <?php else: ?>
                    <?php echo e(new \Illuminate\Support\HtmlString($descSortIcon)); ?>

                <?php endif; ?>
                <?php if($column->isFiltered()): ?>
                    <a href="#" class="text-sm-center moco-color-info"><i class="fas fa-filter"></i></a>
                <?php endif; ?>
            </th>
        <?php else: ?>
            <th scope="col" class="<?php echo e($this->setTableHeadColumnClass($column)); ?>">
                <?php echo e($column->getName()); ?>

                <?php if($column->isFiltered()): ?>
                    <a href="#" class="text-sm-center moco-color-info"><i class="fas fa-filter"></i></a>
                <?php endif; ?>
            </th>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tr>
</thead>
<?php /**PATH /var/www/moco/fassicms/resources/views/livewire/data-table/thead.blade.php ENDPATH**/ ?>