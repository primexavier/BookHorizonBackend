<?php

namespace App\Http\Controllers;

use App\Model\Promotion;
use Illuminate\Http\Request;
use App\DataTables\PromotionDataTable;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PromotionDataTable $dataTable)
    {
        return $dataTable->render('backend.promotion.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("backend.promotion.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validateWithBag('memberships', [
            'name' => ['required'],
            'start' => ['required'],
            'end' => ['required'],
            'promotion_total' => ['required']
        ]);
        $new = new Promotion();
        $new->name = $request->name;
        $new->start = $request->start;
        $new->end = $request->end;
        $new->type = $request->promotion_type;
        if($request->promotion_by == 1){
            $new->is_percent = true;
        }else{
            $new->is_percent = false;
        }
        $new->total = $request->promotion_total;
        $new->description = $request->desc;
        if($new->save()){
            return redirect()->route('backend.promotion.index');
        }else{
            return redirect()->route('backend.promotion.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(Promotion $promotion)
    {
        return view("backend.promotion.detail")->with("promotion",$promotion);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Promotion $promotion)
    {
        return view("backend.promotion.edit")->with("promotion",$promotion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promotion $promotion)
    {
        return $promotion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        if($promotion){
            $promotion->delete();
            return redirect()->route("backend.promotion.index");
        }else{                
            return redirect()->route("backend.promotion.index");
        }
    }
}
