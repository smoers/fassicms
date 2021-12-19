<?php $__env->startSection('content'); ?>

    <div class="container-fluid p-2 h-100 moco-layout-height">
        <div class="container-fluid text-center mb-3">
            <div class="moco-title brown-lighter-hover"><?php echo e(__('Parts List')); ?></div>
        </div>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('store.store-list-head', [])->html();
} elseif ($_instance->childHasBeenRendered('bCw60Uo')) {
    $componentId = $_instance->getRenderedChildComponentId('bCw60Uo');
    $componentTag = $_instance->getRenderedChildComponentTagName('bCw60Uo');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('bCw60Uo');
} else {
    $response = \Livewire\Livewire::mount('store.store-list-head', []);
    $html = $response->html();
    $_instance->logRenderedChild('bCw60Uo', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('store.store-list', [])->html();
} elseif ($_instance->childHasBeenRendered('63qJD7r')) {
    $componentId = $_instance->getRenderedChildComponentId('63qJD7r');
    $componentTag = $_instance->getRenderedChildComponentTagName('63qJD7r');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('63qJD7r');
} else {
    $response = \Livewire\Livewire::mount('store.store-list', []);
    $html = $response->html();
    $_instance->logRenderedChild('63qJD7r', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/store/store-list-main.blade.php ENDPATH**/ ?>