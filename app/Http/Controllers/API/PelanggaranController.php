<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Kelas;
use App\Models\Pelanggaran;
use App\Models\Mahasiswa;
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
        date_default_timezone_set('Asia/Jakarta');
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
        $jam = null;
        $menit = null;
        $data = Pelanggaran::where('NIM','=',$request->NIM)->orderBy('id','desc')->first();
        if($data){
            $waktu_awal = $data->created_at->format("Y-m-d H:i:s");
            $waktu_akhir = date("Y-m-d H:i:s");
            $awal   = strtotime($data->created_at->format("Y-m-d H:i:s"));
            $akhir  = strtotime(date("Y-m-d H:i:s")); // bisa juga waktu sekarang now()
            
            // $awal  = strtotime('2017-08-10 10:05:25');
            // $akhir = strtotime('2017-08-11 11:07:33');
            $diff  = $akhir - $awal;

            // $hari = floor($diff / (60 * 60 * 24));
            $jam   = floor($diff / (60 * 60));
            $menit = $diff - ( $jam * (60 * 60) );
            $detik = $diff % 60;
        }else{
            $data =null;
        }
        
        // return response()->json(
        //     [
        //         "data" => $data
        //     ],
        //     200
        // );

        
        
        if(($jam>=0 && floor( $menit / 60 ) >=1) || $data===null){
            $pelanggaran = new Pelanggaran;
            $pelanggaran->NIM = $request->NIM;
            $pelanggaran->bukti = $request->bukti;
            $pelanggaran->save();


            if($pelanggaran){
                return ResponseFormatter::success($pelanggaran  ,'data Berhasil diinput');
            }
        }else{
            return ResponseFormatter::error(null,'Waktu belum mencukupi',403);
        }
        
    }
    public function getDataMahasiswa(){
        $data = Mahasiswa::get();
        if($data){
            return ResponseFormatter::success($data  ,'data berhasil didapat');
        }
    }
}
