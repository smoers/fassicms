@extends('layouts.layout')

@section('content')
    <div class="container p-5 h-100 moco-layout-height">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                {{ __('Add a crane') }}
            </div>
            <div class="card-body">
                <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{route('crane.store')}}" moco-validation>
                    @csrf
                    <div class="form-group">
                        <label for="serial">{{ __('Serial number') }}</label>
                        <input type="text" id="serial" name="serial" class="form-control" autocomplete="off" value="{{old('serial')}}" moco-validation>
                        <div class="moco-error-small danger-darker-hover" id="serialError"></div>
                    </div>
                    <div class="form-group">
                        <label for="model">{{ __('Model')  }}</label>
                        <input type="text" id="model" name="model" class="form-control" autocomplete="off" value="{{old('model')}}" moco-validation />
                        <div class="moco-error-small danger-darker-hover" id="modelError"></div>
                    </div>
                    <div class="form-group">
                        <label for="plate">{{ __('Numberplate')  }}</label>
                        <input type="text" id="plate" name="plate" class="form-control" autocomplete="off" value="{{old('plate')}}" moco-validation />
                        <div class="moco-error-small danger-darker-hover" id="plateError"></div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                        </div>
                        <div class="col-10">
                            <a href="{{ route('dashboard') }}" class="btn btn-primary">{{__('Cancel')}}</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/moco.ajax.validation.js') }}"></script>
@endsection
