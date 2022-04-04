<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mahasiswa extends Model
{
    // use HasFactory;
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    // public function Jurusan(){
    //     return $this->belongsTo(Jurusan::class,'id_jurusan','id');
    // }
    // public function Prodi(){
    //     return $this->belongsTo(Jurusan::class,'id_prodi','id');
    // }
    public function Kelas(){
        return $this->belongsTo(Kelas::class,'id_kelas','id');
    }
    
    public function Pelanggaran(){
        return $this->hasMany(Kelas::class,'NIM');
    }
    
    

}
