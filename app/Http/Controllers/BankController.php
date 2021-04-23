<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = Bank::all();
        return view('dashboard.bank.index' ,compact(['banks']));
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
        $request->validate([
            'nama_bank' => 'required|min:2',
            'nomor_rekening' => 'required|unique:banks',
            'atas_nama' => 'required|min:3'
        ]);


        $data = $request->all();
        Bank::create($data);
        return redirect()->back()->with('status','Rekening anda berhasil didaftarkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $request->validate([
        'nama_bank' => 'required|min:2',
        'nomor_rekening' => 'required',
        'atas_nama' => 'required|min:3'
        ]);

        $data = $request->all();
        $row = Bank::findOrFail($id);
        $row->update($data);
        return redirect()->back()->with('status','Rekening anda berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Bank::findOrFail($id);
        $item->delete();
         return redirect()->back()->with('status','Rekening anda berhasil dihapus');
    }
}
