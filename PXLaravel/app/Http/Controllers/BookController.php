<?php

namespace App\Http\Controllers;

use App\Model\Book;
use App\Model\BookCategory;
use App\Model\BookGenre;
use App\Model\Author;
use App\Model\Publisher;
use App\Model\Supplier;
use App\Model\Language;
use App\Model\Image;
use App\Model\BookImage;
use App\Model\Genre;
use App\Model\Category;
use App\Imports\BookImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\DataTables\BookDataTable;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BookDataTable $dataTable)
    {
        return $dataTable->render('backend.book.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::get();
        $publishers = Publisher::get();
        $suppliers = Supplier::get();
        $languages = Language::get();
        $genres = Genre::get();
        $categories = Category::get();
        return view("backend.book.add")
        ->with("authors",$authors)
        ->with("publishers",$publishers)
        ->with("suppliers",$suppliers)
        ->with("languages",$languages)
        ->with("genres",$genres)
        ->with("categories",$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validateWithBag('books', [
            'title' => ['required', 'unique:books', 'max:255']
        ]);
        $new = new Book();
        $new->title = $request->title;
        $new->isbn = $request->isbn;
        $new->publication_city = $request->pcity;
        $new->format = $request->format;
        $new->product_code = $request->pcode;
        $new->pages = $request->pages;
        $new->dimension = $request->dimension;
        $new->weight = $request->weight;
        $new->vendor = $request->vendor;
        $new->purchase_price = $request->pprice;
        $new->start_qty = $request->qty;
        $new->stock_now = $request->qty;
        $new->price = $request->price;
        $new->description = $request->desc;
        $new->language_id = $request->languageId;
        if(isset($request->is_sell)){
            $new->language_id = true;
        }else{
            $new->language_id = false;
        }
        if($request->authorId){
            $author = Author::where("name",$request->authorId)->first();
            if($author){
                $new->author_id = $author->id; //$request->authors_id;
            }else{
                $newAuthor = new Author();
                $newAuthor->name = $request->authorId;
                $newAuthor->save();
                $new->author_id = $newAuthor->id; //$request->authors_id;
            }
        }else{
            $new->author_id = "1"; //$request->authors_id;            
        }
        if($request->publisherId){
            $publisher = Publisher::where("name",$request->authorId)->first();
            if($publisher){
                $new->publisher_id = $publisher->id; //$request->authors_id;
            }else{
                $newPublisher = new Publisher();
                $newPublisher->name = $request->publisherId;
                $newPublisher->save();
                $new->publisher_id = $newPublisher->id; //$request->authors_id;
            }
        }else{
            $new->publisher_id = "1"; //$request->authors_id;            
        }
        if($request->supplierId){
            $supplier = Supplier::where("name",$request->supplierId)->first();
            if($supplier){
                $new->supplier_id = $supplier->id; //$request->authors_id;
            }else{
                $newSupplier = new Supplier();
                $newSupplier->name = $request->supplierId;
                $newSupplier->save();
                $new->supplier_id = $newSupplier->id; //$request->authors_id;
            }
        }else{
            $new->supplier_id = "1"; //$request->authors_id;            
        }
        $new->save();

        if ($request->hasFile('photo')) {
            if ($request->file('photo')->isValid()) {
                $extension = $request->photo->extension();
                $request->photo->storeAs('\public\image\book', $new->id.".".$extension);
                $url = "image\book\\".$new->id.".".$extension;
                $newImage = new Image();
                $newImage->name = $new->title;
                $newImage->url = $url;
                $newImage->save();

                $ImageBook = new BookImage();
                $ImageBook->book_id = $new->id;
                $ImageBook->image_id = $newImage->id;
                $ImageBook->save();
            }
        }

        if($request->categoryId){
            $bookCategory = BookCategory::where('book_id',$new->id)->first();
            if($bookCategory){
                $bookCategory->category_id = $request->categoryId;
                $bookCategory->save();
            }else{
                $bookCategory = new BookCategory;
                $bookCategory->book_id = $new->id;
                $bookCategory->category_id = $request->categoryId;
                $bookCategory->save();
            }            
        }
        if($request->genreId)
        {
            $bookGenre = BookGenre::where('book_id',$new->id)->first();            
            if($bookGenre){
                $bookGenre->genre_id = $request->genreId;
                $bookGenre->save();
            }else{
                $bookGenre = new BookGenre;
                $bookGenre->book_id = $new->id;
                $bookGenre->genre_id = $request->genreId;
                $bookGenre->save();
            }                        
        }
        return redirect()->route("backend.book.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $bookImages = BookImage::where('book_id',$book->id)->orderByDesc('id')->first();
        return view("backend.book.detail")
        ->with("bookImages",$bookImages)
        ->with("book",$book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $authors = Author::get();
        $publishers = Publisher::get();
        $suppliers = Supplier::get();
        $languages = Language::get();
        $genres = Genre::get();
        $categories = Category::get();
        $bookGenres =  BookGenre::where('book_id',$book->id)->first();
        if($bookGenres){
            $bookGenre = $bookGenres->genre();
        }else{
            $bookGenre = null;
        }
        $bookCategories = BookCategory::where('book_id',$book->id)->first();
        if($bookCategories){
            $bookCategory = $bookCategories->category();
        }else{
            $bookCategory = null;
        }
        $bookSupplier = Supplier::where("id",$book->supplier_id)->first();
        $bookLanguage = Language::where("id",$book->language_id)->first();
        return view("backend.book.edit")->with("book",$book)
        ->with("authors",$authors)
        ->with("publishers",$publishers)
        ->with("suppliers",$suppliers)
        ->with("languages",$languages)
        ->with("genres",$genres)
        ->with("categories",$categories)
        ->with("genreBooks",$bookGenre)
        ->with("bookCategorie",$bookCategory)
        ->with("bookLanguage",$bookLanguage)
        ->with("bookSupplier",$bookSupplier);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        if($request->title != $book->title){
            $validatedData = $request->validateWithBag('books', [
                'title' => ['required', 'unique:books', 'max:255']
            ]);           
        }
        $book->title = $request->title;
        $book->isbn = $request->isbn;
        $book->publication_city = $request->pcity;
        $book->format = $request->format;
        $book->product_code = $request->pcode;
        $book->pages = $request->pages;
        $book->dimension = $request->dimension;
        $book->weight = $request->weight;
        $book->vendor = $request->vendor;
        $book->purchase_price = $request->pprice;
        $book->price = $request->price;
        $book->start_qty = $request->qty;
        $book->description = $request->desc;
        if(!empty($request->authorId)){
            $author = Author::where("name",$request->authorId)->first();
            if($author){
                $book->author_id = $author->id; //$request->authors_id;
            }else{
                $newAuthor = new Author();
                $newAuthor->name = $request->authorId;
                $newAuthor->save();
                $book->author_id = $newAuthor->id; //$request->authors_id;
            }
        }else{
            $book->author_id = 1; //$request->authors_id;            
        }
        if(!empty($request->publisherId)){
            $publisher = Publisher::where("name",$request->authorId)->first();
            if($publisher){
                $book->publisher_id = $publisher->id; //$request->authors_id;
            }else{
                $newPublisher = new Publisher();
                $newPublisher->name = $request->publisherId;
                $newPublisher->save();
                $book->publisher_id = $newPublisher->id; //$request->authors_id;
            }
        }else{
            $book->publisher_id = 1; //$request->authors_id;            
        }
        // if(!empty($request->supplierId)){
        //     $supplier = Supplier::where("name",$request->supplierId)->first();
        //     if($supplier){
        //         $book->supplier_id = $supplier->id; //$request->authors_id;
        //     }else{
        //         $newSupplier = new Supplier();
        //         $newSupplier->name = $request->supplierId;
        //         $newSupplier->save();
        //         $book->supplier_id = $newSupplier->id; //$request->authors_id;
        //     }
        // }else{
            $book->supplier_id = 1; //$request->authors_id;            
        // }
        if($request->categoryId){
            $bookCategory = BookCategory::where('book_id',$book->id)->first();
            if($bookCategory){
                $bookCategory->category_id = $request->categoryId;
                $bookCategory->save();
            }else{
                $bookCategory = new BookCategory;
                $bookCategory->book_id = $book->id;
                $bookCategory->category_id = $request->categoryId;
                $bookCategory->save();
            }            
        }
        if($request->genreId)
        {
            $bookGenre = BookGenre::where('book_id',$book->id)->first();            
            if($bookGenre){
                $bookGenre->genre_id = $request->categoryId;
                $bookGenre->save();
            }else{
                $bookGenre = new BookGenre;
                $bookGenre->book_id = $book->id;
                $bookGenre->genre_id = $request->genreId;
                $bookGenre->save();
            }                        
        }
        if ($request->hasFile('photo')) {
            if ($request->file('photo')->isValid()) {
                $extension = $request->photo->extension();
                $request->photo->storeAs('\public\image\book', $book->id.".".$extension);
                $url = "image\book\\".$book->id.".".$extension;
                $newImage = new Image();
                $newImage->name = $book->title;
                $newImage->url = $url;
                $newImage->save();

                $ImageBook = new BookImage();
                $ImageBook->book_id = $book->id;
                $ImageBook->image_id = $newImage->id;
                $ImageBook->save();
            }
        }
        if($book->save()){
            return redirect(route("backend.book.detail",$book->id));
        }else{            
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function delete(Book $book)
    {
        if($book){
            $book->delete();
            return redirect()->route("backend.book.index");
        }else{
            return redirect()->route("backend.book.index");
        }
    }    

    public function importExcel(Request $request)
    {
        Excel::import(new BookImport, "book.xlsx");
        
        return redirect('/backend/books')->with('success', 'All good!');
    }

    public function ImportCreate()
    {
        return view('backend.book.import-create');
    }

    public function ImportStore(Request $request)
    {
        if($request->hasFile('importExcel')){
            if($request->file('importExcel')->isValid()){
                $mytime = Carbon::now();
                $extension = $request->importExcel->extension();
                $name = $mytime->timestamp;
                $request->importExcel->storeAs('\public\book\import', $name.".".$extension);
                $url = "book\import\\".$name.".".$extension;
                Excel::import(new BookImport, 'storage\\'.$url);
                return redirect('/backend/books')->with('success', 'All good!');
            }
        }
    }
}
