<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>@yield('title')</title>
</head>

<body>
    <div class="flex flex-col">
        <div class="bg-primary-700 px-3  flex justify-center text-white font-bold">
            <div class="bg-primary-900 hover:bg-primary-800 py-2 px-3 inline">
                <a href="{{ url('/berandaStaf') }}">Beranda</a>
            </div>
            <div class="px-[2px] rounded-lg bg-primary-600 inline"></div>
            <div class="bg-primary-900 hover:bg-primary-800 py-2 px-3 inline">
                <a href="{{ url('/dataMahasiswa') }}">Data Mahasiswa</a>
            </div>
            <div class="px-[2px] rounded-lg bg-primary-600 inline"></div>
            <div class="bg-primary-900 hover:bg-primary-800 py-2 px-3 inline">
                <a href="{{ url('/detailPelanggaranStaf') }}">Monitor</a>
            </div>
        </div>
        <div class="container mx-auto mb-10">
            @yield('content')
        </div>
    </div>
</body>

</html>
