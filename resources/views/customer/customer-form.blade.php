@extends('layouts.layout')

@section('content')
    <div class="container p-5 h-100 moco-layout-height">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2 class="blue-grey-darker-hover">{{ __('Add customer') }}</h2>
            </div>
            <div class="card-body">
                <form name="customer-form" id="customer-form" method="post" action="{{route('customer.store')}}" moco-validation>
                    @csrf

                    <!-- Name -->
                    <div class="form-group">
                        <label for="name">{{ __('Company name') }}</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" moco-validation>
                        <div class="moco-error-small danger-darker-hover" id="nameError"></div>
                    </div>

                    <!-- address -->
                    <div class="form-group">
                        <label for="address">{{ __('Address') }}</label>
                        <input type="text" id="address" name="address" class="form-control" value="{{ old('address') }}" moco-validation>
                        <div class="moco-error-small danger-darker-hover" id="addressError"></div>
                    </div>

                    <!-- address optional-->
                    <div class="form-group">
                        <label for="address_optional">{{ __('Address') }}</label>
                        <input type="text" id="address_optional" name="address_optional" class="form-control" value="{{ old('address_optional') }}" moco-validation>
                        <div class="moco-error-small danger-darker-hover" id="address_optionalError"></div>
                    </div>

                    <div class="row">
                        <!--Zipcode -->
                        <div class="col-4">
                            <div class="form-group">
                                <label for="zipcode">{{__('Zipcode')}}</label>
                                <select id="zipcode" class="selectpicker with-ajax form-control" data-live-search="true"></select>
                                <div class="moco-error-small danger-darker-hover" id="zipcodeError"></div>
                            </div>
                        </div>
                        <div class="col-4">
                            <!-- City-->
                            <div class="form-group">
                                <label for="city">{{ __('City') }}</label>
                                <input type="text" id="city" name="city" class="form-control mt-2" value="{{ old('city') }}" moco-validation>
                                <div class="moco-error-small danger-darker-hover" id="cityError"></div>
                            </div>
                        </div>
                        <div class="col-4">
                            <!-- address Country-->
                            <div class="form-group">
                                <label for="country">{{ __('Country') }}</label>
                                <input type="text" id="country" name="country" class="form-control mt-2" value="{{ old('country') }}" moco-validation>
                                <div class="moco-error-small danger-darker-hover" id="countryError"></div>
                            </div>
                        </div>
                    </div>

                    <!-- email -->
                    <div class="form-group">
                        <label for="email">{{ __('Email') }}</label>
                        <input type="text" id="email" name="email" class="form-control" value="{{ old('email') }}" moco-validation>
                        <div class="moco-error-small danger-darker-hover" id="emailError"></div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <!-- phone -->
                            <div class="form-group">
                                <label for="phone">{{ __('Phone') }}</label>
                                <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') }}" moco-validation>
                                <div class="moco-error-small danger-darker-hover" id="phoneError"></div>
                            </div>
                        </div>
                        <div class="col-4">
                            <!-- mobile -->
                            <div class="form-group">
                                <label for="mobile">{{ __('Mobile') }}</label>
                                <input type="text" id="mobile" name="mobile" class="form-control" value="{{ old('mobile') }}" moco-validation>
                                <div class="moco-error-small danger-darker-hover" id="mobileError"></div>
                            </div>
                        </div>
                        <div class="col-4">
                            <!-- vat -->
                            <div class="form-group">
                                <label for="vat">{{ __('VAT') }}</label>
                                <input type="text" id="vat" name="vat" class="form-control" value="{{ old('vat') }}" moco-validation>
                                <div class="moco-error-small danger-darker-hover" id="vatError"></div>
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
        var options = {
            ajax          : {
                url     : '{{ route('customer.ajaxselect') }}',
                type    : 'POST',
                dataType: 'json',
                data    :  function () {
                    var params = {
                        zipcode:  $('#zipcode').data().selectpicker.$searchbox.val()
                    };
                    return params;
                }
            },
            locale        : {
                emptyTitle: 'Select and Begin Typing'
            },
            log           : 3,
            preprocessData: function (data) {
                var i, l = data.length, array = [];
                if (l) {
                    for (i = 0; i < l; i++) {
                        array.push($.extend(true, data[i], {
                            text : data[i].Name,
                            value: data[i].Email,
                            data : {
                                subtext: data[i].Email
                            }
                        }));
                    }
                }
                // You must always return a valid array when processing data. The
                // data argument passed is a clone and cannot be modified directly.
                return array;
            }
        };
        $('.selectpicker').selectpicker().filter('.with-ajax').ajaxSelectPicker(options);
        $('select.after-init').append('<option value="neque.venenatis.lacus@neque.com" data-subtext="neque.venenatis.lacus@neque.com" selected="selected">Chancellor</option>').selectpicker('refresh');
        $('select').trigger('change');
    </script>
@endsection
