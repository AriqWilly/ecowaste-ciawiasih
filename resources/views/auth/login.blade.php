<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Masuk Admin - Sistem Informasi Pengelolaan Sampah Desa Ciawiasih</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo_recycle.png') }}"/>
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo_recycle.png') }}"/>
    <!-- Material Symbols & Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <!-- Tailwind Config -->
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "tertiary": "#1f6223",
              "on-tertiary-container": "#c8ffbf",
              "surface-container-low": "#f3f4f5",
              "on-primary-fixed": "#002204",
              "on-background": "#191c1d",
              "primary": "#0d631b",
              "primary-container": "#2e7d32",
              "on-secondary-fixed-variant": "#604100",
              "surface-container-high": "#e7e8e9",
              "tertiary-container": "#3a7b39",
              "secondary-container": "#feb300",
              "surface-container": "#edeeef",
              "on-secondary": "#ffffff",
              "inverse-surface": "#2e3132",
              "on-secondary-container": "#6a4800",
              "surface-tint": "#1b6d24",
              "on-error-container": "#93000a",
              "inverse-primary": "#88d982",
              "on-tertiary-fixed": "#002203",
              "inverse-on-surface": "#f0f1f2",
              "outline": "#707a6c",
              "surface": "#f8f9fa",
              "tertiary-fixed-dim": "#91d78a",
              "on-primary": "#ffffff",
              "surface-bright": "#f8f9fa",
              "error": "#ba1a1a",
              "on-surface-variant": "#40493d",
              "surface-dim": "#d9dadb",
              "on-primary-fixed-variant": "#005312",
              "error-container": "#ffdad6",
              "on-secondary-fixed": "#281900",
              "secondary-fixed": "#ffdeac",
              "on-tertiary-fixed-variant": "#0c5216",
              "outline-variant": "#bfcaba",
              "background": "#f8f9fa",
              "on-primary-container": "#cbffc2",
              "secondary-fixed-dim": "#ffba38",
              "tertiary-fixed": "#acf4a4",
              "primary-fixed-dim": "#88d982",
              "on-error": "#ffffff",
              "surface-variant": "#e1e3e4",
              "secondary": "#7e5700",
              "on-surface": "#191c1d",
              "primary-fixed": "#a3f69c",
              "surface-container-highest": "#e1e3e4",
              "surface-container-lowest": "#ffffff",
              "on-tertiary": "#ffffff"
            },
            fontFamily: {
              sans: ["Inter", "sans-serif"],
            }
          }
        }
      }
    </script>
</head>
<body class="bg-surface text-on-surface flex flex-col min-h-screen font-sans" x-data="{ showPassword: false }">

    <!-- TopNavBar -->
    <header class="bg-surface w-full border-b border-outline-variant/30">
        <div class="flex justify-between items-center w-full px-6 py-4 max-w-[1200px] mx-auto">
            <a href="{{ route('home') }}" class="flex items-center gap-2 font-bold text-xl text-primary hover:opacity-90 transition-opacity">
                <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">eco</span>
                <span>Ciawiasih Eco-System</span>
            </a>
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="text-xs font-semibold text-on-surface-variant hover:text-primary transition-colors flex items-center gap-1">
                    <span class="material-symbols-outlined text-base">arrow_back</span>
                    <span>Kembali ke Website</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center p-4 sm:p-6 lg:p-10">
        <div class="w-full max-w-[1000px] flex flex-col lg:flex-row bg-surface-container-lowest rounded-2xl overflow-hidden shadow-[0px_4px_24px_rgba(0,0,0,0.06)] border border-outline-variant/30">
            
            <!-- Left Side: Visual Image & Branding -->
            <div class="hidden lg:block lg:w-1/2 relative bg-surface-variant min-h-[500px]">
                <img class="absolute inset-0 w-full h-full object-cover" 
                     src="https://lh3.googleusercontent.com/aida-public/AB6AXuAZXpm-yHlpUIefSHXqqz9AeDJqz6NzfQZWXwO9wCTLaG0iWartyvZnRmgtQcEPOsY5qzPA6jWMQESb8B5G8sw_CmR-kNM8U80Qp8JJyJbRjRghZMPPQMJY1EBHkLisRXMeRwZgjoS9x8nEj9CNjFx02YF8hUNhiCIXUKbNX0_ePb7RgEfSDrWTdk2uEkg31jxKIu8PGKgFF7Feg_ugu7OxKPX5egjFWuizKrRduBdIDtK-s0PUnP5bjw"
                     alt="Fasilitas Pengolahan & Daur Ulang Sampah Desa Ciawiasih"/>
                <div class="absolute inset-0 bg-primary/20 mix-blend-multiply"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent flex flex-col justify-end p-8 text-white">
                    <h2 class="text-2xl font-bold leading-tight">Pengelolaan Sampah & Daur Ulang Terpadu</h2>
                    <p class="text-xs text-white/90 mt-2">Mendukung terwujudnya desa mandiri, hijau, dan berdaya saing ekonomi.</p>
                </div>
            </div>

            <!-- Right Side: Login Card -->
            <div class="w-full lg:w-1/2 p-8 sm:p-12 flex flex-col justify-center">
                <div class="mb-6">
                    <h1 class="text-2xl sm:text-3xl font-bold text-on-surface mb-1">
                        Selamat Datang Kembali
                    </h1>
                    <p class="text-sm text-on-surface-variant">
                        Masuk ke portal administrator untuk mengelola katalog, edukasi, atau pengaturan desa.
                    </p>
                </div>

                <!-- Toast Alerts -->
                @if(session('success'))
                <div class="mb-5 bg-primary-container text-on-primary-container p-3.5 rounded-xl text-xs font-medium flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">check_circle</span>
                    <span>{{ session('success') }}</span>
                </div>
                @endif

                @if($errors->any())
                <div class="mb-5 bg-error-container text-on-error-container p-3.5 rounded-xl text-xs flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">error</span>
                    <span>{{ $errors->first() }}</span>
                </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Email/Username -->
                    <div class="flex flex-col gap-1.5">
                        <label class="text-xs font-semibold text-on-surface" for="email">Email Administrator</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-on-surface-variant text-lg">mail</span>
                            <input class="w-full bg-surface-container-low border border-outline-variant rounded-xl pl-10 pr-4 py-2.5 text-sm text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors" 
                                   id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email administrator" type="email" required autofocus/>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="flex flex-col gap-1.5">
                        <div class="flex justify-between items-center">
                            <label class="text-xs font-semibold text-on-surface" for="password">Kata Sandi</label>
                        </div>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-on-surface-variant text-lg">lock</span>
                            <input :type="showPassword ? 'text' : 'password'" 
                                   class="w-full bg-surface-container-low border border-outline-variant rounded-xl pl-10 pr-11 py-2.5 text-sm text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors" 
                                   id="password" name="password" placeholder="Masukkan kata sandi" required/>
                            <button type="button" @click="showPassword = !showPassword" 
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-primary transition-colors flex items-center justify-center p-1">
                                <span class="material-symbols-outlined text-[20px]" x-text="showPassword ? 'visibility_off' : 'visibility'"></span>
                            </button>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="pt-3 space-y-4">
                        <button type="submit" 
                                class="w-full bg-primary hover:bg-primary-container text-on-primary font-semibold text-sm py-3 px-6 rounded-xl transition-all shadow-sm flex items-center justify-center gap-2">
                            <span>Masuk ke Dashboard</span>
                            <span class="material-symbols-outlined text-lg">login</span>
                        </button>
                        
                        <p class="text-center text-xs text-on-surface-variant">
                            Perlu bantuan akses? <a class="text-primary font-semibold hover:underline" href="{{ route('contact') }}">Hubungi Pengurus Desa</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Clean Footer -->
    <footer class="py-6 px-6 text-center text-xs text-on-surface-variant border-t border-outline-variant/20">
        <p>© {{ date('Y') }} Ciawiasih Eco-System • Portal Administrator Desa Ciawiasih</p>
    </footer>

</body>
</html>
