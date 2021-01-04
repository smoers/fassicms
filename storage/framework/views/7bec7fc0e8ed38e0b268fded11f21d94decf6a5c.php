<?php $__env->startSection('content'); ?>

    <div class="container-fluid p-2 h-100 moco-layout-height">
        <div class="container-fluid text-center mb-3">
            <div class="moco-title brown-lighter-hover"><?php echo e(__('Worksheet')); ?></div>
        </div>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('worksheet.worksheet-list-head', [])->html();
} elseif ($_instance->childHasBeenRendered('3LMfXrp')) {
    $componentId = $_instance->getRenderedChildComponentId('3LMfXrp');
    $componentTag = $_instance->getRenderedChildComponentTagName('3LMfXrp');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('3LMfXrp');
} else {
    $response = \Livewire\Livewire::mount('worksheet.worksheet-list-head', []);
    $html = $response->html();
    $_instance->logRenderedChild('3LMfXrp', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('worksheet.worksheet-list', [])->html();
} elseif ($_instance->childHasBeenRendered('HOEIQZf')) {
    $componentId = $_instance->getRenderedChildComponentId('HOEIQZf');
    $componentTag = $_instance->getRenderedChildComponentTagName('HOEIQZf');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('HOEIQZf');
} else {
    $response = \Livewire\Livewire::mount('worksheet.worksheet-list', []);
    $html = $response->html();
    $_instance->logRenderedChild('HOEIQZf', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/worksheet/worksheet-list.blade.php ENDPATH**/ ?>