<?php $__env->startSection('content'); ?>
    <div class="container-fluid p-2 h-100 moco-layout-height">
        <div class="container-fluid text-center mb-3">
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount($livewire,['renderViewPath' => $livewire,'title' => $title])->html();
} elseif ($_instance->childHasBeenRendered('AzdYPUB')) {
    $componentId = $_instance->getRenderedChildComponentId('AzdYPUB');
    $componentTag = $_instance->getRenderedChildComponentTagName('AzdYPUB');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('AzdYPUB');
} else {
    $response = \Livewire\Livewire::mount($livewire,['renderViewPath' => $livewire,'title' => $title]);
    $html = $response->html();
    $_instance->logRenderedChild('AzdYPUB', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/reporting/from.blade.php ENDPATH**/ ?>