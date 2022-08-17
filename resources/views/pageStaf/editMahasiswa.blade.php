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

    {{-- <button class="bg-primary-700 rounded-xl py-3 mt-4 px-3 text-white font-bold hover:bg-primary-900">
        <i class="fa-solid fa-plus mr-1 "></i> Tambah Data
    </button> --}}

    <!-- table -->
    <div class="px-28">
        <div class="w-full h-auto shadow-xl  shadow-gray-400 mt-5 ">
            <div class="bg-secondary-900 rounded-t-xl px-10 py-5 flex justify-center">
                <h1 class="font-bold text-white text-xl">EDIT DATA MAHASISWA</h1>
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
            @php
                // dd($oldData);
            @endphp
            <div class="flex flex-row w-full">
                <div class="w-1/2  flex justify-center items-center">
                    <form method="POST" action="{{url('/staf/editMahasiswa')}}">
                        @csrf
                        <div>
                            <input type="hidden" name="NIM" value="{{$oldData?$oldData->NIM:''}}">
                            <div class="text-xl">
                                <label for="fname" class="font-semibold ">NIM :</label><br>
                                <input type="text" :value="old('NIM')" disabled value="{{$oldData?$oldData->NIM:''}}" name="NIM" class="bg-gray-200 border-2 rounded-lg border-primary-800 hover:border-primary-900 h-10 w-96 p-5" required autocomplete="current-password"><br>
                            </div>
                            <div class="mt-4 text-xl">
                                <label for="fname" class="font-semibold  text-xl">Nama :</label><br>
                                <input type="text" :value="old('nama')" value="{{$oldData?$oldData->nama:''}}"   name="nama" class="border-2 rounded-lg border-primary-800 hover:border-primary-900 h-10 w-96 p-5"><br>
                            </div>


                            <div class="mt-4 text-xl ">
                                <label for="fname" class="font-semibold ">Kelas :</label><br>
                                <select name="kelas" class="border-2 rounded-lg border-primary-800 text-gray-900 hover:border-primary-900 h-10 w-96 p-5" >
                                    <label>Kelas :</label><br>
                                    <option  value="{{$oldData?$oldData->id_kelas:''}}" selected>{{$oldData?$oldData->kelas->nm_kelas:''}}</option>
                                    @foreach ($kelas as $i=>$dat)
                                        <option value="{{$dat->id}}">{{$dat->nm_kelas}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="bg-primary-700 rounded-xl py-3 mt-4 px-11 text-white font-bold hover:bg-primary-900"  type="submit" >
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
                <div class="w-1/2  flex items-center justify-center ">
                    <div class="inset-y-0">
                        <img src="{{asset('img/Iluslator.png') }}" alt="" class="my-10 w-[500px]">
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

        window.addEventListener('DOMContentLoaded', () =>{
            const overlay = document.querySelector('#overlay')
            const deleteBtn = document.querySelector('#edit-btn')
            const closeBtn = document.querySelector('#close-modal')

            const toggleModal = () => {
                overlay.classList.toggle('hidden')
                overlay.classList.toggle('flex')
            }

            deleteBtn.addEventListener('click', toggleModal)

            closeBtn.addEventListener('click', toggleModal)
        })

    </script>
@endsection
