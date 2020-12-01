<?php

namespace App\Http\Controllers;

use App\Model\User;
use App\DataTables\UsersDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('backend.users.index');
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
            'name' => ['required'],
            'level' => ['required'],
            'password' => ['required'],
            'email' => ['required', 'unique:users']
        ]);
        $new = new User();
        $new->name = $request->name;
        $new->email = $request->email;
        $new->password = Hash::make($request->password);
        $new->level = $request->level;
        if($new->save()){
            return redirect()->route('backend.users.index');
        }else{
            return redirect()->route('backend.users.index');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("backend.users.add");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view("backend.users.detail")->with("users",$user);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view("backend.users.edit")->with("users",$user);
    }
    
    public function update(Request $request, User $user){
        if($user->email != $request->email){
            $validatedData = $request->validateWithBag('users', [
                'name' => ['required'],
                'email' => ['required', 'unique:users']
            ]);                
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->level = $request->level;
        if($user->save()){
            return redirect()->route('backend.member.index');
        }else{
            return redirect()->route('backend.member.index');
        }
    }

}
