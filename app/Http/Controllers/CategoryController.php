<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.category.index' ,compact(['categories']));
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
            'kategori_mobil' => 'required|unique:categories|max:50',
            'deskripsi_kategori' => 'required',
            'icon_kategori' => 'required|image'
        ]);
        $data = $request->all();
        $data['kategori_slug_mobil'] = \Str::slug($request->nama_kategori);
        $data['icon_kategori'] = $request->file('icon_kategori')->store('icon_kategoris','public');
        Category::create($data);
        return redirect()->back()->with('status','Kategori berhasil ditambahkan');
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
            'icon_kategori' => 'nullable|image',
            'kategori_mobil' => 'required|max:50',
            'deskripsi_kategori' => 'required',
        ]);

        $category = Category::findOrFail($id);
        $category->kategori_mobil = $request->kategori_mobil;
        $category->deskripsi_kategori = $request->deskripsi_kategori;
        $category->kategori_slug_mobil = \Str::slug($request->kategori_mobil);

        if($request->hasFile('icon_kategori')){
            if($request->icon_kategori && file_exists(storage_path('app/public/'.$request->icon_kategori))){
                Storage::delete('public/'.$request->icon_kategori);
            }
            $file = $request->file('icon_kategori')->store('icon_kategoris','public');
            $category->icon_kategori = $file;
        } 
        $category->save();
        return redirect()->back()->with('status','Kategori berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Category::findOrFail($id);
        $item->delete();
         return redirect()->back()->with('status','Kategori berhasil dihapus');
    }
}
