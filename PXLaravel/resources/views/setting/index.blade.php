@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success" onClick="location.href='{{url()->previous()}}'">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                        &nbsp Setting Index</div>
                <div class="card-body">
                <form method="POST" action="{{route('backend.setting.update')}}">
                    @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="checkbox" name="mtmode" id="mtmode">
                                        <label class="form-check-label" for="mtmode" >Maintenance Mode</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" value="{{$setting->name}}" class="form-control" placeholder="Name" name="name">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="Phone">Phone</label>
                                        <input type="text" value="{{$setting->phone}}" class="form-control" placeholder="+62812345789" name="phone">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email">email</label>
                                        <input type="email" class="form-control" placeholder="email@domain.com" name="email" value="{{$setting->email}}" >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea name="address"  class="form-control" id="Description" rows="3" placeholder="Example Street 98, HH2 BacHa, New York, USA"> {{$setting->address}} </textarea>
                                    </div>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="Description">Late Charge</label>
                                    <input type="number" class="form-control" placeholder="Late Charge" name="late_charge">
                                </div> --}}


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