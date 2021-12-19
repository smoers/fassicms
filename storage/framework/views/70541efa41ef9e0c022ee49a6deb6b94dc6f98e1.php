<?php if($offlineIndicator): ?>
    <div wire:offline.class="d-block" wire:offline.class.remove="d-none" class="alert alert-danger d-none">
        <?php echo app('translator')->get('laravel-livewire-tables::strings.offline'); ?>
    </div>
<?php endif; ?>
<?php /**PATH /var/www/moco/fassicms/vendor/rappasoft/laravel-livewire-tables/src/../resources/views/bootstrap-4/includes/offline.blade.php ENDPATH**/ ?>