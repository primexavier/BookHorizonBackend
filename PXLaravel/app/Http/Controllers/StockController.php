<?php

namespace App\Http\Controllers;

use App\Model\Stock;
use App\Model\Book;
use Illuminate\Http\Request;
use App\DataTables\StockDataTable;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StockDataTable $dataTable)
    {
        return $dataTable->render('backend.stock.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("backend.stock.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validateWithBag('stocks', [
            'adjustment' => ['required'],
            'quantity' => ['required'],
            'book_id' => ['required']
        ]);
        if(!Book::find($request->book_id)){
            return back()->withInput();
        }

        $new = new Stock();
        $new->book_id = $request->book_id;
        $new->user_id = Auth::User()->id;
        $new->adjustment = $request->adjustment;
        $new->quantity = $request->quantity;
        $new->description = $request->desc;
        if($new->save()){
            return redirect()->route('backend.stock.index');
        }else{
            return redirect()->route('backend.stock.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
