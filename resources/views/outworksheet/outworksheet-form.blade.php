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
                        <h2 class="blue-grey-darker-hover">{{__('Collecting spare parts')}}</h2>
                        <p class="card-text">{{__('Now, you can collect the parts in the bins and scan the barcode available on this bins.')}}</p>
                        <form name="outworksheet-form" id="outworksheet-form" method="post" action="{{route('outworksheet.treatment')}}">
                        @csrf
                            <div class="form-group">
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
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>{{__('Part number')}}</th>
                                <th>{{__('Qty')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($parts as $part)
                                <tr>
                                    <td>
                                        <input type="text" name="part[]">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        @endif
    </div>

@endsection

