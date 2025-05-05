@extends('layout.main')
@section('content')
<h1>Mahasiswa</h1>
@foreach ($mahasiswa as $item)
    {{ $item->npm }} | 
    {{ $item->nama }} | 
    {{ $item->fakultas ? $item->fakultas->nama : 'Fakultas tidak tersedia' }} |
    <br>
@endforeach
@endsection
