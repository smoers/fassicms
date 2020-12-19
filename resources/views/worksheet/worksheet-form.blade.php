@extends('layouts.layout')

@section('content')
    <div class="container p-5 h-100 moco-layout-height">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2 class="blue-grey-darker-hover">{{ __('Add a worksheet') }}</h2>
            </div>
            <div class="card-body">
                <form name="worksheet-form" id="worksheet-form" method="post" action="{{$_action}}" moco-validation>
                    @csrf
                    <div class="form-group">
                        <label for="date">{{__('Date')}}</label>
                        <div class="input-group mb-3">
                            <input type="text" id="date" name="date" class="form-control"
                                   placeholder="{{__('DD/MM/YYYY')}}" aria-label="date" aria-describedby="basic-addon1">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar-alt"></i></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            $('#date').datepicker({
                format: 'dd-mm-yyyy',
                orientation: 'bottom',
                language: 'fr',
            });
        })
    </script>
@endsection

