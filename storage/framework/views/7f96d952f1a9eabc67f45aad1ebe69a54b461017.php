<?php $__env->startSection('content'); ?>
    <div class="container-fluid p-2 h-100 moco-layout-height">
        <div class="container-fluid text-center mb-3">
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount($livewire,['renderViewPath' => $livewire,'title' => $title])->html();
} elseif ($_instance->childHasBeenRendered('okswnj1')) {
    $componentId = $_instance->getRenderedChildComponentId('okswnj1');
    $componentTag = $_instance->getRenderedChildComponentTagName('okswnj1');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('okswnj1');
} else {
    $response = \Livewire\Livewire::mount($livewire,['renderViewPath' => $livewire,'title' => $title]);
    $html = $response->html();
    $_instance->logRenderedChild('okswnj1', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/reporting/from.blade.php ENDPATH**/ ?>