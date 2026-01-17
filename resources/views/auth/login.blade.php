<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h1>Login</h1>

@if ($errors->any())
    <div style="color:red">
        {{ $errors->first() }}
    </div>
@endif

<form method="POST" action="/login">
    @csrf

    <input type="text" name="username" placeholder="Username" required>
    <br><br>

    <input type="password" name="password" placeholder="Password" required>
    <br><br>

    <button type="submit">Login</button>
</form>

<p>Belum punya akun? <a href="/register">Register</a></p>

</body>
</html>
