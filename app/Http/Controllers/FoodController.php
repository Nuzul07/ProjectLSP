<?php

namespace App\Http\Controllers;

use App\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $food = Food::orderBy("id", "DESC")->get();
        return view('AdmUtama.food.index', compact('food'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('AdmUtama.food.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        $f = new Food;
        $barcode = rand(0, PHP_INT_MAX);
        $f->barcode = $barcode;
        $f->nama = $r->input('nama');
        $f->harga = $r->input('harga');
        $f->status = 1;
        $f->save();
        return redirect()->route("food.index")->with("alertStore", $r->input('nama'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function show(Food $food)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $food = Food::findorFail($id);
        return view('AdmUtama.food.edit', compact('food'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r)
    {
        $f = Food::find($r->input('id'));
        $barcode = rand(0, PHP_INT_MAX);
        $f->barcode = $barcode;
        $f->nama = $r->input('nama');
        $f->harga = $r->input('harga');
        $f->status = 1;
        $f->save();
        return redirect()->route("food.index")->with("alertUpdate", $r->input('nama'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $r, $id)
    {
        $food = Food::find($id);
        $food->delete();
        return redirect()->route("food.index")->with("alertDelete", $r->input('nama'));
    }
}
