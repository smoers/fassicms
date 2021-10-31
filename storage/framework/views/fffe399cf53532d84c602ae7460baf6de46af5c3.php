<thead class="">
<tr class="<?php echo e($this->setTableHeadClass()); ?>">
    <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <th scope="col" class="<?php echo e($this->setTableHeadColumnClass($column)); ?>"><?php echo e($column->getName()); ?></th>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tr>
</thead>
<?php /**PATH /var/www/moco/fassicms/resources/views/livewire/data-table/thead.blade.php ENDPATH**/ ?>