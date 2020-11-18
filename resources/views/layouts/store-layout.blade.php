@extends('layouts.layout')

@section('content')
    <div class="{{ $options->getContainer() }} p-2 h-100 moco-layout-height">
        @if($options->getName() == 'form01')
            <livewire:store.store-part-form />
        @elseif($options->getName() == 'list01')
            <div class="container-fluid text-center mb-3">
                <div class="moco-title brown-lighter-hover">{{ __('Parts List') }}</div>
            </div>
            <livewire:store-list-head/>
            <livewire:store-list/>
        @endif
    </div>
@endsection
