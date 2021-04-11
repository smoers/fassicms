<?php $__env->startSection('content'); ?>

    <div class="container-fluid p-2 h-100 moco-layout-height">
        <div class="container-fluid text-center mb-3">
            <div class="moco-title brown-lighter-hover"><?php echo e(__('Technicians')); ?></div>
        </div>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('technician.technician-list', [])->html();
} elseif ($_instance->childHasBeenRendered('GNXoe4B')) {
    $componentId = $_instance->getRenderedChildComponentId('GNXoe4B');
    $componentTag = $_instance->getRenderedChildComponentTagName('GNXoe4B');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('GNXoe4B');
} else {
    $response = \Livewire\Livewire::mount('technician.technician-list', []);
    $html = $response->html();
    $_instance->logRenderedChild('GNXoe4B', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/technician/technician-list.blade.php ENDPATH**/ ?>