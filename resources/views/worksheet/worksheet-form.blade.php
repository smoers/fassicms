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
                    <div class="row">
                        <div class="col-4">

                            <!-- Date -->
                            <div class="form-group">
                                <label for="date">{{__('Date')}}</label>
                                <div class="input-group mb-3">
                                    <input type="text" id="date" name="date" class="form-control" placeholder="{{__('DD/MM/YYYY')}}" aria-label="date" aria-describedby="basic-addon1" value="{{ old('date', $worksheet->date) }}" moco-validation />
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar-alt"></i></span>
                                    </div>
                                </div>
                                <div class="moco-error-small danger-darker-hover" id="dateError"></div>
                            </div>
                        </div>
                        <div class="col-4">

                            <!-- Number -->
                            <div class="form-group">
                                <label for="number">{{__('Number')}}</label>
                                <input type="text" id="number" name="number" class="form-control" readonly value="{{ old('number', $worksheet->number) }}" moco-validation />
                            </div>
                        </div>
                    </div>

                    <!-- Tabs -->
                    <div>
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a href="#general" class="nav-link active" data-toggle="tab">{{__('General data')}}</a>
                            </li>
                            <li class="nav-item">
                                <a href="#data" class="nav-link" data-toggle="tab">{{__('Data')}}</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="general">

                                <div class="row">

                                    <!-- Crane selector -->
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="crane_id">{{__('Crane')}} <a href="#" id="add_crane"><i class="fas fa-truck-moving" style="color: red !important;"></i></a> </label>
                                            <select id="_crane" class="selectpicker with-ajax form-control" data-live-search="true" data-abs-lang-code="fr"></select>
                                            <input type="hidden" id="crane_id" name="crane_id"  value="{{ old('crane_id',$worksheet->crane()->get('id')) }}" moco-validation>
                                            <div class="moco-error-small danger-darker-hover" id="zipcodeError"></div>
                                        </div>
                                    </div>

                                    <!-- Customer selector -->
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label for="customer_id">{{__('Customer')}} <a href="#" id="add_customer"><i class="fas fa-address-card" style="color: red !important;"></i></a> </label>
                                            <select id="_customer" class="selectpicker with-ajax form-control" data-live-search="true" data-abs-lang-code="fr"></select>
                                            <input type="hidden" id="customer_id" name="customer_id"  value="{{ old('customer_id',$worksheet->customer()->get('id')) }}" moco-validation>
                                            <div class="moco-error-small danger-darker-hover" id="zipcodeError"></div>
                                        </div>

                                    </div>

                                </div>
                                <div class="row">

                                    <!-- Serial -->
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="serial">{{__('Serial number')}}</label>
                                            <input type="text" id="serial" name="serial" class="form-control" readonly value="{{old('serial')}}">
                                        </div>
                                    </div>

                                    <!-- Name -->
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label for="name">{{__('Company name')}}</label>
                                            <input type="text" id="name" name="name" class="form-control" readonly value="{{old('name')}}">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">

                                    <!-- Model -->
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="model">{{__('Model')}}</label>
                                            <input type="text" id="model" name="model" class="form-control" readonly value="{{old('model')}}">
                                        </div>
                                    </div>

                                    <!-- Address -->
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label for="address">{{__('Address')}}</label>
                                            <input type="text" id="address" name="address" class="form-control" readonly value="{{old('address')}}">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">

                                    <!-- Plate -->
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="plate">{{__('Numberplate')}}</label>
                                            <input type="text" id="plate" name="plate" class="form-control" readonly value="{{old('plate')}}">
                                        </div>
                                    </div>

                                    <!-- Phone -->
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label for="phone">{{__('Phone')}}</label>
                                            <input type="text" id="phone" name="phone" class="form-control" readonly value="{{old('phone')}}">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <!-- Nothing -->
                                    <div class="col-4">

                                    </div>

                                    <!-- Email -->
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label for="email">{{__('Email address')}}</label>
                                            <input type="text" id="email" name="email" class="form-control" readonly value="{{old('email')}}">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <!-- Nothing -->
                                    <div class="col-4">

                                    </div>

                                    <!-- VAT -->
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label for="vat">{{__('VAT')}}</label>
                                            <input type="text" id="vat" name="vat" class="form-control" readonly value="{{old('vat')}}">
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="tab-pane fade" id="data">

                                <!-- Remarks -->
                                <div class="form-group">
                                    <label for="remarks">{{__('Customer remarks')}}</label>
                                    <textarea id="remarks" name="remarks" rows="5" autocomplete="off" class="form-control">{{ old('remarks', $worksheet->remarks) }}</textarea>
                                </div>

                                <!-- Work -->
                                <div class="form-group">
                                    <label for="work">{{__('Work done')}}</label>
                                    <textarea id="work" name="work" rows="5" autocomplete="off" class="form-control">{{ old('work', $worksheet->work) }}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-4">

                                        <!-- Oil replace -->
                                        <div class="form-group">
                                            <label for="oil_replace">{{__('Oil replaced (liter)')}}</label>
                                            <input type="text" id="oil_replace" name="oil_replace" class="form-control mt-2" value="{{ old('oil_replace', $worksheet->oil_replace) }}" moco-validation >
                                            <div class="moco-error-small danger-darker-hover" id="oil_replaceError"></div>
                                        </div>
                                    </div>
                                    <div class="col-2">

                                        <!-- Oil filtered -->
                                        <div class="form-group">
                                            <label for="oil_filtered">{{ __('Oil filtered')  }}</label>
                                            <select id="oil_filtered" name="oil_filtered" class="selectpicker form-control" data-width="fit" moco-validation>
                                                <option value="1"
                                                        @if(old('enabled',$worksheet->oil_filtered) == 1) selected @endif>{{__('Yes')}}</option>
                                                <option value="0"
                                                        @if(old('enabled',$worksheet->oil_filtered) == 0) selected @endif>{{__('No')}}</option>
                                            </select>
                                            <div class="moco-error-small danger-darker-hover" id="oil_filteredError"></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('3rd/bootstrap-datepicker-1.9.0-dist/locales/bootstrap-datepicker.fr.min.js')}}"></script>
    <script src="{{ asset('3rd/bootstrap-datepicker-1.9.0-dist/locales/bootstrap-datepicker.nl-BE.min.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $('#date').datepicker({
                format: 'dd/mm/yyyy',
                orientation: 'bottom auto',
                language: 'fr',
                todayBtn: "linked",
                autoclose: true,
            });
        })
    </script>
@endsection

