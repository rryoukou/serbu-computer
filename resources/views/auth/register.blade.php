<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>

<h1>Register Pengguna</h1>

{{-- ERROR VALIDASI --}}
@if ($errors->any())
    <div style="color:red">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('register') }}">
    @csrf

    <input type="text" name="username"
        value="{{ old('username') }}"
        placeholder="Username" required>
    <br><br>

    <input type="text" name="nama"
        value="{{ old('nama') }}"
        placeholder="Nama Lengkap" required>
    <br><br>

    <input type="email" name="email"
        value="{{ old('email') }}"
        placeholder="Email" required>
    <br><br>

    <input type="date" name="tanggal_lahir"
        value="{{ old('tanggal_lahir') }}">
    <br><br>

    <select name="jenis_kelamin">
        <option value="">Pilih Jenis Kelamin</option>
        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>
            Laki-laki
        </option>
        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>
            Perempuan
        </option>
    </select>
    <br><br>

    <input type="text" name="no_hp"
        value="{{ old('no_hp') }}"
        placeholder="No HP">
    <br><br>

    <textarea name="alamat"
        placeholder="Alamat">{{ old('alamat') }}</textarea>
    <br><br>

    <input type="password" name="password"
        placeholder="Password" required>
    <br><br>

    <input type="password" name="password_confirmation"
        placeholder="Konfirmasi Password" required>
    <br><br>

    <button type="submit">Daftar</button>
</form>

<p>
    Sudah punya akun?
    <a href="{{ route('login') }}">Login</a>
</p>

</body>
</html>
