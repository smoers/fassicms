<div class="card mb-3">
    <div class="card-header text-center font-weight-bold">
        <h2 class="blue-grey-darker-hover"><?php echo e(__('Reassortment List')); ?></h2>
    </div>
    <div class="card-body" style="font-size: 12px">
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('reassort-level.reassort-level-list', [])->html();
} elseif ($_instance->childHasBeenRendered('VrHmuJW')) {
    $componentId = $_instance->getRenderedChildComponentId('VrHmuJW');
    $componentTag = $_instance->getRenderedChildComponentTagName('VrHmuJW');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('VrHmuJW');
} else {
    $response = \Livewire\Livewire::mount('reassort-level.reassort-level-list', []);
    $html = $response->html();
    $_instance->logRenderedChild('VrHmuJW', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>
</div>
<?php /**PATH /var/www/moco/fassicms/resources/views/store/reassort-level-list.blade.php ENDPATH**/ ?>