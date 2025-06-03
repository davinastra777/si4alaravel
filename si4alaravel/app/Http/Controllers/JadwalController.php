<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Matakuliah;
use App\Models\Sesi;
use App\Models\User;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwal = Jadwal::all();
        return view('jadwal.index', compact('jadwal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $matakuliah = matakuliah::all();
        $sesi = Sesi::all();
        $users = User::where('role', 'dosen')->get();
        return view('jadwal.create',compact('matakuliah', 'sesi', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $input = $request->validate(
            [
                'tahun_akademik' => 'required',
                'kode_smt' => 'required',
                'kelas' => 'required',
                'matakuliah_id' => 'required',
                'sesi_id' => 'required',
                'dosen_id' => 'required'
            ]);

        //simpan data ke tabel fakultas
        jadwal::create($input);

        //redirect ke route fakultas.index
        return redirect()->route('jadwal.index')
            ->with('success', 'Jadwal berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show( $jadwal)
    {
        $jadwal = jadwal::findOrFail($jadwal);
        return view('jadwal.show', compact('jadwal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(jadwal $jadwal)
    {
        $matakuliah = Matakuliah::all();
        $sesi = Sesi::all();
        $users = User::where('role', 'dosen')->get(); 
        return view('jadwal.edit', compact('jadwal', 'matakuliah', 'sesi', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, jadwal $jadwal)
    {
        $input = $request->validate(
            [
                'tahun_akademik' => 'required',
                'kode_smt' => 'required',
                'kelas' => 'required',
                'matakuliah_id' => 'required',
                'sesi_id' => 'required',
                'dosen_id' => 'required'
            ]);

        //update data ke tabel jadwal
        $jadwal->update($input);

        //redirect ke route jadwal.index
        return redirect()->route('jadwal.index')
            ->with('success', 'Jadwal berhasil diperbarui');  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $jadwal)
    {
        $jadwal = Jadwal::findOrFail($jadwal);
        //hapus data jadwal
        $jadwal->delete();

        //redirect ke route jadwal.index
        return redirect()->route('jadwal.index')
            ->with('success', 'Jadwal berhasil dihapus');
    }
}