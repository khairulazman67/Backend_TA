<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelanggaran extends Model
{
    // use HasFactory;
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    public function Mahasiswa(){
        return $this->belongsTo(Mahasiswa::class,'NIM','NIM');
    }
}
