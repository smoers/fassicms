@extends('layouts.layout')

@section('content')
    <div class="container p-5 h-100 moco-layout-height">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2 class="blue-grey-darker-hover">{{__('Out of stock on worksheet')}}</h2>
            </div>
            <div class="card-body">
                <form name="inworksheet-form" id="inworksheet-form" method="post" action="{{route('outworksheet.outtreatment')}}">
                    @csrf
                    <div class="d-flex justify-content-center p-2 bg-light">
                        <input type="hidden" id="worksheet_id" name="worksheet_id" value=""/>
                        <div class="mr-2 mt-1 moco-color-error">{{__('Worksheet Number')}} :</div>
                        <input id="number" name="number" class="form-control form-control-sm mr-2" style="width: auto" autocomplete="off" value=""/>
                        <div class="mr-2 mt-1 moco-color-error">{{__('Part Number')}} :</div>
                        <input id="part_number" name="part_number" class="form-control form-control-sm" style="width: auto" autocomplete="off" value=""/>
                    </div>
                    <div class="d-flex justify-content-around p-2 bg-light">
                        <a href="#" id="_focus" class="btn moco-btn-sm orange-darker-hover"><i class="fas fa-compress-arrows-alt"></i> {{__('Focus')}}</a>
                        <a href="#" id="_edit" class="btn moco-btn-sm deep-purple-darker-hover"><i class="fas fa-edit"></i> {{__('Modify')}}</a>
                        <a href="#" id="_save" class="btn moco-btn-sm blue-darker-hover"><i class="fas fa-save"></i> {{__('Save')}}</a>
                        <a href="#" id="_cancel" class="btn moco-btn-sm moco-color-error"><i class="fas fa-sign-out-alt"></i> {{__('Cancel')}}</a>
                    </div>
                        <table class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th class="moco-color-success" style="width: 40%">{{__('Part Number')}}</th>
                                    <th class="moco-color-success" style="width: 20%">{{__('Quantity')}}</th>
                                    <th class="moco-color-success" style="width: 20%">{{__('Stock Quantity')}}</th>
                                    <th class="moco-color-success" style="width: 20%">{{__('Remove')}}</th>
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
                            <p class="moco-color-info h4"> {{__('Error message')}}</p>
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
                            <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('Cancel')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script id="document-template" type="text/x-handlebars-template">
        <tr id="delete_@{{ index }}">
            <td><input type="text" id="part_@{{  index }}" class="form-control form-control-sm bg-white" readonly name="parts[]" value="@{{ part }}"></td>
            <td id="_qty"><input type="number" id="qty_@{{ index }}" class="form-control form-control-sm bg-white" readonly name="qtys[]" value="@{{ qty }}"></td>
            <td><input type="number" id="stock_qty_@{{ index }}" class="form-control form-control-sm bg-white" readonly name="stock_qtys[]" value="@{{ stock_qty }}"></td>
            <td>
                <div class="d-flex flex-row">
                    <div class="mr-3"><a href="#" id="_remove"><i class="fas fa-trash fa-lg mt-2" style="color: red !important;" id="remove_@{{ index }}"></i></a></div>
                    <div class="mr-3" id="hidden_@{{ index }}" hidden><a href="#" id="_alert"><i class="fas fa-exclamation-triangle fa-lg mt-2" style="color: red !important;" id="alert_@{{ index }}"></i></a></div>
                </div>
            </td>
        </tr>
    </script>

    <script type="text/javascript">
        /**
         * Tableau avec les messages d'alertes
         */
        var _alert = new Map();
        /**
         * Tableau avec les part numbers
         */
        var _parts = new Map();
        $(function (){
            var _url_number = "{{ route('outworksheet.ajaxworksheetcheck') }}";
            var _url_part_number = "{{ route('outworksheet.ajaxpartcheckout') }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                dataType: "json",
                async: true,
            });
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
                        $('#_msg').html(result.msg+" : "+_number);
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
                    /**
                     *  défini la quantité par défaut
                     */
                    var qty = 1;
                    var index = _parts.get(part);
                    if ( index != null){
                        /**
                         * le part number existe déjà dans la liste des éléments scanner
                         * donc on incrémente la quantité de 1
                         */
                        qty = parseInt($('#qty_'+index).val())+1
                        $('#qty_'+index).val(qty);
                    } else {
                        /**
                         * le part number n'existe pas dans la liste des éléments scanner
                         * donc on l'ajoute dans la tableau _map
                         * on construit la valeur de l'index
                         */
                        index = _parts.size + 1;
                        /**
                         * on l'ajoute dans le tableau
                         */
                        _parts.set(part,index);
                        /**
                         * get html source
                         * @type {*|jQuery}
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
                            index: index
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
                     * lancement d'une requête ajax afin de savoir
                     * si la pièce est disponible dans le stock et si la quantité disponible est suffisante
                     */
                    let _data = {
                        part_number: part,
                        qty: qty
                    };
                    /**
                     * La requète Ajax
                     */
                    request(_data, _url_part_number).then((result) => {
                        $('#stock_qty_' + index).val(result.stock_qty);
                        setPartStatus(result, part, index);
                    });
                    /**
                     * reset
                     */
                    $(this).val("");
                }


            });

            /**
             * Changement de valeur sur le champ quantité
             */
            $(document).on('keyup','#_qty', (event) => {
                /**
                 * Récupère l'index
                 */
                let index = event.target.id.match(/[0-9]+/g)[0];
                if (parseInt($('#qty_' + index).val()) < 1 ){
                    $('#qty_' + index).val(1);
                }
                /**
                 * prépare le données pour la requête Ajax
                 */
                let _data = {
                    part_number: $('#part_' + index).val(),
                    qty: parseInt($('#qty_' + index).val())
                };
                console.log(index, _data);
                /**
                 * Lancement de la requête Ajax
                 */
                request(_data, _url_part_number).then((result) => {
                    $('#stock_qty_' + index).val(result.stock_qty);
                    setPartStatus(result, $('#part_' + index).val(), index);
                });
            });

            /**
             * Supprime une ligne du tableau et supprime l'entrée dans la Map
             */
            $(document).on('click',"#_remove", (event) => {
                /**
                 * Récupère l'index
                 */
                let index = event.target.id.match(/[0-9]+/g)[0];
                /**
                 * Supprime l'entrée dans la tableau Map
                 */
                _parts.delete($('#part_'+index).val());
                /**
                 * Ceci permet de garder une cohérence dans les index
                 * car ils sont calculé sur la base de la longueur du tableau
                 */
                _parts.set('remove_'+index, index);
                /**
                 * Supprime
                 */
                $("#delete_"+index).remove();
                setFocus();
            })

            /**
             * Permat l'affichage des messages d'alerte
             */
            $(document).on('click','#_alert',(event) => {
                /**
                 * Récupère l'index
                 */
                let index = event.target.id.match(/[0-9]+/g)[0];
                /**
                 * Récupère l'objet dans la tableau
                 */
                let _alert_obj = _alert.get($('#part_'+index).val())
                $('#_msg').html(_alert_obj.msg);
                $('#modal_msg').modal('show');
            });
            /**
             * Permet de redonner le focus au champ part number ou numéro fiche de travail
             */
            $('#_focus').on('click',  () => setFocus());
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
            $('#modal_msg').on('hidden.bs.modal',() => setFocus());
            /**
             * Soumet le formulaire
             */
            $('#_save').on('click', () => $('#inworksheet-form').submit());

        })

        /**
         * Requête ajax
         * @param data
         * @param url
         * @returns {Promise<*>}
         */
        async function request(data, url){
            const _get =  await $.ajax({
                url: url,
                data: data,
            })
            return _get;
        }

        /**
         * Assigne le focus au champ actif
         */
        function setFocus(){
            if ($('#number').attr("readonly") == null){
                $('#number').focus();
            } else {
                $('#part_number').focus();
            }
        }

        /**
         * Place le status correct au champ part_number,...
         */
        function setPartStatus(result, part, index){
            if (!result.checked) {
                /**
                 * Si la qty n'est pas suffisante on disabled le champ
                 */
                $('#part_' + index).attr('disabled', 'disabled').addClass('moco-color-bg-warning').css('text-decoration', 'line-through');
                $('#qty_' + index).attr('disabled', 'disabled').addClass('moco-color-bg-warning').css('text-decoration', 'line-through');
                $('#stock_qty_' + index).attr('disabled', 'disabled').addClass('moco-color-bg-warning').css('text-decoration', 'line-through');
                /**
                 * affiche l'icon alert
                 */
                $('#hidden_' + index).removeAttr('hidden');
                /**
                 * enregistre le message
                 */
                _alert.set(part, {
                    msg: result.msg
                });
            }
        }


    </script>
@endsection
