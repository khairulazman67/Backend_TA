<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Pelanggaran;

class BerandaController extends Controller
{
    public function index(){
        $data = Pelanggaran::get();
        // dd($data);
        $jumlah = count($data);
        return view('beranda',['data'=>$data, 'jumlah'=>$jumlah]);
    }
}
