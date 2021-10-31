<?php $__env->startSection('content'); ?>
    <div class="container-fluid p-2 h-100 moco-layout-height">
        <div class="container-fluid text-center mb-3">
            <div class="container-fluid text-center mb-3">
                <div class="moco-title brown-lighter-hover"><?php echo e(__('Reporting')); ?></div>
            </div>
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('reporting.partmetadata-export-data-table', [])->html();
} elseif ($_instance->childHasBeenRendered('tA0gv46')) {
    $componentId = $_instance->getRenderedChildComponentId('tA0gv46');
    $componentTag = $_instance->getRenderedChildComponentTagName('tA0gv46');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('tA0gv46');
} else {
    $response = \Livewire\Livewire::mount('reporting.partmetadata-export-data-table', []);
    $html = $response->html();
    $_instance->logRenderedChild('tA0gv46', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/reporting/from_worksheet.blade.php ENDPATH**/ ?>