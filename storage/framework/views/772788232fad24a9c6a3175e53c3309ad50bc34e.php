<div style="overflow-x: auto">
    <div class="container-fluid text-center mb-3">
        <div class="moco-title brown-lighter-hover"><?php echo e($title); ?></div>
    </div>

    <div class="d-flex flex-row justify-content-between mb-1">
        <?php echo $__env->make('livewire.data-table.perpage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('livewire.data-table.button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <table class="table table-sm table-striped table-bordered" style="white-space: nowrap">
        <?php echo $__env->make('livewire.data-table.thead', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <tbody>
        <?php echo $__env->make('livewire.data-table.filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->make('livewire.data-table.tbody', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </tbody>
    </table>
    <?php echo $__env->make("livewire.data-table.pagination", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php echo $__env->make("livewire.data-table.common", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /var/www/moco/fassicms/resources/views/livewire/data-table/datatable.blade.php ENDPATH**/ ?>