<?php

namespace App\Http\Controllers;

use App\Transaksi;
use App\Food;
use App\Order;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $food = Food::orderBy("nama", "ASC")->get();
        $order = Order::orderBy("id", "DESC")->get();
        $transaksi = Transaksi::where('user_id',\Auth::user()->id)->where('status', 1)->orderBy("id", "DESC")->get();
        $totalcart = Transaksi::where("user_id", \Auth::user()->id)->where("status", 1)->sum('total_bayar');
        return view('admutama.transaksi.index', compact('food','order','transaksi','totalcart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $h = Food::find($request->input("food_id"));

        $d = new Transaksi;
        $d->food_id = $request->input("food_id");
        $d->order_id = $request->input('order_id');

        if($request->input("jumlah") < 1){
            return redirect()->route("transaksi.index")->with("alertBlock", "Masukkan jumlah barang yang ingin Anda beli!");
        }
        $d->jumlah = $request->input("jumlah");
        $d->user_id = \Auth::user()->id;


        $d->total_bayar = $request->input("jumlah") * $h->harga;
        $d->status = 1;
        $d->kode_unik = rand(0, PHP_INT_MAX);

        $d->save();

        return redirect()->route("transaksi.index")->with("alertStore", $request->input("food_id"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $d = Transaksi::find($id);
        $d->delete();

        return redirect()->route("transaksi.index");
    }

    public function transaksiClean()
    {
        Transaksi::where('user_id', \Auth::user()->id)->where('status', 1)->delete();

        return redirect()->route("transaksi.index");
    }
}
