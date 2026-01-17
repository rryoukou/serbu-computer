@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Manajemen Pengguna</h1>

@if (session('success'))
    <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white shadow rounded-lg overflow-x-auto">
<table class="w-full border-collapse text-sm">
    <thead class="bg-gray-100">
        <tr>
            <th class="px-3 py-2">Foto</th>
            <th class="px-3 py-2">Username</th>
            <th class="px-3 py-2">Nama</th>
            <th class="px-3 py-2">Email</th>
            <th class="px-3 py-2">No HP</th>
            <th class="px-3 py-2">Gender</th>
            <th class="px-3 py-2">Alamat</th>
            <th class="px-3 py-2 text-center">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($users as $user)
            <tr class="border-t">
                <td class="px-3 py-2">
                    <img
                        src="{{ $user->foto 
                            ? asset('storage/foto/' . $user->foto)
                            : 'https://via.placeholder.com/40' }}"
                        class="w-10 h-10 rounded-full object-cover">
                </td>

                <td class="px-3 py-2">{{ $user->username }}</td>
                <td class="px-3 py-2">{{ $user->nama }}</td>
                <td class="px-3 py-2">{{ $user->email }}</td>
                <td class="px-3 py-2">{{ $user->no_hp ?? '-' }}</td>
                <td class="px-3 py-2">
                    {{ $user->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
                </td>
                <td class="px-3 py-2 truncate max-w-xs">
                    {{ $user->alamat ?? '-' }}
                </td>

                <td class="px-3 py-2 text-center">
                    <form method="POST"
                          action="{{ route('admin.users.destroy', $user->id) }}"
                          onsubmit="return confirm('Yakin hapus pengguna ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center py-6 text-gray-500">
                    Belum ada pengguna
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
</div>
@endsection
