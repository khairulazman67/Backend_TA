<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Login</title>
</head>
<body>
    <div class="container mx-auto">
        <!-- tulisan atas -->
        <div class="mt-20">
            <div class="flex justify-center text-secondary-900 font-bold text-4xl">
                Sistem Deteksi Physical Distancing dan Wajah Bermasker
            </div>
            <div class="flex justify-center text-primary-900 font-bold text-3xl">
                Menggunakan Metode You Only Look Once (YOLO)
            </div>
        </div>
        <div class="flex mx-44">
            <div class="mt-20 text-primary-900">
                <h1 class="text-[40px] font-bold mb-5">Login</h1>
                <form action="">
                    <div>
                        <label for="fname" class="font-semibold  text-xl">Username :</label><br>
                        <input type="text" id="fname" name="fname" class="border-2 rounded-lg border-primary-800 hover:border-primary-900 h-10 w-96 p-5"><br>
                    </div>
                    <div class="mt-4">
                        <label for="fname" class="font-semibold  text-xl">Password :</label><br>
                        <input type="text" id="fname" name="fname" class="border-2 rounded-lg border-primary-800 hover:border-primary-900 h-10 w-96 p-5"><br>
                    </div>
                    <button class="bg-primary-700 rounded-xl py-3 mt-4 px-11 text-white font-bold hover:bg-primary-900">
                        Login
                    </button>
                </form>
            </div>
            <div>
                <img src="{{asset('img/Iluslator.png') }}" alt="" class="mt-11 ml-8 w-[600px]">
            </div>
        </div>
    </div>
</body>
</html>