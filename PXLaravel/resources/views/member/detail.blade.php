@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success" onClick="location.href='{{url()->previous()}}'">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                        &nbsp Detail Member</div>

                <div class="card-body">
                    @if ($member->photo_id)
                            <div class="single-slide">
                                <img src="/storage/{{$member->photo_id }}" width="150px" alt="">
                            </div>
					@else
						<div class="single-slide">
							<img src="{{ asset('frontend/image/book') }}/empty.jpg" alt="" width="150px">
						</div>
					@endif
                    </br>
                    Member Code : M-{{$member->id}}<br>
                    Member Name : {{$member->last_name}}<br>
                    Phone : {{$member->phone_no}}<br>
                    @if($member->Address()->count() > 0)
                    Address : {{$member->Address[0]->full_address}}<br>
                    @endif
                    Email : {{$member->email}}<br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endpush
