@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success" onClick="location.href='{{url()->previous()}}'">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                        &nbsp Blog Detail</div>

                <div class="card-body">
                    @if ($blog->photo)
						<div class="single-slide">
							<img src="{{ asset('frontend/image/blog') }}/{{$blog->photo}}" width="450px" alt="">
						</div>
					@else
						<div class="single-slide">
							<img src="{{ asset('frontend/image/blog') }}/empty.jpg" alt="" width="450px">
						</div>
					@endif
                    </br>
                    title : {{$blog->title}}
                    </br>
                    Content : {{$blog->content}} 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endpush
