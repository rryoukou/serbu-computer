@extends('layouts.main')

@section('content')
<style>
    /* Keyframes Animasi Custom */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideInRight {
        from { opacity: 0; transform: translateX(50px); }
        to { opacity: 1; transform: translateX(0); }
    }

    @keyframes scaleIn {
        from { opacity: 0; transform: scale(0.9); }
        to { opacity: 1; transform: scale(1); }
    }

    /* Class Helper Animasi */
    .animate-fade-up { animation: fadeInUp 0.7s ease-out forwards; }
    .animate-slide-right { animation: slideInRight 0.8s ease-out forwards; }
    .animate-scale-in { animation: scaleIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
    
    /* Delay agar muncul bergantian */
    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }
</style>

<div class="min-h-screen bg-[#090069] py-12 px-4 overflow-x-hidden">
    <div class="max-w-5xl mx-auto">
        
        {{-- Header Page --}}
        <div class="mb-8 flex items-center justify-between animate-fade-up">
            <h2 class="text-3xl font-bold text-white tracking-wide">Profile</h2>
            <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-[#F0B22B] transition-colors text-sm md:hidden">
                ← Kembali
            </a>
        </div>

        {{-- Alerts --}}
        @if (session('success'))
            <div class="mb-6 px-6 py-4 bg-green-500/20 border border-green-500 text-green-200 rounded-xl backdrop-blur-md animate-scale-in">
                {{ session('success') }}
            </div>
        @endif

        {{-- MAIN CARD --}}
        <div class="bg-[#000066] rounded-[30px] shadow-2xl overflow-hidden border border-white/10 p-6 md:p-12 animate-fade-up delay-100">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf

                <div class="flex flex-col lg:flex-row gap-12">
                    
                    {{-- FOTO PROFIL --}}
                    <div class="w-full lg:w-[300px] flex flex-col items-center justify-start space-y-6 order-first lg:order-last animate-scale-in delay-300">
                        <div class="relative group">
                            <div class="w-40 h-40 md:w-56 md:h-56 bg-white rounded-full p-1 shadow-2xl overflow-hidden flex items-center justify-center border-4 border-[#F0B22B]/30 transition-transform duration-500 group-hover:scale-105">
                                @if ($user->foto)
                                    <img id="preview_foto" src="{{ asset('storage/foto/' . $user->foto) }}" 
                                        class="w-full h-full rounded-full object-cover">
                                @else
                                    <img id="preview_foto" src="" class="w-full h-full rounded-full object-cover hidden">
                                    <div id="placeholder_icon" class="text-gray-200">
                                        <svg class="w-24 h-24 md:w-32 md:h-32" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            
                            <label for="foto_input" class="absolute bottom-2 right-2 md:bottom-4 md:right-4 bg-[#F0B22B] p-3 rounded-full cursor-pointer shadow-lg hover:bg-yellow-400 transition transform hover:scale-110 active:scale-95">
                                <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                </svg>
                            </label>
                        </div>
                        
                        <div class="text-center">
                            <h4 class="text-white font-semibold hidden lg:block">{{ $user->username }}</h4>
                            <p class="text-gray-400 text-xs px-4 mt-1">Klik ikon kamera untuk mengganti foto profil.</p>
                        </div>
                    </div>

                    {{-- INPUT FIELDS --}}
<div class="flex-1 space-y-6 animate-slide-right delay-200">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-gray-300 text-sm font-medium mb-2 ml-1">Username</label>
            <input type="text" name="username" value="{{ old('username', $user->username) }}" 
                class="w-full bg-white rounded-2xl px-5 py-3 text-gray-800 focus:ring-4 focus:ring-[#F0B22B]/50 outline-none transition-all shadow-inner">
        </div>
        <div>
            <label class="block text-gray-300 text-sm font-medium mb-2 ml-1">Nama Lengkap</label>
            <input type="text" name="nama" value="{{ old('nama', $user->nama) }}" 
                class="w-full bg-white rounded-2xl px-5 py-3 text-gray-800 focus:ring-4 focus:ring-[#F0B22B]/50 outline-none transition-all shadow-inner">
        </div>

        {{-- Baris Email & No HP --}}
        <div>
            <label class="block text-gray-300 text-sm font-medium mb-2 ml-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                class="w-full bg-white rounded-2xl px-5 py-3 text-gray-800 focus:ring-4 focus:ring-[#F0B22B]/50 outline-none transition-all shadow-inner">
        </div>
        <div>
            <label class="block text-gray-300 text-sm font-medium mb-2 ml-1">Nomor HP</label>
            <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" placeholder="Contoh: 08123456789"
                class="w-full bg-white rounded-2xl px-5 py-3 text-gray-800 focus:ring-4 focus:ring-[#F0B22B]/50 outline-none transition-all shadow-inner">
        </div>

        <div>
            <label class="block text-gray-300 text-sm font-medium mb-2 ml-1">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}"
                class="w-full bg-white rounded-2xl px-5 py-3 text-gray-800 focus:ring-4 focus:ring-[#F0B22B]/50 outline-none transition-all shadow-inner">
        </div>
        <div>
            <label class="block text-gray-300 text-sm font-medium mb-2 ml-1">Jenis Kelamin</label>
            <div class="relative">
                <select name="jenis_kelamin" class="w-full bg-white rounded-2xl px-5 py-3 text-gray-800 focus:ring-4 focus:ring-[#F0B22B]/50 outline-none transition-all shadow-inner appearance-none">
                    <option value="">Pilih</option>
                    <option value="L" @selected($user->jenis_kelamin == 'L')>Laki-laki</option>
                    <option value="P" @selected($user->jenis_kelamin == 'P')>Perempuan</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
        </div>
    </div>
                        <div class="md:col-span-2">
                            <label class="block text-gray-300 text-sm font-medium mb-2 ml-1">Alamat</label>
                            <textarea name="alamat" rows="3" class="w-full bg-white rounded-2xl px-5 py-3 text-gray-800 focus:ring-4 focus:ring-[#F0B22B]/50 outline-none transition-all shadow-inner resize-none">{{ old('alamat', $user->alamat) }}</textarea>
                        </div>

                        {{-- Password Section --}}
                        <div class="pt-4 border-t border-white/10 mt-6">
                            <h3 class="text-[#F0B22B] font-semibold mb-4 text-lg">Ganti Password</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <input type="password" name="password" placeholder="Password Baru" class="w-full bg-white rounded-2xl px-5 py-3 text-gray-800 focus:ring-4 focus:ring-[#F0B22B]/50 outline-none transition-all shadow-inner">
                                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" class="w-full bg-white rounded-2xl px-5 py-3 text-gray-800 focus:ring-4 focus:ring-[#F0B22B]/50 outline-none transition-all shadow-inner">
                            </div>
                        </div>

                        <div class="pt-8">
                            <button type="submit" class="w-full bg-[#F0B22B] hover:bg-yellow-400 text-black font-extrabold px-6 py-4 rounded-2xl transition duration-300 transform hover:-translate-y-1 shadow-[0_10px_20px_rgba(240,178,43,0.3)] uppercase tracking-widest text-sm">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>
                <input type="file" name="foto" id="foto_input" class="hidden" accept="image/*">
            </form>
        </div>
    </div>
</div>

{{-- Tombol Kembali --}}
<a href="{{ route('dashboard') }}" class="fixed bottom-6 left-6 z-50 hidden md:inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#0c0c3d] border border-gray-700 text-sm font-medium text-gray-200 shadow-2xl hover:border-[#F0B22B] hover:text-[#F0B22B] transition-all duration-300 group animate-fade-up delay-300">
    <span class="transform group-hover:-translate-x-1 transition-transform">←</span> Kembali ke Dashboard
</a>

<script>
    document.getElementById('foto_input').onchange = evt => {
        const [file] = evt.target.files
        if (file) {
            const preview = document.getElementById('preview_foto');
            const placeholder = document.getElementById('placeholder_icon');
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
            if(placeholder) placeholder.classList.add('hidden');
        }
    }
</script>
@endsection