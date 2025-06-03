<?php
 
namespace App\Http\Controllers;
 
use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Http\Request;
 
class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::all(); // Ambil semua data mahasiswa
        return view('mahasiswa.index', compact('mahasiswa'));
 
    }
 
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $prodi = Prodi::all(); // ambil semua data prodi
        return view('mahasiswa.create',compact('prodi'));// mengirimkan data prodi ke view mahasiswa.create
    }
 
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate(
[
            'npm' => 'required|unique:mahasiswa',
            'nama' => 'required',
            'jk' => 'required',
            'tanggal_lahir' => 'required',
            'tempat_lahir' => 'required',
            'asal_sma' => 'required',
            'prodi_id' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
 
        //upload foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $input['foto'] = $filename;
        } else {
            $input['foto'] = 'default.jpg'; // default image
        }
 
        //simpan data ke tabel mahasiswa
        Mahasiswa::create($input);
 
        //redirect ke route mahasiswa.index
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa berhasil ditambahkan');
    }
 
    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //dd($mahasiswa);
        return view('mahasiswa.show', compact('mahasiswa'));
    }
 
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        //dd($mahasiswa);
        $prodi = Prodi::all(); // ambil semua data prodi
        return view('mahasiswa.edit', compact('mahasiswa', 'prodi')); // mengirimkan data mahasiswa dan prodi ke view mahasiswa.edit
    }
 
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $input = $request->validate(
            [
                'npm' => 'required|unique:mahasiswa,npm,' . $mahasiswa->id,
                'nama' => 'required',
                'jk' => 'required',
                'tanggal_lahir' => 'required',
                'tempat_lahir' => 'required',
                'asal_sma' => 'required',
                'prodi_id' => 'required',

            ]);
            
            $mahasiswa->update($input);

            return redirect()->route('mahasiswa.index')
                ->with('success', 'Mahasiswa berhasil diupdate');
    }
 
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($mahasiswa)
    {
        $mahasiswa = Mahasiswa ::findOrFail($mahasiswa);
        //dd($mahasiswa);
        //hapus foto jika ada
        if($mahasiswa->foto){
            $fotoPath = public_path('images/', $mahasiswa->foto);
            if (file_exists($fotoPath)){
                unlink(($fotoPath)); //hapus file foto
            }
        }
        //hapus data Mahasiswa
        $mahasiswa -> delete();
        //redirect ke route mahasiswa index
        return redirect()->route('mahasiswa.index')->with('success','Mahasiswa berhasil dihapus');
    }
}