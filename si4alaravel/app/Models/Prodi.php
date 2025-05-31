<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'prodi'; //nama tabel jika tidak sesuai dengan nama model

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'fakultas_id', 'id');
    }
    public function prodi()
    {
        return $this->hasMany(Mahasiswa::class, 'prodi_id', 'id');
    }
    public function matakuliah()
    {
        return $this->hasMany(MataKuliah::class);
    }

    protected $fillable = [
        'nama',
        'singkatan',
        'kaprodi',
        'sekretaris',
        'fakultas_id',
    ];
}
