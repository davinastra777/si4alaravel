<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // panggil model prodi menggunakan eloquent
        $prodi = Prodi::all();//perintah sql select * from prodi
        //dd($prodi);
        return view('prodi.index')->with('prodi', $prodi);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fakultas = Fakultas::all(); // mengambil semua data fakultas dari tabel fakultas
        return view('prodi.create', compact('fakultas')); // mengirimkan data fakultas ke view create
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validasi input
        $input = $request->validate(
[
                'nama' => 'required|unique:prodi',
                'singkatan' => 'required|max:5',
                'kaprodi' => 'required',
                'sekretaris' => 'required',
                'fakultas_id' => 'required',
            ]);

        //simpan data ke tabel fakultas
        Prodi::create($input);

        //redirect ke route fakultas.index
        return redirect()->route('prodi.index')
            ->with('success', 'Program Studi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Prodi $prodi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prodi $prodi)
    {
        //dd($prodi);
        $fakultas = Fakultas::all(); // mengambil semua data fakultas dari tabel fakultas
        return view('prodi.edit', compact('prodi', 'fakultas')); // mengirimkan data prodi dan fakultas ke view edit
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prodi $prodi)
    {
        //validasi input
        $input = $request->validate(
[
            'nama' => 'required',
            'singkatan' => 'required|max:5',
            'kaprodi' => 'required',
            'sekretaris' => 'required',
            'fakultas_id' => 'required',
        ]);

        //update data ke tabel prodi
        $prodi->update($input);
        //redirect ke route prodi.index
        return redirect()->route('prodi.index')->with('success', 'Program Studi berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prodi $prodi)
    {
        //
    }
}
