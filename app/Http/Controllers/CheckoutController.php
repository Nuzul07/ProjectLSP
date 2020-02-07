<?php

namespace App\Http\Controllers;

use App\Checkout;
use App\Transaksi;
use App\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi = Transaksi::where('user_id',\Auth::user()->id)->where('status', 1)->orderBy("id", "DESC")->get();
        $totalcart = Transaksi::where("user_id", \Auth::user()->id)->where("status", 1)->sum('total_bayar');
        return view('admutama.checkout.index', compact('transaksi','totalcart'));
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
        $d = new Checkout;
        $d->total = $request->input("total");
        $d->user_id = \Auth::user()->id;
        $d->bayar = $request->input("bayar");

        if($request->input('bayar') < $request->input('total')){
            return redirect()->route("checkout.index")->with('alertBlock', 'Bayar dengan uang yang sesuai harga!');
        }
        $d->kembalian = $request->input("bayar") - $request->input("total");
        $d->metode_pembayaran = $request->input("metode_pembayaran");

        $kode_unik = rand(0, PHP_INT_MAX);
        $d->kode_unik = $kode_unik;

        $d->save();

        Transaksi::where('user_id', \Auth::user()->id)->where("status", 1)->update(['kode_unik' => $kode_unik, 'status' => 0]);
        Order::where('user_id', \Auth::user()->id)->where("status", 0)->update(['status' => 1]);

        return redirect()->route("invoice.show", $kode_unik)->with("alertStore", $request->input("total"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function show(Checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function edit(Checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checkout $checkout)
    {
        //
    }
}
