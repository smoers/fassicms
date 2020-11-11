<?php $__env->startSection('content'); ?>

    <div class="container-fluid p-5 h-100 fassi-layout-height">
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('store-list', [])->html();
} elseif ($_instance->childHasBeenRendered('5Bofwjg')) {
    $componentId = $_instance->getRenderedChildComponentId('5Bofwjg');
    $componentTag = $_instance->getRenderedChildComponentTagName('5Bofwjg');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('5Bofwjg');
} else {
    $response = \Livewire\Livewire::mount('store-list', []);
    $html = $response->html();
    $_instance->logRenderedChild('5Bofwjg', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/Moco/fassicms/resources/views/store/store-list-main.blade.php ENDPATH**/ ?>
