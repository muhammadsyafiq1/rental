<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bank;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('dashboard.admin.list-user',compact(['users']));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('dashboard.profile.index', compact(['user']));
    }

    public function settingProfile()
    {
        $user = Auth::user();
        return view('dashboard.profile.setting-profile', compact(['user']));
    }

    public function gantiPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = User::findOrFail(Auth::user()->id);
        $user->password = \Hash::make($request->password);
        $user->save();
        return redirect()->back()->with('status','Password berhasil diubah');
    }

    public function daftarMitra(Request $request, $id)
    {
        $rekenings = Bank::all();
        return view('dashboard.daftar-mitra.index', compact('rekenings'));
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
        // dd($request->all()); die;
        $request->validate([
            'name' => 'required|min:4',
            'phone' => 'required|max:13',
            'address' => 'required|max:100|min:3',
            'avatar' => 'image|nullable'
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        if($request->hasFile('avatar')){
            if($request->avatar && file_exists(storage_path('app/public/'.$request->avatar))){
                Storage::delete('public/'.$request->avatar);
            }
            $file = $request->file('avatar')->store('avatars','public');
            $user->avatar = $file;
        } 
        if($request->hasFile('photo_ktp')){
            if($request->photo_ktp && file_exists(storage_path('app/public/'.$request->photo_ktp))){
                Storage::delete('public/'.$request->photo_ktp);
            }
            $file = $request->file('photo_ktp')->store('photo_ktps','public');
            $user->photo_ktp = $file;
        } 
        $user->save();
        return redirect()->back()->with('status','Profile berhasil diubah');
    }

    public function aktifkan($id)
    {
        $user = User::findOrfail($id);
        $user->status = 'aktif';
        $user->save();
        return redirect()->back()->with('status','user berhasil diaktifkan');
    }

    public function nonaktifkan($id)
    {
        $user = User::findOrfail($id);
        $user->status = 'nonaktif';
        $user->save();
        return redirect()->back()->with('status','user berhasil dinonaktifkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrfail($id);
        $user->delete();
        return redirect()->back()->with('status','Pengguna berhasil dihapus!');
    }
}
