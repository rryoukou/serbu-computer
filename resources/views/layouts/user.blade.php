@vite('resources/css/app.css')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>User Panel</title>
    <style>
        body { margin:0; font-family: Arial; }
        .navbar {
            background: #2563eb;
            padding: 15px;
            color: white;
            display: flex;
            justify-content: space-between;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin-right: 15px;
        }
        .content {
            padding: 20px;
        }
    </style>
</head>
<body>

@include('partials.navbar-user')

<div class="content">
    @yield('content')
</div>

@include('partials.footer')

</body>
</html>
