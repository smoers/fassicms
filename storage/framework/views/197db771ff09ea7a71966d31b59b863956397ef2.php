<?php $__env->startSection('content'); ?>
    <div class="container p-5 h-100 moco-layout-height">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2 class="blue-grey-darker-hover"><?php echo e(__('Stock restocking on worksheet')); ?></h2>
            </div>
            <div class="card-body">
                <form name="inworksheet-form" id="inworksheet-form" method="post" action="<?php echo e(route('outworksheet.intreatment')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="d-flex justify-content-center p-2 bg-light">
                        <input type="hidden" id="worksheet_id" name="worksheet_id" value=""/>
                        <div class="mr-2 mt-1 moco-color-error"><?php echo e(__('Worksheet Number')); ?> :</div>
                        <input id="number" name="number" class="form-control form-control-sm mr-2" style="width: auto" autocomplete="off" value=""/>
                        <div class="mr-2 mt-1 moco-color-error"><?php echo e(__('Part Number')); ?> :</div>
                        <input id="part_number" name="part_number" class="form-control form-control-sm" style="width: auto" autocomplete="off" value=""/>
                    </div>
                    <div class="d-flex justify-content-around p-2 bg-light">
                        <a href="#" id="_focus" class="btn moco-btn-sm orange-darker-hover"><i class="fas fa-compress-arrows-alt"></i> <?php echo e(__('Focus')); ?></a>
                        <a href="#" id="_edit" class="btn moco-btn-sm deep-purple-darker-hover"><i class="fas fa-edit"></i> <?php echo e(__('Modify')); ?></a>
                        <a href="#" id="_save" class="btn moco-btn-sm blue-darker-hover"><i class="fas fa-save"></i> <?php echo e(__('Save')); ?></a>
                        <a href="#" id="_cancel" class="btn moco-btn-sm moco-color-error"><i class="fas fa-sign-out-alt"></i> <?php echo e(__('Cancel')); ?></a>
                    </div>
                        <table class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th class="moco-color-success" style="width: 60%"><?php echo e(__('Part Number')); ?></th>
                                    <th class="moco-color-success" style="width: 20%"><?php echo e(__('Quantity')); ?></th>
                                    <th class="moco-color-success" style="width: 20%"><?php echo e(__('Remove')); ?></th>
                                </tr>

                            </thead>
                            <tbody id="addRow"></tbody>
                        </table>
                </form>
            </div>
        </div>
    </div>

    <div class="modal" id="modal_msg" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-sm-center">
                            <p class="moco-color-info h4"> <?php echo e(__('Message')); ?></p>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-row justify-content-md-between">
                        <div id="_msg" class="moco-color-error font-weight-bold"></div>
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
    <script id="document-template" type="text/x-handlebars-template">
        <tr id="_delete">
            <td><input type="text" id="part_{{  index }}" class="form-control form-control-sm bg-white" readonly name="parts[]" value="{{ part }}"></td>
            <td><input type="number" id="qty_{{ index }}" class="form-control form-control-sm bg-white" readonly name="qtys[]" value="{{ qty }}"></td>
            <td>
                <div class="d-flex flex-row">
                    <div class="mt-2 mr-3"><a href="#" id="remove_{{ index }}"><i class="fas fa-trash fa-lg mt-2" style="color: red !important;"></i></a></div>
                    <div class="mt-2 mr-3" ><a href="#" id="alert_{{ index }}" hidden><i class="fas fa-exclamation-triangle fa-lg mt-2" style="color: red !important;"></i></a></div>
                </div>
            </td>
        </tr>
    </script>

    <script type="text/javascript">
        $(function (){
            var _url_number = "<?php echo e(route('outworksheet.ajaxworksheetcheck')); ?>";
            var _url_part_number = "<?php echo e(route('outworksheet.ajaxpartcheck')); ?>";
            var _url_part_qty = "<?php echo e(route('outworksheet.ajaxpartqtycheck')); ?>";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                dataType: "json",
                async: true,
            });
            /**
             * Tableau avec les messages d'alertes
             */
            var _alert = new Map();
            /**
             * Tableau avec les part numbers
             */
            var _parts = new Map();
            /**
             * Focus sur le champ avec le numéro de fiche
             */
            $('#number').focus();
            /**
             * place le champ part number en readonly
             */
            $('#part_number').attr('readonly','readonly');
            /**
             * Event sur le champ fiche de travail
             */
            $('#number').on('change', function (){
                /**
                 * on check la fiche de travail
                 * si elle existe et si elle peut être modifée
                 */
                let _number = $(this).val();
                /**
                 * Requête ajax rendue sync
                 */
                request({number: _number}, _url_number).then((result) => {
                    /**
                     * Comme la requête ajax est async, il faut mettre en place un mécanisme
                     * permettant d'attendre la réponse
                     */
                    if (result.checked == true){
                        /**
                         * on memorise l'id de la fiche de travail
                         */
                        $('#worksheet_id').val(result.id);
                        /**
                         * place le champ fiche en read only
                         */
                        $(this).attr('readonly','readonly');
                        /**
                         * on autorise le champ part number
                         */
                        $('#part_number').removeAttr('readonly');
                        $('#part_number').focus();
                    } else {
                        /**
                         * reset le champ avec le numéro de la fiche de travail
                         */
                        $(this).val("");
                        $(this).focus();
                        /**
                         * affiche le message modal
                         */
                        $('#_msg').append(result.msg+" : "+_number);
                        $('#modal_msg').modal('show');
                    }
                })
               });
            /**
             * Event sur le champ part number
             */
            $('#part_number').on('change',function (){
                if ($(this).val() != null){
                    /**
                     * On obtiend le part number
                     */
                    var part = $(this).val();
                    if ((index = _parts.get(part)) != null){
                        /**
                         * le part number existe déjà dans la liste des éléments scanner
                         * donc on incrémente la quantité de 1
                         */
                        let _qty = parseInt($('#qty_'+index).val())+1
                        $('#qty_'+index).val(_qty);
                        /**
                         * lancement d'une requête ajax afin de savoir
                         * s'il y a assez de pièce disponible sur la fiche de travail
                         */
                        let _data = {
                            worksheet_id: parseInt($('#worksheet_id').val()),
                            part_number: part,
                            qty: _qty
                        };
                        request(_data, _url_part_qty).then((result) => {
                           if(!result.checked){
                               /**
                                * Si la qty n'est pas suffisante on disabled le champ
                                */
                               $('#part_'+index).attr('disabled','disabled').css('text-decoration','line-through');
                               $('#qty_'+index).attr('disabled','disabled').css('text-decoration','line-through');
                               /**
                                * affiche l'icon alert
                                */
                               $('#alert_'+index).removeAttr('hidden');
                               /**
                                * enregistre le message
                                */
                               _alert.set(part,{
                                  msg: result.msg
                               });
                           }
                        });
                    } else {
                        /**
                         * le part number n'existe pas dans la liste des éléments scanner
                         * donc on l'ajoute dans la tableau _map avec une quantité de 1
                         */
                        var qty = 1;
                        /**
                         * on construit la valeur de l'index
                         */
                        let index = _parts.size + 1;
                        /**
                         * on l'ajoute dans le tableau
                         */
                        _parts.set(part,index);
                        /**
                         * get html source
                         * @type  {*|jQuery}
                         */
                        var source = $('#document-template').html();
                        /**
                         * Objet Handlebars
                         */
                        var template = Handlebars.compile(source);
                        /**
                         * Objet à charger dans le template
                         */
                        var data = {
                            part: part,
                            qty: qty,
                            index: index,
                        }
                        /**
                         * Charge le template avec les valeurs
                         */
                        var html = template(data);
                        /**
                         * affiche la ligne
                         */
                        $('#addRow').append(html);
                    }
                    /**
                     * reset
                     */
                    $(this).val("");
                }
            });

            /**
             * Supprime une ligne du tableau
             */
            $('[id^=remove_]').on('click', () => {
                $(this).closest("#_delete").remove();
                let index = $(this).attr('id').match(/[0-9]+/g)[0];
                _parts.delete($('#part_'+index));
            })
            /**
             * Permet de redonner le focus au champ part number
             */
            $('#_focus').on('click', function (){
                $('#part_number').focus();
            })
            /**
             * permet d'activer l'édition des quantités
             */
            $('#_edit').on('click', () => {
                $('[id^=qty_]').removeAttr('readonly');
                $('[id^=qty_]').addClass('success-darker-hover')
            })
            /**
             * Permet de redonner le focus au champ numéro de fiche de travail après la fermeture de modal
             */
            $('#modal_msg').on('hidden.bs.modal',() => $('#number').focus());

        })

        /**
         * Requête ajax
         * @param  data
         * @param  url
         * @returns  {Promise<*>}
         */
        async function request(data, url){
            const _get =  await $.ajax({
                url: url,
                data: data,
            })
            return _get;
        }


    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/outworksheet/inworksheet-form.blade.php ENDPATH**/ ?>