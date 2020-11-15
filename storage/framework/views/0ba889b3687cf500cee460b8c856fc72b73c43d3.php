<?php $__env->startSection('content'); ?>

    <div class="container-fluid p-2 h-100 moco-layout-height">
        <div class="container-fluid text-center mb-3">
            <div class="moco-title brown-lighter-hover"><?php echo e(__('Parts List')); ?></div>
        </div>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('store-list-head', [])->html();
} elseif ($_instance->childHasBeenRendered('oPHhgSz')) {
    $componentId = $_instance->getRenderedChildComponentId('oPHhgSz');
    $componentTag = $_instance->getRenderedChildComponentTagName('oPHhgSz');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('oPHhgSz');
} else {
    $response = \Livewire\Livewire::mount('store-list-head', []);
    $html = $response->html();
    $_instance->logRenderedChild('oPHhgSz', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('store-list', [])->html();
} elseif ($_instance->childHasBeenRendered('YbmjyYw')) {
    $componentId = $_instance->getRenderedChildComponentId('YbmjyYw');
    $componentTag = $_instance->getRenderedChildComponentTagName('YbmjyYw');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('YbmjyYw');
} else {
    $response = \Livewire\Livewire::mount('store-list', []);
    $html = $response->html();
    $_instance->logRenderedChild('YbmjyYw', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/store/store-list-main.blade.php ENDPATH**/ ?>
