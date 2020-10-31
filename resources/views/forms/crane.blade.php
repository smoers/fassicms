@extends('layouts.layout')

@section('content')
    <div class="container p-5 h-100 fassi-layout-height">
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                {{ __('Add a crane') }}
            </div>
            <div class="card-body">
                <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('store-form')}}">
                    @csrf
                    <div class="form-group">
                        <label for="serial">{{ __('Serial number') }}</label>
                        <input type="text" id="serial" name="serial" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label for="model">{{ __('Model')  }}</label>
                        <input type="text" id="model "name="model" class="form-control" required=""></input>
                    </div>
                    <div class="form-group">
                        <label for="plate">{{ __('Numberplate')  }}</label>
                        <input type="text" id="plate "name="plate" class="form-control" required=""></input>
                    </div>
                    <div class="row">
                        <div class="col-1">
                            <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                        </div>
                        <div class="col-11">
                            <a href="{{ route('dashboard') }}" class="btn btn-primary">{{__('Cancel')}}</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
