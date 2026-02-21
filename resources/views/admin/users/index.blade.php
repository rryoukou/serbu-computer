@extends('layouts.admin')

@section('page_title', 'User Database')

@section('content')
<div class="w-full px-4 md:px-0 pb-12">

    {{-- HEADER SECTION --}}
    <div class="mb-8 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
        <div>
            <h2 class="text-white text-2xl md:text-3xl font-black tracking-tight">
                Manajemen Pengguna
            </h2>
            <p class="text-gray-400 text-[10px] md:text-xs uppercase tracking-[0.2em] mt-1">
                Data Lengkap Member Serbu Comp
            </p>
        </div>

        <div class="flex flex-col md:flex-row gap-4 items-stretch md:items-center">
            {{-- SEARCH --}}
            <form method="GET" action="{{ route('admin.users.index') }}" class="relative w-full md:w-80">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari member..."
                    class="w-full bg-white/5 text-white text-sm px-5 py-3 rounded-2xl outline-none border border-white/10 focus:border-[#F0B22B]/60 placeholder-gray-500 transition-all"
                />
                <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M16 10.5A5.5 5.5 0 1 1 5 10.5a5.5 5.5 0 0 1 11 0Z"/>
                </svg>
            </form>

            {{-- TOTAL COUNTER --}}
            <div class="flex items-center gap-3 bg-[#F0B22B]/10 px-5 py-2.5 rounded-2xl border border-[#F0B22B]/20 shrink-0">
                <span class="w-2 h-2 rounded-full bg-[#F0B22B] animate-pulse"></span>
                <div class="text-left">
                    <p class="text-[#F0B22B] text-[9px] font-black uppercase tracking-wider">Total Members</p>
                    <p class="text-white text-lg font-black leading-none">{{ $users->total() }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- TABLE CONTAINER --}}
    <div class="bg-white/5 backdrop-blur-md rounded-[24px] md:rounded-[32px] border border-white/10 overflow-hidden shadow-2xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white/5 text-[#F0B22B] hidden md:table-row">
                        <th class="px-6 py-5 text-xs font-black uppercase tracking-widest">User</th>
                        <th class="px-6 py-5 text-xs font-black uppercase tracking-widest">Kontak</th>
                        <th class="px-6 py-5 text-xs font-black uppercase tracking-widest hidden xl:table-cell">Alamat</th>
                        <th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-center">Profil</th>
                        <th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5 flex flex-col md:table-row-group">
                    @foreach ($users as $user)
                    <tr class="hover:bg-white/[0.02] transition-all group flex flex-col md:table-row p-5 md:p-0 relative">
                        
                        {{-- USER COLUMN --}}
                        <td class="px-0 md:px-6 py-2 md:py-5 border-none">
                            <div class="flex items-center gap-4">
                                <div class="relative shrink-0">
                                    <img src="{{ $user->foto ? asset('storage/foto/' . $user->foto) : 'https://ui-avatars.com/api/?name='.urlencode($user->nama).'&background=F0B22B&color=090069' }}" 
                                         class="w-12 h-12 rounded-2xl border-2 border-white/10 group-hover:border-[#F0B22B] transition-all object-cover">
                                    @if($user->is_banned)
                                        <div class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 border-2 border-[#090069] rounded-full"></div>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-white text-base font-bold leading-tight">{{ $user->nama }}</p>
                                    <p class="text-[#F0B22B] text-xs font-medium opacity-80 mt-1">@ {{ $user->username }}</p>
                                </div>
                            </div>
                        </td>

                        {{-- CONTACT COLUMN --}}
                        <td class="px-0 md:px-6 py-2 md:py-5">
                            <div class="flex flex-col gap-0.5">
                                <span class="text-gray-500 text-[9px] font-black uppercase md:hidden mb-1 tracking-widest">Kontak & Email</span>
                                <p class="text-gray-200 text-sm font-medium truncate max-w-[250px]">{{ $user->email }}</p>
                                <p class="text-gray-500 text-xs font-bold">{{ $user->no_hp ?? 'No WhatsApp' }}</p>
                            </div>
                        </td>

                        {{-- ADDRESS COLUMN (PC ONLY) --}}
                        <td class="px-0 md:px-6 py-2 md:py-5 hidden xl:table-cell">
                            <p class="text-gray-400 text-xs italic line-clamp-2 max-w-[200px]">{{ $user->alamat ?? 'Alamat belum diatur' }}</p>
                        </td>

                        {{-- PROFILE BUTTON --}}
                        <td class="px-0 md:px-6 py-4 md:py-5 text-center">
                            <button onclick="showUserDetail({{ json_encode($user) }})" 
                                    class="w-full md:w-auto bg-white/10 text-white hover:bg-[#F0B22B] hover:text-[#090069] px-5 py-2.5 rounded-xl text-[10px] font-black uppercase transition-all border border-white/5">
                                Detail Profil
                            </button>
                        </td>
                        {{-- ACTION BUTTON (Toggle Ban) --}}
<td class="px-0 md:px-6 py-2 md:py-5 text-center">
    <form action="{{ route('admin.users.toggleBan', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin {{ $user->is_banned ? 'mengaktifkan' : 'membanned' }} user ini?')" class="w-full md:w-auto">
        @csrf
        <button type="submit"
            class="w-full md:w-auto px-6 py-2.5 rounded-xl text-[10px] font-black uppercase transition-all shadow-lg
            {{ $user->is_banned 
                ? 'bg-green-500/20 text-green-400 hover:bg-green-500 hover:text-white shadow-green-500/10' 
                : 'bg-red-500/20 text-red-400 hover:bg-red-500 hover:text-white shadow-red-500/10' }}">
            
            @if($user->is_banned)
                <span class="flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    Unbanned
                </span>
            @else
                <span class="flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>
                    Banned
                </span>
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
    <div class="mt-8 flex justify-center custom-pagination overflow-x-auto pb-4">
        {{ $users->links() }}
    </div>
</div>

{{-- MODAL DETAIL --}}
<div id="userModal" class="fixed inset-0 z-[9999] hidden flex items-center justify-center p-4">
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-[#090069]/90 backdrop-blur-md" onclick="closeModal()"></div>
    
    {{-- Modal Content --}}
    <div class="bg-[#161B33] border border-white/10 w-full max-w-xl rounded-[32px] p-6 md:p-10 relative z-10 shadow-2xl animate-in zoom-in duration-200">
        
        <button onclick="closeModal()" class="absolute top-6 right-6 text-gray-500 hover:text-[#F0B22B] transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>

        <div class="flex flex-col items-center text-center">
            <img id="modalFoto" src="" class="w-24 h-24 md:w-32 md:h-32 rounded-3xl border-4 border-[#F0B22B]/20 object-cover shadow-xl mb-4">
            
            <h2 id="modalNama" class="text-white text-xl md:text-2xl font-black"></h2>
            <p id="modalUsername" class="text-[#F0B22B] text-sm font-bold italic mb-8"></p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 w-full">
                <div class="bg-white/5 p-4 rounded-2xl border border-white/5 text-left">
                    <p class="text-[#F0B22B] text-[8px] font-black uppercase tracking-widest mb-1">Email Address</p>
                    <p id="modalEmail" class="text-white text-xs font-bold truncate"></p>
                </div>
                <div class="bg-white/5 p-4 rounded-2xl border border-white/5 text-left">
                    <p class="text-[#F0B22B] text-[8px] font-black uppercase tracking-widest mb-1">WhatsApp</p>
                    <p id="modalNoHp" class="text-white text-xs font-bold"></p>
                </div>
                <div class="bg-white/5 p-4 rounded-2xl border border-white/5 text-left">
                    <p class="text-[#F0B22B] text-[8px] font-black uppercase tracking-widest mb-1">Birthday</p>
                    <p id="modalTglLahir" class="text-white text-xs font-bold"></p>
                </div>
                <div class="bg-white/5 p-4 rounded-2xl border border-white/5 text-left">
                    <p class="text-[#F0B22B] text-[8px] font-black uppercase tracking-widest mb-1">Gender</p>
                    <p id="modalGender" class="text-white text-xs font-bold"></p>
                </div>
            </div>

            <div class="w-full mt-3 bg-white/5 p-4 rounded-2xl border border-white/5 text-left">
                <p class="text-[#F0B22B] text-[8px] font-black uppercase tracking-widest mb-1">Home Address</p>
                <p id="modalAlamat" class="text-white text-xs italic leading-relaxed"></p>
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

    const modal = document.getElementById('userModal');
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden'; // prevent scroll
}

function closeModal() {
    const modal = document.getElementById('userModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}
</script>

<style>
    .custom-pagination nav svg { width: 20px; height: 20px; }
    .custom-pagination nav div div span,
    .custom-pagination nav div div a {
        border-radius: 10px !important;
        background: rgba(255,255,255,0.05) !important;
        color: white !important;
        border-color: rgba(255,255,255,0.1) !important;
        padding: 6px 12px !important;
        font-size: 12px;
    }
    .custom-pagination nav span[aria-current="page"] {
        background: #F0B22B !important;
        color: #090069 !important;
        font-weight: 800;
    }
</style>
@endsection