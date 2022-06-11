<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css"/>
    <title>@yield('title')</title>
</head>

<body>
    <div class="flex flex-col">
        <div class="container mx-auto mb-10">
            @yield('content')
        </div>
    </div>
</body>

</html>
