<?php
namespace App\Http\Controllers;
use App\Models\Kelas;
use App\Models\Pelanggaran;
use App\Models\PelanggaranDistance;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
class KaProdiController extends Controller
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

        // dd($data);
        $tanggal = null;
        $hari = null;
        $data = Pelanggaran::orderBy('created_at','desc')->paginate(10);
        $datapelanggaran = Pelanggaran::orderBy('created_at','desc')->get();
        $pelanggaranSocialDistance = PelanggaranDistance::orderBy('id','desc')->get();

        $jumlahMask = count($datapelanggaran);
        $jumlahDistance = $pelanggaranSocialDistance->sum->jumlah;

        return view('pageKaProdi/berandaKaProdi',['data'=>$data,'data2'=>$pelanggaranSocialDistance, 'jumlahMask'=>$jumlahMask, 'jumlahDistance'=>$jumlahDistance,'tanggal'=>$tanggal,'hari'=>$hari]);

        // return view('pageKaProdi/berandaKaProdi',['data'=>$data, 'jumlah'=>$jumlah,'tanggal'=>$tanggal,'hari'=>$hari]);
    }
    public function viewDataMahasiswa(){
        $dataMahasiswa = DB::table('mahasiswas')->join('kelas','mahasiswas.id_kelas','=','kelas.id')->paginate(10);
        return view('pageKaProdi/dataMahasiswa',['DataMahasiswa'=>$dataMahasiswa]);
    }
    public function cariMahasiswa(Request $request){
        $dataMahasiswa  = DB::table('mahasiswas')->join('kelas','mahasiswas.id_kelas','=','kelas.id')->where('NIM', $request->keyword)
        ->orWhere('NIM', $request->keyword)->orWhere('nama','like','%'.$request->keyword.'%')->orderBy('NIM','desc')->paginate(10);
        if(count($dataMahasiswa)>0){
            session()->flash('success', 'Data berhasil ditemukan');
        }else{
            session()->flash('failed', 'Data tidak ditemukan');
        }
        return view('pageKaProdi/dataMahasiswa',['DataMahasiswa'=>$dataMahasiswa]);
    }
    public function filterReportMask(Request $request){
        // dd($request);
        // $old_request = {
        //     'tahun': $request->tahun,
        //     'bulan' : $request->bulan
        // };
        $old_request['tahun']=$request->tahun;
        $old_request['bulan']=$request->bulan;

        $data = Pelanggaran::whereYear('created_at',$request->tahun)->whereMonth('created_at',$request->bulan)->paginate(10);
        if(count($data)>0){
            return view('pageKaProdi/laporanMasker',['data'=>$data,'old_request'=>$old_request]);
        }else{
            session()->flash('failed', 'Data tidak tersedia');
            return view('pageKaProdi/laporanMasker',['data'=>$data,'old_request'=>$old_request]);
        }


        // dd($pelanggaran);
    }
    public function filterReportSocialDistancing(Request $request){
        // dd($request);
        // $old_request = {
        //     'tahun': $request->tahun,
        //     'bulan' : $request->bulan
        // };
        $old_request['tahun']=$request->tahun;
        $old_request['bulan']=$request->bulan;

        $data = PelanggaranDistance::whereYear('created_at',$request->tahun)->whereMonth('created_at',$request->bulan)->paginate(10);
        if(count($data)>0){
            return view('pageKaProdi/laporanDistance',['data'=>$data,'old_request'=>$old_request]);
        }else{
            session()->flash('failed', 'Data tidak tersedia');
            return view('pageKaProdi/laporanDistance',['data'=>$data,'old_request'=>$old_request]);
        }


        // dd($pelanggaran);
    }
    public function printReportMask(Request $request){
        // dd($request);
        $old_request['tahun']=$request->tahun;
        $old_request['bulan']=$request->bulan;
        // dd($old_request);
        $data = Pelanggaran::whereYear('created_at',$request->tahun)->whereMonth('created_at',$request->bulan)->get();
        // dd(count($data));
        if($old_request['tahun']!==null && $old_request['bulan']!==null && count($data)>0){

            $pdf = PDF::loadview('pageKaProdi/printReportMask',['data'=>$data,'old_request'=>$old_request])->setPaper('A4','potrait');
            // return $pdf->stream();
            $pdf->getDomPDF()->setHttpContext(
            stream_context_create([
                    'ssl' => [
                        'allow_self_signed'=> TRUE,
                        'verify_peer' => FALSE,
                        'verify_peer_name' => FALSE,
                    ]
                ])
            );
            return $pdf->download('itsolutionstuff.pdf');
            // session()->flash('success', 'Data berhasil ditemukan');
        }else{
            session()->flash('failed', 'Silahkan melakukan filter Tahun dan Bulan terlebih dahulu');
            return view('pageKaProdi/laporanMasker',['old_request'=>$old_request]);
            //
        }
    }
    public function printReportDistance(Request $request){
        // dd($request);
        $old_request['tahun']=$request->tahun;
        $old_request['bulan']=$request->bulan;
        // dd($old_request);
        $data = PelanggaranDistance::whereYear('created_at',$request->tahun)->whereMonth('created_at',$request->bulan)->get();
        // dd(count($data));
        if($old_request['tahun']!==null && $old_request['bulan']!==null && count($data)>0){

            $pdf = PDF::loadview('pageKaProdi/printReportDistance',['data'=>$data,'old_request'=>$old_request])->setPaper('A4','potrait');
            // return $pdf->stream();
            $pdf->getDomPDF()->setHttpContext(
            stream_context_create([
                    'ssl' => [
                        'allow_self_signed'=> TRUE,
                        'verify_peer' => FALSE,
                        'verify_peer_name' => FALSE,
                    ]
                ])
            );
            return $pdf->download('itsolutionstuff.pdf');
            // session()->flash('success', 'Data berhasil ditemukan');
        }else{
            session()->flash('failed', 'Silahkan melakukan filter Tahun dan Bulan terlebih dahulu');
            return view('pageKaProdi/laporanDistance',['old_request'=>$old_request]);
            //
        }
    }
}
