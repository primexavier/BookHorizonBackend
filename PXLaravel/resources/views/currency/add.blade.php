@extends('backend.layouts.app')

@push('scripts')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success" onClick="location.href='{{url()->previous()}}'">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                        &nbsp Currency Create</div>
                <form method="POST" action="{{route('backend.currency.store')}}">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">       
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Logo</label>
                                            <input type="file" class="form-control-file" accept="image/x-png,image/gif,image/jpeg" name="logo">
                                        </div>    
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" placeholder="Currency" name="name">
                                        </div>              
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="rate">Rate</label>
                                            <input type="number" class="form-control" placeholder="rate" name="rate">
                                        </div>                         
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="CodeCurrency">Code Currency</label>
                                            <input type="text" class="form-control" placeholder="Publication City" name="code_currency">
                                        </div>
                                    </div>    
                                    <div class="col-md-12"> 
                                        <div class="form-group">
                                            <label for="Description">Description</label>
                                            <textarea name="desc" class="form-control" id="Description" rows="3"></textarea>
                                        </div>
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
@endsection

@push('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endpush