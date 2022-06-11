@extends('../layouts/layoutGeneral')
@section('title', 'Detail Mahasiswa')
@section('content')

<body>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
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
        <!-- info -->
        <div class="flex justify-center h-40 mt-6 grid-rows-1 grid-flow-col gap-20 text-center my-10">
            <div class="bg-primary-900 w-full rounded-xl shadow-lg shadow-gray-400 py-10 px-7 ">
                <h1 class="text-white font-semibold text-2xl">Pelanggar Terdeteksi</h1>
                <div class="w-auto h-[3px] bg-white rounded-xl mt-2"></div>
                <div class="text-white text-2xl mt-2">
                    <i class="fa-solid fa-users inline"></i>
                    <p class="inline font-semibold">{{$jumlah}}</p>
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
                            <form action="/cariPelanggar" method="post" class="mb-5">
                                @csrf
                                <input type="text" name="keyword"
                                    class="border-solid border-2 border-gray-800 rounded-xl h-9 w-60 px-3"
                                    placeholder="Cari Data pelanggaran .." value="{{ old('keyword') }}">
                                <button type="submit"
                                    class="bg-primary-800 w-14 h-9 text-lg font-semibold rounded-lg text-white">Cari</button>
                            </form>
                            <table id="myTable" class="divide-y divide-gray-300 ">
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
                                            Waktu Pelanggaran
                                        </th>
                                        <th class="px-10 py-2 text-xs ">
                                            Hapus 
                                        </th>
                                        <th class="px-10 py-2 text-xs ">
                                            Detail
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-300 text-black">
                                    
                                    @foreach ($data as $i=>$dat)
                                    <tr class="whitespace-nowrap">
                                        <td class="px-6 py-4 text-xl">
                                            {{$i+1}}
                                        </td>
                                        <td class="px-6 py-4 text-xl">
                                            {{$dat->mahasiswa->nama}}
                                        </td>
                                        <td class="px-6 py-4 text-xl">
                                            {{$dat->NIM}}
                                        </td>
                                        <td class="px-6 py-4 text-xl">
                                            {{$dat->hari.', '.$dat->tanggal}}
                                        </td>
                                        <td class="px-6 py-4 text-xl">
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
        </script>
    </div>
@endsection

