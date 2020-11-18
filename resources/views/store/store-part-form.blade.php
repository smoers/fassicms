@extends('layouts.layout')

@section('content')
    <div class="container p-5 h-100 moco-layout-height">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2 class="blue-grey-darker-hover">{{ __('Add a part') }}</h2>
            </div>
            <div class="card-body">
                <form name="part-form" id="part-form" method="post" action="{{route('store.store')}}">
                @csrf
                <!-- Part Number-->
                    <div class="form-group">
                        <label for="part_number">{{ __('Part Number') }}</label>
                        <input type="text" id="part_number" name="part_number" class="form-control" value="{{ old('part_number') }}">
                    </div>
                    <!-- Description -->
                    <div class="form-group">
                        <label for="description">{{ __('Description')  }}</label>
                        <input type="text" id="description" name="description" class="form-control" value="{{old('description')}}"></input>
                    </div>
                    <!-- Sur une ligne-->
                    <div class="row">
                        <!-- Quantity -->
                        <div class="col-3">
                            <div class="form-group">
                                <label for="qty">{{ __('Quantity')  }}</label>
                                <input type="number" id="qty "name="qty" class="form-control" value="{{old('qty')}}"></input>
                            </div>
                        </div>
                        <!-- Location -->
                        <div class="col-3">
                            <div class="form-group">
                                <label for="location">{{ __('Location')  }}</label>
                                <input type="text" id="location "name="location" class="form-control" value="{{old('location')}}"></input>
                            </div>
                        </div>
                        <!-- Price -->
                        <div class="col-3">
                            <div class="form-group">
                                <label for="price">{{ __('Price')  }}</label>
                                <input type="text" id="price "name="price" class="form-control" value="{{old('price')}}"></input>
                            </div>
                        </div>
                        <!-- Year -->
                        <div class="col-3">
                            <div class="form-group">
                                <label for="year">{{ __('Year')  }}</label>
                                <input type="number" id="year "name="year" class="form-control" value="{{ \Carbon\Carbon::now()->year }}" readonly="readonly"></input>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <!-- Provider -->
                            <div class="form-group">
                                <label for="provider">{{ __('Provider')  }}</label>
                                <select id="provider" name="provider" class="selectpicker form-control" data-live-search="true" title="{{__('Select a provider')}}">
                                    @foreach($_providers as $_provider)
                                        <option value="{{$_provider->id}}" >{{$_provider->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-2">
                            <!-- Enabled -->
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="enabled">{{ __('Enabled')  }}</label>
                                    <select @if(isset($_enabled)) @if(!is_null($_enabled)) readonly @endif @endif id="enabled" name="enabled" class="selectpicker form-control" data-width="fit" data-style="btn-primary">
                                        <option value="1" @if(isset($_enabled)) @if($_enabled == 1) selected @endif @endif>{{__('Yes')}}</option>
                                        <option value="0" @if(isset($_enabled)) @if($_enabled == 0) selected @endif @endif>{{__('No')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
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
    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\StorePartRequest','#part-form'); !!}
@endsection
