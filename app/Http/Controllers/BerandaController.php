<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Pelanggaran;
use App\Models\PelanggaranDistance;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
// use Illuminate\Support\Facades\Http;

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
        $pelanggaran = Pelanggaran::orderBy('id','desc')->get();
        $pelanggaranSocialDistance = PelanggaranDistance::orderBy('id','desc')->get();
        $data = [];
        foreach($pelanggaran as $i => $v){
            $data[$i]=$v;
            $data[$i]['tanggal'] = $this->tgl_indo($data[$i]->created_at->format('Y-m-d'));
            $data[$i]['hari'] = $this->hari($data[$i]->created_at->format('D'));
        }

        $jumlahMask = count($pelanggaran);
        $jumlahDistance = $pelanggaranSocialDistance->sum->jumlah;

        $date = Carbon::now()->subDays(7);
        $dataPelanggaranWeek = Pelanggaran::where('created_at', '>=', $date)->get();

        $dataGrafikPelanggaran = [];
        $dataGrafikPelanggaranDistance = [];
        foreach($dataPelanggaranWeek as $i => $v){
            $hariini =$this->hari($v->created_at->format('D'));
            $getPelanggaran = Pelanggaran::orderBy('id','desc')->where('created_at',$v->created_at)->get();
            $getPelanggaranDistance = PelanggaranDistance::orderBy('id','desc')->where('created_at',$v->created_at)->get();
            if($hariini==='Senin'){
                $dataGrafikPelanggaran[0]=count($getPelanggaran);
                $dataGrafikPelanggaranDistance[0] = $pelanggaranSocialDistance->sum->jumlah;
            }else{
                if(!isset($dataGrafikPelanggaran[0])){
                    $dataGrafikPelanggaran[0]=0;
                    $dataGrafikPelanggaranDistance[0] = 0;
                }
            }

            if($hariini==='Selasa'){
                $dataGrafikPelanggaran[1]=count($getPelanggaran);
                $dataGrafikPelanggaranDistance[1] = $pelanggaranSocialDistance->sum->jumlah;
            }else{
                if(!isset($dataGrafikPelanggaran[1])){
                    $dataGrafikPelanggaran[1]=0;
                    $dataGrafikPelanggaranDistance[1] = 0;
                }
            }

            if($hariini==='Rabu'){
                $dataGrafikPelanggaran[2]=count($getPelanggaran)+1;
                $dataGrafikPelanggaranDistance[2] = $pelanggaranSocialDistance->sum->jumlah;
            }else{
                if(!isset($dataGrafikPelanggaran[2])){
                    $dataGrafikPelanggaran[2]=0;
                    $dataGrafikPelanggaranDistance[2] = 0;
                }
            }
            if($hariini==='Kamis'){
                $dataGrafikPelanggaran[3]=count($getPelanggaran)+1;
                $dataGrafikPelanggaranDistance[3] = $pelanggaranSocialDistance->sum->jumlah;
            }else{
                if(!isset($dataGrafikPelanggaran[3])){
                    $dataGrafikPelanggaran[3]=0;
                    $dataGrafikPelanggaranDistance[3] = 0;
                }
            }

            if($hariini==='Jumat'){
                $dataGrafikPelanggaran[4]=count($getPelanggaran)+1;
                $dataGrafikPelanggaranDistance[4] = $pelanggaranSocialDistance->sum->jumlah;
            }else{
                if(!isset($dataGrafikPelanggaran[4])){
                    $dataGrafikPelanggaran[4]=0;
                    $dataGrafikPelanggaranDistance[4] = 0;
                }
            }

            if($hariini==='Sabtu'){
                $dataGrafikPelanggaran[5]=count($getPelanggaran)+1;
                $dataGrafikPelanggaranDistance[5] = $pelanggaranSocialDistance->sum->jumlah;
            }else{
                if(!isset($dataGrafikPelanggaran[5])){
                    $dataGrafikPelanggaran[5]=0;
                    $dataGrafikPelanggaranDistance[5] = 0;
                }
            }

            if($hariini==='Minggu'){
                $dataGrafikPelanggaran[6]=count($getPelanggaran)+1;
                $dataGrafikPelanggaranDistance[6] = $pelanggaranSocialDistance->sum->jumlah;
            }else{
                if(!isset($dataGrafikPelanggaran[6])){
                    $dataGrafikPelanggaran[6]=0;
                    $dataGrafikPelanggaranDistance[6] = 0;
                }
            }
        };
        // dd($dataGrafikPelanggaranDistance);
        return view('beranda',['data'=>$data, 'jumlahMask'=>$jumlahMask, 'jumlahDistance'=>$jumlahDistance, 'data2'=>$pelanggaranSocialDistance, 'dataGrafikPelanggaranMasker'=>$dataGrafikPelanggaran, 'dataGrafikPelanggaranDistance'=>$dataGrafikPelanggaranDistance]);
    }
    public function cariPelanggar(Request $request){
        $val = Validator::make(
            $request->all(),
            [
                'keyword' => 'required',
            ]
        );
        $datajumlah = Pelanggaran::orderBy('created_at','desc')->paginate(10);
        $jumlahMask = count($datajumlah);

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

        return view('beranda',['data'=>$sendData, 'jumlahMask'=>$jumlah,'tanggal'=>$tanggal,'hari'=>$hari]);
    }
    public function getDetail($data){
        $data = Pelanggaran::where('id','=',$data)->get();
        $tanggal = $this->tgl_indo($data[0]->created_at->format('Y-m-d'));
        $hari = $this->hari($data[0]->created_at->format('D'));
        return view('detail',['data'=>$data,'tanggal'=>$tanggal,'hari'=>$hari]);
    }
}
