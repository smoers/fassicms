@extends('layouts.layout')

@section('content')

    <div class="container-fluid p-2 h-100 moco-layout-height">
        <div class="container-fluid text-center mb-3">
            <div class="moco-title brown-lighter-hover">{{ __('Worksheet') }}</div>
        </div>
        <livewire:worksheet.worksheet-list-head/>
        <livewire:worksheet.worksheet-list/>
    </div>

@endsection
