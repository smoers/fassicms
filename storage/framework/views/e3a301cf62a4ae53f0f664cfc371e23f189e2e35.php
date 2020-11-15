<?php $__env->startSection('content'); ?>

    <div class="container-fluid p-5 h-100 moco-layout-height">
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('store-list', [])->html();
} elseif ($_instance->childHasBeenRendered('1lBuPfC')) {
    $componentId = $_instance->getRenderedChildComponentId('1lBuPfC');
    $componentTag = $_instance->getRenderedChildComponentTagName('1lBuPfC');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('1lBuPfC');
} else {
    $response = \Livewire\Livewire::mount('store-list', []);
    $html = $response->html();
    $_instance->logRenderedChild('1lBuPfC', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/Moco/fassicms/resources/views/store/store-list-main.blade.php ENDPATH**/ ?>
