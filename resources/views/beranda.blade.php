@extends('../layouts/layoutGeneral')
@section('title', 'Detail Mahasiswa')
@section('content')

<body>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
    <div class="container mx-auto mb-10">
        <!-- tulisan atas -->
        <div class="w-full  relative">
            <div class="mt-4">
                <div class="flex justify-center text-secondary-900 font-bold text-3xl">
                    Sistem Deteksi Physical Distancing dan Wajah Bermasker
                </div>
                <div class="flex justify-center text-primary-900 font-bold text-2xl">
                    Menggunakan Metode You Only Look Once (YOLO)
                </div>
            </div>
            <div class="absolute text-white bg-primary-900 hover:bg-primary-800 rounded-xl  inset-y-0 right-0 mt-5 mb-12">
                @if (auth()->check())
                    {{-- @if (auth()->user()->level === 'ka_prodi') --}}
                        <a href="{{ url('/kaprodi') }}" ><i class="mt-2 mx-3 fa-solid fa-right-to-bracket"></i></a>
                    {{-- @endif --}}
                @else
                    <a href="{{ url('login') }}" ><i class="mt-2 mx-3 fa-solid fa-right-to-bracket"></i></a>
                @endif
            </div>
            <div class="bg-secondary-300 h-2 mt-7"></div>
        </div>

        <div class="flex justify-center flex-row my-5 px-40 gap-20 " >
            <div class="w-2/3 rounded-3xl shadow-lg shadow-gray-400 ">
                <div class="bg-secondary-900 rounded-t-xl px-10 py-3 text-center">
                    <h1 class="font-bold text-white text-xl">Grafik Jumlah Pelanggar</h1>
                </div>
                <div class=" p-8">
                    <canvas id="myChart1"  ></canvas>
                </div>
            </div>
            <div class="w-1/3 rounded-3xl shadow-lg shadow-gray-400">
                <div class="bg-secondary-900 rounded-t-xl px-10 py-3 text-center">
                    <h1 class="font-bold text-white text-xl">Grafik Perbandingan Pelanggar</h1>
                </div>
                <div class=" p-8 ">
                    <canvas id="myChart2" ></canvas>
                </div>
            </div>
        </div>

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
            <div class="w-full h-auto shadow-xl shadow-gray-400 mt-10 rounded-xl">
                <div class="bg-secondary-900 rounded-t-xl px-10 py-3">
                    <h1 class="font-bold text-white text-xl">Data Pelanggar Pengguna Masker</h1>
                </div>
                <!-- table -->
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


                <div class="my-5 pb-5 flex justify-center mx-auto">
                    <div class="flex flex-col">
                        <div class="w-full">
                            <div class="border-b border-gray-200 shadow ">

                                <table id="" class="display divide-y divide-gray-300 ">
                                    <thead class="bg-gray-900 text-white">
                                        <tr>
                                            <th class="px-6 py-2 text-xs ">
                                                No
                                            </th>
                                            <th class="px-20 py-2 text-xs">
                                                Nama Mahasiswa
                                            </th>
                                            <th class="px-10 py-2 text-xs ">
                                                NIM
                                            </th>
                                            <th class="px-16 py-2 text-xs ">
                                                Tanggal
                                            </th>
                                            <th class="px-16 py-2 text-xs ">
                                                Jam
                                            </th>
                                            <th class="px-10 py-2 text-xs ">
                                                Detail
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-300 text-black text-xs">

                                        @foreach ($data as $i=>$dat)
                                        <tr class="whitespace-nowrap">
                                            <td class="px-6 py-4 text-xs">
                                                {{$i+1}}
                                            </td>
                                            <td class="px-6 py-4 text-xs">
                                                {{$dat->mahasiswa->nama}}
                                            </td>
                                            <td class="px-6 py-4 text-xs">
                                                {{$dat->NIM}}
                                            </td>
                                            <td class="px-6 py-4 text-xs">
                                                {{hari($dat->created_at->format('D'))}}, {{tgl_indo($dat->created_at->format('Y-m-d'))}}
                                            </td>
                                            <td class="px-6 py-4 text-xs">
                                                {{$dat->created_at->format('h:i:s A')}}
                                            </td>
                                            <td class="px-6 py-4">
                                                <form action="{{url('detailPelanggaran/'.$dat->id)}}" method="POST">
                                                    @csrf
                                                    <button
                                                        class="px-6 py-1 text-sm text-white bg-primary-800 hover:bg-primary-900 rounded-lg">Detail</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <div class="w-full h-auto shadow-xl shadow-gray-400 mt-10 rounded-xl">
                <div class="bg-secondary-900 rounded-t-xl px-10 py-3">
                    <h1 class="font-bold text-white text-xl">Data Pelanggar Physical Distancing</h1>
                </div>
                <!-- table -->
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

                <div class="my-5 pb-5 flex justify-center mx-auto">
                    <div class="flex flex-col">
                        <div class="w-full">
                            <div class="border-b border-gray-200 shadow ">
                                <table id="" class="display divide-y divide-gray-300">
                                    <thead class="bg-gray-900 text-white">
                                        <tr>
                                            <th class="px-6 py-2 text-xs ">
                                                No
                                            </th>
                                            <th class="px-20 py-2 text-xs">
                                                ID
                                            </th>
                                            <th class="px-20 py-2 text-xs">
                                                Jumlah
                                            </th>
                                            <th class="px-16 py-2 text-xs ">
                                                Tanggal
                                            </th>
                                            <th class="px-16 py-2 text-xs ">
                                                Jam
                                            </th>
                                            <th class="px-10 py-2 text-xs ">
                                                Detail
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-300 text-black text-xs">

                                        @foreach ($data2 as $i=>$dat)
                                        <tr class="whitespace-nowrap">
                                            <td class="px-6 py-4 text-xs">
                                                {{$i+1}}
                                            </td>
                                            <td class="px-6 py-4 text-xs">
                                                {{$dat->id}}
                                            </td>
                                            <td class="px-6 py-4 text-xs">
                                                {{$dat->jumlah}}
                                            </td>
                                            <td class="px-6 py-4 text-xs">
                                                {{hari($dat->created_at->format('D'))}}, {{tgl_indo($dat->created_at->format('Y-m-d'))}}
                                            </td>
                                            <td class="px-6 py-4 text-xs">
                                                {{$dat->created_at->format('h:i:s A')}}
                                            </td>
                                            <td class="px-6 py-4">
                                                <form action="{{url('detailPelanggaranDistance/'.$dat->id)}}" method="POST">
                                                    @csrf
                                                    <button
                                                        class="px-6 py-1 text-sm text-white bg-primary-800 hover:bg-primary-900 rounded-lg">Detail</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <script>
            $(document).ready(function () {
                $('table.display').DataTable();
            });

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
                var namabulan = (
                    "Januari Februari Maret April Mei Juni Juli Agustus September Oktober November Desember");
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

            const labels = [
                'Senin',
                'Selasa',
                'Rabu',
                'Kamis',
                'Jumat',
                'Sabtu',
                'Minggu'
            ];

            const data1 = {
                labels: labels,
                datasets: [
                    {
                        label: 'Masker',
                        backgroundColor: 'rgb(255, 205, 86)',
                        borderColor: 'rgb(255, 205, 86)',
                        data: [
                            @foreach($dataGrafikPelanggaranMasker as $data)
                                {{$data}},
                            @endforeach
                        ],
                    },
                    {
                        label: 'Physical Distancing',
                        backgroundColor: 'rgb(54, 162, 235)',
                        borderColor: 'rgb(54, 162, 235)',
                        data: [
                            @foreach($dataGrafikPelanggaranDistance as $data)
                                {{$data}},
                            @endforeach
                        ],
                    }
                ]
            };

            const data2 = {
                labels: [
                    'Masker',
                    'Physical Distancing'
                ],
                datasets: [{
                    label: 'My First Dataset',
                    data: [{{$jumlahMask}}, {{$jumlahDistance}}],
                    backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)'
                    ],
                    hoverOffset: 4
                }]
            };


            const config1 = {
                type: 'bar',
                data: data1,
                options: {
                    scales: {
                    y: {
                        beginAtZero: true
                    }
                    }
                },
            };

            const config2 = {
                type: 'doughnut',
                data: data2,
            };

            const myChart1 = new Chart(
                document.getElementById('myChart1'),
                config1
            );
            const myChart2 = new Chart(
                document.getElementById('myChart2'),
                config2
            );
        </script>
    </div>
@endsection

