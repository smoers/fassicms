@extends('layouts.layout')

@section('content')
    <div class="container p-5 h-100 moco-layout-height" style="min-width: 50vw">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2 class="blue-grey-darker-hover">{{ $title }}</h2>
            </div>
            <div class="card-body">
                <div class="d-flex flex-row justify-content-around">
                    <div class="d-flex flex-column p-1">
                        <div>{{ __('Year of reference')  }}</div>
                        <div>
                            <input type="text" id="ref_year" name="ref year" class="form-control form-control-sm moco" readonly="readonly" value="{{$ref_year->year}}"/>
                        </div>
                    </div>
                    <div class="d-flex flex-column p-1">
                        <div>{{ __('Year')  }}</div>
                        <div>
                            <select id="year" name="year" class="form-control form-control-sm" title="{{__('Year')}}" >
                                @foreach($years as $year)
                                    <option value="{{$year}}" @if($loop->first) selected @endif>{{$year}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="d-flex flex-column p-1">
                        <div class="moco-font-important">{{__('Global increase percentage')}}</div>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">%</span>
                            </div>
                            <input type="text" id="pourcentage" name="pourcentage" class="form-control" placeholder="{{__('Example')}} : 2,5" aria-label="pourcentage" aria-describedby="basic-addon1"/>
                        </div>
                    </div>
                    <div class="d-flex flex-column p-1">
                        <a href="#" class="btn btn-danger" id="run"><i class="fas fa-running"></i> {{__('Execute')}}</a>
                    </div>
                </div>
                <div class="d-flex flex-row">
                    <div class="d-inline-flex p-3">
                        <table class="table table-info">
                            <thead>
                                <tr>
                                    <th>{{__('Year')}}</th>
                                    <th class="">{{__('Total parts')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($totals as $total)
                                    <tr>
                                        <td>{{$total->year}}</td>
                                        <td>{{$total->total}}</td>
                                    </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="wait p-3">
                        {{__('Please wait ...')}}
                    </div>
                    <div class="result d-flex flex-column p-3">
                        <div class="result moco-font-important moco-color-warning" id="msg_success">
                            %count% {{new \Illuminate\Support\HtmlString(__('recordings were created in a temporary file.</br>You must validate in order to load them permanently in the catalog.</br>Using the search area, you can control before validating.'))}}
                        </div>
                        <div class="result input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"> {{__('Part Number')}}</i> </span>
                            </div>
                            <input type="text" id="search" name="search" class="form-control" aria-describedby="basic-addon1"/>
                        </div>
                    </div>
                </div>
                <script>
                $(function () {
                    $(document).ready(function () {
                        /** Ajax set up **/
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: "POST",
                            dataType: "json",
                            async: true,
                        });
                        /** url pour les requêtes Ajax **/
                        var _url_ajax_newyear = '{{route('system.ajaxnewyear')}}'
                        /** please wait init **/
                        $('.wait').hide();
                        $('.result').hide()
                        /** event sur le bouton executer**/
                        $('#run').on('click', () => {
                            /** Affiche le please wait **/
                            $('.wait').show();
                            /** Les données pour la requète ajax **/
                            let data = {
                                ref_year: $('#ref_year').val(),
                                year: $('#year').val(),
                                pourcentage: $('#pourcentage').val() === '' ? 0 : $('#pourcentage').val(),
                            };
                            /** Requète ajax **/
                            request(data,_url_ajax_newyear).then((result) => {
                                /** cache le please wait **/
                                $('.wait').hide();
                                $('#msg_success').html($('#msg_success').html().replace('%count%', result.count));
                                $('.result').show()
                                console.log(result);
                            });

                        });
                    });
                });
                </script>
            </div>
        </div>
    </div>
@endsection
