@extends('layouts.layout')

@section('content')
    <div class="container p-5 h-100 moco-layout-height">
    @if($asReassort && auth()->user()->can('show reassort list'))
        @include('store.reassort-level-list')
            <div class="card">
                <div class="card-body">
            <div class="d-flex justify-content-between">
                <p>Fassi Belgium - Store Management System</p>
                <p>{{ config('moco.app.version') }}</p>
            </div>
                </div>
            </div>
    @else
            <div class="jumbotron">
                <p class="display-4">
                    Fassi Store Management System
                </p>
                <p>{!!config('moco.app.version')!!}</p>
                <p class="text text-info" style="font-style: italic;font-weight: bold;font-size: 10px">Release note :</p>
                <p class="text text-info" style="font-style: italic; font-size: 10px">{!!config('moco.app.release')!!}</p>
            </div>
    @endif
    </div>

@endsection
