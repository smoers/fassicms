<?php if($loadingIndicator): ?>
    <tbody wire:loading.class.remove="d-none" class="d-none">
        <tr>
            <td colspan="<?php echo e(collect($columns)->count()); ?>">
                <?php echo app('translator')->get('laravel-livewire-tables::strings.loading'); ?>
            </td>
        </tr>
    </tbody>

    <tbody <?php if($collapseDataOnLoading): ?> wire:loading.remove <?php endif; ?>>
<?php else: ?>
    <tbody>
<?php endif; ?>
<?php /**PATH /var/www/moco/fassicms/vendor/rappasoft/laravel-livewire-tables/src/../resources/views/bootstrap-4/includes/loading.blade.php ENDPATH**/ ?>