@extends('layouts.layout')

@section('content')

    <div class="container p-5 h-100 fassi-layout-height">
        <div>
            <x-table>
                <x-slot name="head">
                    <x-table.header></x-table.header>
                </x-slot>
                <x-slot name="body">
                    
                </x-slot>
            </x-table>
        </div>
    </div>

@endsection
