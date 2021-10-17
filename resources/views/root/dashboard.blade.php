@extends('layouts.layout')

@section('content')
    <div class="container p-5 h-100 moco-layout-height">
        <div class="d-flex flex-wrap">
            @asyncWidget('VersionInfo')
            @if($asReassort && auth()->user()->can('show reassort list'))
                @asyncWidget('StockInfo')
            @endif
        </div>
    </div>

@endsection
