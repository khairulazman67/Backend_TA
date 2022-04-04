<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prodi extends Model
{
    // use HasFactory;
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    // public function Mahasiswa(){
    //     return $this->hasMany(Mahasiswa::class,'id_prodi');
    // }

    public function User(){
        return $this->hasMany(User::class,'id_prodi');
    }
    public function Kelas(){
        return $this->hasMany(Kelas::class,'id_prodi');
    }
}
