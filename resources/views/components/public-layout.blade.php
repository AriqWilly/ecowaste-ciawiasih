<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Katalog Daur Ulang Desa Ciawiasih' }}</title>
    <meta name="description" content="Sistem Informasi Pengelolaan Sampah & Katalog Daur Ulang Desa Ciawiasih, Kecamatan Susukan Lebak, Kabupaten Cirebon.">

    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>

    <!-- Tailwind CSS + Stitch Design System Tokens -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "tertiary-container": "#3a7b39",
                        "surface-dim": "#d9dadb",
                        "surface-container-high": "#e7e8e9",
                        "on-primary-fixed": "#002204",
                        "primary-fixed-dim": "#88d982",
                        "tertiary-fixed": "#acf4a4",
                        "on-surface": "#191c1d",
                        "surface-container": "#edeeef",
                        "inverse-primary": "#88d982",
                        "on-tertiary-fixed": "#002203",
                        "surface-container-lowest": "#ffffff",
                        "on-secondary-fixed-variant": "#604100",
                        "primary-fixed": "#a3f69c",
                        "primary": "#0d631b",
                        "error": "#ba1a1a",
                        "on-error": "#ffffff",
                        "surface-container-low": "#f3f4f5",
                        "tertiary-fixed-dim": "#91d78a",
                        "outline-variant": "#bfcaba",
                        "inverse-surface": "#2e3132",
                        "secondary": "#7e5700",
                        "primary-container": "#2e7d32",
                        "surface-tint": "#1b6d24",
                        "on-secondary": "#ffffff",
                        "on-background": "#191c1d",
                        "secondary-container": "#feb300",
                        "on-tertiary": "#ffffff",
                        "tertiary": "#1f6223",
                        "background": "#f8f9fa",
                        "on-secondary-container": "#6a4800",
                        "on-primary-container": "#cbffc2",
                        "on-primary": "#ffffff",
                        "surface-variant": "#e1e3e4",
                        "on-tertiary-fixed-variant": "#0c5216",
                        "on-secondary-fixed": "#281900",
                        "error-container": "#ffdad6",
                        "secondary-fixed": "#ffdeac",
                        "outline": "#707a6c",
                        "on-tertiary-container": "#c8ffbf",
                        "surface-bright": "#f8f9fa",
                        "surface": "#f8f9fa",
                        "surface-container-highest": "#e1e3e4",
                        "inverse-on-surface": "#f0f1f2",
                        "secondary-fixed-dim": "#ffba38",
                        "on-primary-fixed-variant": "#005312",
                        "on-surface-variant": "#40493d",
                        "on-error-container": "#93000a"
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    spacing: {
                        "base": "4px",
                        "margin-mobile": "16px",
                        "xs": "4px",
                        "md": "16px",
                        "container-max": "1200px",
                        "lg": "24px",
                        "xl": "40px",
                        "sm": "8px",
                        "gutter": "24px"
                    },
                    fontFamily: {
                        sans: ["Inter", "sans-serif"]
                    },
                    fontSize: {
                        "label-md": ["14px", { lineHeight: "20px", letterSpacing: "0.01em", fontWeight: "500" }],
                        "headline-xl": ["40px", { lineHeight: "48px", letterSpacing: "-0.02em", fontWeight: "700" }],
                        "label-sm": ["12px", { lineHeight: "16px", letterSpacing: "0.05em", fontWeight: "600" }],
                        "body-md": ["16px", { lineHeight: "24px", fontWeight: "400" }],
                        "headline-md": ["24px", { lineHeight: "32px", fontWeight: "600" }],
                        "body-lg": ["18px", { lineHeight: "28px", fontWeight: "400" }],
                        "headline-lg-mobile": ["28px", { lineHeight: "34px", fontWeight: "700" }],
                        "headline-lg": ["32px", { lineHeight: "40px", letterSpacing: "-0.01em", fontWeight: "700" }]
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined { font-family: 'Material Symbols Outlined'; font-weight: normal; font-style: normal; font-size: 24px; display: inline-block; line-height: 1; text-transform: none; letter-spacing: normal; word-wrap: normal; white-space: nowrap; direction: ltr; }
    </style>
</head>
<body class="bg-background text-on-background font-sans min-h-screen flex flex-col antialiased">

    <!-- TopNavBar -->
    @if(request()->routeIs('home'))
    <nav id="mainNav" class="fixed top-0 left-0 w-full bg-transparent z-50 py-4 transition-colors duration-300">
        <div class="flex justify-between items-center px-8 max-w-[1200px] mx-auto w-full">
            <!-- Logos Capsule (Left) -->
            <div class="flex items-center bg-white rounded-full px-4 py-1.5 gap-2.5 shadow-sm border border-gray-100 h-10 shrink-0">
                <span class="material-symbols-outlined text-primary" style="font-size: 22px;" title="Pemerintah Kabupaten Cirebon">account_balance</span>
                <span class="material-symbols-outlined text-tertiary" style="font-size: 22px;" title="Pengelolaan Sampah Mandiri">recycling</span>
                <img src="{{ asset('images/logo-cirebon.png') }}" class="h-6 w-auto object-contain" alt="Universitas Muhammadiyah Cirebon" title="Universitas Muhammadiyah Cirebon">
            </div>

            <!-- Centered Menu Capsule -->
            <div class="hidden md:flex items-center gap-6 bg-black/30 backdrop-blur-md border border-white/10 rounded-full px-6 py-2">
                <a href="{{ route('home') }}"
                   class="text-sm font-semibold transition-colors px-2 py-0.5 text-white hover:text-primary-fixed-dim">
                    Beranda
                </a>
                <a href="{{ route('catalog.index') }}"
                   class="text-sm font-semibold transition-colors px-2 py-0.5 text-white/80 hover:text-white">
                    Katalog Produk
                </a>
                <a href="{{ route('education.index') }}"
                   class="text-sm font-semibold transition-colors px-2 py-0.5 text-white/80 hover:text-white">
                    Edukasi Sampah
                </a>
                <a href="{{ route('about') }}"
                   class="text-sm font-semibold transition-colors px-2 py-0.5 text-white/80 hover:text-white">
                    Tentang Kami
                </a>
                <a href="{{ route('contact') }}"
                   class="text-sm font-semibold transition-colors px-2 py-0.5 text-white/80 hover:text-white">
                    Kontak
                </a>
            </div>

            <!-- Mobile Menu & Actions (Right) -->
            <div class="flex items-center gap-4">
                <button class="md:hidden text-white hover:text-primary-fixed-dim">
                    <span class="material-symbols-outlined">menu</span>
                </button>
            </div>
        </div>
    </nav>
    @else
    <nav class="bg-surface shadow-sm w-full sticky top-0 z-50 py-4">
        <div class="flex justify-between items-center px-8 max-w-[1200px] mx-auto w-full">
            <!-- Logos Capsule (Left) -->
            <div class="flex items-center bg-white rounded-full px-4 py-1.5 gap-2.5 shadow-sm border border-gray-100 h-10 shrink-0">
                <span class="material-symbols-outlined text-primary" style="font-size: 22px;" title="Pemerintah Kabupaten Cirebon">account_balance</span>
                <span class="material-symbols-outlined text-tertiary" style="font-size: 22px;" title="Pengelolaan Sampah Mandiri">recycling</span>
                <img src="{{ asset('images/logo-cirebon.png') }}" class="h-6 w-auto object-contain" alt="Universitas Muhammadiyah Cirebon" title="Universitas Muhammadiyah Cirebon">
            </div>

            <!-- Centered Menu Capsule -->
            <div class="hidden md:flex items-center gap-6 bg-surface-container-high border border-outline-variant/30 rounded-full px-6 py-2">
                <a href="{{ route('home') }}"
                   class="text-sm font-semibold transition-colors px-2 py-0.5 {{ request()->routeIs('home') ? 'text-primary' : 'text-on-surface-variant hover:text-primary' }}">
                    Beranda
                </a>
                <a href="{{ route('catalog.index') }}"
                   class="text-sm font-semibold transition-colors px-2 py-0.5 {{ request()->routeIs('catalog.*') ? 'text-primary' : 'text-on-surface-variant hover:text-primary' }}">
                    Katalog Produk
                </a>
                <a href="{{ route('education.index') }}"
                   class="text-sm font-semibold transition-colors px-2 py-0.5 {{ request()->routeIs('education.*') ? 'text-primary' : 'text-on-surface-variant hover:text-primary' }}">
                    Edukasi Sampah
                </a>
                <a href="{{ route('about') }}"
                   class="text-sm font-semibold transition-colors px-2 py-0.5 {{ request()->routeIs('about') ? 'text-primary' : 'text-on-surface-variant hover:text-primary' }}">
                    Tentang Kami
                </a>
                <a href="{{ route('contact') }}"
                   class="text-sm font-semibold transition-colors px-2 py-0.5 {{ request()->routeIs('contact') ? 'text-primary' : 'text-on-surface-variant hover:text-primary' }}">
                    Kontak
                </a>
            </div>

            <!-- Mobile Menu & Actions (Right) -->
            <div class="flex items-center gap-4">
                <button class="md:hidden text-on-surface-variant hover:text-primary">
                    <span class="material-symbols-outlined">menu</span>
                </button>
            </div>
        </div>
    </nav>
    @endif

    <!-- Main Content -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-surface-container-highest border-t border-outline-variant">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-lg px-8 py-12 max-w-[1200px] mx-auto w-full">
            <div>
                <div class="text-lg font-bold text-primary mb-4">Katalog Daur Ulang</div>
                <p class="text-label-md text-on-surface-variant">Desa Ciawiasih, Kab. Cirebon.</p>
                <p class="text-label-md text-on-surface-variant mt-2">&copy; {{ date('Y') }} Desa Ciawiasih. Pengelolaan Sampah Mandiri.</p>
            </div>
            <div class="md:col-span-2 flex flex-col md:flex-row gap-6 md:justify-end text-label-md">
                <a class="text-on-surface-variant hover:text-primary underline transition-all duration-300" href="#">Kebijakan Privasi</a>
                <a class="text-on-surface-variant hover:text-primary underline transition-all duration-300" href="#">Syarat &amp; Ketentuan</a>
                <a class="text-on-surface-variant hover:text-primary underline transition-all duration-300" href="#">Peta Situs</a>
            </div>
        </div>
    </footer>

</body>
</html>
<script>
    // Add dark background to navbar on scroll for homepage
    document.addEventListener('DOMContentLoaded', function() {
        const nav = document.getElementById('mainNav');
        if (nav) {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    nav.classList.remove('bg-transparent');
                    nav.classList.add('bg-black/80', 'backdrop-blur-lg', 'shadow-sm');
                } else {
                    nav.classList.add('bg-transparent');
                    nav.classList.remove('bg-black/80', 'backdrop-blur-lg', 'shadow-sm');
                }
            });
        }
    });
</script>
