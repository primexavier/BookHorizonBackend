<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\BookCategory;
use Illuminate\Http\Request;
use App\DataTables\CategoryDataTable;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('backend.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("backend.category.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validateWithBag('categories', [
            'name' => ['required', 'unique:categories', 'max:255']
        ]);
        $new = new Category();
        $new->name = $request->name;
        $new->description = $request->desc;
        $new->save();
        return redirect()->route("backend.category.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $bookCategories = BookCategory::where('category_id',$category->id)->get();
        return view("backend.category.detail")
        ->with("bookCategories",$bookCategories)
        ->with("category",$category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view("backend.category.edit")->with('category',$category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if($category->name != $request->name){
            $validatedData = $request->validateWithBag('categories', [
                'name' => ['required', 'unique:categories', 'max:255']
            ]);
        }
        $category->name = $request->name;
        $category->description = $request->desc;
        $category->save();
        return redirect()->route("backend.category.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category){
            $category->delete();
            return redirect()->route("backend.category.index");
        }else{
            return redirect()->route("backend.category.index");
        }
    }
}
