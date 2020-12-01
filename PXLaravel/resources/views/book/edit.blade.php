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
                        &nbsp Book Create
                    </div>
                <form method="POST" action="{{route('backend.book.update', $book->id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">         
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Photo</label><br>                                            
                                            @if ($book->bookimage())
                                                <img id="imageShow" src="/storage/{{$book->bookimage()->image()->url}}" alt="your image" width="200px" height="250px" >
                                            @else
                                                <img id="imageShow" src="{{ asset('frontend/image/book') }}/empty.jpg" alt="your image" width="200px" height="250px" >
                                            @endif
                                            	<br><br>											
                                            <input onchange="readURL(this)" type="file" class="form-control-file" accept="image/x-png,image/gif,image/jpeg" name="photo">
                                        </div>             
                                        <div class="form-check">
                                            <input @if($book->is_sold) checked @endif type="checkbox" class="form-check-input" id="is_sell" name="is_sell">
                                            <label class="form-check-label" for="is_sell">Is Book is for Sell?</label>
                                        </div>  
                                    </br>
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" placeholder="Book Title" name="title" value="{{$book->title}}">
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="isbn">ISBN</label>
                                            <input type="text" class="form-control" placeholder="isbn" name="isbn" value="{{$book->isbn}}">
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="product_code">Product Code</label>
                                            <input type="text" class="form-control" placeholder="Product Code" name="pcode" value="{{$book->pcode}}">
                                        </div> --}}
                                        <div class="form-group">
                                            <label for="isbn">Pages</label>
                                            <input type="text" class="form-control" placeholder="Pages" name="pages" value="{{$book->pages}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="isbn">Dimension</label>
                                            <input type="text" class="form-control" placeholder="Dimension" name="dimension" value="{{$book->dimension}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="isbn">Weight</label>
                                            <input type="text" class="form-control" placeholder="Weight" name="weight" value="{{$book->weight}}"> 
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="isbn">Vendor</label>
                                            <input type="text" class="form-control" placeholder="Vendor" name="vendor" value="{{$book->vendor}}">
                                        </div>                             --}}
                                        <div class="form-group">
                                            <label for="publication City">Publication City</label>
                                            <input type="text" class="form-control" placeholder="Publication City" name="pcity" value="{{$book->publication_city}}"> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Format</label>
                                            <input type="text" class="form-control" placeholder="Format" name="format" value="{{$book->format}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Purchase Price</label>
                                            <input type="text" class="form-control" placeholder="Purchase Price" name="pprice" value="{{$book->purchase_price}}">
                                        </div>    
                                        <div class="form-group">
                                            <label for="">Start Qty</label>
                                            <input type="number" class="form-control" placeholder="Start Qty" name="qty" value="{{$book->start_qty}}">
                                        </div>       
                                        <div class="form-group">
                                            <label for="">Price</label>
                                            <input type="text" class="form-control" placeholder="Price" name="price" value="{{$book->price}}">
                                        </div>       
                                        <div class="form-group">
                                            <label for="">Purchase Date</label>
                                            <input type="date" class="form-control" placeholder="Purchase Date" name="pdate" value="{{$book->pdate}}">
                                        </div>        
                                    </div>
                                    <div class="col-md-12">        
                                        <div class="form-group">
                                            <label for="title">Authors</label>
                                            <input type="text" class="form-control" placeholder="Authors Name" name="authorId" value="{{$book->author()}}">
                                            <!-- <select  class="form-control"  name="authorId" class="selectpicker" data-live-search="true">
                                                @foreach($authors as $author)
                                                    <option value="{{$author->id}}" data-tokens="ketchup mustard">{{$author->name}}</option>
                                                @endforeach
                                            </select>                                         -->
                                        </div>              
                                    </div>     
                                    <div class="col-md-12">        
                                        <div class="form-group">
                                            <label for="title">Publishers</label>
                                            <input type="text" class="form-control" placeholder="Publisher Name" name="publisherId" value="{{$book->publisher()}}">
                                            <!-- <select  class="form-control"  name="publisherId" class="selectpicker" data-live-search="true">
                                                @foreach($publishers as $publisher)
                                                    <option value="{{$publisher->id}}" data-tokens="ketchup mustard">{{$publisher->name}}</option>
                                                @endforeach
                                            </select>                                         -->
                                        </div>              
                                    </div>                                         
                                    <div class="col-md-12">        
                                        <div class="form-group">
                                            <label for="title">Supplier</label>
                                            <!-- <input type="text" class="form-control" placeholder="Supplier Name" name="supplierId" value="{{$book->supplier()}}"> -->
                                            <select  class="form-control"  name="supplierId" class="selectpicker" data-live-search="true">
                                                
                                                @if(!empty($bookSupplier))
                                                    <option value="{{$bookSupplier->id}}" data-tokens="ketchup mustard">{{$bookSupplier->name}}</option>
                                                @else
                                                    <option value="">Pick One</option>
                                                @endif
                                                @foreach($suppliers as $supplier)
                                                    @if(!empty($bookSupplier))
                                                        @if($supplier->id != $bookSupplier->id)
                                                            <option value="{{$supplier->id}}" data-tokens="ketchup mustard">{{$supplier->name}}</option>
                                                        @endif
                                                    @else
                                                        <option value="{{$supplier->id}}" data-tokens="ketchup mustard">{{$supplier->name}}</option>                                                        
                                                    @endif
                                                @endforeach
                                            </select>                                        
                                        </div>              
                                    </div>                                           
                                    <div class="col-md-12">        
                                        <div class="form-group">
                                            <label for="title">Language</label>
                                            <select  class="form-control"  name="languageId" class="selectpicker" data-live-search="true">
                                                @if(!empty($bookLanguage))
                                                    <option value="{{$bookLanguage->id}}" data-tokens="ketchup mustard">{{$bookLanguage->name}}</option>
                                                @else
                                                    <option value="">Pick One</option>
                                                @endif
                                                @foreach($languages as $language)
                                                    @if(!empty($bookLanguage))
                                                        @if(($language->id != $bookLanguage->id) || empty($bookLanguage))
                                                            <option value="{{$language->id}}" data-tokens="ketchup mustard">{{$language->name}}</option>
                                                        @endif                                                        
                                                    @else
                                                        <option value="{{$language->id}}" data-tokens="ketchup mustard">{{$language->name}}</option>
                                                    
                                                    @endif
                                                @endforeach
                                            </select>                                        
                                        </div>              
                                    </div>  
                                    <div class="col-md-12">        
                                        <div class="form-group">
                                            <label for="title">Category</label>
                                            <select  class="form-control"  name="categoryId" class="selectpicker" data-live-search="true">
                                                @if(!empty($bookCategorie))
                                                    <option value="{{$bookCategorie->id}}" data-tokens="ketchup mustard">{{$bookCategorie->name}}</option>
                                                @else
                                                    <option value="">Pick One</option>
                                                @endif
                                                @foreach($categories as $category)                                                
                                                    @if(!empty($bookCategorie))
                                                        @if($category->id != $bookCategorie->id)
                                                            <option value="{{$category->id}}" data-tokens="ketchup mustard">{{$category->name}}</option>
                                                        @endif
                                                    @else
                                                        <option value="{{$category->id}}" data-tokens="ketchup mustard">{{$category->name}}</option>
                                                 
                                                    @endif
                                                @endforeach
                                            </select>                                        
                                        </div>              
                                    </div>                                       
                                    <div class="col-md-12">        
                                        <div class="form-group">
                                            <label for="title">Genre</label>
                                            <select  class="form-control"  name="genreId" class="selectpicker" data-live-search="true">
                                                @if(!empty($genreBooks))
                                                    <option value="{{$genreBooks->id}}" data-tokens="ketchup mustard">{{$genreBooks->genre}}</option>
                                                @else
                                                    <option value="" data-tokens="ketchup mustard">Pick One</option>
                                                @endif
                                                @foreach($genres as $genre)                                               
                                                    @if(!empty($genreBooks))
                                                        @if($genre->id != $genreBooks->id)
                                                            <option value="{{$genre->id}}" data-tokens="ketchup mustard">{{$genre->genre}}</option>
                                                        @endif
                                                    @else
                                                        <option value="{{$genre->id}}" data-tokens="ketchup mustard">{{$genre->genre}}</option>                                                        
                                                    @endif
                                                @endforeach
                                            </select>                                        
                                        </div>              
                                    </div>       
                                    <div class="col-md-12">        
                                        <div class="form-group">
                                            <label for="title">Description</label>
                                            <textarea rows="3" type="text" class="form-control" placeholder="Desciprtion" name="desc"> {{$book->description}} </textarea>
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