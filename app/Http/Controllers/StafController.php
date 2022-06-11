<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Pelanggaran;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class StafController extends Controller
{
    
    // public function __construct(){
    //     $this->middleware('stafProdi');
    // }
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
        
        // dd($data);
        $tanggal = null;
        $hari = null;
        $data = Pelanggaran::orderBy('created_at','desc')->paginate(10);
        $datapelanggaran = Pelanggaran::orderBy('created_at','desc')->get();
        $jumlah = count($datapelanggaran);
        if($jumlah>0){
            $tanggal = $this->tgl_indo($data[0]->created_at->format('Y-m-d'));
            $hari = $this->hari($data[0]->created_at->format('D'));
        }
        return view('pageStaf/berandaStaf',['data'=>$data, 'jumlah'=>$jumlah,'tanggal'=>$tanggal,'hari'=>$hari]);
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

        return view('pageStaf/berandaStaf',['data'=>$sendData, 'jumlah'=>$jumlah,'tanggal'=>$tanggal,'hari'=>$hari]);
    }


    //Page data mahasiswa
    public function viewDataMahasiswa(){
        $dataMahasiswa = DB::table('mahasiswas')->join('kelas','mahasiswas.id_kelas','=','kelas.id')->paginate(10);
        return view('pageStaf/dataMahasiswa',['DataMahasiswa'=>$dataMahasiswa]);
    }
    public function cariMahasiswa(Request $request){
        $dataMahasiswa  = DB::table('mahasiswas')->join('kelas','mahasiswas.id_kelas','=','kelas.id')->where('NIM', $request->keyword)
        ->orWhere('NIM', $request->keyword)->orWhere('nama','like','%'.$request->keyword.'%')->orderBy('NIM','desc')->paginate(10);
        if(count($dataMahasiswa)>0){
            session()->flash('success', 'Data berhasil ditemukan');
        }else{
            session()->flash('failed', 'Data gagal ditemukan');
        }
        return view('pageStaf/dataMahasiswa',['DataMahasiswa'=>$dataMahasiswa]);
    }
    public function hapusPelanggaran($data){
        $delete = DB::table('pelanggarans')->where('id','=',$data)->delete();
        if($delete){
            return redirect('staf/')->with('success', 'Data berhasil dihapus');
        }else{
            return redirect('staf/')->with('error', 'Terjadi kesalahan saat menghapus data');
        }
    }

}
