<?php

namespace App\Http\Controllers;

use App\Model\Currency;
use Illuminate\Http\Request;
use App\DataTables\CurrencyDataTable;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CurrencyDataTable $dataTable)
    {
        return $dataTable->render('backend.currency.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("backend.currency.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validateWithBag('currencies', [
            'code_currency' => ['required', 'unique:currencies', 'max:255'],
            'name' => ['required', 'max:255'],
            'rate' => ['required']
        ]);
        $new = new Currency();
        $new->name = $request->name;
        $new->rate = $request->rate;
        $new->code_currency = $request->code_currency;
        $new->description = $request->desc;
        if ($request->hasFile('logo')) {
            $new->photo = $request->file('logo')->getClientOriginalName();
        }
        $new->save();
        return redirect()->route("backend.currency.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        return view("backend.currency.detail")->with("currency",$currency);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        return $currency;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Currency $currency)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        if($currency){
            $currency->delete();
            return redirect()->route("backend.currency.index");
        }else{
            return redirect()->route("backend.currency.index");
        }
    }
}
