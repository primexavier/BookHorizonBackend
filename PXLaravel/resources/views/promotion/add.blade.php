@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success" onClick="location.href='{{url()->previous()}}'">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                        &nbsp Promotion Create</div>
                <form method="POST" action="{{route('backend.promotion.store')}}">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" placeholder="Promotion Name" name="name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Description">Start</label>
                                    <input type="date" class="form-control" placeholder="Start" name="start">
                                </div>
                            </div>                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Description">End</label>
                                    <input type="date" class="form-control" placeholder="End" name="end">
                                </div>
                            </div>                        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Description">Promotion Type</label>
                                    <select class="form-control" id="promotion_type" name="promotion_type">
                                        <option value="1">Member</option>
                                        <option value="2">Book</option>
                                        <option value="3">Member & Book</option>
                                    </select>
                                </div>
                            </div>                       
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Description">Promotion By</label>
                                    <select class="form-control" id="promotion_by" name="promotion_by">
                                        <option value="1">Percent</option>
                                        <option value="2">Price</option>
                                    </select>
                                </div>
                            </div>                       
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Description">Promotion Total</label>
                                    <input type="number" class="form-control" name="promotion_total">
                                </div>
                            </div>       
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="Description">Book ID</label>
                                    <input type="text" class="form-control" placeholder="Book Id" name="book_id">
                                </div>
                            </div>  
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="Description">Member ID</label>
                                    <input type="text" class="form-control" placeholder="Member ID" name="member_id">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="Description">Description</label>
                                    <textarea name="desc" class="form-control" id="Description" rows="3"></textarea>
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
@endsection

@push('scripts')
<script src="{{ mix('js/app.js') }}"></script>
@endpush
