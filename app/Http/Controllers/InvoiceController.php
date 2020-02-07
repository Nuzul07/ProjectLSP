<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Checkout;
use App\Transaksi;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $checkouts = Checkout::where("user_id", \Auth::user()->id)->orderBy("id", "DESC")->get();
        return view("invoice.index", compact('checkouts'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $i = Checkout::where('kode_unik', $id)->first();
            $d['transaksi'] = Transaksi::where('user_id', \Auth::user()->id)->where("status", 0)->where('kode_unik', $i->kode_unik)->orderBy("id", "DESC")->get();
            $d['totalcart'] = Transaksi::where("user_id", \Auth::user()->id)->where("status", 0)->where('kode_unik', $i->kode_unik)->sum('total_bayar');
            $d['checkouts'] = Checkout::where('kode_unik', $id)->first();
            return view("invoice.show", $d);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function print(){
        $d['checkouts'] = Checkout::where("user_id", \Auth::user()->id)->orderBy("id", "DESC")->get();
        return view('invoice.print', $d);
    }
}
