@extends('adminlte::page')  
@section('tittle', 'Form Pengarang')
@section('content_header')
     <h1><i class="fa fa-plus">Form Pengarang</i></h1>
@stop
@section('content') {{-- isi konten form Pengarang --}}

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li> {{ $error }} </li>
        @endforeach
    </ul>
</div>
@endif


<form method="POST" action="{{ route('pengarang.store') }}">
@csrf
{{-- cross-site request forgery (CSRF) = pencegahan serangan yang dilakukan
oleh pengguna yang tidak terautentifikasi --}}
<div class="form-group">
    <label>Nama</label><input type="text" name="nama" class="form-control"/>
</div>
<div class="form-group">
    <label>Email</label><input type="email" name="email" class="form-control"/>
</div>
<div class="form-group">
    <label>HP</label><input type="text" name="hp" class="form-control"/>
</div>
<div class="form-group">
    <label>Foto</label><input type="text" name="foto" class="form-control"/>
</div>


<br/>
<a href="{{ route('pengarang.index') }}" class="btn btn-primary btn-md" role="button" ><i class="fa fa-arrow-left"> Back</i></a>
<button type="submit" class="btn btn-primary"> Simpan</button>
</form>
@stop
@section('css')
     <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
     <script> console.log('Hi!'); </script>
@stop