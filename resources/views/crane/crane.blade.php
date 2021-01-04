@extends('layouts.layout')

@section('content')
    <div class="container p-5 h-100 moco-layout-height">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                {{ $title }}
            </div>
            <div class="card-body">
                <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{$action}}" moco-validation>
                    @csrf
                    <input id="id" name="id" type="hidden" value="{{$crane->id}}">
                    <div class="form-group">
                        <label for="serial">{{ __('Serial number') }}</label>
                        <input type="text" id="serial" name="serial" class="form-control" autocomplete="off" value="{{old('serial',$crane->serial)}}" moco-validation>
                        <div class="moco-error-small danger-darker-hover" id="serialError"></div>
                    </div>
                    <div class="form-group">
                        <label for="model">{{ __('Model')  }}</label>
                        <input type="text" id="model" name="model" class="form-control" autocomplete="off" value="{{old('model', $crane->model)}}" moco-validation />
                        <div class="moco-error-small danger-darker-hover" id="modelError"></div>
                    </div>
                    <div class="form-group">
                        <label for="plate">{{ __('Numberplate')  }}</label>
                        <input type="text" id="plate" name="plate" class="form-control" autocomplete="off" value="{{old('plate', $crane->plate)}}" moco-validation />
                        <div class="moco-error-small danger-darker-hover" id="plateError"></div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                        </div>
                        <div>
                            <a id="_expert" href="" class="btn btn-warning">{{__('Expert mode')}}</a>
                        </div>
                        <div>
                            <a href="{{ route('dashboard') }}" class="btn btn-primary">{{__('Cancel')}}</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/moco.ajax.validation.js') }}"></script>
    <script type="text/javascript">
        $(function (){
            /**
             * Expert mode
             */
            if($('#id').val() != ''){
                $('#_expert').show();
                $('#serial').attr('readonly','readonly');
                $('#plate').attr('readonly','readonly');
                $('#_expert').on('click', function (event) {
                    event.preventDefault();
                    $('#serial').removeAttr('readonly');
                    $('#plate').removeAttr('readonly');
                })
            } else {
                $('#_expert').hide();
            }

        })
    </script>
@endsection
