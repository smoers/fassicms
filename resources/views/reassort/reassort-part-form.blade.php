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
                            <div class="form-group">
                                <label for="reason">{{__('Reason')}}</label>
                                <select id="reason" name="reason" class="selectpicker form-control" data-live-search="true" title="{{__('Select a reason')}}" moco-validation>
                                    @foreach($_reasons as $_reason)
                                        <option value="{{$_reason->id}}" @if($_reason->id == old('reason')) selected @endif>{{__($_reason->reason)}}</option>
                                    @endforeach
                                </select>
                                <div class="moco-error-small danger-darker-hover" id="reasonError"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <!-- Note -->
                            <div class="form-group">
                                <label for="note">{{ __('Note')  }}</label>
                                <input type="text" id="note" name="note" class="form-control mt-2" value="{{old('note')}}" moco-validation />
                                <div class="moco-error-small danger-darker-hover" id="noteError"></div>
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
            /** calcule la nouvelle valeur du stock **/
            $('#qty_add').on('keyup', function (event) {
                add =  $('#qty_add').val();
                before = $('#qty_before').val();
                if(!isNaN(add) && !isNaN(before)) {
                    $('#qty_new').val(parseInt(before) + parseInt(add));
                }
            });
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
