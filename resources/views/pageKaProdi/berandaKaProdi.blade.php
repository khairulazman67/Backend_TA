@extends('../layouts/layoutKaProdi')
@section('title', 'Beranda')
@section('content')
@php
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
    // dd($dataGrafikPelanggaran);
    @endphp
    <!-- tulisan atas -->
    <div class="mt-4">
        <div class="flex justify-center text-secondary-900 font-bold text-2xl">
            Sistem Deteksi Physical Distancing dan Wajah Bermasker
        </div>
        <div class="flex justify-center text-primary-900 font-bold text-xl">
            Menggunakan Metode You Only Look Once (YOLO)
        </div>
    </div>
    <div class="w-full bg-secondary-300 h-2 mt-7"></div>

    <!-- info -->
    <div class="flex justify-center h-40 mt-11 grid-rows-1 grid-flow-col gap-20 text-center ">

        <div class="bg-primary-900 w-full rounded-xl shadow-lg shadow-gray-400 py-10 px-7 ">

            <h1 class="text-white font-semibold text-2xl">Pelanggar Masker</h1>
            <div class="w-auto h-[3px] bg-white rounded-xl mt-2"></div>
            <div class="text-white text-2xl mt-2">
                <i class="fa-solid fa-users inline"></i>
                <p class="inline font-semibold">{{$jumlahMask}}</p>
            </div>
        </div>
        <div class="bg-primary-900 w-full rounded-xl shadow-lg shadow-gray-400 py-10 px-7 ">
            <h1 class="text-white font-semibold text-2xl">Pelanggar Physical Distancing</h1>
            <div class="w-auto h-[3px] bg-white rounded-xl mt-2"></div>
            <div class="text-white text-2xl mt-2">
                <i class="fa-solid fa-users inline"></i>
                <p class="inline font-semibold">{{$jumlahDistance}}</p>
            </div>
        </div>
        <div class="bg-primary-900 w-full rounded-xl shadow-lg shadow-gray-400 py-10 px-7 text-lg ">
            <div class="text-white font-semibold text-2xl">
                <div id="tanggal"></div>
            </div>
            <div class="w-auto h-[3px] bg-white rounded-xl mt-2"></div>
            <div class="text-white text-2xl mt-2 font-bold">
                <div id="jam"></div>
            </div>
        </div>
    </div>

    <!-- table -->
    <div class="flex flex-row gap-6">
        <div class="w-full h-auto shadow-xl shadow-gray-400 mt-10 ">
            <div class="bg-secondary-900 rounded-t-xl px-10 py-3">
                <h1 class="font-bold text-white text-xl">Data Pelanggar Pengguna Masker</h1>
            </div>

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
            <div class="my-5 p-4 flex justify-center mx-auto rounded-lg">
                <div class="flex flex-col">
                    <div class="w-full">
                        <div class="border-b border-gray-200 shadow ">
                            <form action="/cariPelanggar" method="post" class="mb-5">
                                @csrf
                                <input type="text" name="keyword"
                                    class="border-solid border-2 text-xs border-gray-800 rounded-xl h-7 w-60 px-3"
                                    placeholder="Cari Data pelanggaran .." value="{{ old('keyword') }}">
                                <button type="submit"
                                    class="bg-primary-800 w-14 h-7 text-xs font-semibold rounded-lg text-white">Cari</button>
                            </form>

                            <table class="divide-y divide-gray-300 ">
                                <thead class="bg-gray-900 text-white rounded-xl">
                                    <tr>
                                        <th class="px-2 py-2 text-xs ">
                                            No
                                        </th>
                                        <th class="px-2 py-2 text-xs">
                                            Nama Mahasiswa
                                        </th>
                                        <th class="px-2 py-2 text-xs ">
                                            NIM
                                        </th>
                                        <th class="px-2 py-2 text-xs ">
                                            Tanggal
                                        </th>
                                        <th class="px-2 py-2 text-xs ">
                                            Waktu
                                        </th>
                                        <th class="px-2 py-2 text-xs ">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-300 text-black">
                                    <?php $j = ($data->currentpage()-1)* $data->perpage() + 1;?>
                                    @foreach ($data as $i=>$dat)
                                    <tr class="whitespace-nowrap">
                                        <td class="px-2 py-4 text-xs">
                                            {{$j++}}
                                        </td>
                                        <td class="px-2 py-4 text-xs">
                                            {{$dat->mahasiswa->nama}}
                                        </td>
                                        <td class="px-2 py-4 text-xs">
                                            {{$dat->mahasiswa->NIM}}
                                        </td>
                                        <td class="px-2 py-4 text-xs">
                                            {{hari($dat->created_at->format('D'))}}, {{tgl_indo($dat->created_at->format('Y-m-d'))}}
                                        </td>
                                        <td class="px-2 py-4 text-xs">
                                            {{$dat->created_at->format('h:i:s A')}}
                                        </td>
                                        <td class="flex px-2 py-4">
                                            <form action="{{url('detailPelanggaran/'.$dat->id)}}" method="POST">
                                                @csrf
                                                <button
                                                    class="px-3 py-1 text-xs text-white bg-primary-800 hover:bg-primary-900 rounded-lg">Detail</button>
                                            </form>
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
        </div>
        <div class="w-full h-auto shadow-xl shadow-gray-400 mt-10 ">
            <div class="bg-secondary-900 rounded-t-xl px-10 py-3">
                <h1 class="font-bold text-white text-xl">Data Pelanggar Phisical Distancing</h1>
            </div>

            {{-- Message --}}
            @if (session()->has('successDistance'))
                <div class="flex justify-between mx-2 my-2 bg-green-600 text-white rounded-lg h-10 text-lg px-5">
                    <p class="my-auto">{{session()->get('successDistance')}}</p>
                    <i class="my-auto hover:text-gray-600 fas fa-times alert-del"></i>
                </div>
            @elseif (session()->has('errorDistance'))
                <div class="flex justify-between mx-2 my-2 bg-red-500 text-white rounded-lg h-10 text-lg px-5">
                    <p class="my-auto">{{session()->get('failedDistance')}}</p>
                    <i class="my-auto hover:text-gray-600 fas fa-times alert-del"></i>
                </div>
            @endif
            <div class="my-5 p-4 flex justify-center mx-auto rounded-lg">
                <div class="flex flex-col">
                    <div class="w-full">
                        <div class="border-b border-gray-200 shadow ">
                            <form action="/cariPelanggar" method="post" class="mb-5">
                                @csrf
                                <input type="text" name="keyword"
                                    class="border-solid border-2 text-xs border-gray-800 rounded-xl h-7 w-60 px-3"
                                    placeholder="Cari Data pelanggaran .." value="{{ old('keyword') }}">
                                <button type="submit"
                                    class="bg-primary-800 w-14 h-7 text-xs font-semibold rounded-lg text-white">Cari</button>
                            </form>

                            <table class="divide-y divide-gray-300 ">
                                <thead class="bg-gray-900 text-white rounded-xl">
                                    <tr>
                                        <th class="px-2 py-2 text-xs ">
                                            No
                                        </th>
                                        <th class="px-2 py-2 text-xs">
                                            ID
                                        </th>
                                        <th class="px-2 py-2 text-xs ">
                                            Jumlah
                                        </th>
                                        <th class="px-2 py-2 text-xs ">
                                            Tanggal
                                        </th>
                                        <th class="px-2 py-2 text-xs ">
                                            Waktu
                                        </th>
                                        <th class="px-2 py-2 text-xs ">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-300 text-black">
                                    <?php $j = ($data->currentpage()-1)* $data->perpage() + 1;?>
                                    @foreach ($data2 as $i=>$dat)
                                    <tr class="whitespace-nowrap">
                                        <td class="px-2 py-4 text-xs">
                                            {{$j++}}
                                        </td>
                                        <td class="px-2 py-4 text-xs">
                                            {{$dat->id}}
                                        </td>
                                        <td class="px-2 py-4 text-xs">
                                            {{$dat->jumlah}}
                                        </td>
                                        <td class="px-2 py-4 text-xs">
                                            {{hari($dat->created_at->format('D'))}}, {{tgl_indo($dat->created_at->format('Y-m-d'))}}
                                        </td>
                                        <td class="px-2 py-4 text-xs">
                                            {{$dat->created_at->format('h:i:s A')}}
                                        </td>
                                        <td class="flex px-2 py-4">
                                            <form action="{{url('detailPelanggaranDistance/'.$dat->id)}}" method="POST">
                                                @csrf
                                                <button
                                                    class="px-3 py-1 text-xs text-white bg-primary-800 hover:bg-primary-900 rounded-lg">Detail</button>
                                            </form>
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
        </div>
    </div>

    <script>
        window.setTimeout("waktu()", 1000);

        function waktu() {
            var waktu = new Date();
            setTimeout("waktu()", 1000);
            document.getElementById("jam").innerHTML = waktu.getHours() + ":" + waktu.getMinutes() + ":" + waktu
                .getSeconds();
        }
        window.setTimeout("tanggal()");

        function tanggal() {
            var tanggallengkap = new String();
            var namahari = ("Minggu Senin Selasa Rabu Kamis Jumat Sabtu");
            namahari = namahari.split(" ");
            var namabulan = ("Januari Februari Maret April Mei Juni Juli Agustus September Oktober November Desember");
            namabulan = namabulan.split(" ");
            var tgl = new Date();
            var hari = tgl.getDay();
            var tanggal = tgl.getDate();
            var bulan = tgl.getMonth();
            var tahun = tgl.getFullYear();
            tanggallengkap = namahari[hari] + ", " + tanggal + " " + namabulan[bulan] + " " + tahun;
            document.getElementById("tanggal").innerHTML = tanggallengkap
        }
        var alert_del = document.querySelectorAll('.alert-del');
            alert_del.forEach((x) =>
                x.addEventListener('click', function () {
                    x.parentElement.classList.add('hidden');
                })
            );
    </script>
@endsection
