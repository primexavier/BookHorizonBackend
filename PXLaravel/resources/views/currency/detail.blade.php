@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success" onClick="location.href='{{url()->previous()}}'">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                        &nbsp Currency Detail</div>
                <div class="card-body">
                    @if ($currency->logo)
						<div class="single-slide">
							<img src="{{ asset('frontend/image/book') }}/{{$currency->photo}}" width="150px" alt="">
						</div>
					@else
						<div class="single-slide">
							<img src="{{ asset('frontend/image/book') }}/empty.jpg" alt="" width="150px">
						</div>
					@endif
                    </br>
                    Name : {{$currency->name}} </br>
                    Code Currency : {{$currency->code_currency}} </br>
                    Rate : {{$currency->rate}} </br>
                    Description : {{$currency->desc}} </br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endpush