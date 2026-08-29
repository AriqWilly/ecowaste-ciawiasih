<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Pengelolaan Sampah Desa Ciawiasih</title>
    <meta name="description" content="Sistem Informasi Pengelolaan Sampah & Katalog Daur Ulang Desa Ciawiasih, Kecamatan Susukan Lebak, Kabupaten Cirebon.">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo_recycle.png') }}"/>
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo_recycle.png') }}"/>
    <link rel="apple-touch-icon" href="{{ asset('images/logo_recycle.png') }}"/>

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
<body class="bg-background text-on-background font-sans min-h-screen flex flex-col antialiased" x-data="{ mobileMenuOpen: false, modalPrivacy: false, modalTerms: false, modalSitemap: false }">

    <!-- TopNavBar -->
    @if(request()->routeIs('home'))
    <nav id="mainNav" class="fixed top-0 left-0 w-full bg-transparent z-50 py-4 transition-colors duration-300">
        <div class="flex justify-between items-center px-6 sm:px-8 max-w-[1200px] mx-auto w-full">
            <!-- Logos Capsule (Left) -->
            <a href="{{ route('home') }}" class="flex items-center bg-white rounded-full px-4 py-1.5 gap-2.5 shadow-sm border border-gray-100 h-10 shrink-0">
                <span class="material-symbols-outlined text-primary" style="font-size: 24px;" title="Gedung">account_balance</span>
                <img src="{{ asset('images/logo_recycle.png') }}" class="h-[28px] w-auto object-contain scale-110" alt="Pengelolaan Sampah Mandiri" title="Pengelolaan Sampah Mandiri">
                <img src="{{ asset('images/logo-cirebon.png') }}" class="h-[26px] w-auto object-contain" alt="Pemerintah Kabupaten Cirebon" title="Pemerintah Kabupaten Cirebon">
            </a>

            <!-- Centered Menu Capsule (Desktop) -->
            <div class="hidden md:flex items-center gap-6 bg-black/40 backdrop-blur-md border border-white/10 rounded-full px-6 py-2">
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

            <!-- Mobile Menu Toggle Button (Right) -->
            <div class="flex items-center gap-4">
                <button type="button" @click="mobileMenuOpen = !mobileMenuOpen" onclick="toggleMobileMenu()"
                        class="md:hidden text-white hover:text-primary-fixed-dim p-2 rounded-full bg-black/40 backdrop-blur-md border border-white/20 flex items-center justify-center transition-transform active:scale-95 cursor-pointer"
                        aria-label="Buka Menu Navigasi">
                    <span class="material-symbols-outlined" x-text="mobileMenuOpen ? 'close' : 'menu'">menu</span>
                </button>
            </div>
        </div>
    </nav>
    @else
    <nav class="bg-surface shadow-sm w-full sticky top-0 z-50 py-4 border-b border-outline-variant/30">
        <div class="flex justify-between items-center px-6 sm:px-8 max-w-[1200px] mx-auto w-full">
            <!-- Logos Capsule (Left) -->
            <a href="{{ route('home') }}" class="flex items-center bg-white rounded-full px-4 py-1.5 gap-2.5 shadow-sm border border-gray-100 h-10 shrink-0">
                <span class="material-symbols-outlined text-primary" style="font-size: 24px;" title="Gedung">account_balance</span>
                <img src="{{ asset('images/logo_recycle.png') }}" class="h-[28px] w-auto object-contain scale-110" alt="Pengelolaan Sampah Mandiri" title="Pengelolaan Sampah Mandiri">
                <img src="{{ asset('images/logo-cirebon.png') }}" class="h-[26px] w-auto object-contain" alt="Pemerintah Kabupaten Cirebon" title="Pemerintah Kabupaten Cirebon">
            </a>

            <!-- Centered Menu Capsule (Desktop) -->
            <div class="hidden md:flex items-center gap-6 bg-surface-container-high border border-outline-variant/30 rounded-full px-6 py-2">
                <a href="{{ route('home') }}"
                   class="text-sm font-semibold transition-colors px-2 py-0.5 {{ request()->routeIs('home') ? 'text-primary font-bold' : 'text-on-surface-variant hover:text-primary' }}">
                    Beranda
                </a>
                <a href="{{ route('catalog.index') }}"
                   class="text-sm font-semibold transition-colors px-2 py-0.5 {{ request()->routeIs('catalog.*') ? 'text-primary font-bold' : 'text-on-surface-variant hover:text-primary' }}">
                    Katalog Produk
                </a>
                <a href="{{ route('education.index') }}"
                   class="text-sm font-semibold transition-colors px-2 py-0.5 {{ request()->routeIs('education.*') ? 'text-primary font-bold' : 'text-on-surface-variant hover:text-primary' }}">
                    Edukasi Sampah
                </a>
                <a href="{{ route('about') }}"
                   class="text-sm font-semibold transition-colors px-2 py-0.5 {{ request()->routeIs('about') ? 'text-primary font-bold' : 'text-on-surface-variant hover:text-primary' }}">
                    Tentang Kami
                </a>
                <a href="{{ route('contact') }}"
                   class="text-sm font-semibold transition-colors px-2 py-0.5 {{ request()->routeIs('contact') ? 'text-primary font-bold' : 'text-on-surface-variant hover:text-primary' }}">
                    Kontak
                </a>
            </div>

            <!-- Mobile Menu Toggle Button (Right) -->
            <div class="flex items-center gap-4">
                <button type="button" @click="mobileMenuOpen = !mobileMenuOpen" onclick="toggleMobileMenu()"
                        class="md:hidden text-on-surface hover:text-primary p-2 rounded-xl bg-surface-container-high border border-outline-variant/40 flex items-center justify-center transition-transform active:scale-95 cursor-pointer"
                        aria-label="Buka Menu Navigasi">
                    <span class="material-symbols-outlined" x-text="mobileMenuOpen ? 'close' : 'menu'">menu</span>
                </button>
            </div>
        </div>
    </nav>
    @endif

    <!-- Mobile Drawer Menu Overlay -->
    <div id="mobileDrawerOverlay"
         x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="mobileMenuOpen = false"
         onclick="toggleMobileMenu()"
         class="fixed inset-0 bg-black/60 backdrop-blur-md z-[99998] md:hidden hidden" 
         style="display: none;"></div>

    <!-- Mobile Drawer Side Panel -->
    <div id="mobileDrawerPanel"
         x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-full"
         class="fixed top-0 right-0 h-full w-[85%] max-w-[300px] bg-white dark:bg-gray-900 shadow-2xl z-[99999] md:hidden flex flex-col p-6 hidden"
         style="display: none;">
        
        <!-- Header in Drawer -->
        <div class="flex justify-between items-center pb-5 mb-6 border-b border-gray-100 dark:border-gray-800">
            <div class="flex items-center gap-2.5">
                <img src="{{ asset('images/logo_recycle.png') }}" class="h-8 w-auto object-contain" alt="Pengelolaan Sampah Mandiri" title="Pengelolaan Sampah Mandiri">
                <div>
                    <div class="font-bold text-xs text-gray-900 dark:text-white leading-tight">Sistem Informasi Pengelolaan Sampah</div>
                    <div class="text-[10px] text-gray-500 font-medium">Desa Ciawiasih</div>
                </div>
            </div>
            <button type="button" @click="mobileMenuOpen = false" onclick="toggleMobileMenu()" 
                    class="w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-500 hover:text-gray-900 dark:hover:text-white flex items-center justify-center transition-colors shrink-0">
                <span class="material-symbols-outlined text-lg">close</span>
            </button>
        </div>

        <!-- Links List -->
        <div class="flex flex-col gap-2 flex-grow">
            <a href="{{ route('home') }}" 
               class="flex items-center gap-3.5 px-4 py-3 rounded-2xl font-semibold text-sm transition-all {{ request()->routeIs('home') ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                <span class="material-symbols-outlined text-xl">home</span>
                <span>Beranda</span>
            </a>
            <a href="{{ route('catalog.index') }}" 
               class="flex items-center gap-3.5 px-4 py-3 rounded-2xl font-semibold text-sm transition-all {{ request()->routeIs('catalog.*') ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                <span class="material-symbols-outlined text-xl">storefront</span>
                <span>Katalog Produk</span>
            </a>
            <a href="{{ route('education.index') }}" 
               class="flex items-center gap-3.5 px-4 py-3 rounded-2xl font-semibold text-sm transition-all {{ request()->routeIs('education.*') ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                <span class="material-symbols-outlined text-xl">school</span>
                <span>Edukasi Sampah</span>
            </a>
            <a href="{{ route('about') }}" 
               class="flex items-center gap-3.5 px-4 py-3 rounded-2xl font-semibold text-sm transition-all {{ request()->routeIs('about') ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                <span class="material-symbols-outlined text-xl">info</span>
                <span>Tentang Kami</span>
            </a>
            <a href="{{ route('contact') }}" 
               class="flex items-center gap-3.5 px-4 py-3 rounded-2xl font-semibold text-sm transition-all {{ request()->routeIs('contact') ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                <span class="material-symbols-outlined text-xl">mail</span>
                <span>Kontak</span>
            </a>
        </div>

        <!-- Footer Note in Drawer -->
        <div class="pt-4 mt-auto border-t border-gray-100 dark:border-gray-800 text-center">
            <p class="text-[11px] text-gray-400 font-medium">© {{ date('Y') }} Desa Ciawiasih • Bank Sampah</p>
        </div>
    </div>

    <!-- Main Content -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-surface-container-highest border-t border-outline-variant">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-lg px-8 py-12 max-w-[1200px] mx-auto w-full">
            <div>
                <div class="text-lg font-bold text-primary mb-4">Sistem Pengelolaan Sampah</div>
                <p class="text-label-md text-on-surface-variant">Desa Ciawiasih, Kab. Cirebon.</p>
                <p class="text-label-md text-on-surface-variant mt-2">&copy; {{ date('Y') }} Desa Ciawiasih. Pengelolaan Sampah Mandiri.</p>
            </div>
            <div class="md:col-span-2 flex flex-wrap gap-6 md:justify-end text-label-md">
                <button type="button" @click="modalPrivacy = true" onclick="openFooterModal('modalPrivacyContainer')" class="text-on-surface-variant hover:text-primary underline transition-all duration-300 cursor-pointer">Kebijakan Privasi</button>
                <button type="button" @click="modalTerms = true" onclick="openFooterModal('modalTermsContainer')" class="text-on-surface-variant hover:text-primary underline transition-all duration-300 cursor-pointer">Syarat &amp; Ketentuan</button>
                <button type="button" @click="modalSitemap = true" onclick="openFooterModal('modalSitemapContainer')" class="text-on-surface-variant hover:text-primary underline transition-all duration-300 cursor-pointer">Peta Situs</button>
            </div>
        </div>
    </footer>

    <!-- MODAL 1: Kebijakan Privasi -->
    <div id="modalPrivacyContainer"
         x-show="modalPrivacy" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click.self="modalPrivacy = false"
         onclick="if(event.target === this) closeFooterModal('modalPrivacyContainer')"
         class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[999999] flex items-center justify-center p-4 hidden" style="display: none;">
        <div class="bg-white dark:bg-gray-900 rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-gray-100 dark:border-gray-800 space-y-5 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center pb-4 border-b border-gray-100 dark:border-gray-800">
                <div class="flex items-center gap-2.5">
                    <span class="material-symbols-outlined text-primary text-2xl">security</span>
                    <h3 class="font-bold text-lg text-gray-900 dark:text-white">Kebijakan Privasi</h3>
                </div>
                <button type="button" @click="modalPrivacy = false" onclick="closeFooterModal('modalPrivacyContainer')" class="w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-500 hover:text-gray-900 dark:hover:text-white flex items-center justify-center">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>
            <div class="space-y-3 text-sm text-gray-600 dark:text-gray-300 leading-relaxed">
                <p><strong>Perlindungan Data Warga:</strong> Pemerintah Desa Ciawiasih dan pengurus desa berkomitmen penuh menjaga privasi dan kerahasiaan informasi warga Desa Ciawiasih.</p>
                <p><strong>Penggunaan Informasi:</strong> Informasi pribadi seperti Nama, Email, dan Nomor WhatsApp yang diisikan pada formulir kontak atau pemesanan produk hanya digunakan secara khusus untuk keperluan komunikasi pelayanan desa dan transaksi produk daur ulang.</p>
                <p><strong>Kerahasiaan Identitas:</strong> Data Anda tidak akan diperjualbelikan atau disebarluaskan kepada pihak ketiga di luar kepentingan operasional resmi Desa Ciawiasih.</p>
            </div>
            <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex justify-end">
                <button type="button" @click="modalPrivacy = false" onclick="closeFooterModal('modalPrivacyContainer')" class="bg-primary text-white font-semibold px-5 py-2.5 rounded-xl text-xs hover:opacity-90 transition-opacity cursor-pointer">Tutup</button>
            </div>
        </div>
    </div>

    <!-- MODAL 2: Syarat & Ketentuan -->
    <div id="modalTermsContainer"
         x-show="modalTerms" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click.self="modalTerms = false"
         onclick="if(event.target === this) closeFooterModal('modalTermsContainer')"
         class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[999999] flex items-center justify-center p-4 hidden" style="display: none;">
        <div class="bg-white dark:bg-gray-900 rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-gray-100 dark:border-gray-800 space-y-5 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center pb-4 border-b border-gray-100 dark:border-gray-800">
                <div class="flex items-center gap-2.5">
                    <span class="material-symbols-outlined text-primary text-2xl">description</span>
                    <h3 class="font-bold text-lg text-gray-900 dark:text-white">Syarat & Ketentuan</h3>
                </div>
                <button type="button" @click="modalTerms = false" onclick="closeFooterModal('modalTermsContainer')" class="w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-500 hover:text-gray-900 dark:hover:text-white flex items-center justify-center">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>
            <div class="space-y-3 text-sm text-gray-600 dark:text-gray-300 leading-relaxed">
                <p><strong>Pemesanan Produk Daur Ulang:</strong> Pemesanan produk dilakukan secara langsung via WhatsApp resmi desa Ciawiasih. Pembayaran dan konfirmasi pengiriman disepakati bersama pengurus desa.</p>
                <p><strong>Ketersediaan Stok & Harga:</strong> Harga dan stok barang daur ulang hasil karya warga dapat berubah sewaktu-waktu sesuai dengan ketersediaan bahan baku olahan di desa.</p>
                <p><strong>Etika Komunikasi:</strong> Warga diharapkan menyampaikan pertanyaan, keluhan, atau pesan pada formulir kontak menggunakan bahasa yang sopan dan santun.</p>
            </div>
            <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex justify-end">
                <button type="button" @click="modalTerms = false" onclick="closeFooterModal('modalTermsContainer')" class="bg-primary text-white font-semibold px-5 py-2.5 rounded-xl text-xs hover:opacity-90 transition-opacity cursor-pointer">Saya Mengerti</button>
            </div>
        </div>
    </div>

    <!-- MODAL 3: Peta Situs -->
    <div id="modalSitemapContainer"
         x-show="modalSitemap" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click.self="modalSitemap = false"
         onclick="if(event.target === this) closeFooterModal('modalSitemapContainer')"
         class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[999999] flex items-center justify-center p-4 hidden" style="display: none;">
        <div class="bg-white dark:bg-gray-900 rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-gray-100 dark:border-gray-800 space-y-5 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center pb-4 border-b border-gray-100 dark:border-gray-800">
                <div class="flex items-center gap-2.5">
                    <span class="material-symbols-outlined text-primary text-2xl">map</span>
                    <h3 class="font-bold text-lg text-gray-900 dark:text-white">Peta Situs Desa Ciawiasih</h3>
                </div>
                <button type="button" @click="modalSitemap = false" onclick="closeFooterModal('modalSitemapContainer')" class="w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-500 hover:text-gray-900 dark:hover:text-white flex items-center justify-center">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>
            <div class="grid grid-cols-2 gap-3 text-sm">
                <a href="{{ route('home') }}" class="p-3 rounded-2xl bg-gray-50 dark:bg-gray-800 hover:bg-primary/10 text-gray-800 dark:text-gray-200 font-semibold flex items-center gap-2.5 transition-colors">
                    <span class="material-symbols-outlined text-primary text-lg">home</span>
                    <span>Beranda</span>
                </a>
                <a href="{{ route('catalog.index') }}" class="p-3 rounded-2xl bg-gray-50 dark:bg-gray-800 hover:bg-primary/10 text-gray-800 dark:text-gray-200 font-semibold flex items-center gap-2.5 transition-colors">
                    <span class="material-symbols-outlined text-primary text-lg">storefront</span>
                    <span>Katalog Produk</span>
                </a>
                <a href="{{ route('education.index') }}" class="p-3 rounded-2xl bg-gray-50 dark:bg-gray-800 hover:bg-primary/10 text-gray-800 dark:text-gray-200 font-semibold flex items-center gap-2.5 transition-colors">
                    <span class="material-symbols-outlined text-primary text-lg">school</span>
                    <span>Edukasi Sampah</span>
                </a>
                <a href="{{ route('about') }}" class="p-3 rounded-2xl bg-gray-50 dark:bg-gray-800 hover:bg-primary/10 text-gray-800 dark:text-gray-200 font-semibold flex items-center gap-2.5 transition-colors">
                    <span class="material-symbols-outlined text-primary text-lg">info</span>
                    <span>Tentang Kami</span>
                </a>
                <a href="{{ route('contact') }}" class="p-3 rounded-2xl bg-gray-50 dark:bg-gray-800 hover:bg-primary/10 text-gray-800 dark:text-gray-200 font-semibold flex items-center gap-2.5 transition-colors">
                    <span class="material-symbols-outlined text-primary text-lg">mail</span>
                    <span>Kontak Warga</span>
                </a>
            </div>
            <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex justify-end">
                <button type="button" @click="modalSitemap = false" onclick="closeFooterModal('modalSitemapContainer')" class="bg-primary text-white font-semibold px-5 py-2.5 rounded-xl text-xs hover:opacity-90 transition-opacity cursor-pointer">Tutup</button>
            </div>
        </div>
    </div>

    <script>
        function openFooterModal(id) {
            const el = document.getElementById(id);
            if (el) {
                el.style.display = 'flex';
                el.classList.remove('hidden');
            }
        }

        function closeFooterModal(id) {
            const el = document.getElementById(id);
            if (el) {
                el.style.display = 'none';
                el.classList.add('hidden');
            }
        }

        function toggleMobileMenu() {
            const overlay = document.getElementById('mobileDrawerOverlay');
            const panel = document.getElementById('mobileDrawerPanel');
            if (overlay && panel) {
                const isHidden = overlay.classList.contains('hidden') || overlay.style.display === 'none';
                if (isHidden) {
                    overlay.style.display = 'block';
                    overlay.classList.remove('hidden');
                    panel.style.display = 'flex';
                    panel.classList.remove('hidden');
                } else {
                    overlay.style.display = 'none';
                    overlay.classList.add('hidden');
                    panel.style.display = 'none';
                    panel.classList.add('hidden');
                }
            }
        }

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
</body>
</html>
