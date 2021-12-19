<?php $__env->startSection('content'); ?>
    <div class="container-fluid p-2 h-100 moco-layout-height">
        <div class="container-fluid text-center mb-3">
            <div class="container-fluid text-center mb-3">
                <div class="moco-title brown-lighter-hover"><?php echo e($title); ?></div>
            </div>
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount($livewire,['renderViewPath' => $livewire])->html();
} elseif ($_instance->childHasBeenRendered('15zFl0x')) {
    $componentId = $_instance->getRenderedChildComponentId('15zFl0x');
    $componentTag = $_instance->getRenderedChildComponentTagName('15zFl0x');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('15zFl0x');
} else {
    $response = \Livewire\Livewire::mount($livewire,['renderViewPath' => $livewire]);
    $html = $response->html();
    $_instance->logRenderedChild('15zFl0x', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/reporting/from.blade.php ENDPATH**/ ?>