@extends('layouts.layout')

@section('content')
    <div class="container p-5 h-100 moco-layout-height">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2 class="blue-grey-darker-hover">{{ __('Stock restocking') }}</h2>
            </div>
            <div class="card-body">
                <form name="part-form" id="part-form" method="post" action="{{route('reassort.update')}}" moco-validation>
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{ $_store->id }}">
                    <!-- Part Number-->
                    <div class="form-group">
                        <label for="part_number">{{ __('Part Number') }}</label>
                        <input type="text" id="part_number" name="part_number" class="form-control" readonly value="{{ old('part_number', $_partmetadata->part_number) }}" moco-validation />
                    </div>
                    <!-- Sur une ligne-->
                    <div class="row">
                        <div class="col-8">
                            <!-- Description -->
                            <div class="form-group">
                                <label for="description">{{ __('Description')  }}</label>
                                <input type="text" id="description" name="description" class="form-control" readonly value="{{old('description', $_partmetadata->description)}}" moco-validation />
                            </div>
                        </div>
                        <div class="col-4">
                            <!-- Location -->
                            <div class="form-group">
                                <label for="description">{{ __('Location')  }}</label>
                                <input type="text" id="location" name="location" class="form-control" readonly value="{{old('location', $_store->location()->first()->location.' : '.$_store->location()->first()->description)}}" moco-validation />
                            </div>
                        </div>
                    </div>
                    <!-- Sur une ligne-->
                    <div class="row">
                        <!-- qty-before -->
                        <div class="col-4">
                            <div class="form-group">
                                <label for="qty_before">{{ __('Number of pieces in stock')  }}</label>
                                <input type="number" id="qty_before" name="qty_before" class="form-control" readonly value="{{old('qty_before', $_store->qty)}}" moco-validation />
                            </div>
                        </div>
                        <!-- qty-add -->
                        <div class="col-4">
                            <div class="form-group">
                                <label for="qty_add">{{ __('Number of parts to add')  }}</label>
                                <input type="number" id="qty_add" name="qty_add" class="form-control" value="{{old('qty_add')}}" moco-validation />
                                <div class="moco-error-small danger-darker-hover" id="qty_addError"></div>
                            </div>
                        </div>
                        <!-- qty-new -->
                        <div class="col-4">
                            <div class="form-group">
                                <label for="qty_new">{{ __('New stock')  }}</label>
                                <input type="number" id="qty_new" name="qty_new" class="form-control" readonly value="{{old('qty_new')}}" moco-validation />
                             </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <!-- Reason -->
                            <div class="d-flex flex-column">
                                <div>{{__('Reason')}}</div>
                                <div>
                                    <select id="reason" name="reason" class="selectpicker form-control" data-live-search="true" title="{{__('Select a reason')}}" moco-validation>
                                        @foreach($_reasons as $_reason)
                                            <option value="{{$_reason->id}}" @if($_reason->id == old('reason')) selected @endif>{{__($_reason->reason)}}</option>
                                        @endforeach
                                    </select>
                                    <div class="moco-error-small danger-darker-hover" id="reasonError"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <!-- Note -->
                            <div class="form-group note_area">
                                <label for="note">{{ __('Note')  }}</label>
                                <input type="text" id="note" name="note" class="form-control" value="{{old('note')}}" moco-validation />
                                <div class="moco-error-small danger-darker-hover" id="noteError"></div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <!-- Location -->
                                    <div class="d-flex flex-column location_area">
                                        <div class="location_area">{{ __('Location from')  }}</div>
                                        <div class="location_area">
                                            <select id="location_id" name="location_id" disabled class="selectpicker form-control" data-width="fit" title="{{__('Select a Location')}}" moco-validation>
                                                @foreach(App\Models\Location::all() as $location)
                                                    <option value="{{$location->id}}" @if(old('location_id',$_store->location_id) == $location->id) selected @endif>{{__($location->location)." : ".__($location->description)}}</option>
                                                @endforeach
                                            </select>
                                            <div class="moco-error-small danger-darker-hover" id="location_idError"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group location_area">
                                        <label for="src_stock">{{ __('Source stock')  }}</label>
                                        <input type="text" id="src_stock" disabled name="src_stock" class="form-control" readonly moco-validation/>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                        </div>
                        <div>
                            <a href="{{ route('reassort.index') }}" class="btn btn-primary">{{__('Cancel')}}</a>
                        </div>
                    </div>
                </form>
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
    <script type="text/javascript" src="{{ asset('js/moco.ajax.validation.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            /** Ajax set up **/
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                dataType: "json",
                async: true,
            });
            /** url pour les requêtes Ajax **/
            var _url_ajax_reassort = '{{route('reassort.ajaxreassortcheck')}}'
            /** Cache le champ location **/
            $('.location_area').hide();
            /** on retire de la liste l'emplacement actuel **/
            $('#location_id').find('[value={{$_store->location()->first()->id}}]').remove();
            /** dans le cas d'un retour vers le formulaire après une validation avec erreur **/
            updateInterface();
            setLocation(_url_ajax_reassort);
            /** event sur le changement de raison **/
            $('#reason').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue){
                updateInterface();
            });
            /** event sur le choix de l'emplacement d'origine **/
            $('#location_id').on('changed.bs.select', function (){
                setLocation(_url_ajax_reassort);
            });
            /** calcule la nouvelle valeur du stock **/
            $('#qty_add').on('keyup', function (event) {
                add =  $('#qty_add').val();
                before = $('#qty_before').val();
                if(!isNaN(add) && !isNaN(before)) {
                    $('#qty_new').val(parseInt(before) + parseInt(add));
                }
            });
        });
        /**
         * quand un emplacement est choisi on en recherche la qty en stock
         */
        function setLocation(url){
            let data = {
                location_id: parseInt($('#location_id').val()),
                id: parseInt($('#id').val())
            }
            /** requète ajax **/
            request(data,url).then((result) => {
                if (result.checked == true){
                    $('#src_stock').val(result.src_stock);
                } else {
                    /**
                     * affiche le message modal
                     */
                    $('#_msg').html(result.msg);
                    $('#modal_msg').modal('show');
                }
            });
        }
        /**
         * affiche les champs en relation avec le choix de la raison
         */
        function updateInterface(){
            if($('#reason').val() == {{$_move_from}}){
                /** affiche le combo avec les emplacements **/
                $('.note_area').hide();
                $('.location_area').show();
                $('#location_id').prop('disabled', false);
                $('#location_id').selectpicker('refresh');
                $('#src_stock').removeAttr('disabled');
            } else {
                $('.note_area').show();
                $('.location_area').hide();
                $('#location_id').prop('disabled', true);
                $('#location_id').selectpicker('refresh');
                $('#src_stock').attr('disabled','disabled');
            };
        }
        /** remet la valeur du combo location sur null **/
        $('#modal_msg').on('hidden.bs.modal',() => {
            $('#location_id').val('default').selectpicker('refresh');
            $('#src_stock').val('');
        });
    </script>
@endsection
