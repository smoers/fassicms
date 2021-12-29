@extends('layouts.layout')

@section('content')
    <div class="container-fluid p-2 h-100 moco-layout-height">
        <div class="container-fluid text-center mb-3">
            @livewire($livewire,['renderViewPath' => $livewire,'title' => $title])
        </div>
    </div>
@endsection
