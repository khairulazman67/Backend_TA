@extends('/layouts/layoutGeneral')

@section('title', 'Detail Mahasiswa')
@section('content')
    <div class="container mx-auto mb-10 px-40">
        <!-- tulisan atas -->
        <div class="mt-2">
            <div class="flex justify-center text-secondary-900 font-bold text-3xl mt-12">
                Sistem Deteksi Physical Distancing dan Wajah Bermasker
            </div>
            <div class="flex justify-center text-primary-900 font-bold text-2xl">
                Menggunakan Metode You Only Look Once (YOLO)
            </div>
        </div>
        <div class="w-full bg-secondary-300 h-2 mt-5 mb-10"></div>

        <div class="px-10">
            <div class="px-20 py-10 w-full h-auto shadow-lg shadow-gray-400 mt-5">
                <a href="{{ url()->previous() }}" class="text-lg text-primary-800 hover:text-gray-900"><i class="fas fa-arrow-left mr-1"></i>Kembali</a>
                <div class="flex flex-row">
                    <div>
                        <h1 class="text-primary-900 font-bold text-2xl mt-6">Detail Pelanggaran Physical Distancing</h1>
                        <div class="w-full bg-primary-800 rounded-full h-1 mt-2"></div>
                        <table class="table-auto mt-3 text-lg">
                            <tbody>
                                @foreach ($data as $i=>$dat)
                                    <tr>
                                        <td class="py-3">ID</td>
                                        <td class="py-3 pl-10">:</td>
                                        <td class="py-3">{{$dat->id}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3">Tanggal</td>
                                        <td class="py-3 pl-10 ">:</td>
                                        <td class="py-3 w-96">{{$hari.', '.$tanggal}}</td>
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
                        <img src="{{asset('imgpelanggaran/'.$data[0]->bukti) }}" alt="" class="w-[500px] rounded-xl m-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
