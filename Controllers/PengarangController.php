<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class PengarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $ar_pengarang = DB::table('pengarang')->get();
      
    return view('pengarang.index', compact('ar_pengarang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pengarang.c_pengarang');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate(
            [
               'nama'=>'required|unique:pengarang',
               'email'=>'required|max:50|regex:/(.+)@(.+)\.(.+)/i',
               'hp'=>'required|max:50',
               'foto'=>'required|max:50',
             ],
        
             //2. menampilkan pesan kesalahan
             [
               'nama.required'=>'Nama Wajib di Isi',
               'nama.unique'=>'Nama tidak Boleh Sama',
               'email.required'=>'Email Wajib di Isi',
               'email.regex'=>'Harus Berformat Email',
               'hp.required'=>'HP Wajib di Isi',
               'foto.required'=>'Foto Wajib di Isi',
        
             ],
         );
         
         
         DB::table('pengarang')->insert(
            [
               'nama'=>$request->nama,
               'email'=>$request->email,
               'hp'=>$request->hp,
               'foto'=>$request->foto,
            ] );
        return redirect()->route('pengarang.index')->with('success', 'Data Pengarang berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $ar_pengarang = DB::table('pengarang')->where('pengarang.id','=',$id)->get();
     //arahkan data ke view pengarang
        return view('pengarang.show',compact('ar_pengarang'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = DB::table('pengarang')->where('id','=',$id)->get();
        return view('pengarang.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        DB::table('pengarang')->where('id','=',$id)->update(
            [
               'nama'=>$request->nama,
               'email'=>$request->email,
               'hp'=>$request->hp,  
               'foto'=>$request->foto,
            ] );
            return redirect('/pengarang');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        DB::table('pengarang')->where('id',$id)->delete();
        return redirect('/pengarang');
    }
}
