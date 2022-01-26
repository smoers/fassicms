<?php $__env->startSection('content'); ?>

    <div class="container-fluid p-2 h-100 moco-layout-height">
        <div class="container-fluid text-center mb-3">
            <div class="moco-title brown-lighter-hover"><?php echo e(__('Cranes')); ?></div>
        </div>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('crane.crane-list', [])->html();
} elseif ($_instance->childHasBeenRendered('aSyJdbP')) {
    $componentId = $_instance->getRenderedChildComponentId('aSyJdbP');
    $componentTag = $_instance->getRenderedChildComponentTagName('aSyJdbP');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('aSyJdbP');
} else {
    $response = \Livewire\Livewire::mount('crane.crane-list', []);
    $html = $response->html();
    $_instance->logRenderedChild('aSyJdbP', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/crane/crane-list.blade.php ENDPATH**/ ?>