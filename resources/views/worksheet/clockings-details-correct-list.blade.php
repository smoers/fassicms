@extends('layouts.layout')

@section('content')

    <div class="container-fluid p-2 h-100 moco-layout-height">
        <div class="container-fluid text-center mb-3">
            <div class="moco-title brown-lighter-hover">{{ __('Clocking correction') }}</div>
        </div>
        <livewire:clocking.clockings-details-correct-list/>
    </div>
    <div class="modal" id="modal_closed" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-sm-center">
                            <p class="moco-color-info h4"> {{__('Enter the end time')}}</p>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column">
                        <div class="d-flex flex-row justify-content-center">
                            <div class="mr-2 mt-2">{{__('Worksheet')}} :</div>
                            <div class="mr-2 mt-2"><input type="text" class="form-control form-control-sm bg-white" readonly id="mo_w_number"/></div>
                        </div>
                        <div class="d-flex flex-row justify-content-center">
                            <div class="mr-2 mt-2">{{__('Technician')}} :</div>
                            <div class="mr-2 mt-2"><input type="text" class="form-control form-control-sm bg-white" readonly id="mo_technician"/></div>
                        </div>
                        <div class="d-flex flex-row justify-content-center">
                            <div class="mr-2 mt-2">{{__('Date')}} :</div>
                            <div class="mr-2 mt-2"><input type="date" class="form-control form-control-sm bg-white" readonly id="mo_date"/></div>
                        </div>
                        <div class="d-flex flex-row justify-content-center">
                            <div class="mr-2 mt-2">{{__('Start time')}} :</div>
                            <div class="mr-2 mt-2"><input type="time" class="form-control form-control-sm bg-white" readonly id="mo_start_time"/></div>
                        </div>
                        <div class="d-flex flex-row justify-content-center">
                            <div class="mr-2 mt-2">{{__('Stop time')}} :</div>
                            <div class="mr-2 mt-2"><input type="time" class="form-control form-control-sm bg-white" id="mo_stop_time"/></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-md-between">
                            <button type="button" id="startClosed" class="btn btn-primary" data-dismiss="modal">{{__('Save')}}</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('Cancel')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/moco.redirect.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            var id = null;
            var _url_ajaxcorrect = '{{route('clocking.ajaxcorrect')}}'
            /** Ajax setup **/
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                dataType: "json",
                async: true,
            });
            /** affiche le modal pour introdiore l'heure de fin de la prestation **/
            $(document).on('click','a.closed_id', function (event) {
                id = $(this).attr('id').match(/[0-9]+/g)[0];
                /** Récupére les données de l'objet **/
                let obj = JSON.parse($('#closed_'+id).attr('object'));
                $('#mo_w_number').val(obj.w_number);
                $('#mo_date').val(obj.date);
                $('#mo_technician').val(obj.technician);
                $('#mo_start_time').val(obj.time);
                $('#mo_stop_time').val(null);
                $('#modal_closed').modal('show');
                $('#mo_stop_time').focus();
            })
            /** affiche le modal pour confirmer la supression du début de prestation **/
            $(document).on('click','a.removed_id', function (event) {
                id = $(this).attr('id').match(/[0-9]+/g);
            })

            $('#startClosed').on('click', () => {
                let stop_time = $('#mo_stop_time').val();
                request({id: id, stop_time: stop_time},_url_ajaxcorrect).then((result) => {
                    if (result.save){
                        iziToast.success({
                            title: '{{__('Success')}}',
                            message: result.msg,
                            timeout: 10000,
                        });
                    } else {
                        iziToast.error({
                            title: '{{__('Error')}}',
                            message: result.msg,
                            timeout: 10000,
                        })
                    }
                    /** recharge le composant livewire **/
                    window.livewire.emit('reload');
                })
            })
        })
    </script>


@endsection
