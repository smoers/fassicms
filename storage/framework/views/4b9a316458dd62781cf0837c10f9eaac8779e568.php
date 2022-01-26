<?php $__env->startSection('content'); ?>

    <div class="container-fluid p-2 h-100 moco-layout-height">
        <div class="container-fluid text-center mb-3">
            <div class="moco-title brown-lighter-hover"><?php echo e(__('Parts in stock')); ?></div>
        </div>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('reassort.reassort-list-head', [])->html();
} elseif ($_instance->childHasBeenRendered('DQEaTr1')) {
    $componentId = $_instance->getRenderedChildComponentId('DQEaTr1');
    $componentTag = $_instance->getRenderedChildComponentTagName('DQEaTr1');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('DQEaTr1');
} else {
    $response = \Livewire\Livewire::mount('reassort.reassort-list-head', []);
    $html = $response->html();
    $_instance->logRenderedChild('DQEaTr1', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('reassort.reassort-list-parts', [])->html();
} elseif ($_instance->childHasBeenRendered('QSdlEm1')) {
    $componentId = $_instance->getRenderedChildComponentId('QSdlEm1');
    $componentTag = $_instance->getRenderedChildComponentTagName('QSdlEm1');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('QSdlEm1');
} else {
    $response = \Livewire\Livewire::mount('reassort.reassort-list-parts', []);
    $html = $response->html();
    $_instance->logRenderedChild('QSdlEm1', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/reassort/reassort-list-main.blade.php ENDPATH**/ ?>