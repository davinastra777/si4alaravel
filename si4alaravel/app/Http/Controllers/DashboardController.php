<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // cara 1 sql query

        $mahasiswaprodi = DB::select ('
        SELECT prodi.nama, COUNT(*) as jumlah 
        FROM mahasiswa
        JOIN prodi on mahasiswa.prodi_id = prodi_id
        group by prodi.nama');
        return view('dashboard.index', compact('mahasiswaprodi'));
    }
}
