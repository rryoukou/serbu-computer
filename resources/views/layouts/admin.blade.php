@vite('resources/css/app.css')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <style>
        body {
            margin: 0;
            font-family: Arial;
            display: flex;
        }
        .sidebar {
            width: 230px;
            background: #111827;
            color: white;
            min-height: 100vh;
            padding: 20px;
        }
        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 10px 0;
        }
        .sidebar a:hover {
            background: #1f2937;
            padding-left: 10px;
        }
        .content {
            flex: 1;
            padding: 25px;
        }
    </style>
</head>
<body>

@include('partials.sidebar-admin')

<div class="content">
    @yield('content')
</div>

</body>
</html>
