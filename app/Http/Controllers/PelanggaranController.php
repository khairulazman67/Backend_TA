<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggaran;
use App\Models\PelanggaranDistance;

class PelanggaranController extends Controller
{
    function tgl_indo($tanggal){
        $bulan = array (
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun
        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
    function hari($hari){
        switch($hari){
            case 'Sun':
                $hari_ini = "Minggu";
            break;
            case 'Mon':
                $hari_ini = "Senin";
            break;
            case 'Tue':
                $hari_ini = "Selasa";
            break;
            case 'Wed':
                $hari_ini = "Rabu";
            break;
            case 'Thu':
                $hari_ini = "Kamis";
            break;
            case 'Fri':
                $hari_ini = "Jumat";
            break;
            case 'Sat':
                $hari_ini = "Sabtu";
            break;
            default:
                $hari_ini = "Tidak di ketahui";
            break;
        }
        return  $hari_ini ;
    }
    public function getDetail($data){
        $data = Pelanggaran::where('id','=',$data)->get();
        $tanggal = $this->tgl_indo($data[0]->created_at->format('Y-m-d'));
        $hari = $this->hari($data[0]->created_at->format('D'));
        // dd(auth()->user());
        if(auth()->user()){

            return view('detailPelanggaranUser',['data'=>$data,'tanggal'=>$tanggal,'hari'=>$hari]);
        }else{
            return view('detailPelanggaran',['data'=>$data,'tanggal'=>$tanggal,'hari'=>$hari]);
        }
    }
    public function getDetailDistance($data){
        $data = PelanggaranDistance::where('id','=',$data)->get();
        $tanggal = $this->tgl_indo($data[0]->created_at->format('Y-m-d'));
        $hari = $this->hari($data[0]->created_at->format('D'));
        // dd(auth()->user());
        if(auth()->user()){

            return view('detailPelanggaranDistance',['data'=>$data,'tanggal'=>$tanggal,'hari'=>$hari]);
        }else{
            return view('detailPelanggaranDistance',['data'=>$data,'tanggal'=>$tanggal,'hari'=>$hari]);
        }
    }
}
