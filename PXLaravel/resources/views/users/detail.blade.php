<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-success" onClick="location.href='{{url()->previous()}}'">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                            &nbsp Users Detail</div>
    
                    <div class="card-body">
                        Name  : {{$users->name}} </br>
                        Email : {{$users->email}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@extends('layouts.app')

@push('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endpush