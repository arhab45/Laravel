@extends('adminlte::page')  
@section('tittle', 'Detail Pengarang')
@section('content_header')
     <h1>Detail Pengarang</h1>
@stop
@section('content') {{-- isi konten Detail Pengarang --}}


@foreach($ar_pengarang AS $p)
<form>
@csrf
{{-- cross-site request forgery (CSRF) = pencegahan serangan yang dilakukan
oleh pengguna yang tidak terautentifikasi --}}
<div class="form-group">
    <label>Nama</label><input type="text" placeholder="{{ $p->nama }}" class="form-control" disabled/>
</div>
<div class="form-group">
    <label>Email</label><input type="text" placeholder="{{ $p->email }}" class="form-control" disabled/>
</div>
<div class="form-group">
    <label>HP</label><input type="text" placeholder="{{ $p->hp }}" class="form-control" disabled/>
</div>
<div class="form-group">
    <label>Foto</label><input type="text" placeholder="{{ $p->foto }}" class="form-control" disabled/>
</div>

<br/>
<a href="{{ route('pengarang.index') }}" class="btn btn-primary btn-md" role="button" ><i class="fa fa-arrow-left"> Back</i></a>
</form>
@endforeach
@stop
@section('css')
     <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
     <script> console.log('Hi!'); </script>
@stop