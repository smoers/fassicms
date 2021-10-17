@extends('widgets.template')
@section('body')
<div class="d-flex flex-sm-row">
    <div class="d-flex flex-sm-column mr-2">
        <img src="{{asset('images/stock-48.png')}}">
    </div>
    <div class="d-flex flex-sm-column">
        <div>{{__('Spares to restock')}}: {{$config['count']}}</div>
        <a href="{{$config['report']}}" class="btn btn-success moco-btn-sm">{{__('Show report')}}</a>
    </div>
</div>
@endsection
