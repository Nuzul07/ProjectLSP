<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use App\Food;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::orderBy("id", "DESC")->get();
        return view('admutama.order.index', compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::where('level_id', 5 || 1 || 2)->orderBy("id", "DESC")->get();
        $food = Food::orderBy("id", "DESC")->get();
        return view('admutama.order.create', compact('user','food'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        $o = new Order;
        $barcode = rand(0, PHP_INT_MAX);
        $o->barcode = $barcode;
        $o->user_id = $r->input('user_id');
        $o->food_id = $r->input('food_id');
        $o->no_meja = $r->input('no_meja');
        $o->keterangan = $r->input('keterangan');
        $o->status = 0;
        $o->save();
    return redirect()->route("order.index")->with("alertStore", $r->input('no_meja'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, Order $order)
    {
        $o = Order::find($r->input('id'));
        $o->user_id = $r->input('user_id');
        $o->food_id = $r->input('food_id');
        $o->no_meja = $r->input('no_meja');
        $o->keterangan = $r->input('keterangan');
        $o->status = 0;
        $o->save();
        return redirect()->route("order.index")->with("alertUpdate", $r->input('no_meja'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect()->route("order.index")->with("alertDelete");
    }
}
