<?php $__env->startSection('content'); ?>

    <div class="container-fluid p-2 h-100 moco-layout-height">
        <div class="container-fluid text-center mb-3">
            <div class="moco-title brown-lighter-hover"><?php echo e(__('Technicians')); ?></div>
        </div>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('technician.technician-list', [])->html();
} elseif ($_instance->childHasBeenRendered('eQ9001G')) {
    $componentId = $_instance->getRenderedChildComponentId('eQ9001G');
    $componentTag = $_instance->getRenderedChildComponentTagName('eQ9001G');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('eQ9001G');
} else {
    $response = \Livewire\Livewire::mount('technician.technician-list', []);
    $html = $response->html();
    $_instance->logRenderedChild('eQ9001G', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/technician/technician-list.blade.php ENDPATH**/ ?>