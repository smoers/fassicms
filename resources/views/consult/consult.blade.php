@extends('layouts.layout')

@section('content')
    <div class="container p-5 h-100 moco-layout-height">
        <a href="{{$return}}" class="btn moco-btn-sm btn-info"><i class="fas fa-arrow-alt-circle-left"></i> {{__('Return')}}</a>
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                {{ $title }}
            </div>
            <div class="card-body">
                {!! $consult !!}
            </div>
        </div>
        <a href="{{$return}}" class="btn moco-btn-sm btn-info"><i class="fas fa-arrow-alt-circle-left"></i> {{__('Return')}}</a>
    </div>
@endsection

