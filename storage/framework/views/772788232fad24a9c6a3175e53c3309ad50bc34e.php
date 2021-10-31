<div class="table-responsive">
    <table class="table table-sm table-striped table-bordered">
        <?php echo $__env->make('livewire.data-table.thead', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <tbody>
        <?php echo $__env->make('livewire.data-table.filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->make('livewire.data-table.tbody', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </tbody>
    </table>
    <?php echo $__env->make("livewire.data-table.pagination", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php /**PATH /var/www/moco/fassicms/resources/views/livewire/data-table/datatable.blade.php ENDPATH**/ ?>