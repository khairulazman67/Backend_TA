@extends('../layouts/layoutStaf')
@section('title', 'DataMHS')
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

    <div class="px-10">
        <div class="px-20 py-10 w-full h-auto shadow-lg shadow-gray-400 mt-5">
            <a href="{{url('/')}}" class="text-lg text-primary-800 hover:text-gray-900"><i class="fas fa-arrow-left mr-1"></i>Kembali</a>
            <div class="flex flex-row">
                <div>
                    <h1 class="text-primary-900 font-bold text-2xl mt-6">Detail Pelanggaran</h1>
                    <div class="w-full bg-primary-800 rounded-full h-1 mt-2"></div>
                    <table class="table-auto mt-3 text-xl">
                        <tbody>
                            @foreach ($data as $i=>$dat)
                                <tr>
                                    <td class="py-3">Nama</td>
                                    <td class="py-3 pl-10">:</td>
                                    <td class="py-3 w-80">{{$dat->mahasiswa->nama}}</td>
                                </tr>
                                <tr>
                                    <td class="py-3">NIM</td>
                                    <td class="py-3 pl-10">:</td>
                                    <td class="py-3">{{$dat->NIM}}</td>
                                </tr>
                                <tr>
                                    <td class="py-3">Tanggal</td>
                                    <td class="py-3 pl-10">:</td>
                                    <td class="py-3">{{$hari.', '.$tanggal}}</td>
                                </tr>
                                <tr>
                                    <td class="py-3">Waktu</td>
                                    <td class="py-3 pl-10">:</td>
                                    <td class="py-3 ">{{$dat->created_at->format('h:i:s A')}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
                <div class=" w-full h-full">
                    <img src="{{asset('imgpelanggaran/'.$data[0]->bukti) }}" alt="" class="w-[600px] rounded-xl m-auto">
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
    </script>
@endsection