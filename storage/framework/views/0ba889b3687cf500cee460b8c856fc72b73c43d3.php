<?php $__env->startSection('content'); ?>

    <div class="container-fluid p-2 h-100 moco-layout-height">
        <div class="container-fluid text-center mb-3">
            <div class="moco-title brown-lighter-hover"><?php echo e(__('Parts List')); ?></div>
        </div>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('store.store-list-head', [])->html();
} elseif ($_instance->childHasBeenRendered('AYojBgy')) {
    $componentId = $_instance->getRenderedChildComponentId('AYojBgy');
    $componentTag = $_instance->getRenderedChildComponentTagName('AYojBgy');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('AYojBgy');
} else {
    $response = \Livewire\Livewire::mount('store.store-list-head', []);
    $html = $response->html();
    $_instance->logRenderedChild('AYojBgy', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('store.store-list', [])->html();
} elseif ($_instance->childHasBeenRendered('n79JBnh')) {
    $componentId = $_instance->getRenderedChildComponentId('n79JBnh');
    $componentTag = $_instance->getRenderedChildComponentTagName('n79JBnh');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('n79JBnh');
} else {
    $response = \Livewire\Livewire::mount('store.store-list', []);
    $html = $response->html();
    $_instance->logRenderedChild('n79JBnh', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/store/store-list-main.blade.php ENDPATH**/ ?>