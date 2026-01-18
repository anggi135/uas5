<x-guest-layout>
    @push('css')
    <style>
        /* Mengatur font agar konsisten dengan halaman sebelumnya */
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        /* Card Login Custom */
        .login-card {
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.05);
            padding: 10px;
        }

        /* Input Styling */
        .custom-input {
            border-radius: 12px !important;
            border: 1px solid #e2e8f0 !important;
            padding: 12px 16px !important;
            transition: all 0.3s !important;
        }
        .custom-input:focus {
            border-color: #0d6efd !important;
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1) !important;
        }

        /* Button Styling */
        .btn-login-modern {
            background: #0d6efd !important;
            border-radius: 12px !important;
            padding: 12px !important;
            font-weight: 700 !important;
            text-transform: none !important;
            letter-spacing: normal !important;
            transition: all 0.3s !important;
            width: 100%;
            justify-content: center;
        }
        .btn-login-modern:hover {
            background: #0056b3 !important;
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(13, 110, 253, 0.2);
        }
    </style>
    @endpush

    <div class="mb-8 text-center">
        <h3 class="text-2xl font-bold text-gray-800">Selamat Datang Kembali</h3>
        <p class="text-gray-500 mt-2">Silakan masuk ke akun Anda untuk mulai berbelanja souvenir.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="font-semibold text-gray-700 ml-1" />
            <x-text-input id="email" 
                         class="custom-input block mt-1 w-full" 
                         type="email" 
                         name="email" 
                         :value="old('email')" 
                         required 
                         autofocus 
                         placeholder="nama@email.com"
                         autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <div class="flex justify-between items-center">
                <x-input-label for="password" :value="__('Password')" class="font-semibold text-gray-700 ml-1" />
                @if (Route::has('password.request'))
                    <a class="text-xs font-semibold text-blue-600 hover:text-blue-800 transition" href="{{ route('password.request') }}">
                        {{ __('Lupa Password?') }}
                    </a>
                @endif
            </div>

            <x-text-input id="password" 
                         class="custom-input block mt-1 w-full"
                         type="password"
                         name="password"
                         required 
                         placeholder="Masukkan password"
                         autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded-lg border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
            </label>
        </div>

        <div class="pt-2">
            <x-primary-button class="btn-login-modern">
                {{ __('Masuk Sekarang') }}
            </x-primary-button>
        </div>

        <div class="text-center mt-6">
            <p class="text-sm text-gray-600">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-blue-600 font-bold hover:underline">Daftar di sini</a>
            </p>
        </div>
    </form>
</x-guest-layout>