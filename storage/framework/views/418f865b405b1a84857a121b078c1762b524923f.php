<?php $__env->startSection('content'); ?>
    <div class="container p-5 h-100 moco-layout-height">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2 class="blue-grey-darker-hover"><?php echo e($title); ?></h2>
            </div>
            <div class="card-body">
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('worksheet.worksheet-livewire', ['worksheet' => $worksheet])->html();
} elseif ($_instance->childHasBeenRendered('CLXj3YS')) {
    $componentId = $_instance->getRenderedChildComponentId('CLXj3YS');
    $componentTag = $_instance->getRenderedChildComponentTagName('CLXj3YS');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('CLXj3YS');
} else {
    $response = \Livewire\Livewire::mount('worksheet.worksheet-livewire', ['worksheet' => $worksheet]);
    $html = $response->html();
    $_instance->logRenderedChild('CLXj3YS', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/worksheet/worksheet-form-v2.blade.php ENDPATH**/ ?>