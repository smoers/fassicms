<div class="row">
    <div class="col">
        <?php echo e($models->links()); ?>

    </div>

    <div class="col text-right text-muted">
        <?php echo e(__('results', [
            'first' => $models->count() ? $models->firstItem() : 0,
            'last' => $models->count() ? $models->lastItem() : 0,
            'total' => $models->total()
        ])); ?>

    </div>
</div>
<?php /**PATH /var/www/moco/fassicms/resources/views/livewire/data-table/pagination.blade.php ENDPATH**/ ?>