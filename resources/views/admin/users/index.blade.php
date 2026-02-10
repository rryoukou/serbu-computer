@extends('layouts.admin')

@section('page_title', 'User Database')

@section('content')
<div class="w-full px-4 md:px-8 pb-12">

    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-6">

        {{-- LEFT : TITLE --}}
        <div>
            <h2 class="text-white text-2xl md:text-3xl font-black tracking-tight">
                Manajemen Pengguna
            </h2>
            <p class="text-gray-400 text-xs md:text-sm uppercase tracking-[0.25em] mt-1">
                Data Lengkap Member Serbu Comp
            </p>
        </div>

        {{-- MIDDLE : SEARCH --}}
        <form method="GET" action="{{ route('admin.users.index') }}"
              class="w-full md:w-[360px]">
            <div class="relative">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama / username / email..."
                    class="w-full bg-[#0B0B5A] text-white text-sm px-5 py-3
                           rounded-2xl outline-none
                           border border-white/10
                           focus:border-[#F0B22B]/60
                           placeholder-gray-400"
                />

                {{-- icon --}}
                <svg class="absolute right-4 top-1/2 -translate-y-1/2
                            w-5 h-5 text-gray-400"
                     fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21 21l-4.35-4.35M16 10.5A5.5 5.5 0 1 1 5 10.5a5.5 5.5 0 0 1 11 0Z"/>
                </svg>
            </div>
        </form>

        {{-- RIGHT : TOTAL --}}
        <div class="flex items-center gap-3 bg-[#F0B22B]/10 px-5 py-3 rounded-2xl
                    border border-[#F0B22B]/20">

            <span class="w-2 h-2 rounded-full bg-[#F0B22B] animate-pulse"></span>

            <div class="text-right">
                <p class="text-[#F0B22B] text-[10px] font-black uppercase tracking-widest">
                    Total Members
                </p>
                <p class="text-white text-xl font-black">
                    {{ $users->total() }}
                </p>
            </div>
        </div>

    </div>
</div>


    {{-- Container Tabel --}}
    <div class="bg-white/5 backdrop-blur-md rounded-[24px] md:rounded-[32px] border-2 border-white/10 overflow-hidden shadow-2xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    {{-- Header sembunyi di mobile, karena kita pakai sistem card --}}
                    <tr class="bg-white/10 text-[#F0B22B] hidden md:table-row">
                        <th class="px-6 py-5 text-sm font-black uppercase tracking-widest">User</th>
                        <th class="px-6 py-5 text-sm font-black uppercase tracking-widest hidden lg:table-cell">Kontak</th>
                        <th class="px-6 py-5 text-sm font-black uppercase tracking-widest hidden xl:table-cell">Alamat</th>
                        <th class="px-6 py-5 text-sm font-black uppercase tracking-widest text-center">Detail</th>
                        <th class="px-6 py-5 text-sm font-black uppercase tracking-widest text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5 flex flex-col md:table-row-group">
                    @foreach ($users as $user)
                    <tr class="hover:bg-white/[0.07] transition-all group flex flex-col md:table-row p-4 md:p-0">
                        
                        {{-- USER COLUMN --}}
                        <td class="px-0 md:px-6 py-2 md:py-5 border-none md:border-b border-white/5">
                            <div class="flex items-center gap-4">
                                <img src="{{ $user->foto ? asset('storage/foto/' . $user->foto) : 'https://ui-avatars.com/api/?name='.urlencode($user->nama).'&background=F0B22B&color=090069' }}" 
                                     class="w-12 h-12 rounded-full border-2 border-white/20 group-hover:border-[#F0B22B] shrink-0">
                                <div>
                                    <p class="text-white text-base font-bold">{{ $user->nama }}</p>
                                    <p class="text-[#F0B22B] text-xs font-black italic">@ {{ $user->username }}</p>
                                </div>
                            </div>
                        </td>

                        {{-- CONTACT COLUMN (Label muncul di mobile) --}}
                        <td class="px-0 md:px-6 py-2 md:py-5 md:table-cell">
                            <div class="flex flex-col">
                                <span class="text-gray-500 text-[10px] font-black uppercase md:hidden mb-1">Kontak:</span>
                                <p class="text-gray-200 text-sm font-medium">{{ $user->email }}</p>
                                <p class="text-gray-500 text-xs font-bold">{{ $user->no_hp ?? '-' }}</p>
                            </div>
                        </td>

                        {{-- ADDRESS COLUMN (Sembunyi di tablet, muncul di PC) --}}
                        <td class="px-0 md:px-6 py-2 md:py-5 hidden xl:table-cell">
                            <p class="text-gray-400 text-xs italic truncate max-w-[200px]">{{ $user->alamat ?? 'Belum ada alamat' }}</p>
                        </td>

                        {{-- DETAIL BUTTON --}}
                        <td class="px-0 md:px-6 py-4 md:py-5 text-center">
                            <button onclick="showUserDetail({{ json_encode($user) }})" 
                                    class="w-full md:w-auto bg-[#F0B22B] text-[#090069] px-6 py-2.5 rounded-xl text-xs font-black uppercase hover:scale-105 active:scale-95 transition-all">
                                Lihat Profil
                            </button>
                        </td>

                        {{-- ACTION BUTTON --}}
<td class="px-0 md:px-6 py-2 md:py-5 text-center flex md:table-cell justify-end">
    <form action="{{ route('admin.users.toggleBan', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin {{ $user->is_banned ? 'mengaktifkan' : 'membanned' }} user ini?')">
        @csrf
        <button type="submit"
            class="p-3 rounded-xl transition-all
            {{ $user->is_banned ? 'bg-green-500/10 text-green-500 hover:bg-green-500 hover:text-white' : 'bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white' }}">
            @if($user->is_banned)
                Unbanned
            @else
                Banned
            @endif
        </button>
    </form>
</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- PAGINATION --}}
    <div class="mt-8 flex justify-center overflow-x-auto pb-4 custom-pagination">
        {{ $users->links() }}
    </div>
</div>

{{-- MODAL DETAIL (Full Responsive) --}}
<div id="userModal" class="fixed inset-0 z-[9999] hidden bg-[#090069]/95 backdrop-blur-xl flex items-center justify-center p-4">
    <div class="bg-white/10 border-2 border-white/20 w-full max-w-2xl rounded-[32px] md:rounded-[40px] p-6 md:p-12 relative shadow-2xl animate-in fade-in zoom-in duration-300 max-h-[90vh] overflow-y-auto">
        
        <button onclick="closeModal()" class="absolute top-4 right-4 md:top-6 md:right-8 text-white/50 hover:text-[#F0B22B] transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>

        <div class="flex flex-col md:flex-row gap-6 md:gap-10 items-center md:items-start mt-4 md:mt-0">
            <img id="modalFoto" src="" class="w-28 h-28 md:w-48 md:h-48 rounded-[24px] md:rounded-[32px] border-4 border-[#F0B22B] shadow-2xl object-cover shrink-0">
            
            <div class="flex-1 space-y-4 md:space-y-6 text-center md:text-left">
                <div>
                    <h2 id="modalNama" class="text-white text-2xl md:text-3xl font-black"></h2>
                    <p id="modalUsername" class="text-[#F0B22B] text-base md:text-lg font-black italic mt-1"></p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-left">
                    <div class="bg-white/5 p-3 rounded-2xl border border-white/5">
                        <p class="text-gray-500 text-[9px] font-black uppercase tracking-widest">Email</p>
                        <p id="modalEmail" class="text-white text-sm font-bold truncate"></p>
                    </div>
                    <div class="bg-white/5 p-3 rounded-2xl border border-white/5">
                        <p class="text-gray-500 text-[9px] font-black uppercase tracking-widest">WhatsApp</p>
                        <p id="modalNoHp" class="text-white text-sm font-bold"></p>
                    </div>
                    <div class="bg-white/5 p-3 rounded-2xl border border-white/5">
                        <p class="text-gray-500 text-[9px] font-black uppercase tracking-widest">Birthday</p>
                        <p id="modalTglLahir" class="text-white text-sm font-bold"></p>
                    </div>
                    <div class="bg-white/5 p-3 rounded-2xl border border-white/5">
                        <p class="text-gray-500 text-[9px] font-black uppercase tracking-widest">Gender</p>
                        <p id="modalGender" class="text-white text-sm font-bold"></p>
                    </div>
                </div>

                <div class="pt-4 border-t border-white/10 text-left">
                    <p class="text-gray-500 text-[9px] font-black uppercase tracking-widest mb-2">Home Address</p>
                    <p id="modalAlamat" class="text-gray-300 text-sm italic leading-relaxed"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showUserDetail(user) {
    document.getElementById('modalNama').innerText = user.nama;
    document.getElementById('modalUsername').innerText = '@' + user.username;
    document.getElementById('modalEmail').innerText = user.email;
    document.getElementById('modalNoHp').innerText = user.no_hp || '-';
    document.getElementById('modalTglLahir').innerText = user.tanggal_lahir || '-';
    document.getElementById('modalGender').innerText = user.jenis_kelamin === 'L' ? 'Laki-Laki' : 'Perempuan';
    document.getElementById('modalAlamat').innerText = user.alamat || 'Belum mengisi alamat.';
    
    const fotoUrl = user.foto ? `/storage/foto/${user.foto}` : `https://ui-avatars.com/api/?name=${encodeURIComponent(user.nama)}&background=F0B22B&color=090069`;
    document.getElementById('modalFoto').src = fotoUrl;

    document.getElementById('userModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('userModal').classList.add('hidden');
}
</script>

<style>
    .custom-pagination nav svg { width: 24px; height: 24px; }
    .custom-pagination nav span, .custom-pagination nav a { 
        border-radius: 12px !important; background: rgba(255,255,255,0.05) !important;
        color: #fff !important; border: 1px solid rgba(255,255,255,0.1) !important;
        padding: 8px 16px !important; font-weight: bold;
    }
    .custom-pagination nav span[aria-current="page"] { background: #F0B22B !important; color: #090069 !important; }
</style>
@endsection