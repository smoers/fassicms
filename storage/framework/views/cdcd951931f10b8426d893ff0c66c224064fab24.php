<?php if($paginationEnabled || $searchEnabled): ?>
    <div class="row mb-4">
        <?php if($paginationEnabled && count($perPageOptions)): ?>
            <div class="col form-inline">
                <?php echo app('translator')->get('laravel-livewire-tables::strings.per_page'); ?>: &nbsp;

                <select wire:model="perPage" class="form-control">
                    <?php $__currentLoopData = $perPageOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option><?php echo e($option); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div><!--col-->
        <?php endif; ?>

        <?php if($searchEnabled): ?>
            <div class="col">
                <?php if($clearSearchButton): ?>
                    <div class="input-group">
                        <?php endif; ?>
                        <input
                            <?php if(is_numeric($searchDebounce) && $searchUpdateMethod === 'debounce'): ?> wire:model.debounce.<?php echo e($searchDebounce); ?>ms="search" <?php endif; ?>
                            <?php if($searchUpdateMethod === 'lazy'): ?> wire:model.lazy="search" <?php endif; ?>
                            <?php if($disableSearchOnLoading): ?> wire:loading.attr="disabled" <?php endif; ?>
                            class="form-control"
                            type="text"
                            placeholder="<?php echo e(__('laravel-livewire-tables::strings.search')); ?>"
                        />
                        <?php if($clearSearchButton): ?>
                            <div class="input-group-append">
                                <button class="btn btn-outline-dark" type="button" wire:click="clearSearch"><?php echo app('translator')->get('laravel-livewire-tables::strings.clear'); ?></button>
                            </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php echo $__env->make('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.export', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div><!--row-->
<?php endif; ?>
<?php /**PATH /var/www/moco/fassicms/vendor/rappasoft/laravel-livewire-tables/src/../resources/views/bootstrap-4/includes/options.blade.php ENDPATH**/ ?>