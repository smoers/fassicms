<div class="d-flex flex-sm-row">
    <select class="form-control form-control-sm" wire:model="filters.<?php echo e($name[0]); ?>" style="width: 60px">
        <option value="=" selected>=</option>
        <option value=">" >></option>
        <option value="<" ><</option>
        <option value=">=" >>=</option>
        <option value="<=" ><=</option>
        <option value="<>" ><></option>
    </select>
    <input type="number" class="form-control form-control-sm" wire:model="filters.<?php echo e($name[1]); ?>" value="<?php echo e($defaultValue); ?>">
</div>
<?php /**PATH /var/www/moco/fassicms/resources/views/livewire/data-table/filter/number-filter.blade.php ENDPATH**/ ?>