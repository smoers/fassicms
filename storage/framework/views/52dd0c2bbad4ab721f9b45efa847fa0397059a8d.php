<?php $__env->startSection('content'); ?>

    <div class="container-fluid p-2 h-100 moco-layout-height">
        <div class="container-fluid text-center mb-3">
            <div class="moco-title brown-lighter-hover"><?php echo e(__('Clocking correction')); ?></div>
        </div>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('clocking.clockings-details-correct-list', [])->html();
} elseif ($_instance->childHasBeenRendered('27pcVyQ')) {
    $componentId = $_instance->getRenderedChildComponentId('27pcVyQ');
    $componentTag = $_instance->getRenderedChildComponentTagName('27pcVyQ');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('27pcVyQ');
} else {
    $response = \Livewire\Livewire::mount('clocking.clockings-details-correct-list', []);
    $html = $response->html();
    $_instance->logRenderedChild('27pcVyQ', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>
    <!-- Modal pour introduire l'heure de fin -->
    <div class="modal" id="modal_closed" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-sm-center">
                            <p class="moco-color-info h4"> <?php echo e(__('Enter the end time')); ?></p>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column">
                        <div class="d-flex flex-row justify-content-center">
                            <div class="mr-2 mt-2"><?php echo e(__('Worksheet')); ?> :</div>
                            <div class="mr-2 mt-2"><input type="text" class="form-control form-control-sm bg-white" readonly id="mo_w_number"/></div>
                        </div>
                        <div class="d-flex flex-row justify-content-center">
                            <div class="mr-2 mt-2"><?php echo e(__('Technician')); ?> :</div>
                            <div class="mr-2 mt-2"><input type="text" class="form-control form-control-sm bg-white" readonly id="mo_technician"/></div>
                        </div>
                        <div class="d-flex flex-row justify-content-center">
                            <div class="mr-2 mt-2"><?php echo e(__('Date')); ?> :</div>
                            <div class="mr-2 mt-2"><input type="date" class="form-control form-control-sm bg-white" readonly id="mo_date"/></div>
                        </div>
                        <div class="d-flex flex-row justify-content-center">
                            <div class="mr-2 mt-2"><?php echo e(__('Start time')); ?> :</div>
                            <div class="mr-2 mt-2"><input type="time" class="form-control form-control-sm bg-white" readonly id="mo_start_time"/></div>
                        </div>
                        <div class="d-flex flex-row justify-content-center">
                            <div class="mr-2 mt-2"><?php echo e(__('Stop time')); ?> :</div>
                            <div class="mr-2 mt-2"><input type="time" class="form-control form-control-sm bg-white" id="mo_stop_time"/></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-md-between">
                            <button type="button" id="startClosed" class="btn btn-primary" data-dismiss="modal"><?php echo e(__('Save')); ?></button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal pour la confirmation de suppression d'un début de prestations -->
    <div class="modal" id="modal_removed" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-sm-center">
                            <p class="moco-color-info h4"> <?php echo e(__('Confirmation')); ?></p>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="moco-color-warning moco" id="msgRemoved"><?php echo e(__('Are you sure to remove the start clocking for this worksheet : ')); ?></div>
                </div>
                <div class="modal-footer">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-md-between">
                            <button type="button" id="startRemoved" class="btn btn-primary" data-dismiss="modal"><?php echo e(__('Removed')); ?></button>
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
            var _url_ajaxcorrect = '<?php echo e(route('clocking.ajaxcorrect')); ?>';
            /** Ajax setup **/
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                dataType: "json",
                async: true,
            });
            /** affiche le modal pour introdiore l'heure de fin de la prestation **/
            $(document).on('click','a.closed_id', function (event) {
                id = $(this).attr('id').match(/[0-9]+/g)[0];
                /** Récupére les données de l'objet **/
                let obj = JSON.parse($('#closed_'+id).attr('object'));
                $('#mo_w_number').val(obj.w_number);
                $('#mo_date').val(obj.date);
                $('#mo_technician').val(obj.technician);
                $('#mo_start_time').val(obj.time);
                $('#mo_stop_time').val(null);
                $('#modal_closed').modal('show');
                $('#mo_stop_time').focus();
            })
            /** affiche le modal pour confirmer la supression du début de prestation **/
            $(document).on('click','a.removed_id', function (event) {
                let obj = getId($(this));
                let msg = $('#msgRemoved').text();
                $('#msgRemoved').text(msg + obj.w_number);
                $('#modal_removed').modal('show');
            })
            /** Sauvegarde l'heure de fin de prestation **/
            $('#startClosed').on('click', () => {
                let stop_time = $('#mo_stop_time').val();
                request({id: id, stop_time: stop_time, whyis: 'closed'},_url_ajaxcorrect).then((result) => {
                    showMsg(result);
                    /** recharge le composant livewire **/
                    window.livewire.emit('reload');
                })
            })
            /** Place le status du record début de prestation en "remove" **/
            $('#startRemoved').on('click', () => {
                request({id: id, whyis: 'removed'},_url_ajaxcorrect).then((result) => {
                    showMsg(result);
                    /** recharge le composant livewire **/
                    window.livewire.emit('reload');
                });
            })

            /**
             * Retourne un objet avec les valeur de la ligne du tableau
             * @param  element
             * @returns  {any}
             */
            function getId(element){
                id = element.attr('id').match(/[0-9]+/g)[0];
                /** Récupére les données de l'objet **/
                let obj = JSON.parse($('#closed_'+id).attr('object'));
                return obj;
            }
        })

        /**
         * Affiche un message sur base du résultat de la requête Ajax
         * @param  result
         */
        function showMsg(result){
            if (result.status){
                iziToast.success({
                    title: '<?php echo e(__('Success')); ?>',
                    message: result.msg,
                    timeout: 10000,
                });
            } else {
                iziToast.error({
                    title: '<?php echo e(__('Error')); ?>',
                    message: result.msg,
                    timeout: 10000,
                })
            }
        }
    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/worksheet/clockings-details-correct-list.blade.php ENDPATH**/ ?>