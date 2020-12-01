<?php

namespace App\Http\Controllers;

use App\Model\User;
use App\Model\Bank;
use App\Model\Transaction;
use App\Model\TransactionBook;
use App\Model\TransactionMembership;
use App\Model\Download;
use App\Model\Bill;
use App\Model\Payment;
use App\Model\PaymentMethod;
use App\Model\Address;
use App\Model\Membership;
use App\Model\Wishlist;
use App\Model\Chart;
use App\Model\Setting;
use App\Model\Book;
use App\Model\Courier;
use App\Model\UserMembership;
use App\Model\UserBook;
use Illuminate\Http\Request;
use App\DataTables\MemberDataTable;
use App\DataTables\OrdersDataTable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MemberController extends Controller
{
    public function index(MemberDataTable $dataTable)
    {
        return $dataTable->render('backend.member.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validateWithBag('users', [
            'first_name' => ['required'],
            'password' => ['required'],
            'email' => ['required', 'unique:users']
        ]);
        $new = new User();
        $new->name = $request->first_name;
        $new->email = $request->email;
        $new->first_name = $request->first_name;
        $new->last_name = $request->last_name;
        $new->display_name = $request->display_name;
        $new->phone_no = $request->phone_no;
        if(isset($_POST['test'])){
            $new->privacy = true;
        }else{
            $new->privacy = false;
        }
        if ($request->hasFile('photoId')) {
            if ($request->file('photoId')->isValid()) {
                $extension = $request->photoId->extension();
                $request->photoId->storeAs('\public\image\user', 'photoId'.$user->id.".".$extension);
                $url = "image\user\\photoId".$user->id.".".$extension;
                $new->photo_id = $url;
            }
        }
        if(isset($address)){            
            $newAddress = new Address;
            $newAddress->user_id = $new->id;
            $newAddress->name = "Default";
            $newAddress->lg = 0;
            $newAddress->la = 0;
            $newAddress->full_address = $request->address;
            $newAddress->phone_no = $request->phone_no;
            $newAddress->country_id = 0;
            $newAddress->province_id = 0;
            $newAddress->city_id = 0;
            $newAddress->zip_code = 0;
            $newAddress->save();
        }
        $new->password = Hash::make($request->password);
        $new->level = 2;
        if($new->save()){
            return redirect()->route('backend.member.index');
        }else{
            return redirect()->route('backend.member.index');
        }
    }

    /*
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function create(Request $request)
   {
       return view("backend.member.add");
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $softDelete = User::where('id',$id)->first();
        if($softDelete){
            if($softDelete->level == 2){
                $softDelete->delete();
                return redirect()->route("backend.member.index");
            }else{                
                return redirect()->route("backend.member.index");
            }
        }else{
            return redirect()->route("backend.member.index");
        }
    }    

    public function profile()
    {
        $userID = Auth::id();
        $user = User::where('id',$userID)->first();
        $membership = TransactionMembership::get();
        // $transactionBook = TransactionBook::where("user_id",$userID)->get();
        $wishlist = Wishlist::where('user_id',$userID)->pluck('book_id');
        $booklist = Chart::where('user_id',$userID)->pluck('book_id');
        $bookUser = UserBook::where('user_id',$userID)->pluck('book_id');
        $transaction = Transaction::where('user_id',$userID)->pluck('id');
        $bookTransaction = TransactionBook::whereIn('transaction_id',$transaction)->pluck('book_id')->unique();
        $books = Book::whereIn("id",$wishlist)
        ->orWhereIn("id",$booklist)
        ->orWhereIn("id",$booklist)
        ->orWhereIn("id",$bookUser)
        ->orWhereIn("id",$bookTransaction)
        ->get()
        ->unique('id');

        $userMembership = UserMembership::where('user_id',Auth::User()->id)
        ->where('is_active',true)
        ->where('expired','>', Carbon::now())
        ->first(); 

        $bookRented = UserBook::where('is_return',false)->get();

        return view('frontend.profile.myprofile')
        ->with('membership', $membership)
        ->with('userDetail', $user)
        ->with('books', $books)
        ->with('bookRented', $bookRented)
        ->with('userMembership', $userMembership);
    }

    public function update(Request $request, User $user){
        if($user->email != $request->email){
            $validatedData = $request->validateWithBag('users', [
                'name' => ['required'],
                'email' => ['required', 'unique:users']
            ]);                
        }
        $user->name = $request->first_name;
        $user->phone_no = $request->phone_no;
        $user->email = $request->email;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->display_name = $request->display_name;
        if(isset($_POST['test'])){
            $user->privacy = true;
        }else{
            $user->privacy = false;
        }
        if(!empty($_POST['password'])){            
            $user->password = Hash::make($request->password);
        }
        if ($request->hasFile('photoId')) {
            if ($request->file('photoId')->isValid()) {
                $extension = $request->photoId->extension();
                $request->photoId->storeAs('\public\image\user', 'photoId'.$user->id.".".$extension);
                $url = "image\user\\photoId".$user->id.".".$extension;
                $user->photo_id = $url;
            }
        }
        if(isset($request->address) && $request->address != $user->address){          
            $newAddress = new Address;
            $newAddress->user_id = $user->id;
            $newAddress->name = "Default";
            $newAddress->lg = 0;
            $newAddress->la = 0;
            $newAddress->full_address = $request->address;
            $newAddress->phone_no = $request->phone_no;
            $newAddress->country_id = 0;
            $newAddress->province_id = 0;
            $newAddress->city_id = 0;
            $newAddress->zip_code = 0;
            $newAddress->save();
        }
        if($user->save()){
            return redirect()->route('backend.member.index');
        }else{
            return redirect()->route('backend.member.index');
        }
    }

    public function orderlist()
    {
        $userID = Auth::id();
        $user = User::where('id',$userID)->first();
        $transaction = Transaction::where('user_id',Auth::User()->id)->get();
        return view('frontend.profile.order')
        ->with('transactions', $transaction)
        ->with('userDetail', $user);
    }

    public function downloadList()
    {
        $userID = Auth::id();
        $user = User::where('id',$userID)->first();
        $download = Download::where('user_id',Auth::User()->id)->get();
        return view('frontend.profile.download')
        ->with('download', $download)
        ->with('userDetail', $user);
    }

    public function billList()
    {
        $userID = Auth::id();
        $user = User::where('id',$userID)->first();
        $bills = Bill::where('user_id',Auth::User()->id)->where('status','<',2)->get();
        return view('frontend.profile.bill')
        ->with('bills', $bills)
        ->with('userDetail', $user);
    }

    public function paymentList()
    {
        $userID = Auth::id();
        $user = User::where('id',$userID)->first();
        $payment = Bill::where('user_id',Auth::User()->id)->where('status','>',1)->get();
        return view('frontend.profile.payment')
        ->with('payment', $payment)
        ->with('userDetail', $user);
    }

    public function addressList()
    {
        $userID = Auth::id();
        $user = User::where('id',$userID)->first();
        $address = Address::where('user_id',Auth::User()->id)->get();
        return view('frontend.profile.address')
        ->with('addresses', $address)
        ->with('userDetail', $user);
    }

    public function paymentMethod()
    {
        $userID = Auth::id();
        $user = User::where('id',$userID)->first();
        $paymentMethods = paymentMethod::get();
        return view('frontend.profile.payment-method')
        ->with('paymentMethods', $paymentMethods)
        ->with('userDetail', $user);
    }

    public function editProfile()
    {
        $userID = Auth::id();
        $user = User::where('id',$userID)->first();
        return view('frontend.profile.editprofile')
        ->with('userDetail', $user);
    }

    public function editProfileMembership($fromMembership)
    {
        if($fromMembership == "1"){
            $fromMembership = true;
        }else{
            $fromMembership = false;
        }
        $userID = Auth::id();
        $user = User::where('id',$userID)->first();
        return view('frontend.profile.editprofilemembership')
        ->with('userDetail', $user)
        ->with('fromMembership', $fromMembership );
    }

    public function privacy()
    {
        $userID = Auth::id();
        $user = User::where('id',$userID)->first();
        return view('frontend.profile.privacy')
        ->with('userDetail', $user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view("backend.member.detail")->with("member",$user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view("backend.member.edit")->with("member",$user);
    }

    public function becomeMember(User $user)
    {
        if($user->phone_no && $user->photo_profile && $user->photo_id)
        {
            $memberships = Membership::get();
            return view("frontend.profile.become")
            ->with("memberships",$memberships)
            ->with("userDetail",$user);
        }else{
            return redirect()->route('profile.edit.membership',1);
        }       
    }

    public function extendMember(User $user)
    { 
        if($user->phone_no && $user->photo_profile && $user->photo_id)
        {
            $memberships = Membership::get();
            return view("frontend.profile.extend")
            ->with("memberships",$memberships)
            ->with("userDetail",$user);
        }else{
            return redirect()->route('profile.edit.membership',1);
        }        
    }

    public function wishlistChart(Request $request){
        if($request->wishlistId){
            $wishlist = Wishlist::where("user_id",$request->wishlistId)->first();
            if($wishlist){
                $newChart = new Chart;
                $newChart->user_id = Auth::User()->id;
                $newChart->book_id = $wishlist->book_id;
                $newChart->transaction_type = 1;
                if($newChart->save()){
                    $wishlist->delete();
                }
            }
        }

        return redirect(route("wishlist"));
    }

    public function checkout(Request $request)
    {  
        $charts = Chart::where("user_id",Auth::user()->id)->get();
        if($charts->count() > 0){
            foreach($request->charId as $chardId){
                $bookDetailData = Chart::where('id',$chardId)->first();
                $bookDetailData->transaction_type_id = $request->typeTransaction[$chardId];
                $bookDetailData->duration = $request->rentDuration[$chardId];
                $bookDetailData->save();
            }

            $paymentMethods = PaymentMethod::get();
            $address = Address::where("user_id",Auth::user()->id)->first();
            $provinces = FrontEndController::getProvince(NULL);
            $couriers = Courier::get();

            return redirect(route("checkout.view"))
            ->with("charts",$charts)
            ->with("paymentMethods",$paymentMethods)
            ->with("address",$address)
            ->with("provinces",$provinces)
            ->with("couriers",$couriers);                
        }else{
            return redirect(route("index"));
        }
    }
    
    public function checkoutView(Request $request)
    {  
        $charts = Chart::where("user_id",Auth::user()->id)->get();
        if($charts->count() > 0){

            $userMembership = UserMembership::where('user_id',Auth::User()->id)
            ->where('is_active',true)
            ->where('expired','>', Carbon::now())
            ->first(); 
            $paymentMethods = PaymentMethod::get();
            $address = Address::where("user_id",Auth::user()->id)->first();
            $addresses = Address::where("user_id",Auth::user()->id)->get();
            $provinces = FrontEndController::getProvince(NULL);
            $couriers = Courier::get();
            return view("frontend.checkout")
            ->with("charts",$charts)
            ->with("paymentMethods",$paymentMethods)
            ->with("address",$address)
            ->with("addresses",$addresses)
            ->with("provinces",$provinces)
            ->with("couriers",$couriers)
            ->with('userMembership', $userMembership);                
        }else{
            return redirect(route("index"));
        }
    }

    public function deleteChart(Chart $chart)
    {        
        if($chart->delete()){
            return redirect()->route("chart");
        }
    }

    public function pay(Request $request)
    {        
        $userMembership = UserMembership::where('user_id',Auth::User()->id)
        ->where('is_active',true)
        ->where('expired','>', Carbon::now())
        ->first(); 
        $buy_discount = 0;
        $rent_discount = 0;
        if($userMembership){
            $membership = Membership::where('id',$userMembership->membership_id)->first();
            if($membership){                
                $buy_discount = $membership->buy_discount;
                $rent_discount = $membership->rent_discount;
            }
        }
        $user_id = Auth::user()->id;
        $charts = Chart::where("user_id",$user_id)->get();
        if($charts->count() > 0){
            $newTransaction = new Transaction;
            $newTransaction->user_id = $user_id;
            $newTransaction->sub_total = $request->subTotalInput;
            $newTransaction->shipping_cost = $request->shippingCost;
            $newTransaction->product_total = $charts->count();
            $newTransaction->grand_total = $request->grandTotalInput;
            $newTransaction->payment_method_id = $request->paymentMethod;
            $newTransaction->status = 1;
            if(isset($request->is_regional)){
                $newTransaction->is_regional = true;
            }else{
                $newTransaction->is_regional = false;
            }
            $newTransaction->save();
            $totalDiscount = 0;
            foreach($charts as $chart){
                $newTransactionDetail = new TransactionBook;
                $newTransactionDetail->transaction_id = $newTransaction->id;
                $newTransactionDetail->book_id = $chart->book_id;
                $newTransactionDetail->price = $chart->total();
                $newTransactionDetail->duration = $chart->duration;
                $newTransactionDetail->transaction_type_id = $chart->transaction_type_id;
                if($chart->transaction_type_id == 1){
                    if($chart->total() > 0){
                        $newTransactionDetail->discount = $buy_discount;
                        $totalDiscount = $totalDiscount+$buy_discount;
                    }
                }
                if($newTransactionDetail->save()){
                    $chart->delete();
                }
            }

            $newBill = new Bill;
            $newBill->name = "Transaction - {$user_id} No {$newTransaction->id}";
            $newBill->status = 0;
            $newBill->user_id = $user_id;
            $newBill->transaction_id = $newTransaction->id;
            $newBill->total = $request->grandTotalInput;
            $newBill->is_active = true;
            $newBill->save();

            if($request->isShipping == 1){                
                if(isset($request->is_regional)){
                    $newTransaction->regional_address = $request->address;
                }else{
                    if(empty($request->oldAddress)){
                        $newAddress = new Address;
                        $newAddress->user_id = $user_id;
                        $newAddress->name = "Defauilt";
                        $newAddress->lg = 0;
                        $newAddress->la = 0;
                        $newAddress->full_address = $request->address;
                        $newAddress->phone_no = $request->phone_no;
                        $newAddress->country_id = $request->country_id;
                        $newAddress->province_id = $request->province_id;
                        $newAddress->city_id = $request->city_id;
                        $newAddress->zip_code = $request->zipCode;
                        $newAddress->save();
                        $newTransaction->address_id = $newAddress->id;
                    }else{
                        $newTransaction->address_id = $request->oldAddress;
                    }    
                }            
            }

            if(!Auth::user()->phone_no){
                $updateUser = User::where('id'.$user_id)->first();
                $updateUser->phone_no = $request->phone_no;
                $updateUser->save();
            }
           
            $newTransaction->discount = $totalDiscount;
            $newTransaction->save();

            return redirect()->route("transaction.detail",$newTransaction->id);
            
        }else{
            return redirect(route("index"));
        }
    }

    public function transactionDetail(Transaction $transaction)
    {        
        $transactionBook = TransactionBook::where('transaction_id',$transaction->id)->get();
        $transactionMembership = TransactionMembership::where('transaction_id',$transaction->id)->get();
        $banks = Bank::get();
        if($transactionBook->count() < 1){
            if($transactionMembership->count() < 1){
                $transaction->delete();
                return redirect(route('order.list'));
            }
        }
        return view("frontend.transaction-detail")
        ->with("banks",$banks)
        ->with("transaction",$transaction)
        ->with("transactionBooks",$transactionBook)
        ->with("transactionMemberships",$transactionMembership);
    }

    public function addTransaction(Request $request)
    {        
        $transaction = "";
        return view("frontend.transaction-detail")->with("transaction",$transaction);
    }

    public function getShippingCost($courier,$city_id,$weight){
        $setting = Setting::First();
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "origin={$setting->city_id}&destination=$city_id&weight={$weight}&courier={$courier}",
        CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: 106e7050f0400a42b414fb308db9dc00"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            if(count(json_decode($response)->rajaongkir->results) > 0){
                return json_decode($response)->rajaongkir->results[0]->costs;
            }else{
                return null;
            }
        }
    }

    public function confirmBill(Bill $bill){
        if(!$bill->transaction()){
            $bill->delete();
            return redirect()->back();
        }
        
        return view("frontend.profile.upload-receipt")
        ->with("bill",$bill);
    }

    public function paymentView(Bill $bill){
        if(!$bill->transaction()){
            $bill->delete();
            return redirect()->back();
        }
        
        return view("frontend.profile.payment-view")
        ->with("bill",$bill);
    }

    public function uploadBill(Bill $bill, Request $request){
        try
        {
            if ($request->hasFile('receipt')) {
                if ($request->file('receipt')->isValid()) {
                    $extension = $request->receipt->extension();
                    $request->receipt->storeAs('\public\image\bill', 'bill-'.$bill->id.".".$extension);
                    $url = "image\bill\bill-".$bill->id.".".$extension;
                }
            }            
        } catch (Throwable $e) {
            return redirect()->back()->with('error',' upload receipt Gagal');
            
        }
        $bill->photo = $url;
        $bill->status = 2;
        $bill->save();
        $transaction = Transaction::where('id',$bill->transaction_id)->first();
        $transaction->status = 2;
        $transaction->save();
        return redirect(route('confirm.bill',$bill->id))->with('success','Upload Receipt Berhasil');
    }

    public function rentedList(){
        $bookRenteds = UserBook::where('user_id',Auth::user()->id)->get();
        return view("frontend.profile.rented")
        ->with("bookRenteds",$bookRenteds);
    }

    public function checkoutMembership ($id){
        if(Auth::user()){
            $membership = Membership::where('id',$id)->first();
            $paymentMethods = PaymentMethod::get();
            return view('frontend.profile.checkout-membership')
            ->with("membership",$membership)
            ->with("paymentMethods",$paymentMethods);
        }else{
            return redirect(route('index'));
        }
    }

    public function paymembership(Request $request){
        $user_id = Auth::user()->id;
        $newTransaction = new Transaction;
        $newTransaction->user_id = $user_id;
        $newTransaction->sub_total = $request->subTotalInput;
        $newTransaction->shipping_cost = $request->shippingCost;
        $newTransaction->product_total = 1;
        $newTransaction->grand_total = $request->grandTotalInput;
        $newTransaction->save();

        $newTransactionMembership = new TransactionMembership;
        $newTransactionMembership->transaction_id = $newTransaction->id;
        $newTransactionMembership->membership_id = $request->membershipId;
        $newTransactionMembership->save();

        $newBill = new Bill;
        $newBill->name = "Transaction - {$user_id} No {$newTransaction->id}";
        $newBill->user_id = $user_id;
        $newBill->transaction_id = $newTransaction->id;
        $newBill->total = $request->grandTotalInput;
        $newBill->is_active = true;
        $newBill->status = 0;
        $newBill->save();

        return redirect()->route("transaction.detail",$newTransaction->id);
    }

    public function updateProfile(Request $request){
        $user = User::where("id",Auth::user()->id)->first();
        $user->first_name = $request->fname;
        $user->last_name = $request->lname;
        $user->display_name = $request->dname;
        $user->phone_no = $request->phone;
        $user->bod = $request->bod;
        $user->occupation = $request->occupation;
        $user->gender = $request->gender;
        $user->email = $request->email;

        if ($request->hasFile('photoId')) {
            if ($request->file('photoId')->isValid()) {
                $extension = $request->photoId->extension();
                $request->photoId->storeAs('\public\image\user', 'photoId'.$user->id.".".$extension);
                $url = "image\user\\photoId".$user->id.".".$extension;
                $user->photo_id = $url;
            }
        }

        if ($request->hasFile('profilePic')) {
            if ($request->file('profilePic')->isValid()) {
                $extension = $request->profilePic->extension();
                $request->profilePic->storeAs('\public\image\user', 'profilePic'.$user->id.".".$extension);
                $url = "image\user\\profilePic".$user->id.".".$extension;
                $user->photo_profile = $url;
            }
        }


        $user->save();
        if($request->fromMember){
            return redirect()->route('become.member',Auth::user()->id);
        }
        return redirect()->route("profile");
    }
}
