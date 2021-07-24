@extends('layouts.layout')

@section('content')

    <div class="container-fluid p-2 h-100 moco-layout-height">
        <div class="container-fluid text-center mb-3">
            <div class="moco-title brown-lighter-hover">{{ __('Worksheet') }}</div>
        </div>
        <livewire:worksheet.worksheet-list-head/>
        <livewire:worksheet.worksheet-list/>
    </div>
    <div class="modal" id="modal_print" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-sm-center">
                            <p class="moco-color-info h4"> {{__('Worksheet printing options')}}</p>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-row justify-content-md-between">
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-row">
                                <div class="mr-2 mt-2">{{__('Manual hours')}} (*):</div>
                                <div class="mr-2 mt-2"><input type="checkbox" id="manualHours"/></div>
                            </div>
                            <div class="d-flex flex-row">
                                <div class="mr-2 mt-2">{{__('Hours')}} :</div>
                                <div class="mr-2 mt-2"><input type="checkbox" id="hours"/></div>
                            </div>
                            <div class="d-flex flex-row">
                                <div class="mr-2 mt-2">{{__('Spare parts')}} :</div>
                                <div class="mr-2 mt-2"><input type="checkbox" id="parts"/></div>
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <img src="{{asset('./images/worksheet.png')}}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-md-between">
                            <button type="button" id="startPrint" class="btn btn-primary" data-dismiss="modal">{{__('Print')}}</button>
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
            var href = null;

            $(document).on('click','a.print_id', function (event) {
                event.preventDefault();
                id = $(this).attr('id').match(/[0-9]+/g);
                href = $(this).attr('href');
                $('#modal_print').modal('show');
            })

            $('#startPrint').on('click', function () {
                var data = [];
                data['_token'] = $('meta[name="csrf-token"]').attr('content');
                data['id'] = id;
                data['mh'] = $('#manualHours').is(':checked');
                data['h'] = $('#hours').is(':checked');
                data['p'] = $('#parts').is(':checked');
                $.redirect({
                    url : href,
                    method : 'post',
                    data : data,
                });
            });

        })


    </script>


@endsection
