<?php $__env->startSection('content'); ?>

    <div class="container-fluid p-2 h-100 moco-layout-height">
        <div class="container-fluid text-center mb-3">
            <div class="moco-title brown-lighter-hover"><?php echo e(__('Parts in stock')); ?></div>
        </div>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('reassort.reassort-list-head', [])->html();
} elseif ($_instance->childHasBeenRendered('3TIjLiZ')) {
    $componentId = $_instance->getRenderedChildComponentId('3TIjLiZ');
    $componentTag = $_instance->getRenderedChildComponentTagName('3TIjLiZ');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('3TIjLiZ');
} else {
    $response = \Livewire\Livewire::mount('reassort.reassort-list-head', []);
    $html = $response->html();
    $_instance->logRenderedChild('3TIjLiZ', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('reassort.reassort-list-parts', [])->html();
} elseif ($_instance->childHasBeenRendered('05BzOMf')) {
    $componentId = $_instance->getRenderedChildComponentId('05BzOMf');
    $componentTag = $_instance->getRenderedChildComponentTagName('05BzOMf');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('05BzOMf');
} else {
    $response = \Livewire\Livewire::mount('reassort.reassort-list-parts', []);
    $html = $response->html();
    $_instance->logRenderedChild('05BzOMf', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/reassort/reassort-list-main.blade.php ENDPATH**/ ?>