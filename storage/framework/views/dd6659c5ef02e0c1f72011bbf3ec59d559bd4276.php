<?php $__env->startSection('content'); ?>

    <div class="container-fluid p-2 h-100 moco-layout-height">
        <div class="container-fluid text-center mb-3">
            <div class="moco-title brown-lighter-hover"><?php echo e(__('Cranes')); ?></div>
        </div>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('crane.crane-list', [])->html();
} elseif ($_instance->childHasBeenRendered('Qt7oGn7')) {
    $componentId = $_instance->getRenderedChildComponentId('Qt7oGn7');
    $componentTag = $_instance->getRenderedChildComponentTagName('Qt7oGn7');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('Qt7oGn7');
} else {
    $response = \Livewire\Livewire::mount('crane.crane-list', []);
    $html = $response->html();
    $_instance->logRenderedChild('Qt7oGn7', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/crane/crane-list.blade.php ENDPATH**/ ?>