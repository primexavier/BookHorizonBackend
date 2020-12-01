@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success" onClick="location.href='{{url()->previous()}}'">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                        &nbsp Membership Detail</div>
                <div class="card-body">
                    Name : {{$membership->name}} </br>
                    Price : {{$membership->price}} </br>
                    Duration : {{$membership->duration}} </br>
                    Description : {{$membership->description}} </br>
                    Buy Discount : {{$membership->buy_discount}} </br>
                    Rent Discount : {{$membership->rent_discount}} </br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endpush