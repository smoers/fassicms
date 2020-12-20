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
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" autocomplete="off" moco-validation>
                        <div class="moco-error-small danger-darker-hover" id="nameError"></div>
                    </div>

                    <!-- address -->
                    <div class="form-group">
                        <label for="address">{{ __('Address') }}</label>
                        <input type="text" id="address" name="address" class="form-control" value="{{ old('address') }}" autocomplete="off" moco-validation>
                        <div class="moco-error-small danger-darker-hover" id="addressError"></div>
                    </div>

                    <!-- address optional-->
                    <div class="form-group">
                        <label for="address_optional">{{ __('Address (optional)') }}</label>
                        <input type="text" id="address_optional" name="address_optional" class="form-control" value="{{ old('address_optional') }}" autocomplete="off" moco-validation>
                        <div class="moco-error-small danger-darker-hover" id="address_optionalError"></div>
                    </div>

                    <div class="row">
                        <!--Zipcode -->
                        <div class="col-4">
                            <div class="form-group">
                                <label for="zipcode">{{__('Zipcode')}} <a href="#" id="flipflap"><i class="fas fa-ellipsis-h" style="color: #00aa00 !important;"></i></a> </label>
                                <select id="_zipcode" class="selectpicker with-ajax form-control" data-live-search="true" data-abs-lang-code="fr" autocomplete="off"></select>
                                <input type="text" id="zipcode" name="zipcode" class="form-control mt-2" value="{{ old('zipcode') }}" autocomplete="off" moco-validation>
                                <div class="moco-error-small danger-darker-hover" id="zipcodeError"></div>
                            </div>
                        </div>
                        <div class="col-4">
                            <!-- City-->
                            <div class="form-group">
                                <label for="city">{{ __('City') }}</label>
                                <input type="text" id="city" name="city" class="form-control mt-2" value="{{ old('city') }}" autocomplete="off" moco-validation>
                                <div class="moco-error-small danger-darker-hover" id="cityError"></div>
                            </div>
                        </div>
                        <div class="col-4">
                            <!-- address Country-->
                            <div class="form-group">
                                <label for="country">{{ __('Country') }}</label>
                                <input type="text" id="country" name="country" class="form-control mt-2" value="{{ old('country') }}" autocomplete="off" moco-validation>
                                <div class="moco-error-small danger-darker-hover" id="countryError"></div>
                            </div>
                        </div>
                    </div>

                    <!-- email -->
                    <div class="form-group">
                        <label for="mail">{{ __('Email address') }}</label>
                        <input type="text" id="mail" name="mail" class="form-control" value="{{ old('mail') }}" autocomplete="off" moco-validation>
                        <div class="moco-error-small danger-darker-hover" id="emailError"></div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <!-- phone -->
                            <div class="form-group">
                                <label for="phone">{{ __('Phone') }}</label>
                                <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') }}" autocomplete="off" moco-validation>
                                <div class="moco-error-small danger-darker-hover" id="phoneError"></div>
                            </div>
                        </div>
                        <div class="col-4">
                            <!-- mobile -->
                            <div class="form-group">
                                <label for="mobile">{{ __('Mobile') }}</label>
                                <input type="text" id="mobile" name="mobile" class="form-control" value="{{ old('mobile') }}" autocomplete="off" moco-validation>
                                <div class="moco-error-small danger-darker-hover" id="mobileError"></div>
                            </div>
                        </div>
                        <div class="col-4">
                            <!-- vat -->
                            <div class="form-group">
                                <label for="vat">{{ __('VAT') }}</label>
                                <input type="text" id="vat" name="vat" class="form-control" value="{{ old('vat') }}" autocomplete="off" moco-validation>
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
    <script type="text/javascript" src="{{ asset('js/moco.selectpicker.js') }}"></script>

    <script type="text/javascript">
        $(function (){
            //init le champ zipcode
            $('#zipcode').hide();

            /*
            * definition de l'objet selectPickerOptions
             */
            var options = jQuery.extend(true,{},selectPickerOtions);
            options.ajax.url = '{{ route('customer.ajaxselect') }}';
            options.ajax.data = function () {
                var params = {
                    zipcode:  $('#_zipcode').data().selectpicker.$searchbox.val()
                };
                return params;
            };
            options.language('fr');
            options.select = function(obj){
                return {
                    'value': obj.id,
                    'text': obj.zipcode,
                    'data': {
                        'subtext': obj.locality,
                    },
                    'disabled': false,
                }
            }


            //Configuration du selectpicker
            $('#_zipcode').selectpicker().ajaxSelectPicker(options);
            $('select').trigger('change');
            //mise à jour du champ City
            $('#_zipcode').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                _array = $('#_zipcode').selectpicker().data('AjaxBootstrapSelect').options._data;
                $('#city').val(_array[clickedIndex-1].locality);
                $('#zipcode').val(_array[clickedIndex-1].zipcode);
            });
            //flipflap
            $('#flipflap').on('click', function (){
                if($('#_zipcode').parent().is(":visible")){
                    $('#_zipcode').parent().hide();
                    $('#zipcode').show();
                } else {
                    $('#_zipcode').parent().show();
                    $('#zipcode').hide();
                }
            })
        })
    </script>
@endsection
