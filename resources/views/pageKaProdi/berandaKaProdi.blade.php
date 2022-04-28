@extends('../layouts/layoutKaProdi')
@section('title', 'Beranda')
@section('content')
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
    <div class="flex justify-center h-40 mt-6 grid-rows-1 grid-flow-col gap-20 ">
        <div class="bg-primary-900 w-64 rounded-xl shadow-lg shadow-gray-400 py-10 px-7">
            <h1 class="text-white font-semibold text-2xl">Mahasiswa</h1>
            <div class="w-auto h-[3px] bg-white rounded-xl mt-2"></div>
            <div class="text-white text-xl mt-2">
                <i class="fa-solid fa-users inline"></i>
                <p class="inline font-semibold">19</p>
            </div>
        </div>
        <div class="bg-primary-900 w-64 rounded-xl shadow-lg shadow-gray-400 py-10 px-7">
            <h1 class="text-white font-semibold text-xl">Pelanggar Terdeteksi</h1>
            <div class="w-auto h-[3px] bg-white rounded-xl mt-2"></div>
            <div class="text-white text-xl mt-2">
                <i class="fa-solid fa-users inline"></i>
                <p class="inline font-semibold">{{$jumlah}}</p>
            </div>
        </div>
        <div class="bg-primary-900 w-64 rounded-xl shadow-lg shadow-gray-400 py-10 px-7 text-lg">
            <div class="text-white font-semibold text-lg">
                <div id="tanggal"></div>
            </div>
            <div class="w-auto h-[3px] bg-white rounded-xl mt-2"></div>
            <div class="text-white text-xl mt-2 font-bold">
                <div id="jam"></div>
            </div>
        </div>
    </div>

    <!-- table -->
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
        <!-- table -->
        <div class="my-5 pb-5 flex justify-center mx-auto rounded-lg">
            <div class="flex flex-col">
                <div class="w-full">
                    <div class="border-b border-gray-200 shadow ">
                        <form action="/cariPelanggarStaf" method="post" class="mb-5">
                            @csrf
                            <input type="text" name="keyword"
                                class="border-solid border-2 border-gray-800 rounded-xl h-9 w-60 px-3"
                                placeholder="Cari Data pelanggaran .." value="{{ old('keyword') }}">
                            <button type="submit"
                                class="bg-primary-800 w-14 h-9 text-lg font-semibold rounded-lg text-white">Cari</button>
                        </form>

                        <table class="divide-y divide-gray-300 ">
                            <thead class="bg-gray-900 text-white rounded-xl">
                                <tr>
                                    <th class="px-6 py-2 text-xl ">
                                        No
                                    </th>
                                    <th class="px-20 py-2 text-xl">
                                        Nama Mahasiswa
                                    </th>
                                    <th class="px-10 py-2 text-xl ">
                                        NIM
                                    </th>
                                    <th class="px-16 py-2 text-xl ">
                                        Tanggal
                                    </th>
                                    <th class="px-16 py-2 text-xl ">
                                        Waktu
                                    </th>
                                    <th class="px-10 py-2 text-xl ">
                                        Detail
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
                                    <td class="px-6 py-4 text-xl">
                                        {{$dat->mahasiswa->nama}}
                                    </td>
                                    <td class="px-6 py-4 text-xl">
                                        {{$dat->mahasiswa->NIM}}
                                    </td>
                                    <td class="px-6 py-4 text-xl">
                                        {{$hari.', '.$tanggal}}
                                    </td>
                                    <td class="px-6 py-4 text-xl">
                                        {{$dat->created_at->format('h:i:s A')}}
                                    </td>
                                    <td class="flex px-6 py-4">
                                        <form action="{{url('detailPelStaf/'.$dat->id)}}" method="POST">
                                            @csrf
                                            <button
                                                class="px-6 py-1 text-sm text-white bg-primary-800 hover:bg-primary-900 rounded-lg">Detail</button>
                                        </form>
                                        <form action="{{url('staf/hapusPelanggaran/'.$dat->id)}}" method="post" onsubmit="return confirm('Apakah anda ingin melanjutkan penghapusan data?')">
                                            @method('delete')
                                            @csrf
                                            <button
                                                class="px-6 py-1 text-sm text-white bg-red-700 ml-2 hover:bg-red-800 rounded-lg">Hapus</button>
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