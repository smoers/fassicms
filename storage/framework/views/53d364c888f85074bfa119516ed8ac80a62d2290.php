<?php $__env->startSection('content'); ?>
    <div class="container p-5 h-100 moco-layout-height">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2 class="blue-grey-darker-hover"><?php echo e($title); ?></h2>
            </div>
            <div class="card-body">
                <?php if(isset($serial)): ?>
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('crane.crane-livewire', ['serial' => $serial])->html();
} elseif ($_instance->childHasBeenRendered('x8m1TVy')) {
    $componentId = $_instance->getRenderedChildComponentId('x8m1TVy');
    $componentTag = $_instance->getRenderedChildComponentTagName('x8m1TVy');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('x8m1TVy');
} else {
    $response = \Livewire\Livewire::mount('crane.crane-livewire', ['serial' => $serial]);
    $html = $response->html();
    $_instance->logRenderedChild('x8m1TVy', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                <?php else: ?>
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('crane.crane-livewire', [])->html();
} elseif ($_instance->childHasBeenRendered('e9WRpPz')) {
    $componentId = $_instance->getRenderedChildComponentId('e9WRpPz');
    $componentTag = $_instance->getRenderedChildComponentTagName('e9WRpPz');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('e9WRpPz');
} else {
    $response = \Livewire\Livewire::mount('crane.crane-livewire', []);
    $html = $response->html();
    $_instance->logRenderedChild('e9WRpPz', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/crane/crane-v2.blade.php ENDPATH**/ ?>