<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Serbu Comp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            background: radial-gradient(circle, #090069 0%, #0000FF 100%);
        }
        .login-card {
            background-color: #161B33;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">

    <div class="relative w-full max-w-[380px] sm:max-w-[420px] mt-8">

        <div class="absolute -top-14 left-1/2 -translate-x-1/2 z-10">
            <img src="{{ asset('images/logo.png') }}" 
                 alt="Logo" 
                 class="w-32 sm:w-36 md:w-44 drop-shadow-2xl object-contain">
        </div>

        <div class="login-card rounded-[24px] px-5 sm:px-8 pt-16 pb-8 sm:pb-10 shadow-2xl border border-white/5">

            <div class="text-center mb-6">
                <h1 class="text-base sm:text-xl font-semibold tracking-tight uppercase">
                    <span class="text-white">Admin</span>
                    <span class="text-[#F0B22B]">Login Panel</span>
                </h1>
            </div>

            @if ($errors->any())
                <div class="bg-red-500/10 border-l-4 border-red-500 text-red-400 text-[11px] sm:text-[13px] p-3 rounded mb-6">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-4">
                @csrf

                <div class="group">
                    <input type="text"
                           name="username"
                           value="{{ old('username') }}"
                           placeholder="Admin username"
                           required
                           class="w-full bg-[#2A314D]/50 text-gray-300 text-sm placeholder-gray-500 px-4 py-3.5 rounded-xl border border-white/5 focus:border-[#F0B22B]/50 focus:ring-1 focus:ring-[#F0B22B]/20 focus:outline-none transition-all">
                </div>

                <div class="group relative">
                    <input type="password"
                           id="password"
                           name="password"
                           placeholder="Admin password"
                           required
                           class="w-full bg-[#2A314D]/50 text-gray-300 text-sm placeholder-gray-500 px-4 py-3.5 pr-12 rounded-xl border border-white/5 focus:border-[#F0B22B]/50 focus:ring-1 focus:ring-[#F0B22B]/20 focus:outline-none transition-all">
                    
                    <button type="button" 
                            onclick="togglePassword()"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-[#F0B22B] transition-colors">
                        <i id="eye-icon" data-lucide="eye" class="w-5 h-5"></i>
                    </button>
                </div>

                <button type="submit"
                        class="w-full bg-gradient-to-r from-[#B8860B] to-[#F0B22B] text-white text-sm font-bold py-3.5 rounded-xl shadow-lg hover:brightness-110 active:scale-[0.96] transition-all uppercase tracking-widest mt-2">
                    Admin Sign in
                </button>
            </form>

        </div>
    </div>

    <script>
        // Inisialisasi Icon
        lucide.createIcons();

        let timer;

        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            
            // Clear timer kalau user klik lagi sebelum 5 detik
            clearTimeout(timer);

            if (passwordInput.type === 'password') {
                // Tampilkan password
                passwordInput.type = 'text';
                eyeIcon.setAttribute('data-lucide', 'eye-off');
                lucide.createIcons();

                // Set timer 3 detik untuk sembunyiin lagi
                timer = setTimeout(() => {
                    hidePassword();
                }, 3000);
            } else {
                hidePassword();
            }
        }

        function hidePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            
            passwordInput.type = 'password';
            eyeIcon.setAttribute('data-lucide', 'eye');
            lucide.createIcons();
        }
    </script>

</body>
</html>