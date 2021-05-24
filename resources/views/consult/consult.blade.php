@extends('layouts.layout')

@section('content')
    <div class="container p-5 h-100 moco-layout-height">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                {{ $title }}
            </div>
            <div class="card-body">
                {!! $consult !!}
            </div>
        </div>
    </div>
@endsection

