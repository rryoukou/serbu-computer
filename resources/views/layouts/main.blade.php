<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Serbu Computer - Servis & Jual Laptop Sawojajar')</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Serbu Computer: Pusat servis laptop, jual beli laptop bekas & baru, serta aksesoris komputer termurah di Sawojajar. Solusi IT terpercaya untuk Anda.">
    <meta name="keywords" content="servis laptop sawojajar, beli laptop sawojajar, jual laptop sawojajar, aksesoris laptop sawojajar, serbu computer, laptop malang, reparasi laptop sawojajar">
    <meta name="author" content="Serbu Computer">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Serbu Computer - Servis & Jual Laptop Sawojajar">
    <meta property="og:description" content="Servis laptop kilat dan jual beli laptop aksesoris terlengkap di Sawojajar Malang.">
    <meta property="og:image" content="{{ asset('images/logo.png') }}">

    <link rel="icon" type="image/png" href="{{ asset('images/iconsc.png') }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="font-[Poppins] bg-[#090069]">

    @auth
        @include('partials.header-user')
    @else
        @include('partials.header-guest')
    @endauth

    <main class="min-h-screen">
        @yield('content')
    </main>

    @include('partials.footer')

</body>
</html>
