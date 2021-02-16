<?php $__env->startSection('content'); ?>

    <div class="container-fluid p-2 h-100 moco-layout-height">
        <div class="container-fluid text-center mb-3">
            <div class="moco-title brown-lighter-hover"><?php echo e(__('Worksheet')); ?></div>
        </div>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('worksheet.worksheet-list-head', [])->html();
} elseif ($_instance->childHasBeenRendered('X1lodzx')) {
    $componentId = $_instance->getRenderedChildComponentId('X1lodzx');
    $componentTag = $_instance->getRenderedChildComponentTagName('X1lodzx');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('X1lodzx');
} else {
    $response = \Livewire\Livewire::mount('worksheet.worksheet-list-head', []);
    $html = $response->html();
    $_instance->logRenderedChild('X1lodzx', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('worksheet.worksheet-list', [])->html();
} elseif ($_instance->childHasBeenRendered('kHyVYVZ')) {
    $componentId = $_instance->getRenderedChildComponentId('kHyVYVZ');
    $componentTag = $_instance->getRenderedChildComponentTagName('kHyVYVZ');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('kHyVYVZ');
} else {
    $response = \Livewire\Livewire::mount('worksheet.worksheet-list', []);
    $html = $response->html();
    $_instance->logRenderedChild('kHyVYVZ', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>
    <div class="modal" id="modal_print" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-sm-center">
                            <p class="moco-color-info h4"> <?php echo e(__('Worksheet printing options')); ?></p>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-row justify-content-md-between">
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-row">
                                <div class="mr-2 mt-2"><?php echo e(__('Manual hours')); ?> (*):</div>
                                <div class="mr-2 mt-2"><input type="checkbox" id="manualHours"/></div>
                            </div>
                            <div class="d-flex flex-row">
                                <div class="mr-2 mt-2"><?php echo e(__('Hours')); ?> :</div>
                                <div class="mr-2 mt-2"><input type="checkbox" id="hours"/></div>
                            </div>
                            <div class="d-flex flex-row">
                                <div class="mr-2 mt-2"><?php echo e(__('Spare parts')); ?> :</div>
                                <div class="mr-2 mt-2"><input type="checkbox" id="parts"/></div>
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <img src="<?php echo e(asset('./images/worksheet.png')); ?>">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-md-between">
                            <button type="button" id="startPrint" class="btn btn-primary" data-dismiss="modal"><?php echo e(__('Print')); ?></button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo e(asset('js/moco.redirect.js')); ?>"></script>
    <script type="text/javascript">
        $(function () {
            var id = null;
            var href = null;

            $('[id^=print_]').on('click', function (event) {
                event.preventDefault();
                id = $(this).attr('id').match(/[0-9]+/g);
                href = $(this).attr('href');
                $('#modal_print').modal('show');
            })

            $('#startPrint').on('click', function () {
                var data = [];
                data['_token'] = $('meta[name="csrf-token"]').attr('content');
                data['id'] = id;
                data['mh'] = $('#manualHours').is(':checked');
                data['h'] = $('#hours').is(':checked');
                data['p'] = $('#parts').is(':checked');
                $.redirect({
                    url : href,
                    method : 'post',
                    data : data,
                });
            });

        })

    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/worksheet/worksheet-list.blade.php ENDPATH**/ ?>