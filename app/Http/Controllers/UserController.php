<?php

namespace App\Http\Controllers;

use App\User;
use App\InformasiToko;
use Illuminate\Http\Request;

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
        return view('admutama.user.create');
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
        $n->level = $r->input('level');
        $n->password = $r->bcrypt(input('password'));
        $n->toko_id = 1;

        $foto = $r->file('foto');

        if(!empty($foto)){
            $rand = bin2hex(openssl_random_pseudo_bytes(100)).".".$foto->extension();
            $rand_md5 = md5($rand).".".$foto->extension();
            $n->foto = $rand_md5;

            $foto->move(public_path('img_upload/pengguna'),$rand_md5);
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
        return view('admutama.user.edit', compact('user'));
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
        $u->level = $r->input('level');
        if(!empty($r->input("password"))){
            $u->password = $r->bcrypt(input('password'));
        }
        $u->toko_id = 1;

        $foto = $r->file('foto');

        if(!empty($foto)){
            $rand = bin2hex(openssl_random_pseudo_bytes(100)).".".$foto->extension();
            $rand_md5 = md5($rand).".".$foto->extension();
            $u->foto = $rand_md5;

            $foto->move(public_path('img_upload/pengguna'),$rand_md5);
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

        return view("app.users.print", compact('user','itoko'));
    }
}
