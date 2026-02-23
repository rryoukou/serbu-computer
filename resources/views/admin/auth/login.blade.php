<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Serbu Comp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: radial-gradient(circle, #090069 0%, #0000FF 100%);
        }
        .login-card {
            background-color: #161B33;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 sm:p-6">

    <div class="relative w-full max-w-[420px]">

        <div class="absolute -top-12 left-1/2 -translate-x-1/2 z-10">
            <img src="{{ asset('images/logo.png') }}" 
                 alt="Logo" 
                 class="w-28 sm:w-36 md:w-40 drop-shadow-xl">
        </div>

        <div class="login-card rounded-[24px] px-6 sm:px-8 pt-16 pb-8 sm:pb-10 shadow-2xl border border-white/5">

            <div class="text-center mb-6 sm:mb-8">
                <h1 class="text-lg sm:text-xl font-semibold tracking-tight">
                    <span class="text-white">Admin</span>
                    <span class="text-[#F0B22B]">Login Panel</span>
                </h1>
            </div>

            @if ($errors->any())
                <div class="bg-red-500/10 border-l-4 border-red-500 text-red-400 text-xs sm:text-[13px] p-3 rounded mb-6">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-4">
                @csrf

                <div>
                    <input type="text"
                           name="username"
                           value="{{ old('username') }}"
                           placeholder="Admin username"
                           required
                           class="w-full bg-[#2A314D]/50 text-gray-300 text-sm placeholder-gray-500 px-4 sm:px-5 py-3.5 rounded-xl border border-white/5 focus:border-[#F0B22B]/50 focus:outline-none transition-all">
                </div>

                <div>
                    <input type="password"
                           name="password"
                           placeholder="Admin password"
                           required
                           class="w-full bg-[#2A314D]/50 text-gray-300 text-sm placeholder-gray-500 px-4 sm:px-5 py-3.5 rounded-xl border border-white/5 focus:border-[#F0B22B]/50 focus:outline-none transition-all">
                </div>

                <button type="submit"
                        class="w-full bg-gradient-to-r from-[#B8860B] to-[#F0B22B] text-white text-sm font-bold py-3.5 rounded-xl shadow-lg hover:brightness-110 active:scale-[0.98] transition-all uppercase tracking-wide mt-2">
                    Admin Sign in
                </button>
            </form>

        </div>
    </div>

</body>
</html>