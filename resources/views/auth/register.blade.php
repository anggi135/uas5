<x-guest-layout>
    @push('css')
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        /* Card Styling */
        .register-card {
            background: #ffffff;
            border-radius: 24px;
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
        .btn-register-modern {
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
        .btn-register-modern:hover {
            background: #0056b3 !important;
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(13, 110, 253, 0.2);
        }

        /* Progress indicator sederhana untuk password (opsional visual) */
        .password-hint {
            font-size: 0.75rem;
            color: #64748b;
            margin-top: 4px;
        }
    </style>
    @endpush

    <div class="mb-8 text-center">
        <h3 class="text-2xl font-bold text-gray-800">Buat Akun Baru</h3>
        <p class="text-gray-500 mt-2">Bergabunglah untuk mendapatkan koleksi souvenir terbaik.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" class="font-semibold text-gray-700 ml-1" />
            <x-text-input id="name" 
                         class="custom-input block mt-1 w-full" 
                         type="text" 
                         name="name" 
                         :value="old('name')" 
                         required 
                         autofocus 
                         placeholder="Masukkan nama lengkap Anda"
                         autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Alamat Email')" class="font-semibold text-gray-700 ml-1" />
            <x-text-input id="email" 
                         class="custom-input block mt-1 w-full" 
                         type="email" 
                         name="email" 
                         :value="old('email')" 
                         required 
                         placeholder="contoh@email.com"
                         autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" class="font-semibold text-gray-700 ml-1" />
            <x-text-input id="password" 
                         class="custom-input block mt-1 w-full"
                         type="password"
                         name="password"
                         required 
                         placeholder="Minimal 8 karakter"
                         autocomplete="new-password" />
            <p class="password-hint px-1 italic">Gunakan kombinasi huruf, angka, dan simbol untuk keamanan ekstra.</p>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="font-semibold text-gray-700 ml-1" />
            <x-text-input id="password_confirmation" 
                         class="custom-input block mt-1 w-full"
                         type="password"
                         name="password_confirmation" 
                         required 
                         placeholder="Ulangi password Anda"
                         autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-4">
            <x-primary-button class="btn-register-modern">
                {{ __('Daftar Sekarang') }}
            </x-primary-button>
        </div>

        <div class="text-center mt-6">
            <p class="text-sm text-gray-600">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline">Masuk di sini</a>
            </p>
        </div>
    </form>
</x-guest-layout>