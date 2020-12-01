@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success" onClick="location.href='{{url()->previous()}}'">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                        &nbsp Bank Detail</div>
                <div class="card-body">
                    @if ($bank->logo)
						<div class="single-slide">
							<img src="{{ asset('frontend/image/book') }}/{{$bank->logo}}" width="150px" alt="">
						</div>
					@else
						<div class="single-slide">
							<img src="{{ asset('frontend/image/book') }}/empty.jpg" alt="" width="150px">
						</div>
					@endif
                    </br>
                    Name : {{$bank->name}} </br>
                    Account : {{$bank->account}} </br>
                    Desciprtion : {{$bank->description}} </br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endpush