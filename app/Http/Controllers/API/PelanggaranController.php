<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Kelas;
use App\Models\Pelanggaran;
use GrahamCampbell\ResultType\Success;

class PelanggaranController extends Controller
{
    public function dataKelas(){
        $data = Kelas::orderBy('id')->get();

        if($data){
            return ResponseFormatter::success($data,'Data Berhasil Diambil');
        }else{
            return ResponseFormatter::error(null,'Data Order Tidak Ada',404);
        }
    }

    public function inputPelanggaran(Request $request){
        $val = Validator::make(
            $request->all(),
            [
                'NIM' => 'required',
                'bukti' => 'required'
            ]
        );

        if ($val->fails()) {
            return ResponseFormatter::error(null,'Data Tidak Lengkap',403);
        }
        
        $pelanggaran = new Pelanggaran;
        $pelanggaran->NIM = $request->NIM;
        $pelanggaran->bukti = $request->bukti;
        $pelanggaran->save();

        if($pelanggaran){
            return ResponseFormatter::success($pelanggaran,'data Berhasil diinput');
        }
    }
}
