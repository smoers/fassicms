
<div class="d-flex flex-sm-row">
    <div class="d-flex flex-sm-column mr-2">
        <img src="{{asset('images/stock-48.png')}}">
    </div>
    <div class="d-flex flex-sm-column">
        <div style="font-size: 12px">{{__('Spares to restock')}}: {{$config['count']}}</div>
        <a href="{{route('reporting.from',3)}}" class="btn btn-success moco-btn-sm">{{__('Show report')}}</a>
    </div>
</div>
