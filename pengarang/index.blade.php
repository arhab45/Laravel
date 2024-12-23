@extends('adminlte::page')
@section('title', 'Data Pengarang')
@section('content_header')
<h1><i class="fa fa-user">Data Pengarang</i></h1>
@stop
@section('content')
@if (session('success'))
    <div class="alert alert-info">
        {{session('success')}}

    </div>
@endif
@php
    $ar_judul = ['No', 'Nama', 'Email', 'HP', 'Foto'];
    $no = 1;
@endphp
<a class="btn btn-info btn-md" href="{{ route('pengarang.create') }}" role="button"><i class="fa fa-plus">Tambah Mahasantri</i></a>
<br/><br/>
<table class="table table-striped">
    <thead>
        <tr>
            @foreach ($ar_judul as $jdl)
                <th>{{ $jdl }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($ar_pengarang as $pg)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $pg->nama }}</td>
                <td>{{ $pg->email }}</td>
                <td>{{ $pg->hp }}</td>
                <td>{{ $pg->foto }}</td>
                
                <td>
                    <form action="{{ route('pengarang.destroy',$pg->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <a href="{{ route('pengarang.show',$pg->id) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                        <a href="{{ route('pengarang.edit',$pg->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                        <button class="btn btn-danger" onclick="return confirm('Anda Yakin Data Dihapus?')"> <i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@stop
@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
<script> console.log('Hi!'); </script>
@stop