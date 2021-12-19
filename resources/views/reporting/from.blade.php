@extends('layouts.layout')

@section('content')
    <div class="container-fluid p-2 h-100 moco-layout-height">
        <div class="container-fluid text-center mb-3">
            <div class="container-fluid text-center mb-3">
                <div class="moco-title brown-lighter-hover">{{$title}}</div>
            </div>
            @livewire($livewire,['renderViewPath' => $livewire])
        </div>
    </div>
@endsection
