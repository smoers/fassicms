<?php $__env->startSection('content'); ?>

    <div class="container-fluid p-2 h-100 moco-layout-height">
        <div class="container-fluid text-center mb-3">
            <div class="moco-title brown-lighter-hover"><?php echo e(__('Parts List')); ?></div>
        </div>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('store.store-list-head', [])->html();
} elseif ($_instance->childHasBeenRendered('4lOx3bx')) {
    $componentId = $_instance->getRenderedChildComponentId('4lOx3bx');
    $componentTag = $_instance->getRenderedChildComponentTagName('4lOx3bx');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('4lOx3bx');
} else {
    $response = \Livewire\Livewire::mount('store.store-list-head', []);
    $html = $response->html();
    $_instance->logRenderedChild('4lOx3bx', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('store.store-list', [])->html();
} elseif ($_instance->childHasBeenRendered('sH5qQxR')) {
    $componentId = $_instance->getRenderedChildComponentId('sH5qQxR');
    $componentTag = $_instance->getRenderedChildComponentTagName('sH5qQxR');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('sH5qQxR');
} else {
    $response = \Livewire\Livewire::mount('store.store-list', []);
    $html = $response->html();
    $_instance->logRenderedChild('sH5qQxR', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/store/store-list-main.blade.php ENDPATH**/ ?>