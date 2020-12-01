@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success" onClick="location.href='{{url()->previous()}}'">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                        &nbsp Supplier Index</div>
                <div class="card-body">                
                    <form method="POST" action="{{route('backend.supplier.update')}}">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">       
                                            <div class="form-group">
                                                <label for="exampleFormControlFile1">Photo</label>
                                                <input type="file" class="form-control-file" accept="image/x-png,image/gif,image/jpeg" name="photo">
                                            </div>    
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input type="text" class="form-control" placeholder="Book Email" name="title">
                                            </div>              
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="isbn">ISBN</label>
                                                <input type="text" class="form-control" placeholder="isbn" name="isbn">
                                            </div>
                                            <div class="form-group">
                                                <label for="product_code">Product Code</label>
                                                <input type="text" class="form-control" placeholder="Product Code" name="pcode">
                                            </div>
                                            <div class="form-group">
                                                <label for="isbn">Pages</label>
                                                <input type="text" class="form-control" placeholder="Pages" name="pages">
                                            </div>
                                            <div class="form-group">
                                                <label for="isbn">Dimension</label>
                                                <input type="text" class="form-control" placeholder="Dimension" name="dimension">
                                            </div>
                                            <div class="form-group">
                                                <label for="isbn">Weight</label>
                                                <input type="text" class="form-control" placeholder="Weight" name="weight">
                                            </div>
                                            <div class="form-group">
                                                <label for="isbn">Vendor</label>
                                                <input type="text" class="form-control" placeholder="Vendor" name="vendor">
                                            </div>                            
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="publication City">Publication City</label>
                                                <input type="text" class="form-control" placeholder="Publication City" name="pcity">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Format</label>
                                                <input type="text" class="form-control" placeholder="Format" name="format">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Purchase Price</label>
                                                <input type="text" class="form-control" placeholder="Purchase Price" name="pprice">
                                            </div>    
                                            <div class="form-group">
                                                <label for="">Start Qty</label>
                                                <input type="number" class="form-control" placeholder="Start Qty" name="qty">
                                            </div>       
                                            <div class="form-group">
                                                <label for="">Price</label>
                                                <input type="text" class="form-control" placeholder="Price" name="price">
                                            </div>       
                                            <div class="form-group">
                                                <label for="">Purchase Date</label>
                                                <input type="date" class="form-control" placeholder="Purchase Date" name="pdate">
                                            </div>        
                                        </div>
                                        <div class="col-md-12">        
                                            <div class="form-group">
                                                <label for="title">Description</label>
                                                <input type="text" class="form-control" placeholder="Book Email" name="desc">
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
</div>
@endsection

@push('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endpush