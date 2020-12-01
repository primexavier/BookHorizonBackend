@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success" onClick="location.href='{{url()->previous()}}'">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                        &nbsp Member Edit</div>
                <div class="card-body">
                    <form method="POST" action="{{route('backend.member.update', $member->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">       
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">Upload ID</label><br>
                                        @if ($member->photo_id)
                                            <img id="imageShow" src="/storage/{{$member->photo_id}}" alt="your image" width="200px" height="250px" >
                                        @else
                                            <img id="imageShow" src="{{ asset('frontend/image/book') }}/empty.jpg" alt="your image" width="200px" height="250px" >
                                        @endif							
                                        
                                        <br>		
                                        
                                        <br>
                                        <input onchange="readURL(this)" type="file" class="form-control-file" accept="image/x-png,image/gif,image/jpeg" name="photoId">
                                    </div>          
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">First Name</label>
                                        <input type="text" class="form-control" name="first_name" value="{{$member->first_name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Display Name</label>
                                        <input type="text" class="form-control" name="display_name" value="{{$member->display_name}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Last Name</label>
                                        <input type="text" class="form-control" name="last_name" value="{{$member->last_name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Phone Number</label>
                                        <input type="text" class="form-control" name="phone_no" value="{{$member->phone_no}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" name="email" value="{{$member->email}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Full Address</label>
                                        @if(count($member->address) > 0)
                                            <textarea type="text" class="form-control" name="address">{{$member->address[0]->full_address}}</textarea>
                                        @else
                                            <textarea type="text" class="form-control" name="address"></textarea>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" name="privacy" id="privacy">
                                            <label class="form-check-label" for="privacy">
                                                Sharing Profile
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
            $('#imageShow').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
        }
    </script>
@endpush