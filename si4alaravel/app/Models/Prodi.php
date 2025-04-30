<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'prodi';//nama tabel jika tidak sesuai dengan nama model

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class,'fakultas_id', 'id');
    }
}
