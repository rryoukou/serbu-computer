<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serbu Comp</title>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
</head>

<body class="font-[Poppins] bg-[#090069]">

    {{-- HEADER GUEST --}}
    @include('partials.header-guest')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

</body>
</html>
