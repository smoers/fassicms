<?php if($tableFooterEnabled): ?>
    <tfoot>
        <?php echo $__env->make('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.columns', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </tfoot>
<?php endif; ?>
<?php /**PATH /var/www/Moco/fassicms/vendor/rappasoft/laravel-livewire-tables/src/../resources/views/bootstrap-4/includes/tfoot.blade.php ENDPATH**/ ?>
