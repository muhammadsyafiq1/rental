<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fasilitas;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fasilitas = Fasilitas::all();
        return view('dashboard.fasilitas.index', compact(['fasilitas']));
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
            'icon_fasilitas' => 'required|image',
            'nama_fasilitas' => 'required|max:20|unique:fasilitas',
        ]);

        $data = $request->all();
        $data['icon_fasilitas'] = $request->file('icon_fasilitas')->store('fasilitas','public');
        Fasilitas::create($data);
        return redirect()->back()->with('status','Fasilitas berhasil ditambah');
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
            'icon_fasilitas' => 'nullable|image',
            'nama_fasilitas' => 'required|max:50',
        ]);

        $fasilitas = Fasilitas::findOrFail($id);
        $fasilitas->nama_fasilitas = $request->nama_fasilitas;

        if($request->hasFile('icon_fasilitas')){
            if($request->icon_fasilitas && file_exists(storage_path('app/public/'.$request->icon_fasilitas))){
                Storage::delete('public/'.$request->icon_fasilitas);
            }
            $file = $request->file('icon_fasilitas')->store('icon_fasilitas','public');
            $fasilitas->icon_fasilitas = $file;
        } 
        $fasilitas->save();
        return redirect()->back()->with('status','Fasilitas berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Fasilitas::findOrFail($id);
        $item->delete();
        return redirect()->back()->with('status','Fasilitas berhasil dihapus');
    }
}
