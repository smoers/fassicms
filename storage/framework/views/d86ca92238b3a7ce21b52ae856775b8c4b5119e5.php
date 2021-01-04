<div class="row">
    <div class="col-2">
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><?php echo e(__('Worksheets for ')); ?></div>
            </div>
            <input wire:model='year' type="text" class="form-control" id="_year" placeholder="<?php echo e(__('Year')); ?>" value="<?php echo e($year); ?>" <?php if($template): ?> readonly <?php endif; ?>>
        </div>
    </div>
    <div class="col-2">
        <div class="custom-control custom-switch">
            <input wire:model="template" class="custom-control-input" type="checkbox" id="_template">
            <label class="custom-control-label" for="_template"><?php echo e(__('Worksheets template')); ?></label>
        </div>
    </div>
</div>
<?php /**PATH /var/www/moco/fassicms/resources/views/livewire/worksheet/worksheet-list-head.blade.php ENDPATH**/ ?>