@extends('layouts.layout')

@section('content')
    <div class="container p-5 h-100 moco-layout-height">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2 class="blue-grey-darker-hover">{{ __('Add a part') }}</h2>
            </div>
            <div class="card-body">
                <form name="part-form" id="part-form" method="post" action="{{$_action}}" moco-validation>
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{ $store->id }}">
                    <input type="hidden" id="cat_id" name="cat_id" value="{{ $catalog->id }}">

                    <div class="row">
                        <div class="col-6">
                            <!-- Part Number-->
                            <div class="form-group">
                                <label for="part_number">{{ __('Part Number') }}</label>
                                <input type="text" id="part_number" name="part_number" class="form-control"
                                       @if($store->id != null) readonly
                                       @endif value="{{ old('part_number', $store->part_number) }}" moco-validation>
                                <div class="moco-error-small danger-darker-hover" id="part_numberError"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <!-- Bar Code-->
                            <div class="form-group">
                                <label for="part_number">{{ __('Bar Code') }}</label>
                                <input type="text" id="bar_code" name="bar_code" class="form-control"
                                       value="{{ old('bar_code', $store->bar_code) }}" moco-validation>
                                <div class="moco-error-small danger-darker-hover" id="bar_codeError"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Description -->
                    <div class="form-group">
                        <label for="description">{{ __('Description')  }}</label>
                        <input type="text" id="description" name="description" class="form-control"
                               value="{{old('description', $store->description)}}" moco-validation />
                        <div class="moco-error-small danger-darker-hover" id="descriptionError"></div>
                    </div>
                    <!-- Sur une ligne-->
                    <div class="row">
                        <!-- Quantity -->
                        <div class="col-3">
                            <div class="form-group">
                                <label for="qty">{{ __('Quantity')  }}</label>
                                <input type="number" id="qty" name="qty" class="form-control"
                                       @if($store->id != null) readonly
                                       @endif value="{{old('qty', $store->qty)}}" moco-validation />
                                <div class="moco-error-small danger-darker-hover" id="qtyError"></div>
                            </div>
                        </div>
                        <!-- Location -->
                        <div class="col-3">
                            <div class="form-group">
                                <label for="location">{{ __('Location')  }}</label>
                                <input type="text" id="location" name="location" class="form-control"
                                       value="{{old('location', $store->location)}}" moco-validation/>
                                <div class="moco-error-small danger-darker-hover" id="locationError"></div>
                            </div>
                        </div>
                        <!-- Price -->
                        <div class="col-3">
                            <div class="form-group">
                                <label for="price">{{ __('Price')  }}</label>
                                <input type="text" id="price" name="price" class="form-control"
                                       value="{{old('price', $catalog->price)}}" moco-validation />
                                <div class="moco-error-small danger-darker-hover" id="priceError"></div>
                            </div>
                        </div>
                        <!-- Year -->
                        <div class="col-3">
                            <div class="form-group">
                                <label for="year">{{ __('Year')  }}</label>
                                <input type="number" id="year" name="year" class="form-control"
                                       value="{{ old('year', $catalog->year) }}" readonly="readonly" moco-validation />
                                <div class="moco-error-small danger-darker-hover" id="yearError"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <!-- Provider -->
                            <div class="form-group">
                                <label for="provider">{{ __('Provider')  }}</label>
                                @if($store->id != null)
                                    <input type="text" id="provider" name="provider" class="form-control mt-2"
                                           value="{{ \App\Models\Provider::find($catalog->provider_id)->name }}"
                                           readonly="readonly" moco-validation />
                                @else
                                    <select id="provider" name="provider" class="selectpicker form-control"
                                            @if($store->id != null) disabled @endif data-live-search="true"
                                            title="{{__('Select a provider')}}" moco-validation>
                                        @foreach($_providers as $_provider)
                                            <option value="{{$_provider->id}}"
                                                    @if($_provider->id == old('provider', $catalog->provider_id)) selected @endif>{{$_provider->name}}</option>
                                        @endforeach
                                    </select>
                                @endif
                                <div class="moco-error-small danger-darker-hover" id="providerError"></div>
                            </div>
                        </div>


                        <div class="col-2">
                            <!-- Enabled -->
                            <div class="form-group">
                                <label for="enabled">{{ __('Enabled')  }}</label>
                                <select id="enabled" name="enabled" class="selectpicker form-control" data-width="fit" moco-validation>
                                    <option value="1"
                                            @if(old('enabled',$store->enabled) == 1) selected @endif>{{__('Yes')}}</option>
                                    <option value="0"
                                            @if(old('enabled',$store->enabled) == 0) selected @endif>{{__('No')}}</option>
                                </select>
                                <div class="moco-error-small danger-darker-hover" id="enabledError"></div>
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
    <script type="text/javascript" src="{{ asset('js/moco.ajax.validation.js') }}"></script>
    <script type="text/javascript">
        $(function (){
            var previousVal = '';
            $('#part_number').on('keyup',function () {
                if($('#bar_code').val() == previousVal){
                    previousVal = $('#part_number').val();
                    $('#bar_code').val(previousVal);
                }
            })
            $('#part-form').on('keypress', function (event) {
                var keyPressed = event.keyCode || event.which;
                if (keyPressed === 13) {
                    event.preventDefault();
                    return false;
                }
            })
        })
    </script>
@endsection
