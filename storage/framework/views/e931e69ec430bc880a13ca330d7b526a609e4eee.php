<div class="d-sm-flex flex-sm-row">
    <input type="text" class="form-control form-control-sm" id="filter-date-<?php echo e($name); ?>" placeholder="<?php echo e(__('DD/MM/YYYY')); ?>" aria-label="date" aria-describedby="basic-addon1" wire:model.debounce.2000ms="filters.<?php echo e($name); ?>"/>
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar-alt"></i></span>
    </div>
</div>
<script>
    $(function (){
        $('#filter-date-<?php echo e($name); ?>').datepicker({
            format: 'dd/mm/yyyy',
            orientation: 'bottom auto',
            language: 'fr',
            todayBtn: "linked",
            autoclose: true,
        }).on('changeDate',function(e){
            window.livewire.find('<?php echo e($_instance->id); ?>').set('filters.<?php echo e($name); ?>',moment(e.date).format('DD/MM/YYYY'));
        });
    })
</script>
<?php /**PATH /var/www/moco/fassicms/resources/views/livewire/data-table/filter/date-filter.blade.php ENDPATH**/ ?>