<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\anggota;
class AnggotaController extends Controller
{
    //
    public function index()
    {
        $ar_anggota = DB::table('anggota')->get();
        return view('anggota.index',compact('ar_anggota'));
    }
    //Function Menambahkan
    public function create()
    {
        //Mengarahkan ke halaman form
        return view('anggota.form');
    }

    //Validasi data
    public function store(Request $request)
    {
        //Validasi Uploadd
        if(!empty($request->foto)){
            $request->validate([
            'foto' => 'image|mimes:jpg,jpeg,png,giff|max:2048',
            ]);
            $fileName = $request->nama.'.'.$request->foto->extension();
            $request->foto->move(public_path('images'), $fileName);
            }else{
            $fileName = '';
            }
        //1. proses validasi data
        // $validasi = $request->validate(
        //     [
        //         'nip' => 'required|unique:anggota|numeric',
        //         'nama' => 'required|max:50',
        //         'alamat' => 'required',
        //         'email' => 'required|max:50|regex:/(.+)@(.+)\.(.+)/i',
        //     ],
        //     //2.Menampilkan pesan kesalahan
        //     [
        //         'nip.required' => 'NIP Wajib di Isi',
        //         'nip.unique' => 'NIP Tidak Boleh Sama',
        //         'nip.numeric' => 'Harus Berupa Angka',
        //         'nama.required' => 'Nama Wajib di Isi',
        //         'alamat.required' => 'Alamat Wajib di Isi',
        //         'email.required' => 'Email Wajib di Isi',
        //         'email.regex' => 'Harus berformat email',
        //     ],
        // );
        //3.tangkap data
        DB::table('anggota')->insert(
            [
                'nip' => $request->nip,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'foto' => $fileName,
            ]
        );
        //4.setelah input data, arahkan ke/pegawai
        return redirect()->route('anggota.index')->with('success','Data anggota berhasil ditambahkan');
    }
}
