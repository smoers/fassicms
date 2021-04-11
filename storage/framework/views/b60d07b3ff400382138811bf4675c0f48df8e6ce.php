<?php $__env->startSection('content'); ?>
    <div class="container p-5 h-100 moco-layout-height" style="min-width: 50vw">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2 class="blue-grey-darker-hover"><?php echo e(__('Technician clocking')); ?></h2>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between p-2">
                    <div id="timedate" class="mr-2 mt-1">
                        <a id="mon">January</a>
                        <a id="d">1</a>,
                        <a id="y">0</a><br />
                        <a id="h">12</a> :
                        <a id="m">00</a>:
                        <a id="s">00</a>
                    </div>
                    <div class="d-flex flex-column justify-content-around">
                        <div class="d-flex flex-row justify-content-end">
                    <input type="hidden" id="worksheet_id" name="worksheet_id" value=""/>
                    <div class="mr-2 mt-1 moco-color-error moco-row-table-font-large"><?php echo e(__('Worksheet Number')); ?> :</div>
                    <input id="number" name="number" class="form-control form-control" style="width: auto" autocomplete="off" value=""/>
                        </div>
                        <div class="d-flex flex-row justify-content-end">
                    <div id="technician_field" class="mr-2 mt-1 moco-color-error moco-row-table-font-large"><?php echo e(__('Technician number')); ?> :</div>
                    <input id="technician" name="technician" class="form-control form-control" style="width: auto" autocomplete="off" value=""/>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="m-3 moco-color-success font-italic moco-row-table-font-large" id="success_msg">

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal message-->
    <div class="modal" id="modal_msg" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-sm-center">
                            <p class="moco-color-info h4"> <?php echo e(__('Error message')); ?></p>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-row justify-content-md-start">
                        <div class="mr-3"><i class="fa fa-exclamation-triangle fa-3x" style="color: red !important;"></i></div>
                        <div id="_msg" class="moco-color-error"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-md-end">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script type="text/javascript" src="<?php echo e(asset('js/moco.clock.js')); ?>"></script>
    <script type="text/javascript">
        $(function (){
            /*
            * fonction pour l'horloge
            */
            initClock('<?php echo e(Auth::user()->language); ?>');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                dataType: "json",
                async: true,
            });
            var _url_worksheetcheck = '<?php echo e(route('clocking.ajaxworksheetcheck')); ?>'
            var _url_teccheck = '<?php echo e(route('clocking.ajaxtechniciancheck')); ?>'
            /*
            * init les champs
            */
            initField();
            /*
            * event sur le champ numéro fiche de travail
            */
            $('#number').on('change', function() {
                /**
                 * on check la fiche de travail
                 * si elle existe et si elle peut être modifée
                 */
                let _number = $(this).val();
                /**
                 * Requête ajax rendue sync
                 */
                request({number: _number}, _url_worksheetcheck).then((result) => {
                    if (result.checked == true){
                        /* mémorie l'id de la fiche de travail*/
                        $('#worksheet_id').val(result.id);
                        /* Le numéro est valide, on place en lecture seul le champ number  */
                        $('#number').attr('readonly','readonly');
                        /* activation du champ pour le numéro technicien */
                        $('#technician').removeAttr('hidden');
                        $('#technician_field').removeAttr('hidden');
                        /* donne le focus au champ technician*/
                        $('#technician').focus();
                    }
                });
            });
            $('#technician').on('change', function(){
                /**
                 * on va checker si le technicien existe
                 * et s'il peut mettre des heures sur la fiche de travail
                 */
                let _tec_number = $(this).val();
                /* donnée pour la requête Ajax*/
                let _data = {
                    worksheet_id: parseInt($('#worksheet_id').val()),
                    tec_number: _tec_number,
                };
                /* requête */
                request(_data,_url_teccheck).then((result) => {
                    /* réinitalise les champs*/
                    initField()
                    if(result.checked){
                        /* affiche le message */
                        console.log(result.msg);
                        $('#success_msg').append(result.msg);
                        /* prévoit la suppression du message */
                        const stop = window.setInterval(() => {
                                $('#success_msg').empty();
                                clearInterval(stop);
                            },15000);
                    } else {
                        /**
                         * affiche le message modal
                         */
                        $('#_msg').html(result.msg);
                        $('#modal_msg').modal('show');
                    }
                });
            });
        });

        /**
         * Initialise les champs
         */
        function initField(){
            /*
            * supprime le contenu
            */
            $('#number').val('');
            $('#technician').val('');
            /*
            * unlock
            */
            $('#number').removeAttr('readonly');
            /*
            * donne le focus au numéro de la fiche de travail
            */
            $('#number').focus();
            /*
            * cache le champ technicien
             */
            $('#technician').attr('hidden','hidden');
            $('#technician_field').attr('hidden','hidden');
        }

        /**
         * Permet de redonner le focus au champ numéro de fiche de travail après la fermeture de modal
         */
        $('#modal_msg').on('hidden.bs.modal',() => $('#number').focus());
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/worksheet/clocking-technician-form.blade.php ENDPATH**/ ?>