@extends('layouts.layout')

@section('content')
    <div class="container p-5 h-100 moco-layout-height">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2 class="blue-grey-darker-hover">{{__('Stock restocking on worksheet')}}</h2>
            </div>
            <div class="card-body">
                <form name="inworksheet-form" id="inworksheet-form" method="post" action="{{route('outworksheet.intreatment')}}">
                    @csrf
                    <input type="hidden" id="worksheet_id" name="worksheet_id" value=""/>
                    <input type="hidden" id="cookie" name="cookie" value="{{$cookie}}"/>
                    <div class="d-flex justify-content-center p-2 bg-light">
                        <div class="mr-2 mt-1 moco-color-error">{{__('Location')}} :</div>
                        <select id="location_id" name="location_id" class="form-control form-control-sm mr-2" autocomplete="off" style="width: auto">
                            <option></option>
                            @foreach(App\Models\Location::all() as $location)
                                <option value="{{$location->id}}" @if($location->id == $cookie) selected @endif>{{$location->location.' : '.$location->description}}</option>
                            @endforeach
                        </select>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="auto" name="auto" @if($cookie != 0) checked @endif>
                            <label class="custom-control-label mr-2 mt-1 moco-color-error" for="auto">{{__('Auto')}}</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center p-2 bg-light">
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
                                    <th class="moco-color-success" style="width: 60%">{{__('Part Number')}}</th>
                                    <th class="moco-color-success" style="width: 20%">{{__('Quantity')}}</th>
                                    <th class="moco-color-success" style="width: 20%">{{__('Worksheet Quantity')}}</th>
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
            <td><input type="number" id="wks_qty_@{{ index }}" class="form-control form-control-sm bg-white" readonly name="wks_qtys[]" value="@{{ wks_qty }}"></td>
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
            var _url_part_number = "{{ route('outworksheet.ajaxpartcheck') }}";
            var _url_part_qty = "{{ route('outworksheet.ajaxpartqtycheck') }}";
            var _init_cookie = $('#cookie').val() == 0 ? false : true;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                dataType: "json",
                async: true,
            });
            /** place le status des champs sur base de la valeur du cookie **/
            if(parseInt($('#cookie').val()) == 0){
                /** place le champ number en readonly **/
                $('#number').attr('readonly','readonly');
                /** focus sur le select **/
                setFocus();
            } else {
                /** place le champ location en readonly **/
                $('#location_id').attr('readonly','readonly');
                $('#location_id option:not(:selected)').prop('disabled', true);
                /** Focus sur le champ avec le numéro de fiche **/
                setFocus();
            }
            /**
             * place le champ part number en readonly
             */
            $('#part_number').attr('readonly','readonly');
            /** Event sur le checkbox Auto**/
            $('#auto').on('click', function() {
                if($('#auto').is(':checked')){
                    /** si on flag the checkbox on mémorise la valeur de l'emplacement **/
                    $('#cookie').val($('#location_id').val());
                    setFocus();
                } else if(!$('#auto').is(':checked') && _init_cookie && $('#number').attr('readonly') == undefined && $('#part_number').attr('readonly') != undefined){
                    _init_cookie = false;
                    $('#location_id').removeAttr('readonly');
                    $('#location_id option:not(:selected)').prop('disabled', false);
                    $('#location_id').val('');
                    /**  on active le champ number  **/
                    $('#number').attr('readonly','readonly');
                    setFocus();
                }
            });
            /** event sur le changement de valeur du select **/
            $('#location_id').on('change', function () {
                if($(this).val() != ''){
                    /** si la selection n'est pas null on place le select en readonly **/
                    $(this).attr('readonly','readonly');
                    $('#location_id option:not(:selected)').prop('disabled', true);
                    /**  on active le champ number  **/
                    $('#number').removeAttr('readonly');
                    setFocus();
                };
            })
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
                    if (index != null){
                        /**
                         * le part number existe déjà dans la liste des éléments scanner
                         * donc on incrémente la quantité de 1
                         */
                        qty = parseInt($('#qty_'+index).val())+1
                        $('#qty_'+index).val(qty);
                    } else {
                        /**
                         * le part number n'existe pas dans la liste des éléments scanner
                         * donc on l'ajoute dans la tableau _map avec une quantité de 1
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
                     * lancement d'une requête ajax afin de savoir
                     * s'il y a assez de pièce disponible sur la fiche de travail
                     */
                    let _data = {
                        worksheet_id: parseInt($('#worksheet_id').val()),
                        part_number: part,
                        qty: qty
                    };
                    /**
                     * La requète Ajax
                     */
                    request(_data, _url_part_qty).then((result) => {
                        $('#wks_qty_' + index).val(result.wks_qty);
                        setPartStatus(result, part, index);
                    });
                    /**
                     * reset
                     */
                    $(this).val("");
                }
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
            if($('#location_id').attr("readonly") == null){
                $('#location_id').focus();
            } else if ($('#number').attr("readonly") == null){
                $('#number').focus();
            } else if($('#part_number').attr("readonly") == null){
                $('#part_number').focus();
            }


        }

        /**
         * Place le status correct au champ part_number,...
         */
        function setPartStatus(result, part, index) {
            if (!result.checked) {
                /**
                 * Si la qty n'est pas suffisante on disabled le champ
                 */
                $('#part_' + index).attr('disabled', 'disabled').addClass('moco-color-bg-warning').css('text-decoration', 'line-through');
                $('#qty_' + index).attr('disabled', 'disabled').addClass('moco-color-bg-warning').css('text-decoration', 'line-through');
                $('#wks_qty_' + index).attr('disabled', 'disabled').addClass('moco-color-bg-warning').css('text-decoration', 'line-through');
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
