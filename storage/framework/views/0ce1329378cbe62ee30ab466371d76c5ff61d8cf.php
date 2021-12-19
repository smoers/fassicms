<?php if(count($exports)): ?>
    <div class="dropdown table-export">
        <button class="dropdown-toggle <?php echo e($this->getOption('bootstrap.classes.buttons.export')); ?>" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo app('translator')->get('laravel-livewire-tables::strings.export'); ?>
        </button>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <?php if(in_array('csv', $exports, true)): ?>
                <a class="dropdown-item" href="#" wire:click.prevent="export('csv')">CSV</a>
            <?php endif; ?>

            <?php if(in_array('xls', $exports, true)): ?>
                <a class="dropdown-item" href="#" wire:click.prevent="export('xls')">XLS</a>
            <?php endif; ?>

            <?php if(in_array('xlsx', $exports, true)): ?>
                <a class="dropdown-item" href="#" wire:click.prevent="export('xlsx')">XLSX</a>
            <?php endif; ?>

            <?php if(in_array('pdf', $exports, true)): ?>
                <a class="dropdown-item" href="#" wire:click.prevent="export('pdf')">PDF</a>
            <?php endif; ?>
        </div>
    </div><!--export-dropdown-->
<?php endif; ?>
<?php /**PATH /var/www/moco/fassicms/vendor/rappasoft/laravel-livewire-tables/src/../resources/views/bootstrap-4/includes/export.blade.php ENDPATH**/ ?>