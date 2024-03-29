@extends('layouts.layout')

@section('content')
    <div class="container p-5 h-100 moco-layout-height">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2 class="blue-grey-darker-hover">{{ $title }}</h2>
            </div>
            <div class="card-body">
                <form name="customer-form" id="customer-form" method="post" action="{{$action}}" moco-validation>
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{$customer->id}}">
                    <input type="hidden" id="black_listed" name="black_listed" value="{{$customer->black_listed}}">
                    <!-- Name -->
                    <div class="form-group">
                        <label for="name">{{ __('Company name') }}  :  <a href="#" id="black_listed_href"><i class="fas fa-thumbs-up green-lighter-hover" id="black_listed_fa"></i></a></label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name',$customer->name) }}" autocomplete="off" moco-validation>
                        <div class="moco-error-small danger-darker-hover" id="nameError"></div>
                    </div>

                    <div>
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a href="#general" class="nav-link active" data-toggle="tab">{{__('General data')}}</a>
                            </li>
                            <li class="nav-item">
                                <a href="#contacts" class="nav-link" data-toggle="tab">{{__('Contacts')}}</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-3">
                            <!-- TAB GENERAL-->
                            <div class="tab-pane fade show active" id="general">
                                <!-- address -->
                                <div class="form-group">
                                    <label for="address">{{ __('Address') }}</label>
                                    <input type="text" id="address" name="address" class="form-control" value="{{ old('address',$customer->address) }}" autocomplete="off" moco-validation>
                                    <div class="moco-error-small danger-darker-hover" id="addressError"></div>
                                </div>

                                <!-- address optional-->
                                <div class="form-group">
                                    <label for="address_optional">{{ __('Address (optional)') }}</label>
                                    <input type="text" id="address_optional" name="address_optional" class="form-control" value="{{ old('address_optional',$customer->address_optional) }}" autocomplete="off" moco-validation>
                                    <div class="moco-error-small danger-darker-hover" id="address_optionalError"></div>
                                </div>

                                <div class="row">
                                    <!--Zipcode -->
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="zipcode">{{__('Zipcode')}} <a href="#" id="flipflap"><i class="fas fa-ellipsis-h" style="color: #00aa00 !important;"></i></a> </label>
                                            <select id="_zipcode" class="selectpicker with-ajax form-control" data-live-search="true" data-abs-lang-code="fr" autocomplete="off">
                                                @if(isset($_zipcode))<option selected value="{{$_zipcode->id}}">{{$_zipcode->zipcode}}</option>@endif
                                            </select>
                                            <input type="text" id="zipcode" name="zipcode" class="form-control mt-2" value="{{ old('zipcode',$customer->zipcode) }}" autocomplete="off" moco-validation>
                                            <div class="moco-error-small danger-darker-hover" id="zipcodeError"></div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <!-- City-->
                                        <div class="form-group">
                                            <label for="city">{{ __('City') }}</label>
                                            <input type="text" id="city" name="city" class="form-control mt-2" value="{{ old('city',$customer->city) }}" autocomplete="off" moco-validation>
                                            <div class="moco-error-small danger-darker-hover" id="cityError"></div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <!-- address Country-->
                                        <div class="form-group">
                                            <label for="country">{{ __('Country') }}</label>
                                            <input type="text" id="country" name="country" class="form-control mt-2" value="{{ old('country',$customer->country) }}" autocomplete="off" moco-validation>
                                            <div class="moco-error-small danger-darker-hover" id="countryError"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- email -->
                                <div class="form-group">
                                    <label for="mail">{{ __('Email address') }}</label>
                                    <input type="text" id="mail" name="mail" class="form-control" value="{{ old('mail',$customer->mail) }}" autocomplete="off" moco-validation>
                                    <div class="moco-error-small danger-darker-hover" id="mailError"></div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <!-- phone -->
                                        <div class="form-group">
                                            <label for="phone">{{ __('Phone') }}</label>
                                            <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone',$customer->phone) }}" autocomplete="off" moco-validation>
                                            <div class="moco-error-small danger-darker-hover" id="phoneError"></div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <!-- mobile -->
                                        <div class="form-group">
                                            <label for="mobile">{{ __('Mobile') }}</label>
                                            <input type="text" id="mobile" name="mobile" class="form-control" value="{{ old('mobile',$customer->mobile) }}" autocomplete="off" moco-validation>
                                            <div class="moco-error-small danger-darker-hover" id="mobileError"></div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <!-- vat -->
                                        <div class="form-group">
                                            <label for="vat">{{ __('VAT') }}</label>
                                            <input type="text" id="vat" name="vat" class="form-control" value="{{ old('vat',$customer->vat) }}" autocomplete="off" moco-validation>
                                            <div class="moco-error-small danger-darker-hover" id="vatError"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contacts">
                                @include('customer.customer-contact-form')
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
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
    <script type="text/javascript" src="{{ asset('js/moco.selectpicker.js') }}"></script>

    <script type="text/javascript">
        $(function (){
            //init le champ zipcode
            $('#zipcode').hide();
            /** place l'icon Black Listed à la valeur correct**/
            setBlackListedValue();
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
                _id = $(this).selectpicker().val();
                _array = $(this).selectpicker().data('AjaxBootstrapSelect').options._data;
                if (_array.length > 0 && _id != null) {
                    _obj = _array.find(_obj => _obj.id === parseInt(_id));
                    $('#city').val(_obj.locality);
                    $('#zipcode').val(_obj.zipcode);
                }
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
            });
            /** Black Listed action **/
            $('#black_listed_href').on('click', () => {
                if (parseInt($('#black_listed').val()) == 1){
                    $('#black_listed').val(0);
                } else {
                    $('#black_listed').val(1);
                }
               setBlackListedValue();
            });

            function setBlackListedValue(){
                if (parseInt($('#black_listed').val()) == 1){
                    $('#black_listed_fa').attr('class', 'fas fa-biohazard red-darker-hover');
                } else {
                    $('#black_listed_fa').attr('class', 'fas fa-thumbs-up green-lighter-hover');
                }
                console.log('black'+$('#black_listed').val());
            }
        })


    </script>
@endsection
