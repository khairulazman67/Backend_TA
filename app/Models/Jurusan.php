<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    // use HasFactory;
    // protected $hidden = [
    //     'created_at',
    //     'updated_at'
    // ];
    protected $table="jurusans";
    protected $fillable = [
        'nm_jurusan',
        'created_at',
        'updated_at',
    ]; 
    public function Prodi(){
        return $this->hasMany(Prodi::class,'id_jurusan');
    }
}
