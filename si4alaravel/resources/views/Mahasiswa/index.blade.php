@extends('layout.main')
@section('content')
<h1>Mahasiswa</h1>

<table>
    <tr>
        <th>npm</th>
        <th>nama</th>
        <th>jk</th>
        <th>tanggal_lahir</th>
        <th>tempat_lahir</th>
        <th>asal_sma</th>
        <th>prodi_id</th>
        <th>foto</th>
    </tr>
@foreach ($mahasiswa as $item)
    <tr>
    <td>{{  $item->npm }} </td>
    <td>{{  $item->nama }} </td>
    <td>{{  $item->jk }} </td>
    <td>{{  $item->tanggal_lahir }} </td>
    <td>{{  $item->tempat_lahir}} </td>
    <td>{{  $item->asal_sma}} </td>
    <td>{{  $item->prodi->nama}}</td>
    <td>{{  $item->foto}} </td>
</tr>

@endforeach
@endsection
</table>