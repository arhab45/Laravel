<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\Controllers;

class MahasantriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $ar_mahasantri = DB::table('mahasantri')
        ->join('dosen', 'dosen.id', '=', 'mahasantri.dosen_id')
        ->join('matakuliah', 'matakuliah.id', '=', 'dosen.matakuliah_id')
        ->join('jurusan', 'jurusan.id', '=', 'mahasantri.jurusan_id')
        ->select('mahasantri.*', 'jurusan.nama AS jrs','dosen.nama AS dp','matakuliah.nama AS mk'
        )->get();
    return view('mahasantri.index', compact('ar_mahasantri'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('mahasantri.c_mahasantri');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        DB::table('mahasantri')->insert(
            [
                'nama' => $request->nama,
                'nim' => $request->nim,
                'jurusan_id' => $request->jurusan_id,
                'matakuliah_id' => $request->matakuliah_id,
                'dosen_id' => $request->dosen_id,

            ]
            );
            return redirect()->route('mahasantri.index');
        }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
