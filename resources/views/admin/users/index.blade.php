@extends('layouts.admin')

@section('page_title', 'User Database')

@section('content')
    <div class="w-full px-4 md:px-0 pb-12">

        {{-- BARIS 1: JUDUL DENGAN ANIMASI --}}
        <div class="mb-6 reveal-anim" style="animation-delay: 0.1s">
            <h2 class="text-white text-2xl md:text-2xl font-black tracking-tight">
                Users Management
            </h2>
            <p class="text-gray-400 text-[10px] md:text-sm uppercase tracking-[0.2em] mt-1">
                Data Lengkap Member Serbu Comp
            </p>
        </div>

        {{-- BARIS 2: SEARCH & PER PAGE DENGAN ANIMASI --}}
        <div class="reveal-anim mb-8 flex flex-col md:flex-row items-center justify-between gap-4 bg-white/5 p-4 rounded-2xl border border-white/10 backdrop-blur-md shadow-xl"
            style="animation-delay: 0.2s">

            <form method="GET" action="{{ route('admin.users.index') }}"
                class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
                <select name="per_page" onchange="this.form.submit()"
                    class="w-full sm:w-auto bg-[#090069] border border-white/10 rounded-xl px-3 py-2.5 text-sm text-white focus:border-[#F0B22B] focus:outline-none transition-all cursor-pointer font-bold hover:bg-[#090069]/80">
                    <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>Show 5</option>
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>Show 10</option>
                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>Show 25</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>Show 50</option>
                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>Show 100</option>
                </select>

                <div class="relative w-full sm:w-80">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari member..."
                        class="w-full bg-[#090069] border border-white/10 rounded-xl pl-10 pr-4 py-2.5 text-sm text-white focus:border-[#F0B22B] focus:outline-none transition-all placeholder-gray-500" />
                    <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                            stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8" />
                            <path d="m21 21-4.3-4.3" />
                        </svg>
                    </div>
                </div>
            </form>

            <div
                class="flex items-center gap-3 bg-[#F0B22B]/10 px-5 py-2.5 rounded-2xl border border-[#F0B22B]/20 w-full md:w-auto justify-center group/total">
                <span class="w-2 h-2 rounded-full bg-[#F0B22B] animate-pulse"></span>
                <div class="text-left">
                    <p class="text-[#F0B22B] text-[9px] font-black uppercase tracking-wider leading-none">Total Members</p>
                    <p
                        class="text-white text-lg font-black leading-none mt-1 group-hover/total:scale-110 transition-transform">
                        {{ $users->total() }}</p>
                </div>
            </div>
        </div>

        {{-- TABLE CONTAINER DENGAN ANIMASI --}}
        <div class="reveal-anim bg-white/5 backdrop-blur-md rounded-[24px] md:rounded-[32px] border border-white/10 overflow-hidden shadow-2xl"
            style="animation-delay: 0.3s">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white/5 text-[#F0B22B] hidden md:table-row">
                            <th class="px-6 py-5 text-xs font-black uppercase tracking-widest">User</th>
                            <th class="px-6 py-5 text-xs font-black uppercase tracking-widest">Kontak</th>
                            <th class="px-6 py-5 text-xs font-black uppercase tracking-widest hidden xl:table-cell">Alamat
                            </th>
                            <th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-center">Profil</th>
                            <th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 flex flex-col md:table-row-group">
                        @foreach ($users as $index => $user)
                            <tr class="row-anim hover:bg-[#F0B22B]/5 transition-all group flex flex-col md:table-row p-5 md:p-0 relative"
                                style="animation-delay: {{ 0.4 + $index * 0.05 }}s">

                                <td class="px-0 md:px-6 py-2 md:py-5 border-none">
                                    <div class="flex items-center gap-4">
                                        <div class="relative shrink-0">
                                            <img src="{{ $user->foto ? asset('storage/foto/' . $user->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($user->nama) . '&background=F0B22B&color=090069' }}"
                                                class="w-12 h-12 rounded-2xl border-2 border-white/10 group-hover:border-[#F0B22B] group-hover:scale-110 transition-all object-cover">
                                            @if ($user->is_banned)
                                                <div
                                                    class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 border-2 border-[#090069] rounded-full shadow-lg shadow-red-500/50">
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <p
                                                class="text-white text-base font-bold leading-tight group-hover:text-[#F0B22B] transition-colors">
                                                {{ $user->nama }}</p>
                                            <p class="text-[#F0B22B] text-xs font-medium opacity-80 mt-1">@
                                                {{ $user->username }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-0 md:px-6 py-2 md:py-5">
                                    <div class="flex flex-col gap-0.5">
                                        <span
                                            class="text-gray-500 text-[9px] font-black uppercase md:hidden mb-1 tracking-widest">Kontak
                                            & Email</span>
                                        <p class="text-gray-200 text-sm font-medium truncate max-w-[250px]">
                                            {{ $user->email }}</p>
                                        <p class="text-gray-500 text-xs font-bold">{{ $user->no_hp ?? 'No WhatsApp' }}</p>
                                    </div>
                                </td>

                                <td class="px-0 md:px-6 py-2 md:py-5 hidden xl:table-cell">
                                    <p class="text-gray-400 text-xs italic line-clamp-2 max-w-[200px]">
                                        {{ $user->alamat ?? 'Alamat belum diatur' }}</p>
                                </td>

                                <td class="px-0 md:px-6 py-4 md:py-5 text-center">
                                    <button onclick="showUserDetail({{ json_encode($user) }})"
                                        class="w-full md:w-auto bg-white/10 text-white hover:bg-[#F0B22B] hover:text-[#090069] px-5 py-2.5 rounded-xl text-[10px] font-black uppercase transition-all border border-white/5 active:scale-90">
                                        Detail Profil
                                    </button>
                                </td>

                                <td class="px-0 md:px-6 py-2 md:py-5 text-center">
                                    <form action="{{ route('admin.users.toggleBan', $user->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin {{ $user->is_banned ? 'mengaktifkan' : 'membanned' }} user ini?')"
                                        class="w-full md:w-auto">
                                        @csrf
                                        <button type="submit"
                                            class="w-full md:w-auto px-6 py-2.5 rounded-xl text-[10px] font-black uppercase transition-all shadow-lg
                                    {{ $user->is_banned
                                        ? 'bg-green-500/20 text-green-400 hover:bg-green-500 hover:text-white shadow-green-500/10'
                                        : 'bg-red-500/20 text-red-400 hover:bg-red-500 hover:text-white shadow-red-500/10' }}">

                                            @if ($user->is_banned)
                                                <span class="flex items-center justify-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                                    </svg>
                                                    Unbanned
                                                </span>
                                            @else
                                                <span class="flex items-center justify-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                                        <circle cx="12" cy="12" r="10"></circle>
                                                        <line x1="4.93" y1="4.93" x2="19.07"
                                                            y2="19.07"></line>
                                                    </svg>
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

        @if ($users->hasPages())
            <div class="mt-20 flex justify-center custom-pagination reveal-anim" style="animation-delay: 0.8s">
                {{ $users->appends(request()->query())->links() }}
            </div>
        @endif
    </div>

    {{-- MODAL DETAIL TETAP SAMA NAMUN DITAMBAH TRANISI HALUS --}}
    <div id="userModal" class="fixed inset-0 z-[9999] hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-[#090069]/95 backdrop-blur-xl transition-opacity duration-300"
            onclick="closeModal()"></div>
        <div class="bg-[#161B33] border border-white/10 w-full max-w-xl rounded-[40px] p-6 md:p-10 relative z-10 shadow-[0_0_50px_rgba(0,0,0,0.5)] transform transition-all duration-300 scale-90 opacity-0"
            id="modalContent">
            <button onclick="closeModal()"
                class="absolute top-8 right-8 text-gray-500 hover:text-[#F0B22B] transition-all hover:rotate-90">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="3">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            <div class="flex flex-col items-center text-center">
                <div class="relative group">
                    <div
                        class="absolute -inset-1 bg-[#F0B22B] rounded-[36px] blur opacity-20 group-hover:opacity-40 transition duration-1000">
                    </div>
                    <img id="modalFoto" src=""
                        class="relative w-24 h-24 md:w-32 md:h-32 rounded-3xl border-4 border-[#F0B22B]/20 object-cover mb-4">
                </div>
                <h2 id="modalNama" class="text-white text-xl md:text-2xl font-black mt-2"></h2>
                <p id="modalUsername" class="text-[#F0B22B] text-sm font-bold italic mb-8"></p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 w-full">
                    <div
                        class="bg-white/5 p-4 rounded-2xl border border-white/5 text-left hover:border-[#F0B22B]/30 transition-colors">
                        <p class="text-[#F0B22B] text-[8px] font-black uppercase tracking-widest mb-1">Email Address</p>
                        <p id="modalEmail" class="text-white text-xs font-bold truncate"></p>
                    </div>
                    <div
                        class="bg-white/5 p-4 rounded-2xl border border-white/5 text-left hover:border-[#F0B22B]/30 transition-colors">
                        <p class="text-[#F0B22B] text-[8px] font-black uppercase tracking-widest mb-1">WhatsApp</p>
                        <p id="modalNoHp" class="text-white text-xs font-bold"></p>
                    </div>
                    <div
                        class="bg-white/5 p-4 rounded-2xl border border-white/5 text-left hover:border-[#F0B22B]/30 transition-colors">
                        <p class="text-[#F0B22B] text-[8px] font-black uppercase tracking-widest mb-1">Birthday</p>
                        <p id="modalTglLahir" class="text-white text-xs font-bold"></p>
                    </div>
                    <div
                        class="bg-white/5 p-4 rounded-2xl border border-white/5 text-left hover:border-[#F0B22B]/30 transition-colors">
                        <p class="text-[#F0B22B] text-[8px] font-black uppercase tracking-widest mb-1">Gender</p>
                        <p id="modalGender" class="text-white text-xs font-bold"></p>
                    </div>
                </div>
                <div
                    class="w-full mt-3 bg-white/5 p-4 rounded-2xl border border-white/5 text-left hover:border-[#F0B22B]/30 transition-colors">
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
            const fotoUrl = user.foto ? `/storage/foto/${user.foto}` :
                `https://ui-avatars.com/api/?name=${encodeURIComponent(user.nama)}&background=F0B22B&color=090069`;
            document.getElementById('modalFoto').src = fotoUrl;

            const modal = document.getElementById('userModal');
            const content = document.getElementById('modalContent');

            modal.classList.remove('hidden');
            setTimeout(() => {
                content.classList.remove('scale-90', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('userModal');
            const content = document.getElementById('modalContent');

            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-90', 'opacity-0');

            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }, 300);
        }
    </script>

    <style>
        /* 1. ANIMASI REVEAL UTAMA */
        @keyframes slideDownFade {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .reveal-anim {
            opacity: 0;
            animation: slideDownFade 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* 2. ANIMASI BARIS TABEL (STAGGERED) */
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .row-anim {
            opacity: 0;
            animation: slideInLeft 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* 3. CUSTOM PAGINATION STYLING (FIXED SLIM VERSION) */
        .custom-pagination nav {
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }

        /* Sembunyiin "Showing X to Y" HANYA pada desktop, tanpa menyembunyikan pagination mobile */
        .custom-pagination nav>div.hidden>div:first-child {
            display: none !important;
        }

        .custom-pagination nav>div.hidden>div:last-child {
            background: transparent !important;
            width: 100%;
            display: flex;
            justify-content: center;
        }

        /* Menghilangkan background wrapper dasar dari span container */
        .custom-pagination nav span.relative {
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }

        /* Styling Tombol Angka & Arrow (Mencegah targeting ke span wrapper) */
        .custom-pagination nav span.relative>span,
        .custom-pagination nav span.relative>a,
        .custom-pagination nav>div:first-child>a,
        .custom-pagination nav>div:first-child>span {
            border-radius: 12px !important;
            background: rgba(255, 255, 255, 0.03) !important;
            color: #6b7280 !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            padding: 8px 14px !important;
            font-size: 11px !important;
            font-weight: 800 !important;
            margin: 0 2px !important;
            transition: all 0.3s ease !important;
            box-shadow: none !important;
        }

        /* Hover Effect */
        .custom-pagination nav span.relative>a:hover,
        .custom-pagination nav>div:first-child>a:hover {
            background: rgba(240, 178, 43, 0.1) !important;
            color: #F0B22B !important;
            border-color: #F0B22B !important;
            transform: translateY(-2px);
        }

        /* Active Page (Halaman yang lagi dibuka) */
        .custom-pagination nav span[aria-current="page"]>span {
            background: #F0B22B !important;
            color: #090069 !important;
            border-color: #F0B22B !important;
            box-shadow: 0 5px 15px rgba(240, 178, 43, 0.2) !important;
        }

        /* Ukuran Icon Arrow */
        .custom-pagination nav svg {
            width: 14px !important;
            height: 14px !important;
        }
    </style>
@endsection
