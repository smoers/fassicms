@extends('layouts.layout')

@section('content')
    <div class="container p-5 h-100 moco-layout-height">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2 class="blue-grey-darker-hover">{{ __('Out of stock') }}</h2>
            </div>
            <div class="card-body">
                <form name="part-form" id="part-form" method="post" action="{{route('out.update')}}">
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{ $_store->id }}">
                    <!-- Part Number-->
                    <div class="form-group">
                        <label for="part_number">{{ __('Part Number') }}</label>
                        <input type="text" id="part_number" name="part_number" class="form-control" readonly value="{{ old('part_number', $_store->part_number) }}">
                    </div>
                    <!-- Description -->
                    <div class="form-group">
                        <label for="description">{{ __('Description')  }}</label>
                        <input type="text" id="description" name="description" class="form-control" readonly value="{{old('description', $_store->description)}}"></input>
                    </div>

                    <!-- Sur une ligne-->
                    <div class="row">
                        <!-- qty-before -->
                        <div class="col-4">
                            <div class="form-group">
                                <label for="qty_before">{{ __('Number of pieces in stock')  }}</label>
                                <input type="number" id="qty_before" name="qty_before" class="form-control" readonly value="{{old('qty_before', $_store->qty)}}"></input>
                            </div>
                        </div>
                        <!-- qty-add -->
                        <div class="col-4">
                            <div class="form-group">
                                <label for="qty_pull">{{ __('Number of pieces to take out')  }}</label>
                                <input type="number" id="qty_pull" name="qty_pull" class="form-control" value="{{old('qty_pull')}}"></input>
                                <div class="moco-error-small danger-darker-hover" id="qty_pullError"></div>
                            </div>
                        </div>
                        <!-- qty-new -->
                        <div class="col-4">
                            <div class="form-group">
                                <label for="qty_new">{{ __('New stock')  }}</label>
                                <input type="number" id="qty_new" name="qty_new" class="form-control" readonly value="{{old('qty_new')}}"></input>
                             </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <!-- Reason -->
                            <div class="form-group">
                                <label for="reason">{{__('Reason')}}</label>
                                <select id="reason" name="reason" class="selectpicker form-control" data-live-search="true" title="{{__('Select a reason')}}">
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
                                <input type="text" id="note" name="note" class="form-control mt-2" value="{{old('note')}}"></input>
                                <div class="moco-error-small danger-darker-hover" id="noteError"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                        </div>
                        <div class="col-10">
                            <a href="{{ route('reassort.index') }}" class="btn btn-primary">{{__('Cancel')}}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">

        $(function () {
            var pullValidation = 0;
            var reasonValidation = 0
            var noteValidation = 0
            /** calcule la nouvelle valeur du stock **/
            $('#qty_pull').on('keyup', function (event) {
                clearTimeout(pullValidation);
                pull =  $('#qty_pull').val();
                before = $('#qty_before').val();
                if(!isNaN(pull) && !isNaN(before)) {
                    $('#qty_new').val(parseInt(before) - parseInt(pull));
                }
                validation = setTimeout(outValidation,1000,'#qty_pull');
            })

            /** validation du champ Reason **/
            $('#reason').on('change',function (event){
                clearTimeout(reasonValidation)
                pullValidation = setTimeout(outValidation,1000,'#reason');
            })
            /** Validation du champ Note **/
            $('#note').on('keyup', function (event) {
                clearTimeout(noteValidation);
                noteValidation = setTimeout(outValidation,1000,'#note');
            })
            /** Ajax request pour la validation **/
            var outValidation = function (selector) {
                console.log("Start AJAX");
                qty_pull = $('#qty_pull').val();
                reason = $('#reason').val();
                $.ajax({
                    url: "{{ route('out.ajaxvalidation') }}",
                    type:"POST",
                    data:{
                        "_token": "{{ csrf_token() }}",
                        qty_pull: qty_pull,
                        reason: reason,
                    },
                    success:function (response) {
                        console.log(response);
                        $(selector).removeClass('is-invalid').addClass('is-valid');
                        $(selector+'Error').text("");
                    },
                    error:function (response) {
                        id = $(selector).attr('id');
                        message = response.responseJSON.errors[id];
                        if(message == null)
                        {
                            $(selector).removeClass('is-invalid').addClass('is-valid');
                            $(selector+'Error').text("");
                        }
                        else
                        {
                            console.log([id, 'not null']);
                            $(selector).removeClass('is-valid').addClass('is-invalid');
                            $(selector+'Error').text(response.responseJSON.errors[id]);
                        }
                    }
                })
            }
        });
    </script>
@endsection
