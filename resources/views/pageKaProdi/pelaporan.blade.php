@extends('../layouts/layoutKaProdi')
@section('title', 'Beranda')
@section('content')
<?php
    function bulan_indo($inp){
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
        
        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun
        return $bulan[ (int)$inp ];
    }
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
?>
    <!-- tulisan atas -->
    <div class="mt-4">
        <div class="flex justify-center text-secondary-900 font-bold text-3xl">
            Sistem Deteksi Physical Distancing dan Wajah Bermasker
        </div>
        <div class="flex justify-center text-primary-900 font-bold text-2xl">
            Menggunakan Metode You Only Look Once (YOLO)
        </div>
    </div>
    <div class="w-full bg-secondary-300 h-2 mt-7"></div>



    <!-- table -->
    <div class="w-full h-auto shadow-xl shadow-gray-400 mt-4">
        <div class="bg-secondary-900 rounded-t-xl px-10 py-3">
            <h1 class="font-bold text-white text-xl">Pelaporan Pelanggaran</h1>
        </div>
        <?php 
            date_default_timezone_set('Asia/Jakarta');
            if(!isset($old_request)){
                $old_request['tahun']=date("Y");
                $old_request['bulan']=date("m");
            }
        ?>
        <div class="py-5 px-10">
            {{-- Message --}}
            @if (session()->has('success'))
                <div class="flex justify-between mx-2 my-2 bg-green-600 text-white rounded-lg h-10 text-lg px-5">
                    <p class="my-auto">{{session()->get('success')}}</p>
                    <i class="my-auto hover:text-gray-600 fas fa-times alert-del"></i>
                </div>
            @elseif (session()->has('failed'))
                <div class="flex justify-between mx-2 my-2 bg-red-500 text-white rounded-lg h-10 text-lg px-5">
                    <p class="my-auto">{{session()->get('failed')}}</p>
                    <i class="my-auto hover:text-gray-600 fas fa-times alert-del"></i>
                </div>        
            @endif
            <div class="bg-primary-900 rounded-xl py-4 mt-4 px-4  font-bold ">
                <div class="flex flex-row justify-between">
                    
                    <div >
                        <form class="flex flex-row" action="{{url('/kaprodi/filterreport')}}" method="post">
                        @csrf
                            <div class="flex">
                                <div id="states-button" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-500 bg-gray-100 border border-gray-300 rounded-l-lg  ">
                                    Tahun
                                </div>
                                <label class="sr-only">Pilih Tahun</label>

                                <select name="tahun" class="bg-gray-50 w-32 border border-gray-300 text-gray-900 text-sm rounded-r-lg border-l-gray-100  border-l-2 focus:ring-primary-900 focus:border-primary-900 block  p-2.5">
                                    
                                    <option value="{{$old_request['tahun']?$old_request['tahun']:''}}" selected>{{$old_request['tahun']?$old_request['tahun']:'Pilih Tahun'}}</option>
                                    
                                    @foreach (range(date('Y'), 1990) as $x)
                                        <option value="{{$x}}">{{$x}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex ml-4">
                                <div id="states-button" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-500 bg-gray-100 border border-gray-300 rounded-l-lg  ">
                                    Bulan
                                </div>
                                <label class="sr-only">Pilih Bulan</label>
                                <select name="bulan" class="bg-gray-50 border w-32 border-gray-300 text-gray-900 text-sm rounded-r-lg border-l-gray-100  border-l-2 focus:ring-primary-900 focus:border-primary-900 block  p-2.5">
                                    
                                    <option   option value="{{$old_request['bulan']?$old_request['bulan']:''}}" selected>{{bulan_indo($old_request['bulan']?$old_request['bulan']:'Pilih Bulan')}}</option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                            <div  class="flex ml-4"> 
                                <button type="submit" class="px-5 bg-secondary-900 hover:bg-secondary-800 rounded-xl text-white font-bold">Filter</button>
                            </div>
                        </form>
                    </div>
                    <div>
                        <form action="{{url('/kaprodi/printreport')}}" method="post">
                            @csrf
                            {{-- {{dd($old_request['tahun'])}} --}}
                            @if (!isset($old_request))
                                <?php
                                    $old_request['tahun']=null;
                                    $old_request['bulan']=null
                                ?>
                            @endif
                            <input type="hidden" name="tahun" value="{{$old_request['tahun']}}">
                            <input type="hidden" name="bulan" value="{{$old_request['bulan']}}">
                            <button type="submit" class="px-5 py-3 bg-gray-300 hover:bg-gray-400 rounded-xl  font-bold">Print Report</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- table -->
            @if (isset($data) && count($data)>0)
                
            
            <div class="my-5 pb-5 flex justify-center mx-auto">
                <div class="flex flex-col">
                    <div class="w-full">
                        <div class="border-b border-gray-200 shadow">
                            <table class="divide-y divide-gray-300 text-xl ">
                                <thead class="bg-gray-900 text-white">
                                    <tr>
                                        <th class="px-6 py-2 text-xl ">
                                            No
                                        </th>
                                        <th class="px-20 py-2 text-xl">
                                            Nama Mahasiswa
                                        </th>
                                        <th class="px-20 py-2 text-xl">
                                            NIM
                                        </th>
                                        <th class="px-10 py-2 text-xl ">
                                            Kelas
                                        </th>
                                        <th class="px-10 py-2 text-xl ">
                                            Tanggal
                                        </th>
                                        
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-300 text-black">
                                    <?php $j = ($data->currentpage()-1)* $data->perpage() + 1;?>
                                    @foreach ($data as $i=>$dat)
                                        <tr class="whitespace-nowrap">
                                            <td class="px-6 py-4 text-xl">
                                                {{$j++}}
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-xl">
                                                    {{$dat->mahasiswa->nama}}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <div class="text-xl">{{$dat->mahasiswa->NIM}}</div>
                                            </td>
                                            <td>
                                                <div class="text-xl text-center">{{$dat->mahasiswa->kelas->nm_kelas}}</div>
                                            </td>
                                            <td>
                                                <div class="text-xl text-center">{{hari($dat->created_at->format('D'))}}, {{tgl_indo($dat->created_at->format('Y-m-d'))}}</div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $data->links('pagination::tailwind') }}
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <script>
        var alert_del = document.querySelectorAll('.alert-del');
            alert_del.forEach((x) =>
                x.addEventListener('click', function () {
                    x.parentElement.classList.add('hidden');
                })
            );
    </script>
@endsection