@extends('adminlte::page')  
@section('tittle', 'Edit Pengarang')
@section('content_header')
     <h1>Edit Pengarang</h1>
@stop
@section('content') {{-- isi konten Edit Pengarang --}}


@foreach($data AS $d)
<form action="{{ route('pengarang.update',$d->id) }}" method="POST">
@csrf
@method('put')
{{-- cross-site request forgery (CSRF) = pencegahan serangan yang dilakukan
oleh pengguna yang tidak terautentifikasi --}}
<div class="form-group">
    <label>Nama</label><input type="text" name="nama" value="{{ $d->nama }}" class="form-control"/>
</div>
<div class="form-group">
    <label>Email</label><input type="text" name="email" value="{{ $d->email }}" class="form-control"/>
</div>
<div class="form-group">
    <label>HP</label><input type="text" name="hp" value="{{ $d->hp }}" class="form-control"/>
</div>
<div class="form-group">
    <label>Foto</label><input type="text" name="foto" value="{{ $d->foto }}" class="form-control"/>
</div>

<br/>
<a href="{{ route('pengarang.index') }}" class="btn btn-primary btn-md" role="button" ><i class="fa fa-arrow-left"> Back</i></a>
<button type="submit" class="btn btn-primary"> Update</button>
</form>
@endforeach
@stop
@section('css')
     <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
     <script> console.log('Hi!'); </script>
@stop