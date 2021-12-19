<?php if($tableHeaderEnabled): ?>
    <thead class="<?php echo e($this->getOption('bootstrap.classes.thead')); ?>">
        <?php echo $__env->make('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.columns', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </thead>
<?php endif; ?>
<?php /**PATH /var/www/moco/fassicms/vendor/rappasoft/laravel-livewire-tables/src/../resources/views/bootstrap-4/includes/thead.blade.php ENDPATH**/ ?>