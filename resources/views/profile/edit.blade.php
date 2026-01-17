@extends('layouts.user')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-lg mt-10">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Profil</h2>

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Pesan error --}}
    @if ($errors->any())
        <div class="mb-4 px-4 py-2 bg-red-100 text-red-800 rounded">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 mb-1">Username</label>
                <input type="text" name="username" value="{{ old('username', $user->username) }}" placeholder="Username"
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div>
                <label class="block text-gray-700 mb-1">Nama</label>
                <input type="text" name="nama" value="{{ old('nama', $user->nama) }}" placeholder="Nama"
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div>
                <label class="block text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Email"
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div>
                <label class="block text-gray-700 mb-1">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}"
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 mb-1">Jenis Kelamin</label>
                <select name="jenis_kelamin"
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="">Pilih</option>
                    <option value="L" @selected($user->jenis_kelamin == 'L')>Laki-laki</option>
                    <option value="P" @selected($user->jenis_kelamin == 'P')>Perempuan</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 mb-1">No HP</label>
                <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" placeholder="No HP"
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
        </div>

        <div>
            <label class="block text-gray-700 mb-1">Alamat</label>
            <textarea name="alamat" placeholder="Alamat" rows="3"
                class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">{{ old('alamat', $user->alamat) }}</textarea>
        </div>

        <hr class="my-4">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 mb-1">Password Baru</label>
                <input type="password" name="password" placeholder="Password baru"
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div>
                <label class="block text-gray-700 mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" placeholder="Konfirmasi password"
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
        </div>

        <hr class="my-4">

        <div class="flex items-center gap-4">
            @if ($user->foto)
                <img src="{{ asset('storage/foto/' . $user->foto) }}" alt="Foto Profil" class="w-28 h-28 rounded-full object-cover border">
            @endif
            <div>
                <label class="block text-gray-700 mb-1">Upload Foto</label>
                <input type="file" name="foto" class="block">
            </div>
        </div>

        <div class="mt-6">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded-md transition">
                Simpan Profil
            </button>
        </div>
    </form>
</div>
@endsection
