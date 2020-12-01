<?php

namespace App\Http\Controllers;

use App\Model\Bank;
use Illuminate\Http\Request;
use App\DataTables\BankDataTable;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BankDataTable $dataTable)
    {
        return $dataTable->render('backend.bank.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("backend.bank.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validateWithBag('banks', [
            'account' => ['required', 'unique:banks', 'max:255']
        ]);
        $new = new Bank();
        $new->name = $request->name;
        $new->account = $request->account;
        $new->description = $request->desc;
        if ($request->hasFile('logo')) {
            $new->photo = $request->file('logo')->getClientOriginalName();
        }
        $new->save();
        return redirect()->route("backend.bank.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function show(Bank $bank)
    {
        return view("backend.bank.detail")->with("bank",$bank);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit(Bank $bank)
    {
        return $bank;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bank $bank)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank)
    {
        if($bank){
            $bank->delete();
            return redirect()->route("backend.bank.index");
        }else{
            return redirect()->route("backend.bank.index");
        }
    }
}
