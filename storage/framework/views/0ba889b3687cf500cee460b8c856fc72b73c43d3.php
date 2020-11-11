<?php $__env->startSection('content'); ?>

    <div class="container-fluid p-2 h-100 fassi-layout-height">
        <div class="container-fluid text-center mb-3">
            <div class="fassi-title"><?php echo e(__('Parts List')); ?></div>
        </div>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('store-list-head', [])->html();
} elseif ($_instance->childHasBeenRendered('9gzoo2L')) {
    $componentId = $_instance->getRenderedChildComponentId('9gzoo2L');
    $componentTag = $_instance->getRenderedChildComponentTagName('9gzoo2L');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('9gzoo2L');
} else {
    $response = \Livewire\Livewire::mount('store-list-head', []);
    $html = $response->html();
    $_instance->logRenderedChild('9gzoo2L', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('store-list', [])->html();
} elseif ($_instance->childHasBeenRendered('BGh8lum')) {
    $componentId = $_instance->getRenderedChildComponentId('BGh8lum');
    $componentTag = $_instance->getRenderedChildComponentTagName('BGh8lum');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('BGh8lum');
} else {
    $response = \Livewire\Livewire::mount('store-list', []);
    $html = $response->html();
    $_instance->logRenderedChild('BGh8lum', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/Moco/fassicms/resources/views/store/store-list-main.blade.php ENDPATH**/ ?>
