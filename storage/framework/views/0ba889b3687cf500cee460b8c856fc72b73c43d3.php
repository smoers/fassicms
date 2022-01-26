<?php $__env->startSection('content'); ?>

    <div class="container-fluid p-2 h-100 moco-layout-height">
        <div class="container-fluid text-center mb-3">
            <div class="moco-title brown-lighter-hover"><?php echo e(__('Parts List')); ?></div>
        </div>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('store.store-list-head', [])->html();
} elseif ($_instance->childHasBeenRendered('jGcHh9E')) {
    $componentId = $_instance->getRenderedChildComponentId('jGcHh9E');
    $componentTag = $_instance->getRenderedChildComponentTagName('jGcHh9E');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('jGcHh9E');
} else {
    $response = \Livewire\Livewire::mount('store.store-list-head', []);
    $html = $response->html();
    $_instance->logRenderedChild('jGcHh9E', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('store.store-list', [])->html();
} elseif ($_instance->childHasBeenRendered('zOVji6F')) {
    $componentId = $_instance->getRenderedChildComponentId('zOVji6F');
    $componentTag = $_instance->getRenderedChildComponentTagName('zOVji6F');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('zOVji6F');
} else {
    $response = \Livewire\Livewire::mount('store.store-list', []);
    $html = $response->html();
    $_instance->logRenderedChild('zOVji6F', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/store/store-list-main.blade.php ENDPATH**/ ?>