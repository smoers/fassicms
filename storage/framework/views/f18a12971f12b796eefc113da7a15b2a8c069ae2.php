<?php $__env->startSection('content'); ?>

    <div class="container-fluid p-2 h-100 moco-layout-height">
        <div class="container-fluid text-center mb-3">
            <div class="moco-title brown-lighter-hover"><?php echo e(__('Customers')); ?></div>
        </div>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('customer.customer-list', [])->html();
} elseif ($_instance->childHasBeenRendered('4mgamte')) {
    $componentId = $_instance->getRenderedChildComponentId('4mgamte');
    $componentTag = $_instance->getRenderedChildComponentTagName('4mgamte');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('4mgamte');
} else {
    $response = \Livewire\Livewire::mount('customer.customer-list', []);
    $html = $response->html();
    $_instance->logRenderedChild('4mgamte', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/customer/customer-list.blade.php ENDPATH**/ ?>