<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Model\Book;
use App\Model\BookCategory;
use App\Model\BookComment;
use App\Model\Blog;
use App\Model\Chart;
use App\Model\Wishlist;
use App\Model\Bank;
use App\Model\PaymentMethod;
use App\Model\TransactionType;
use App\Model\TransactionBook;
use App\Model\Category;
use App\Model\Comment;
use App\Model\Review;
use App\Model\UserMembership;
use Carbon\Carbon;

class FrontEndController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        $booklist = Book::limit(20)->get();
        $spesialOffers = Book::inRandomOrder()->limit(0)->get();
        $newArrivals = Book::orderByDesc('id')->limit(10)->get();
        $mostViews = Book::orderByDesc('view')->limit(10)->get();
        $TransactionDetail = TransactionBook::groupBy('book_id')->limit(10)->pluck('book_id');
        if($TransactionDetail->count()>0){
            $featuredBooks = Book::whereIn("id", $TransactionDetail)->get();
        }else{
            $featuredBooks = Book::inRandomOrder()->limit(10)->get();
        }
        $category1 = BookCategory::groupBy('book_id')->where('category_id',1)->limit(10)->pluck('book_id');
        if($category1->count()>0){
            $category1Book = Book::whereIn("id", $category1)->get();
        }else{
            $category1Book = Book::inRandomOrder()->limit(10)->get();
        }
        $category2 = BookCategory::groupBy('book_id')->where('category_id',2)->limit(10)->pluck('book_id');
        if($category2->count()>0){
            $category2Book = Book::whereIn("id", $category2)->get();
        }else{
            $category2Book = Book::inRandomOrder()->limit(10)->get();
        }
        $category3 = BookCategory::groupBy('book_id')->where('category_id',3)->limit(10)->pluck('book_id');
        if($category3->count()>0){
            $category3Book = Book::whereIn("id", $category3)->get();
        }else{
            $category3Book = Book::inRandomOrder()->limit(10)->get();
        }
        $userMembership = null;
        if(Auth::User()){
            $userMembership = UserMembership::where('user_id',Auth::User()->id)
            ->where('is_active',true)
            ->where('expired','>', Carbon::now())
            ->first();
        }
        return view("index")
        ->with("categories",$categories)
        ->with("category1",$category1Book)
        ->with("category2",$category2Book)
        ->with("category3",$category3Book)
        ->with("booklist",$booklist)
        ->with("spesialOffers",$spesialOffers)
        ->with("newArrivals",$newArrivals)
        ->with("featuredBooks",$featuredBooks)
        ->with("mostViews",$mostViews)
        ->with("userMembership",$userMembership);
    }

    public function bookDetail($id)
    {
        $comments = BookComment::where('book_id',$id)->get();
        $reviews = Review::where('book_id',$id)->get();
        $booklist = Book::limit(6)->get();        
        $book = Book::where('id',$id)->first();
        if(!$book){
            abort(404);
        }
        $book->view++;
        $book->save();
        return view("frontend.book.detail")
        ->with("reviews",$reviews)
        ->with("comments",$comments)
        ->with("booklist",$booklist)
        ->with("bookDetail",$book);
    }

    public function blogIndex()
    {
        $blogList = Blog::get();
        return view("frontend.blog.index")
        ->with("blogList",$blogList);
    }
    
    public function blogDetail($id)
    {
        $blog = Blog::where('id',$id)->first();
        if(!$blog){
            abort(404);
        }
        return view("frontend.blog.detail")
        ->with('blog',$blog);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addChart(Request $request)
    {
        if(!Auth::User()){
            return response("login", 200)->header('Content-Type', 'text/plain');
        }
        if(!Book::find($request->id)){
            return response($request->id, 500)->header('Content-Type', 'text/plain');
        }
        $existChart = Chart::where('user_id',Auth::user()->id)->where('book_id',$request->id)->first();
        if(!$existChart){
            $addChart = new Chart;
            $addChart->book_id = $request->id;
            $addChart->user_id = Auth::User()->id;
            $addChart->transaction_type_id = 1;
            $addChart->duration = 0;
            $addChart->save();
            if(!$addChart){
                return response($request->id, 500)->header('Content-Type', 'text/plain');
            }else{
                return response($request->id, 200)->header('Content-Type', 'text/plain');
            }
        }else{            
            return response($request->id, 200)->header('Content-Type', 'text/plain');
        }
    }

    public function addWishlist(Request $request)
    {
        if(!Auth::User()){
            return response("login", 200)->header('Content-Type', 'text/plain');
        }
        if(!Book::find($request->id)){
            return response($request->id, 500)->header('Content-Type', 'text/plain');
        }
        $addChart = new Wishlist;
        $addChart->book_id = $request->id;
        $addChart->user_id = Auth::User()->id;
        $addChart->save();
        if(!$addChart){
            return response($request->id, 500)->header('Content-Type', 'text/plain');
        }else{
            return response($request->id, 200)->header('Content-Type', 'text/plain');
        }
    }

    public function chart()
    {
        if(Auth::User()){
            $transactionTypes = TransactionType::get();
            $charts = Chart::where("user_id", Auth::User()->id)->get();
            foreach($charts as $chart){
                if(!$chart->book()){
                    $chart->delete();
                }
            }
            $userMembership = UserMembership::where('user_id',Auth::User()->id)
            ->where('is_active',true)
            ->where('expired','>', Carbon::now())
            ->first();
            return view("frontend.chart")
            ->with("transactionTypes",$transactionTypes)
            ->with("charts",$charts)
            ->with("userMembership",$userMembership);
        }else{
            return redirect(route("login"));
        }
    }

    public function wishlist()
    {
        if(Auth::User()){
            $wishlist = Wishlist::where("user_id", Auth::User()->id)->get();
            return view("frontend.wishlist")
            ->with("wishlists",$wishlist);
        }else{
            return redirect(route("login"));
        }
    }

    public function bookModal(Book $book)
    {
        return $book;
    }

    public static function getProvince($province_id){        
        $curl = curl_init();
        if($province_id){
            $province = "?id=".$province_id;
        }else{
            $province = "";
        }
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province".$province,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
              "key: 106e7050f0400a42b414fb308db9dc00"
            ),
          ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return null;
        } else {
            return json_decode($response)->rajaongkir->results;
        }
    }

    public function getCity($provinceId, $cityId = NULL){   
        if($provinceId){
            $province = "?province=".$provinceId;
        }else{
            $province = "";
        }     
        if($cityId){
            $province = $province."&id=".$cityId;
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city".$province,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
              "key: 106e7050f0400a42b414fb308db9dc00"
            ),
          ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return null;
        } else {
            if($cityId){
                $response = str_replace(chr(0), '', $response);
                $contents = utf8_encode($response);
                $results = json_decode($contents);
                return response()->json([$results->rajaongkir->results]);
            }else{
                return json_decode($response)->rajaongkir->results;
            }
        }
    }

    public function searchBook(Request $request){   
        $categories = Category::get();
        if($request->category){
            $bookCategory = BookCategory::where('category_id',$request->category)->pluck('book_id');
            if($request->sort){
                if($request->sort == "newest"){
                    $searchedBook = Book::whereIn('id',$bookCategory)->where('title', 'like', '%'.$request->searchBook.'%')->orderBy('created_at','ASC')->get();   
                }else{
                    $searchedBook = Book::whereIn('id',$bookCategory)->where('title', 'like', '%'.$request->searchBook.'%')->orderBy('created_at','ASC')->get();   
                }
            }else{                
                $searchedBook = Book::whereIn('id',$bookCategory)->where('title', 'like', '%'.$request->searchBook.'%')->get();
            }
            return view('frontend.search')
            ->with("searchBooks",$searchedBook)
            ->with("categories",$categories);
        }else{
            if($request->sort){     
                if($request->sort == "newest"){
                    $searchedBook = Book::where('title', 'like', '%'.$request->searchBook.'%')->orderBy('created_at','ASC')->get();
                }else{
                    $searchedBook = Book::where('title', 'like', '%'.$request->searchBook.'%')->orderBy('created_at','ASC')->get();
                }
            }else{  
                $searchedBook = Book::where('title', 'like', '%'.$request->searchBook.'%')->get();    
            }     
            return view('frontend.search')
            ->with("searchBooks",$searchedBook)
            ->with("categories",$categories);
        }
    }

    public function paymentMethodList(PaymentMethod $paymentmethod){
        $banks = Bank::get();
    
        return view('frontend.payment-method')
        ->with("banks", $banks);
    }

    public function addComment($id, Request $request){
        if(Auth::User()){
            $validatedData = $request->validateWithBag('comments', [
                'message' => ['required', 'max:255']
            ]);
            $newComment = new Comment();
            $newComment->user_id = Auth::user()->id;
            $newComment->comment = $request->message;
            $newComment->save();

            $newBookComment = new BookComment();
            $newBookComment->comment_id = $newComment->id;
            $newBookComment->book_id = $id;
            $newBookComment->save();
            
            return redirect(route("book.detail",$id));
        }else{
            return redirect(route("book.detail",$id));
        }
    }
}
