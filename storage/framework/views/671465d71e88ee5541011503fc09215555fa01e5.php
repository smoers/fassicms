<select class="form-control form-control-sm" wire:model="filters.<?php echo e($name); ?>">
    <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option => $text): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($option); ?>" <?php if($option == $selected): ?> selected <?php endif; ?> ><?php echo e($text); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
<?php /**PATH /var/www/moco/fassicms/resources/views/livewire/data-table/filter/select-filter.blade.php ENDPATH**/ ?>