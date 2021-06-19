@extends('layouts.layout')

@section('content')
    <div class="container p-5 h-100 moco-layout-height">
        <div class="card mb-3">
            <div class="card-header text-center font-weight-bold">
                <h2 class="blue-grey-darker-hover">{{ __('Providers List') }}</h2>
            </div>
            <div class="card-body" style="font-size: 12px">
                <livewire:provider.provider-list/>
            </div>
        </div>
    </div>
@endsection
