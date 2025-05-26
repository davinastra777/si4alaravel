<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // panggil model fakultas menggunakan eloquent
        $fakultas = Fakultas::all(); // perintah SQL select * from fakultas
        //dd($fakultas); //dump and die
        return view('fakultas.index', compact
        ('fakultas')); //selain compact bisa juga menggunakan with()
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fakultas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validasi input
        $input = $request->validate(
            [
                'nama' => 'required|
                unique:fakultas',
                'singkatan' => 'required|max:5',
                'dekan' => 'required',
                'wakil_dekan' => 'required',
            ]);

        //simpan data ke tabel fakultas
        Fakultas::create($input);

        //redirect ke route fakultas.index
        return redirect()->route('fakultas.index')
            ->with('success', 'Fakultas berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fakultas  $fakultas
     * @return \Illuminate\Http\Response
     */
    public function show(Fakultas $fakultas)
    {
        $fakultas = Fakultas::findorfail($fakultas);
        //dd($fakultas); 
        return view('fakultas.show', compact('fakultas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fakultas  $fakultas
     * @return \Illuminate\Http\Response
     */
    public function edit($fakultas)
    {
        $fakultas = Fakultas::findorfail($fakultas);
        //dd($fakultas);
        return view('fakultas.edit', compact('fakultas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fakultas  $fakultas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $fakultas)
    {
        
        $fakultas = Fakultas::findorfail($fakultas);
        //validasi input
        $input = $request->validate(
            [
                'nama' => 'required',
                'singkatan' => 'required|max:5',
                'dekan' => 'required',
                'wakil_dekan' => 'required',
            ]);

            //update data fakultas
        $fakultas->update($input);
        //redirect ke route fakultas.index
        return redirect()->route('fakultas.index')
            ->with('success', 'Fakultas berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fakultas  $fakultas
     * @return \Illuminate\Http\Response
     */
    public function destroy($fakultas)
    {
        $fakultas = Fakultas::findorfail($fakultas);
        //dd($fakultas);


        //hapus data fakultas
        $fakultas->delete();

        //redirect ke route fakultas.index
        return redirect()->route('fakultas.index')
            ->with('success', 'Fakultas berhasil dihapus');
    }
}