<?php $__env->startSection('content'); ?>

    <div class="container-fluid p-2 h-100 moco-layout-height">
        <div class="container-fluid text-center mb-3">
            <div class="moco-title brown-lighter-hover"><?php echo e(__('Parts in stock')); ?></div>
        </div>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('reassort.reassort-list-parts', [])->html();
} elseif ($_instance->childHasBeenRendered('Sf8Gl3R')) {
    $componentId = $_instance->getRenderedChildComponentId('Sf8Gl3R');
    $componentTag = $_instance->getRenderedChildComponentTagName('Sf8Gl3R');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('Sf8Gl3R');
} else {
    $response = \Livewire\Livewire::mount('reassort.reassort-list-parts', []);
    $html = $response->html();
    $_instance->logRenderedChild('Sf8Gl3R', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/reassort/reassort-list-main.blade.php ENDPATH**/ ?>