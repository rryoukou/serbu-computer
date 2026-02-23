<div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
     class="fixed lg:static inset-y-0 left-0 w-64 bg-[#090069] text-white flex flex-col h-screen border-r border-white/5 z-[50] transition-transform duration-300 ease-in-out lg:translate-x-0">
    
    <div class="p-6 flex items-center relative shrink-0 min-h-[90px]">
    <div class="flex-1 flex items-center lg:justify-start justify-center">
        <img src="{{ asset('images/logo.png') }}" 
             alt="Logo SC" 
             class="w-28 md:w-32 drop-shadow-xl object-contain block mx-auto lg:mx-0">
    </div>
    
    <button @click="sidebarOpen = false" 
            class="lg:hidden absolute right-4 p-2 text-gray-400 hover:text-[#F0B22B] hover:bg-white/5 rounded-xl transition-all">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
    </button>
</div>

    <nav class="flex-1 px-4 py-2 space-y-1.5 overflow-y-auto custom-scrollbar">
        
        <a href="{{ route('admin.dashboard') }}" 
           class="group flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-300 
           {{ request()->routeIs('admin.dashboard') ? 'bg-black/30 text-[#F0B22B] border-r-4 border-[#F0B22B]' : 'text-gray-400 hover:text-[#F0B22B] hover:bg-white/5' }}">
            <div class="shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/>
                </svg>
            </div>
            <span class="font-bold text-base tracking-wide">Dashboard</span>
        </a>

        <a href="{{ route('admin.products.index') }}" 
           class="group flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-300 
           {{ request()->routeIs('admin.products.*') ? 'bg-black/30 text-[#F0B22B] border-r-4 border-[#F0B22B]' : 'text-gray-400 hover:text-[#F0B22B] hover:bg-white/5' }}">
            <div class="shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/>
                </svg>
            </div>
            <span class="font-bold text-base tracking-wide">Product</span>
        </a>

        <a href="{{ route('admin.orders.index') }}" 
           class="group flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-300 
           {{ request()->routeIs('admin.orders.*') ? 'bg-black/30 text-[#F0B22B] border-r-4 border-[#F0B22B]' : 'text-gray-400 hover:text-[#F0B22B] hover:bg-white/5' }}">
            <div class="shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 9a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V9Z"/><path d="M7 21V5a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v16"/>
                </svg>
            </div>
            <span class="font-bold text-base tracking-wide">Transaction</span>
        </a>

        <a href="{{ route('admin.users.index') }}" 
           class="group flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-300 
           {{ request()->routeIs('admin.users.*') ? 'bg-black/30 text-[#F0B22B] border-r-4 border-[#F0B22B]' : 'text-gray-400 hover:text-[#F0B22B] hover:bg-white/5' }}">
            <div class="shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>
            <span class="font-bold text-base tracking-wide">Users</span>
        </a>
    </nav>

    <div class="p-4 border-t border-white/5">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="group flex items-center justify-center lg:justify-start gap-4 w-full px-5 py-3.5 text-[#F0B22B] bg-white/5 hover:bg-red-600 hover:text-white rounded-2xl transition-all duration-300 font-bold uppercase text-xs tracking-widest shadow-inner">
                <svg class="transition-transform group-hover:-translate-x-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/>
                </svg>
                <span>Logout</span>
            </button>
        </form>
    </div>
</div>