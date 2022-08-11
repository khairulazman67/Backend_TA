<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelanggaranDistance extends Model
{
    // use HasFactory;
    protected $table = 'pelanggaran_distances';
    protected $hidden = [
        'updated_at'
    ];
}
