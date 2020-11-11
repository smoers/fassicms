<?php $__env->startSection('content'); ?>

    <div class="container p-5 h-100 fassi-layout-height">
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('counter')->html();
} elseif ($_instance->childHasBeenRendered('6pbjYRa')) {
    $componentId = $_instance->getRenderedChildComponentId('6pbjYRa');
    $componentTag = $_instance->getRenderedChildComponentTagName('6pbjYRa');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('6pbjYRa');
} else {
    $response = \Livewire\Livewire::mount('counter');
    $html = $response->html();
    $_instance->logRenderedChild('6pbjYRa', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/store/storelist.blade.php ENDPATH**/ ?>