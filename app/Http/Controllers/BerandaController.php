<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Pelanggaran;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Validator;

class BerandaController extends Controller
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
    public function index(){
        $tanggal = null;
        $hari = null;
        $data = Pelanggaran::orderBy('created_at','desc')->paginate(10);
        // dd($data);
        $jumlah = count($data);
        if($jumlah>0){
            $tanggal = $this->tgl_indo($data[0]->created_at->format('Y-m-d'));
            $hari = $this->hari($data[0]->created_at->format('D'));
        }
        return view('beranda',['data'=>$data, 'jumlah'=>$jumlah,'tanggal'=>$tanggal,'hari'=>$hari]);
    }
    public function cariPelanggar(Request $request){
        $val = Validator::make(
            $request->all(),
            [
                'keyword' => 'required',
            ]
        );
        $datajumlah = Pelanggaran::orderBy('created_at','desc')->paginate(10);
        $jumlah = count($datajumlah);
    
        $dataNIM = null;
        $NIM1 = Mahasiswa::where('nama','like','%'.$request->keyword.'%')->first();
        if($NIM1){
            $dataNIM=$NIM1->NIM;
        }else{
            $dataNIM=null;
        }
        
        $data = Pelanggaran::where('NIM', $request->keyword)
        ->orWhere('bukti', $request->keyword)->orWhere('NIM', $dataNIM)->paginate(10);
        $sendData = null;
        if(count($data)>0){
            $sendData = $data;
            $request->session()->flash('success', 'Data berhasil ditemukan');

        }else{
            $sendData = Pelanggaran::orderBy('created_at','desc')->paginate(10);
            session()->flash('failed', 'Data gagal ditemukan');
        }
        $tanggal = $this->tgl_indo($sendData[0]->created_at->format('Y-m-d'));
        $hari = $this->hari($sendData[0]->created_at->format('D'));

        return view('beranda',['data'=>$sendData, 'jumlah'=>$jumlah,'tanggal'=>$tanggal,'hari'=>$hari]);
    }
    public function getDetail($data){
        $data = Pelanggaran::where('id','=',$data)->get();
        $tanggal = $this->tgl_indo($data[0]->created_at->format('Y-m-d'));
        $hari = $this->hari($data[0]->created_at->format('D'));
        return view('detail',['data'=>$data,'tanggal'=>$tanggal,'hari'=>$hari]);
    }
}
