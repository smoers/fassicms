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
} elseif ($_instance->childHasBeenRendered('qV4W9oi')) {
    $componentId = $_instance->getRenderedChildComponentId('qV4W9oi');
    $componentTag = $_instance->getRenderedChildComponentTagName('qV4W9oi');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('qV4W9oi');
} else {
    $response = \Livewire\Livewire::mount('crane.crane-livewire', ['serial' => $serial]);
    $html = $response->html();
    $_instance->logRenderedChild('qV4W9oi', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                <?php else: ?>
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('crane.crane-livewire', [])->html();
} elseif ($_instance->childHasBeenRendered('visRTww')) {
    $componentId = $_instance->getRenderedChildComponentId('visRTww');
    $componentTag = $_instance->getRenderedChildComponentTagName('visRTww');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('visRTww');
} else {
    $response = \Livewire\Livewire::mount('crane.crane-livewire', []);
    $html = $response->html();
    $_instance->logRenderedChild('visRTww', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/crane/crane-v2.blade.php ENDPATH**/ ?>