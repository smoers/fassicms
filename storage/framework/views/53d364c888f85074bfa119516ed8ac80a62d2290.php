<?php $__env->startSection('content'); ?>
    <div class="container p-5 h-100 moco-layout-height">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2 class="blue-grey-darker-hover"><?php echo e($title); ?></h2>
            </div>
            <div class="card-body">
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('crane.crane-livewire', [])->html();
} elseif ($_instance->childHasBeenRendered('vI8VgGV')) {
    $componentId = $_instance->getRenderedChildComponentId('vI8VgGV');
    $componentTag = $_instance->getRenderedChildComponentTagName('vI8VgGV');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('vI8VgGV');
} else {
    $response = \Livewire\Livewire::mount('crane.crane-livewire', []);
    $html = $response->html();
    $_instance->logRenderedChild('vI8VgGV', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/crane/crane-v2.blade.php ENDPATH**/ ?>