<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\MahasantriController;

use App\Models\anggota;
use App\Models\pegawai;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\pegawaiController;
use App\Http\Controllers\anggotaController;

use App\Http\Controllers\PengarangController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/salam', function () {
    return "Assalamu'alaikum, Selamat Belajar Laravel peTIK Jombang Angkatan III";
});

//Routing Parameter
Route::get('/pegawai/{nama}/{divisi}', function ($nama,$divisi) {
    return 'Nama Pegawai : '.$nama.'<br/>Departemen : '.$divisi;
});

//routing view kondisi
Route::get('/kabar', function () {
    return view('Kondisi');
});
//routing Data Santri
Route::get('/santri', [SantriController::class, 'dataSantri']
);

//routing view hello
Route::get('/hello', function () {
    return view('hello', ['name' => 'Inaya']);
});

//routing view Nilai
Route::get('/nilai', function () {
    return view('nilai');
});

//routing view daftar_Nilai
Route::get('/daftarNilai', function () {
    return view('daftar_nilai');
});

//Tambahkan route baru di routes/web.php
Route::get('/phpframework', function ()
{ return view('layouts.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//routing view Nilai
Route::get('/pegawai', [pegawaiController::class,'index'])->name('pegawai.index');
Route::get('/pegawai/create', [pegawaiController::class,'create'])->name('pegawai.create');
Route::post('/pegawai', [pegawaiController::class,'store'])->name('pegawai.store');

Route::get('/anggota', [anggotaController::class,'index'])->name('anggota.index');
Route::get('/anggota/create', [anggotaController::class,'create'])->name('anggota.create');
Route::post('/anggota', [anggotaController::class,'store'])->name('anggota.store');
Route::resource('anggota', AnggotaController::class);

Route::resource('pengarang', PengarangController::class);
Route::resource('penerbit', PenerbitController::class);
Route::resource('kategori', KategoriController::class);
Route::resource('buku', BukuController::class);



Route::resource('dosen', DosenController::class);
Route::resource('matakuliah', MatakuliahController::class);
Route::resource('jurusan', JurusanController::class);
Route::resource('mahasantri', MahasantriController::class);

Route::get('bukupdf',[BukuController::class, 'bukuPdf']);

Route::get('bukucsv',[BukuController::class,'bukucsv']);

 