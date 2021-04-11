@extends('layouts.layout')

@section('content')
    <div class="container p-5 h-100 moco-layout-height" style="min-width: 50vw">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2 class="blue-grey-darker-hover">{{__('Parts list')}}</h2>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <div class="d-flex flex-row">
                        <div class="mr-2">{{_('Date')}} :</div>
                        <div class="mr-2">{{$worksheet->date}}</div>
                    </div>
                    <div class="d-flex flex-row">
                        <div class="mr-2">{{_('Number')}} :</div>
                        <div class="mr-2 moco-color-error">{{$worksheet->number}}</div>
                    </div>
                    <div class="d-flex flex-row">
                        <div class="mr-2">{{_('Total')}} :</div>
                        <div class="mr-2 moco-color-error" style="font-weight: bold">{{number_format(intval($_total['O'])+intval($_total['R']),2,',','.')}}</div>
                    </div>
                </div>
                <ul class="nav nav-tabs nav-fill mb-3" >
                    <li class="nav-item" >
                        <a href="#out" class="nav-link active" data-toggle="tab">{{__('Parts Out')}}</a>
                    </li>
                    <li class="nav-item">
                        <a href="#in" class="nav-link" data-toggle="tab">{{__('Parts Return')}}</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <!-- TAB OUT-->
                    <div class="tab-pane fade show active" id="out">
                        <table class="table table-sm table-striped table-bordered mt-2">
                            <thead class="moco-title-table">
                            <tr>
                                <th class="moco-row-table-font-small">{{ __('Part Number') }}</th>
                                <th class="moco-row-table-font-small">{{ __('Description') }}</th>
                                <th class="moco-row-table-font-small">{{ __('Quantity') }}</th>
                                <th class="moco-row-table-font-small">{{ __('Unit Price') }}</th>
                                <th class="moco-row-table-font-small">{{ __('Total Price') }}</th>
                                <th class="moco-row-table-font-small">{{ __('Year') }}</th>
                                <th class="moco-row-table-font-small">{{ __('Date') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($_outs as $_out)
                                <tr>
                                    <td class="moco-row-table-font-small">{{$_out->part_number}}</td>
                                    <td class="moco-row-table-font-small">{{$_out->description}}</td>
                                    <td class="moco-row-table-font-small text-right">{{$_out->qty_signed}}</td>
                                    <td class="moco-row-table-font-small text-right">{{$_out->unit_price_signed}}</td>
                                    <td class="moco-row-table-font-small text-right">{{$_out->total_price_signed}}</td>
                                    <td class="moco-row-table-font-small text-right">{{$_out->year}}</td>
                                    <td class="moco-row-table-font-small text-right">{{$_out->updated_at}}</td>
                                </tr>
                            @endforeach
                                <tr>
                                    <td colspan="4" class="moco-row-table-font-small text-right moco-color-error" style="font-weight: bold">Total :</td>
                                    <td class="moco-row-table-font-small text-right moco-color-error" style="font-weight: bold">{{number_format(intval($_total['O']),2,',','.')}}</td>
                                    <td colspan="2"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade show" id="in">
                        <table class="table table-sm table-striped table-bordered table-dark mt-2">
                            <thead class="moco-title-table">
                            <tr>
                                <th class="moco-row-table-font-small">{{ __('Part Number') }}</th>
                                <th class="moco-row-table-font-small">{{ __('Description') }}</th>
                                <th class="moco-row-table-font-small">{{ __('Quantity') }}</th>
                                <th class="moco-row-table-font-small">{{ __('Unit Price') }}</th>
                                <th class="moco-row-table-font-small">{{ __('Total Price') }}</th>
                                <th class="moco-row-table-font-small">{{ __('Year') }}</th>
                                <th class="moco-row-table-font-small">{{ __('Date') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($_reassorts as $_reassort)
                                <tr>
                                    <td class="moco-row-table-font-small">{{$_reassort->part_number}}</td>
                                    <td class="moco-row-table-font-small">{{$_reassort->description}}</td>
                                    <td class="moco-row-table-font-small text-right">{{$_reassort->qty_signed}}</td>
                                    <td class="moco-row-table-font-small text-right">{{$_reassort->unit_price_signed}}</td>
                                    <td class="moco-row-table-font-small text-right">{{$_reassort->total_price_signed}}</td>
                                    <td class="moco-row-table-font-small text-right">{{$_reassort->year}}</td>
                                    <td class="moco-row-table-font-small text-right">{{$_reassort->updated_at}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" class="moco-row-table-font-small text-right moco-color-error" style="font-weight: bold">Total :</td>
                                <td class="moco-row-table-font-small text-right moco-color-error" style="font-weight: bold">{{number_format(intval($_total['R']),2,',','.')}}</td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
