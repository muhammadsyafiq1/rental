<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\User;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksis = Transaction::with(['user','rekening'])->get();

        return view('dashboard.transaksi.index', compact('transaksis'));
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

    public function TransaksiDiterima($id)
    {
        $transaksi = Transaction::with('user')->where('id' ,$id)->firstOrFail();
        $transaksi->status = 'diterima';

        $user  = User::where('id', $transaksi->user->id)->firstOrFail();
        $user->roles = 2;
        $user->status = 'aktif';

        $user->save();
        $transaksi->save();
        return redirect()->back()->with('status','Transfer diterima dan mitra sudah ditambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'bukti_bayar' => 'image'
        ]);

        $transaksi = new Transaction;
        $transaksi->lama_jadi_mitra = $request->lama_jadi_mitra;
        $transaksi->rekening_id = $request->rekening_id;
        $transaksi->total_bayar = $request->lama_jadi_mitra * 50000;
        $transaksi->bukti_bayar = $request->file('bukti_bayar')->store('bukti_bayar','public');
        $transaksi->user_id = \Auth::user()->id;
        $transaksi->status = 'pending';
        $transaksi->save();
        return redirect()->back()->with('status','Permintaan anda sedang diproses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
