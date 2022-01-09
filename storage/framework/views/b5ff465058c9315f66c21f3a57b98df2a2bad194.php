<div class="row">
    <div class="col-2">
        <label class="sr-only" for="inlineFormInputGroup">Username</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><?php echo e(__('Price catalogue')); ?></div>
            </div>
             <input wire:model='year' type="text" class="form-control" id="inlineFormInputGroup" placeholder="<?php echo e(__('Year')); ?>" value="<?php echo e($year); ?>">
        </div>
    </div>
    <div class="col-2">
        <div class="custom-control custom-switch">
            <input wire:model="enabled" class="custom-control-input" type="checkbox" id="autoSizingCheck">
            <label class="custom-control-label" for="autoSizingCheck"><?php echo e(__('Active parts')); ?></label>
        </div>
    </div>
</div>
<?php /**PATH /var/www/moco/fassicms/resources/views/livewire/store/store-list-head.blade.php ENDPATH**/ ?>