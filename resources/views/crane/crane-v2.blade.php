@extends('layouts.layout')

@section('content')
    <div class="container p-5 h-100 moco-layout-height">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2 class="blue-grey-darker-hover">{{ $title }}</h2>
            </div>
            <div class="card-body">
                @if(isset($serial))
                    <livewire:crane.crane-livewire :serial="$serial"/>
                @else
                    <livewire:crane.crane-livewire/>
                @endif
            </div>
        </div>
    </div>
@endsection
