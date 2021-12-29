<div class="d-flex flex-row justify-content-start mb-3 ml-3" style="vertical-align: center">
    <div class="moco-color-info mr-2"><i class="fas fa-map-pin fa-2x"></i></div>
    <div>
        <select wire:model='locationId' id="location"  class="form-control moco-row-table-font-small" data-width="fit" title="<?php echo e(__('Select a Location')); ?>">
            <?php $__currentLoopData = App\Models\Location::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($location->id); ?>" class="moco-row-table-font-small" ><?php echo e(__($location->location)." : ".__($location->description)); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>
<?php /**PATH /var/www/moco/fassicms/resources/views/livewire/reassort/reassort-list-head.blade.php ENDPATH**/ ?>