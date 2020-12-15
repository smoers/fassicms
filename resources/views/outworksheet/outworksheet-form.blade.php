@extends('layouts.layout')

@section('content')
    <div class="container p-5 h-100 moco-layout-height">
        @if($step == 10)
            <div class="d-flex justify-content-center">
                <div class="card" style="width: 30rem;">
                    <img class="card-img-top" src="{{asset('images/barcode-scanner.jpg')}}" alt="Card image cap">
                    <div class="card-body">
                        <h2 class="blue-grey-darker-hover">{{__('Out on worksheet')}}</h2>
                        <p class="card-text">{{__('Please scan the barcode available on your worksheet !')}}</p>
                        <form name="outworksheet-form" id="outworksheet-form" method="post" action="{{route('outworksheet.out')}}">
                        @csrf

                        <!-- Name -->
                            <div class="form-group">
                                <input type="text" id="number" name="number" class="form-control" value="{{ old('number') }}">
                                <div class="moco-error-small danger-darker-hover" id="numberError"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $(function () {
                    $('#number').focus();
                });
            </script>
        @elseif($step == 20)
            <div class="d-flex justify-content-center">
                <div class="card" style="width: 30rem;">
                    <img class="card-img-top" src="{{asset('images/barcode-scanner.jpg')}}" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="blue-grey-darker-hover">{{__('Collecting spare parts')}}</h4>
                        <p class="info-lighter-hover" style="font-size: small">{{__('Now, you can collect the parts in the bins and scan the barcode available on this bins.')}}</p>
                        <p class="red-darker-hover">{{__('Worksheet').' : '.$number}}</p>
                        <form name="outworksheet-form" id="outworksheet-form" method="post" action="{{route('outworksheet.treatment')}}">
                        @csrf
                            <div class="form-group">
                                <input name="number" value="{{$number}}" hidden>
                                <textarea id="parts" name="parts" class="form-control" value="{{ old('parts') }}" rows="5"></textarea>
                                <div class="moco-error-small danger-darker-hover" id="numberError"></div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <button type="submit" class="btn btn-primary">{{__('Treatment')}}</button>
                                </div>
                                <div>
                                    <a href="{{ route('dashboard') }}" class="btn btn-primary">{{__('Cancel')}}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $(function () {
                    $('#parts').focus();
                });
            </script>
        @elseif($step == 30)
            <div class="card">
                <div class="card-header text-center font-weight-bold">
                    <h2 class="blue-grey-darker-hover">{{ __('Out of stock validation') }}</h2>
                </div>
                <div class="card-body">
                    <form name="part-form" id="part-form" method="post" action="{{route('outworksheet.validation')}}" moco-validation-table>
                        @csrf
                        <div class="moco-table-wrapper-scroll-y moco-scrollbar">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>{{__('Part number')}}</th>
                                    <th>{{__('Quantity')}}</th>
                                    <th>{{__('Qty available')}}</th>
                                    <th class="text-center"><i class="fa fa-trash-alt" style="color: red !important;"></i></th>
                                </tr>
                                </thead>
                                <tbody>
                                @var $index = 0
                                @foreach($parts as $part)
                                    <tr id="row{{$index}}">
                                        <td>
                                            <input type="text" id="part_number{{$index}}"  name="part_number[]" class="form-control" value="{{old('part_number.'.$index,$part['part']->part_number)}}" moco-validation-table>
                                            <div class="moco-error-small danger-darker-hover" id="part_number{{$index}}Error"></div>
                                        </td>
                                        <td>
                                            <input type="number" id="qty{{$index}}" name="qty[]" class="form-control @if(!$part['enough']) is-invalid @endif " value="{{old('qty.'.$index,$part['part']->qty)}}" moco-validation-table>
                                            <div class="moco-error-small danger-darker-hover" id="qty{{$index}}Error"></div>
                                        </td>
                                        <td>
                                            <div class="warning-darker-hover text-center" style="font-weight: bold">{{$part['qty_before']}}</div>
                                        </td>
                                        <td>
                                            <div class="text-center"><a href="#" onclick="_delete({{$index}})"><i class="fa fa-trash-alt" style="color: red !important;"></i></a></div>
                                        </td>
                                    </tr>
                                    @var $index++
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <button type="submit" class="btn btn-primary">{{__('Validate')}}</button>
                            </div>
                            <div>
                                <a href="{{ route('dashboard') }}" class="btn btn-primary">{{__('Cancel')}}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <script type="text/javascript">
                /**
                 * Supprime une ligne du formulaire
                 * place les éléments 'input' en disabled pour ne pas les avoir dans le POST du formulaire
                 * @param index
                 * @private
                 */
                function _delete(index) {
                    $('#row' + index).hide();
                    $('#part_number' + index).attr('disabled', 'disabled')
                    $('#qty' + index).attr('disabled', 'disabled');
                }
            </script>
            <script type="text/javascript" src="{{ asset('js/moco.ajax.validation.js') }}"></script>
        @endif
    </div>

@endsection

