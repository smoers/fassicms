@extends('layouts.layout')

@section('content')

    <div class="container-fluid p-2 h-100 moco-layout-height">
        <div class="container-fluid text-center mb-3">
            <div class="moco-title brown-lighter-hover">{{ __('Customers') }}</div>
        </div>
        <livewire:customer.customer-list/>
    </div>

@endsection
