@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success" onClick="location.href='{{url()->previous()}}'">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                        &nbsp Promotion Detail</div>
                <div class="card-body">
                    Name : {{$promotion->name}} </br>
                    Start : {{$promotion->start}} </br>
                    End : {{$promotion->end}} </br>
                    Total : {{$promotion->total}} </br>
                    is Percent : {{$promotion->is_percent}} </br>
                    Description : {{$promotion->description}} </br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endpush