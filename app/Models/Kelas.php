<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    // use HasFactory;
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    public function Mahasiswa(){
        return $this->hasMany(Mahasiswa::class,'id_prodi');
    }
    public function Prodi(){
        return $this->belongsTo(Prodi::class,'id_prodi','id');
    }
}
