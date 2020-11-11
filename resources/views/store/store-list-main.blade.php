@extends('layouts.layout')

@section('content')

    <div class="container-fluid p-2 h-100 fassi-layout-height">
        <div class="container-fluid text-center mb-3">
            <div class="fassi-title">{{ __('Parts List') }}</div>
        </div>
        <livewire:store-list-head/>
        <livewire:store-list/>
    </div>

@endsection
