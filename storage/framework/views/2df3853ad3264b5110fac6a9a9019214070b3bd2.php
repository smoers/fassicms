<div class="row mb-3">
    <div class="d-flex justify-content-start">
        <div class="custom-control custom-switch">
            <input wire:model="edit" class="custom-control-input" type="checkbox" id="edit">
            <label class="custom-control-label" for="edit"><?php echo e(__('Edit')); ?></label>
        </div>
        <button type="submit" class="btn btn-primary moco-btn-sm" wire:click='submit' <?php if(!$edit): ?> disabled <?php endif; ?>  ><?php echo e(__('Save')); ?></button>
    </div>
</div>
<?php /**PATH /var/www/moco/fassicms/resources/views/livewire/provider/provider-list-head.blade.php ENDPATH**/ ?>