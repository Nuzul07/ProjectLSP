<?php

namespace App\Http\Controllers;

use App\OrderDetails;
use App\Order;
use App\Food;
use Illuminate\Http\Request;

class OrderDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dorder = OrderDetails::orderBy("id", "DESC")->get();
        return view('admutama.detailorder.index',compact('dorder'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $order = Order::orderBy("id", "DESC")->get();
        $food = Food::orderBy("id", "DESC")->get();
        return view('admutama.detailorder.create', compact('order','food'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        $do = new OrderDetails;
        $do->order_id = $r->input('order_id');
        $do->food_id = $r->input('food_id');
        $do->keterangan = $r->input('keterangan');
        $do->status = 0;
        $do->save();
        return redirect()->route("orderdetail.index")->with("alertStore", $r->input('order_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrderDetails  $orderDetails
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrderDetails  $orderDetails
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dorder = Order::find($id);
        return view('admutama.detailorder.edit', compact('dorder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrderDetails  $orderDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r)
    {
        $do = OrderDetails::find($r->input('id'));
        $do->order_id = $r->input('order_id');
        $do->food_id = $r->input('food_id');
        $do->keterangan = $r->input('keterangan');
        $do->status = 0;
        $do->save();
        return redirect()->route("orderdetail.index")->with("alertUpdate", $r->input('order_id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrderDetails  $orderDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dorder = OrderDetails::find($id);
        $dorder->delete();
        return redirect()->route("orderdetail.index");
    }
}
