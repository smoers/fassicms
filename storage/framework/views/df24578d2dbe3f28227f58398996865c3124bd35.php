<?php $__env->startSection('content'); ?>
    <div class="container p-5 h-100 moco-layout-height">
        <div class="card mb-3">
            <div class="card-header text-center font-weight-bold">
                <h2 class="blue-grey-darker-hover"><?php echo e(__('Providers List')); ?></h2>
            </div>
            <div class="card-body" style="font-size: 12px">
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('provider.provider-list', [])->html();
} elseif ($_instance->childHasBeenRendered('sLkPkEP')) {
    $componentId = $_instance->getRenderedChildComponentId('sLkPkEP');
    $componentTag = $_instance->getRenderedChildComponentTagName('sLkPkEP');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('sLkPkEP');
} else {
    $response = \Livewire\Livewire::mount('provider.provider-list', []);
    $html = $response->html();
    $_instance->logRenderedChild('sLkPkEP', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/provider/provider-list.blade.php ENDPATH**/ ?>