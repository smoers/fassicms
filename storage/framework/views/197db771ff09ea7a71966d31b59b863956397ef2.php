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
            <td><a href="#" id="_remove"><i class="fas fa-trash fa-lg mt-2" style="color: red !important;"></i></a></td>
        </tr>
    </script>

    <script type="text/javascript">
        $(function (){
            var _url_number = "<?php echo e(route('outworksheet.ajaxworksheetcheck')); ?>"
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                dataType: "json",
                async: true,
            });
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
                 * Rquête ajax rendue sync
                 */
                request({number: _number}, _url_number).then((result) => {
                    /**
                     * Comme la requête ajax est async, il faut mettre en place un mécanisme
                     * permettant d'attendre la réponse
                     */
                    if (result.checked == true){
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
                        $('#qty_'+index).val(parseInt($('#qty_'+index).val())+1);
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
            $(document).on('click', "#_remove", function (event) {
                $(this).closest("#_delete").remove();
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
            $('#_edit').on('click', function (){
                $('[id^=qty_]').removeAttr('readonly');
                $('[id^=qty_]').addClass('success-darker-hover')
            })
            $('#modal_msg').on('hidden.bs.modal',() => $('#number').focus());

        })

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