<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\Buku;
use PDF;


class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $ar_buku = DB::table('buku') //join tabel dengan Query Builder Laravel
            ->join('pengarang', 'pengarang.id', '=', 'buku.idpengarang')
            ->join('penerbit', 'penerbit.id', '=', 'buku.idpenerbit')
            ->join('kategori', 'kategori.id', '=', 'buku.idkategori')
            ->select(
                'buku.*',
                'pengarang.nama',
                'penerbit.nama AS pen',
                'kategori.nama AS kat'
            )->get();
        return view('buku.index', compact('ar_buku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('buku.c_buku');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //1.Proses validasi data
        $validasi = $request->validate(
            [
                'isbn' => 'required|unique:buku|numeric',
                'judul' => 'required|max:100',
                'tahun_cetak' => 'required|numeric',
                'stok' => 'required',
                'idpengarang' => 'required',
                'idpenerbit' => 'required',
                'idkategori' => 'required',
            ],
            //2.Menampilkan pesan kesalahan
            [
                'isbn.required' => 'NIP Wajib di Isi',
                'isbn.unique' => 'NIP Tidak Boleh Sama',
                'isbn.numeric' => 'Harus Berupa Angka',
                'judul.required' => 'Judul Wajib di Isi',
                'tahun_cetak.required' => 'Tahun_cetak Wajib di Isi',
                'stok.required' => 'Stok Wajib di Isi',
                'idpengarang.required' => 'Pengarang Wajib di Isi',
                'idpenerbit.required' => 'Penerbit Wajib di Isi',
                'idkategori.required' => 'Kategori Wajib di Isi',
            ],

        );
        DB::table('buku')->insert(
            [
                'isbn' => $request->isbn,
                'judul' => $request->judul,
                'tahun_cetak' => $request->tahun_cetak,
                'stok' => $request->stok,
                'idpengarang' => $request->idpengarang,
                'idpenerbit' => $request->idpenerbit,
                'idkategori' => $request->idkategori,
            ]
        );
        return redirect()->route('buku.index')->with('success', 'Data Buku berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //Menampilkan Detail Buku
        $ar_buku = DB::table('buku') 
        ->join('pengarang', 'pengarang.id', '=', 'buku.idpengarang')
        ->join('penerbit', 'penerbit.id', '=', 'buku.idpenerbit')
        ->join('kategori', 'kategori.id', '=', 'buku.idkategori')
        ->select('buku.*', 'pengarang.nama', 'penerbit.nama AS pen',
        'kategori.nama AS kat')
        ->where('buku.id','=',$id)->get();

        return view('buku.show',compact('ar_buku'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //Mengarahkan ke halaman form edit
        $data = DB::table('buku')->where('id','=',$id)->get();

        return view('buku.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        DB::table('buku')->where('id','=',$id)->update(
            [
                'isbn'=>$request->isbn,
                'judul'=>$request->judul,
                'tahun_cetak'=>$request->tahun_cetak,
                'stok'=>$request->stok,
                'idpengarang'=>$request->idpengarang,
                'idpenerbit'=>$request->idpenerbit,
                'idkategori'=>$request->idkategori,
            ]
        );
        return redirect('/buku');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //Hapus Data
        DB::table('buku')->where('id',$id)->delete();
        return redirect('/buku');

    }

    public function bukuPDF()
    {
        //
        $ar_buku = DB::table('buku') //join tabel dengan Query Builder Laravel
            ->join('pengarang', 'pengarang.id', '=', 'buku.idpengarang')
            ->join('penerbit', 'penerbit.id', '=', 'buku.idpenerbit')
            ->join('kategori', 'kategori.id', '=', 'buku.idkategori')
            ->select('buku.*','pengarang.nama','penerbit.nama AS pen',
            'kategori.nama AS kat')->get();
            $pdf = PDF::loadView('buku/bukuPDF',['ar_buku'=>$ar_buku]);
            return $pdf->download('dataBuku.pdf');

    }

}
