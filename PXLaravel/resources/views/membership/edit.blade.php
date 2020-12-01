@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success" onClick="location.href='{{url()->previous()}}'">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                        &nbsp Membership Index</div>
                <div class="card-body">                
                    <form method="POST" action="{{route('backend.membership.update',$membership->id)}}">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" placeholder="Name" name="name" value="{{$membership->name}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Description">Duration (day)</label>
                                        <input type="number" class="form-control" placeholder="Duration" name="duration" value="{{$membership->duration}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Description">Price</label>
                                        <input type="number" class="form-control" placeholder="Price" name="price" value="{{$membership->price}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Description">Duration (day)</label>
                                        <input type="number" class="form-control" placeholder="Duration" name="duration" value="{{$membership->duration}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Description">Discount Buy</label>
                                        <input type="number" class="form-control" placeholder="Duration" name="buy_discount" value="{{$membership->buy_discount}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Description">Discount Rent</label>
                                        <input type="number" class="form-control" placeholder="Duration" name="rent_discount" value="{{$membership->rent_discount}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="Description">Description</label>
                                        <textarea name="desc" class="form-control" id="Description" rows="3"> {{$membership->description}}</textarea>
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
@endpush