@extends('../layouts/layoutStaf')
@section('title', 'Data Mahasiswa')
@section('content')
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

    <button class="bg-primary-700 rounded-xl py-3 mt-4 px-3 text-white font-bold hover:bg-primary-900">
        <i class="fa-solid fa-plus mr-1 "></i> Tambah Data
    </button>

    <!-- table -->
    <div class="w-full h-auto shadow-xl shadow-gray-400 mt-5 ">
        <div class="bg-secondary-900 rounded-t-xl px-10 py-3">
            <h1 class="font-bold text-white text-xl">Data Mahasiswa</h1>
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
        <div class="my-5 pb-5 flex justify-center mx-auto">
            <div class="flex flex-col">
                <div class="w-full">
                    <div class="border-b border-gray-200 shadow">
                        <form action="/cariMahasiswaStaf" method="post" class="mb-5">
                            @csrf
                            <input type="text" name="keyword"
                                class="border-solid border-2 border-gray-800 rounded-xl h-9 w-60 px-3"
                                placeholder="Cari data mahasiswa .." value="{{ old('keyword') }}">
                            <button type="submit"
                                class="bg-primary-800 w-14 h-9 text-lg font-semibold rounded-lg text-white">Cari</button>
                        </form>
                        <table class="divide-y divide-gray-300 text-xl">
                            <thead class="bg-gray-900 text-white">
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
                                    <th class="px-10 py-2 text-xl ">
                                        Kelas
                                    </th>
                                    <th class="px-10 py-2 text-xl ">
                                        Hapus 
                                    </th>
                                    <th class="px-10 py-2 text-xl ">
                                        Detail
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-300 text-black">
                                <?php $j = ($DataMahasiswa->currentpage()-1)* $DataMahasiswa->perpage() + 1;?>
                                @foreach ($DataMahasiswa as $i=>$dat)
                                    <tr class="whitespace-nowrap">
                                        <td class="px-6 py-4 text-xl">
                                            {{$j++}}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-xl">
                                                {{$dat->nama}}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="text-xl">{{$dat->NIM}}</div>
                                        </td>
                                        <td>
                                            <div class="text-xl text-center">{{$dat->nm_kelas}}</div>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <a href="#" class="px-6 py-1 text-sm text-white bg-yellow-500 hover:bg-yellow-600 rounded-lg">Edit</a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="#" class="px-6 py-1 text-sm text-white bg-red-600 hover:bg-red-700 rounded-lg">Hapus</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $DataMahasiswa->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
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