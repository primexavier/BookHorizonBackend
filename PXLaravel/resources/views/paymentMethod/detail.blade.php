@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success" onClick="location.href='{{url()->previous()}}'">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                        &nbsp Payment Method</div>

                <div class="card-body">
                    First Name : {{$member->last_name}}<br>
                    Last Name : {{$member->first_name}}<br>
                    Display Name : {{$member->display_name}}<br>
                    Sharing Profile : {{$member->privacy}}<br>
                    Email : {{$member->email}}<br>
                    Status : {{$member->delete_at}}<br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endpush
