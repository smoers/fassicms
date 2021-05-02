@extends('layouts.layout')

@section('content')
    <div class="container p-5 h-100 moco-layout-height">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2 class="blue-grey-darker-hover">{{ __('Out of stock') }}</h2>
            </div>
            <div class="card-body">
                <form name="part-form" id="part-form" method="post" action="{{route('out.update')}}" moco-validation>
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{ $_store->id }}">
                    <!-- Part Number-->
                    <div class="form-group">
                        <label for="part_number">{{ __('Part Number') }}</label>
                        <input type="text" id="part_number" name="part_number" class="form-control" readonly value="{{ old('part_number', $_store->partmetadata()->first()->part_number) }}" moco-validation>
                    </div>
                    <!-- Sur une ligne-->
                    <div class="row">
                        <div class="col-8">
                            <!-- Description -->
                            <div class="form-group">
                                <label for="description">{{ __('Description')  }}</label>
                                <input type="text" id="description" name="description" class="form-control" readonly value="{{old('description', $_store->partmetadata()->first()->description)}}" moco-validation />
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
                                <label for="qty_pull">{{ __('Number of pieces to take out')  }}</label>
                                <input type="number" id="qty_pull" name="qty_pull" class="form-control" value="{{old('qty_pull')}}" moco-validation />
                                <div class="moco-error-small danger-darker-hover" id="qty_pullError"></div>
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
                            <!-- Location -->
                            <div class="row">
                                <div class="col-8">
                                    <div class="d-flex flex-column location_area">
                                        <div class="location_area">{{ __('Destination location')  }}</div>
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
                                        <label for="dest_stock">{{ __('Destination stock')  }}</label>
                                        <input type="text" id="dest_stock" name="dest_stock" class="form-control" readonly/>
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
            var _url_ajax_out = '{{route('out.ajaxoutcheck')}}'
            /** Cache le champ location **/
            $('.location_area').hide();
            /** on retire de la liste l'emplacement actuel **/
            $('#location_id').find('[value={{$_store->location()->first()->id}}]').remove();
            /** event sur le changement de raison **/
            $('#reason').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue){
                if($('#reason').val() == {{$_move_to}}){
                    /** affiche le combo avec les emplacements **/
                    $('.note_area').hide();
                    $('.location_area').show();
                    $('#location_id').prop('disabled', false);
                    $('#location_id').selectpicker('refresh');
                } else {
                    $('.note_area').show();
                    $('.location_area').hide();
                };
            });
            /** event sur le choix de l'emplacement de destination **/
            $('#location_id').on('changed.bs.select', function(){
                /** on recherche la valeur du stock de destination **/
                let data = {
                    location_id: parseInt($(this).val()),
                    id: parseInt($('#id').val())
                };
                request(data,_url_ajax_out).then((result) => {
                    $('#dest_stock').val(result.dest_stock);
                });
            })
            /** calcule la nouvelle valeur du stock **/
            $('#qty_pull').on('keyup', function (event) {
                pull =  $('#qty_pull').val();
                before = $('#qty_before').val();
                if(!isNaN(pull) && !isNaN(before)) {
                    if (parseInt(before) >= parseInt(pull)) {
                        $('#qty_new').val(parseInt(before) - parseInt(pull));
                    } else {
                        $('#qty_new').val('');
                    }
                }
            })

            /**
             * Disabled la touche enter pour pouvoir utiliser un scanner
             */
            $('#part-form').on('keypress', function (event) {
                var keyPressed = event.keyCode || event.which;
                if (keyPressed === 13) {
                    event.preventDefault();
                    return false;
                }
            })
        });
    </script>
@endsection
