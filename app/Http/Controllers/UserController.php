<?php

namespace App\Http\Controllers;

use App\User;
use App\InformasiToko;
use App\Level;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::orderBy("id", "DESC")->get();
        return view('admutama.user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $level = Level::orderBy("id", "DESC")->get();
        return view('admutama.user.create', compact('level'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        $r->validate([
            'email' => 'unique:users'
        ]);
        $n = new User;
        $n->name = $r->input('name');
        $n->email = $r->input('email');
        $n->alamat = $r->input('alamat');
        $n->level_id = $r->input('level_id');
        $n->password = bcrypt($r->input('password'));
        $n->toko_id = 1;
        if (Input::hasFile('foto')) {
            $foto = date("YmdHis")
                . uniqid()
                . "."
                . Input::file('foto')->getClientOriginalName();
            Input::file('foto')->move(storage_path('images'), $foto);
            $n->foto = $foto;
        }
        $n->save();

        return redirect()->route("users.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $level = Level::orderBy("id", "DESC")->get();
        return view('admutama.user.edit', compact('user', 'level'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r)
    {
        $u = User::find($r->input('id'));
        $u->name = $r->input('name');
        $u->email = $r->input('email');
        $u->alamat = $r->input('alamat');
        $u->level_id = $r->input('level_id');
        if(!empty($r->input("password"))){
            $u->password = bcrypt($r->input('password'));
        }
        $u->toko_id = 1;
        if (Input::hasFile('foto')) {
            $foto = date("YmdHis")
                . uniqid()
                . "."
                . Input::file('foto')->getClientOriginalName();
            Input::file('foto')->move(storage_path('images'), $foto);
            $u->foto = $foto;
        }
        $u->save();

        return redirect()->route("users.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route("users.index");
    }

    public function print(){
        $user = User::orderBy("id", "DESC")->get();
        $itoko = InformasiToko::first();

        return view("user.print", compact('user','itoko'));
    }
}
