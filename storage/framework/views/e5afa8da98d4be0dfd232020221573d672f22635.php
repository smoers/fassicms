    <div class="d-flex justify-content-start">
        <button class="btn btn-danger moco-btn-sm" wire:click="edit(<?php echo e($model->id); ?>)"><?php echo e(__('Edit')); ?></button>
        <button class="btn btn-primary moco-btn-sm" wire:click="save(<?php echo e($model->id); ?>)" <?php if(!$edit): ?> disabled <?php endif; ?>  ><?php echo e(__('Save')); ?></button>
    </div>
<?php /**PATH /var/www/moco/fassicms/resources/views/provider/provider-action.blade.php ENDPATH**/ ?>