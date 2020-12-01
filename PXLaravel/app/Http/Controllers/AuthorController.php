<?php

namespace App\Http\Controllers;

use App\Model\Author;
use Illuminate\Http\Request;
use App\DataTables\AuthorDataTable;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AuthorDataTable $dataTable)
    {
        return $dataTable->render('backend.author.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("backend.author.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validateWithBag('authors', [
            'name' => ['required', 'unique:authors', 'max:255']
        ]);
        $new = new Author();
        $new->name = $request->name;
        $new->save();
        
        return redirect()->route("backend.author.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        return view("backend.author.detail")->with("author",$author);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return $author;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        //
    }
}
