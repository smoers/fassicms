<?php $__env->startSection('content'); ?>
    <div class="<?php echo e($options->getContainer()); ?> p-2 h-100 moco-layout-height">
        <?php if($options->getName() == 'form01'): ?>

            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('store.store-part-form', [])->html();
} elseif ($_instance->childHasBeenRendered('J5t5xy8')) {
    $componentId = $_instance->getRenderedChildComponentId('J5t5xy8');
    $componentTag = $_instance->getRenderedChildComponentTagName('J5t5xy8');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('J5t5xy8');
} else {
    $response = \Livewire\Livewire::mount('store.store-part-form', []);
    $html = $response->html();
    $_instance->logRenderedChild('J5t5xy8', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php elseif($options->getName() == 'list01'): ?>
            <div class="container-fluid text-center mb-3">
                <div class="moco-title brown-lighter-hover"><?php echo e(__('Parts List')); ?></div>
            </div>
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('store-list-head', [])->html();
} elseif ($_instance->childHasBeenRendered('jG7SMiO')) {
    $componentId = $_instance->getRenderedChildComponentId('jG7SMiO');
    $componentTag = $_instance->getRenderedChildComponentTagName('jG7SMiO');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('jG7SMiO');
} else {
    $response = \Livewire\Livewire::mount('store-list-head', []);
    $html = $response->html();
    $_instance->logRenderedChild('jG7SMiO', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('store-list', [])->html();
} elseif ($_instance->childHasBeenRendered('xn31q3l')) {
    $componentId = $_instance->getRenderedChildComponentId('xn31q3l');
    $componentTag = $_instance->getRenderedChildComponentTagName('xn31q3l');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('xn31q3l');
} else {
    $response = \Livewire\Livewire::mount('store-list', []);
    $html = $response->html();
    $_instance->logRenderedChild('xn31q3l', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/layouts/store-layout.blade.php ENDPATH**/ ?>