<?php

namespace App\Http\Controllers;

use App\Model\Blog;
use Illuminate\Http\Request;
use App\DataTables\BlogDataTable;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BlogDataTable $dataTable)
    {
        return $dataTable->render('backend.blog.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("backend.blog.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $validatedData = $request->validateWithBag('blogs', [
            'title' => ['required', 'unique:blogs', 'max:255'],
            'content' => ['required'],
        ]);
        $new = new Blog();
        $new->title = $request->title;
        $new->content = $request->content;
        $new->user_id = Auth::user()->id;
        $new->save();

        return redirect()->route('backend.blog.index');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return view("backend.blog.detail")->with("blog",$blog);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return $blog;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        return $blog;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        return $blog;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function delete(Blog $blog)
    {
        if($blog){
            $blog->delete();
            return redirect()->route("backend.blog.index");
        }else{
            return redirect()->route("backend.blog.index");
        }
    }    
}
