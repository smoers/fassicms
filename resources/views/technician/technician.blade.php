@extends('layouts.layout')

@section('content')
    <div class="container p-5 h-100 moco-layout-height">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                {{ $title }}
            </div>
            <div class="card-body">
                <form name="technician-form" id="technician-form" method="post" action="{{$action}}" moco-validation>
                    @csrf
                    <input id="id" name="id" type="hidden" value="{{$technician->id}}">
                    <div class="form-group">
                        <label for="number">{{ __('Number') }}</label>
                        <input type="text" id="number" name="number" class="form-control" autocomplete="off" readonly value="{{old('number',$technician->number)}}" moco-validation>
                        <div class="moco-error-small danger-darker-hover" id="numberError"></div>
                    </div>
                    <div class="form-group">
                        <label for="lastname">{{ __('Lastname')  }}</label>
                        <input type="text" id="lastname" name="lastname" class="form-control" autocomplete="off" value="{{old('lastname', $technician->lastname)}}" moco-validation />
                        <div class="moco-error-small danger-darker-hover" id="lastnameError"></div>
                    </div>
                    <div class="form-group">
                        <label for="firstname">{{ __('Firstname')  }}</label>
                        <input type="text" id="firstname" name="firstname" class="form-control" autocomplete="off" value="{{old('firstname', $technician->firstname)}}" moco-validation />
                        <div class="moco-error-small danger-darker-hover" id="firstnameError"></div>
                    </div>
                    <!-- Enabled -->
                    <div class="form-group">
                        <label for="enabled">{{ __('Enabled')  }}</label>
                        <select id="enabled" name="enabled" class="selectpicker form-control" data-width="fit" moco-validation>
                            <option value="1"
                                    @if(old('enabled',$technician->enabled) == 1) selected @endif>{{__('Yes')}}</option>
                            <option value="0"
                                    @if(old('enabled',$technician->enabled) == 0) selected @endif>{{__('No')}}</option>
                        </select>
                        <div class="moco-error-small danger-darker-hover" id="enabledError"></div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                        </div>
                        <div>
                            <a href="{{ route('technician.index') }}" class="btn btn-primary">{{__('Cancel')}}</a>
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
                            <p class="moco-color-info h4"> {{__('Information message')}}</p>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-row justify-content-md-start">
                        <div class="mr-3"><i class="fa fa-info-circle fa-3x" style="color: red !important;"></i></div>
                        <div id="_msg" class="moco-color-warning"></div>
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
            /*
            * fonction pour l'horloge
            */
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                dataType: "json",
                async: true,
            });
            /* url pour le check */
            var _url_namecheck = '{{route('technician.ajaxnamecheck')}}'
            /* event sur le Nom */
            $('#lastname').on('keyup', () => {
                check(_url_namecheck);
            });
            /* event sur le prenom */
            $('#firstname').on('keyup',() => {
                check(_url_namecheck);
            });
        });
        /**
         * check si un technicien existe déjà avece
         * le même nom et prénom
         *
         */
        function check(_url){
            if ($('#lastname').val() != '' && $('#firstname').val()) {
                let _data = {
                    lastname: $('#lastname').val(),
                    firstname: $('#firstname').val(),
                };
                request(_data, _url).then((result) => {
                    if (result.checked) {
                        /**
                         * affiche le message modal
                         */
                        $('#_msg').html(result.msg);
                        $('#modal_msg').modal('show');
                    }
                });
            };
        };
    </script>
@endsection
