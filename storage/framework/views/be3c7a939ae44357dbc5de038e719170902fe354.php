<?php if($paginationEnabled): ?>
    <div class="row">
        <div class="col">
            <?php echo e($models->links()); ?>

        </div>

        <div class="col text-right text-muted">
            <?php echo app('translator')->get('laravel-livewire-tables::strings.results', [
                'first' => $models->count() ? $models->firstItem() : 0,
                'last' => $models->count() ? $models->lastItem() : 0,
                'total' => $models->total()
            ]); ?>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /var/www/moco/fassicms/vendor/rappasoft/laravel-livewire-tables/src/../resources/views/bootstrap-4/includes/pagination.blade.php ENDPATH**/ ?>