<div class="d-flex flex-row">
    <div class="text-sm-right mr-2"><?php echo e(__('Per page')); ?> :</div>
    <div>
        <select class="form-control form-control-sm" wire:model="perPage">
            <?php $__currentLoopData = $perPageOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perPage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($perPage); ?>"><?php echo e($perPage); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>
<?php /**PATH /var/www/moco/fassicms/resources/views/livewire/data-table/perpage.blade.php ENDPATH**/ ?>