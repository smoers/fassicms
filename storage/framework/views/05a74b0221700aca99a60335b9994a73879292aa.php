<?php $__env->startSection('content'); ?>
    <div class="<?php echo e($options->getContainer()); ?> p-2 h-100 moco-layout-height">
        <?php if($options->getName() == 'form01'): ?>
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('store.store-part-form', [])->html();
} elseif ($_instance->childHasBeenRendered('igSMXba')) {
    $componentId = $_instance->getRenderedChildComponentId('igSMXba');
    $componentTag = $_instance->getRenderedChildComponentTagName('igSMXba');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('igSMXba');
} else {
    $response = \Livewire\Livewire::mount('store.store-part-form', []);
    $html = $response->html();
    $_instance->logRenderedChild('igSMXba', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
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
} elseif ($_instance->childHasBeenRendered('631dJrs')) {
    $componentId = $_instance->getRenderedChildComponentId('631dJrs');
    $componentTag = $_instance->getRenderedChildComponentTagName('631dJrs');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('631dJrs');
} else {
    $response = \Livewire\Livewire::mount('store-list-head', []);
    $html = $response->html();
    $_instance->logRenderedChild('631dJrs', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('store-list', [])->html();
} elseif ($_instance->childHasBeenRendered('paI9nB1')) {
    $componentId = $_instance->getRenderedChildComponentId('paI9nB1');
    $componentTag = $_instance->getRenderedChildComponentTagName('paI9nB1');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('paI9nB1');
} else {
    $response = \Livewire\Livewire::mount('store-list', []);
    $html = $response->html();
    $_instance->logRenderedChild('paI9nB1', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/layouts/store-layout.blade.php ENDPATH**/ ?>