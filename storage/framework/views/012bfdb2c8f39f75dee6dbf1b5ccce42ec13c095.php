<div
    class="<?php echo e($this->getOption('bootstrap.container') ? 'container-fluid' : ''); ?>"
    <?php if(is_numeric($refresh)): ?> wire:poll.<?php echo e($refresh); ?>.ms <?php elseif(is_string($refresh)): ?> wire:poll="<?php echo e($refresh); ?>" <?php endif; ?>
>
    <?php echo $__env->make('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.offline', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.options', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if($this->getOption('bootstrap.responsive')): ?>
        <div class="table-responsive">
    <?php endif; ?>
        <table class="<?php echo e($this->getOption('bootstrap.classes.table')); ?>">
            <?php echo $__env->make('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.thead', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php echo $__env->make('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php if($models->isEmpty()): ?>
                    <?php echo $__env->make('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.empty', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php else: ?>
                    <?php echo $__env->make('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            </tbody>

            <?php echo $__env->make('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.tfoot', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </table>
    <?php if($this->getOption('bootstrap.responsive')): ?>
        </div><!--table-responsive-->
    <?php endif; ?>

    <?php echo $__env->make('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.pagination', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php /**PATH /var/www/Moco/fassicms/vendor/rappasoft/laravel-livewire-tables/src/../resources/views/bootstrap-4/table-component.blade.php ENDPATH**/ ?>
