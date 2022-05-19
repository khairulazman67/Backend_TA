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
        <div class="bg-primary-700 px-3 py-2 flex flex-row justify-center text-white font-bold">
            <div>   
                <div class="bg-primary-900 hover:bg-primary-800 py-2 px-3 inline">
                    <a href="{{ url('kaprodi/') }}">Beranda</a>
                </div>
                <div class="px-[2px] rounded-lg bg-primary-600 inline"></div>
                <div class="bg-primary-900 hover:bg-primary-800 py-2 px-3 inline">
                    <a href="{{ url('kaprodi/') }}">Data Mahasiswa</a>
                </div>
                <div class="px-[2px] rounded-lg bg-primary-600 inline"></div>
                <div class="bg-primary-900 hover:bg-primary-800 py-2 px-3 inline">
                    <a href="{{ url('kaprodi/') }}">Pelaporan</a>
                </div>
            </div>
            <div class="absolute right-3 flex flex-row ">
                <div class="mr-3">
                    {{ Auth::user()->name }} 
                </div>
                <div >
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="underline text-sm hover:text-gray-900">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="container mx-auto mb-10">
            @yield('content')
        </div>
    </div>
</body>

</html>
