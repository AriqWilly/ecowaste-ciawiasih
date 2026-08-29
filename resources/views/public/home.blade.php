<x-public-layout>
    <!-- Hero Section -->
    <section class="relative bg-gray-900 bg-cover bg-center min-h-screen flex items-center text-white pt-20" 
             style="background-image: linear-gradient(rgba(0, 0, 0, 0.72), rgba(0, 0, 0, 0.72)), url('{{ asset('images/bg-hero.jpg') }}');">
        <div class="max-w-[1200px] mx-auto px-6 sm:px-8 relative z-10 w-full space-y-6">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md px-4 py-1.5 rounded-full border border-white/20 text-xs font-semibold text-primary-fixed-dim">
                <span class="material-symbols-outlined text-sm text-emerald-400">recycling</span>
                <span>Digitalisasi Katalog Daur Ulang & Edukasi Sampah</span>
            </div>
            <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold tracking-tight leading-tight max-w-4xl">
                Sistem Informasi<br>Pengelolaan Sampah<br><span class="text-emerald-400">Desa Ciawiasih</span>
            </h1>
            <p class="text-base sm:text-lg md:text-xl opacity-90 max-w-2xl leading-relaxed">
                Mendukung pengelolaan sampah mandiri, edukasi literasi lingkungan, dan pertumbuhan ekonomi sirkular desa melalui promosi produk daur ulang berkualitas.
            </p>
            <div class="flex flex-wrap gap-4 pt-4">
                <a href="{{ route('catalog.index') }}"
                   class="border border-white/40 hover:bg-white/10 backdrop-blur-sm text-white text-sm sm:text-base px-7 py-3.5 rounded-xl font-semibold transition duration-300 flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">storefront</span>
                    <span>Lihat Katalog Produk</span>
                </a>
                <a href="{{ route('education.index') }}"
                   class="border border-white/40 hover:bg-white/10 backdrop-blur-sm text-white text-sm sm:text-base px-7 py-3.5 rounded-xl font-semibold transition duration-300 flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">school</span>
                    <span>Pelajari Edukasi</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Impact Cards -->
    <section class="bg-surface-container-low py-xl">
        <div class="max-w-[1200px] mx-auto px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-surface-variant hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 bg-primary-container text-on-primary-container rounded-full flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined">cycle</span>
                    </div>
                    <h3 class="text-headline-md font-semibold text-on-surface mb-2">Pengelolaan Terintegrasi</h3>
                    <p class="text-on-surface-variant text-body-md">Sistem bank sampah desa yang terstruktur untuk mengelola limbah rumah tangga.</p>
                </div>
                <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-surface-variant hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 bg-secondary-container text-on-secondary-container rounded-full flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined">volunteer_activism</span>
                    </div>
                    <h3 class="text-headline-md font-semibold text-on-surface mb-2">Produk Lokal Berkualitas</h3>
                    <p class="text-on-surface-variant text-body-md">Kerajinan tangan dan pupuk kompos bernilai jual tinggi hasil karya warga desa.</p>
                </div>
                <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-surface-variant hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 bg-tertiary-container text-on-tertiary-container rounded-full flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined">forum</span>
                    </div>
                    <h3 class="text-headline-md font-semibold text-on-surface mb-2">Pemesanan Mudah via WhatsApp</h3>
                    <p class="text-on-surface-variant text-body-md">Hubungi pengrajin langsung melalui WhatsApp untuk transaksi yang aman dan cepat.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Catalog Preview -->
    <section class="max-w-[1200px] mx-auto px-6 sm:px-8 py-16 md:py-24">
        <!-- Section Header -->
        <div class="text-center max-w-2xl mx-auto mb-12 space-y-3">
            <span class="text-xs font-bold uppercase tracking-wider text-primary bg-primary/10 px-3.5 py-1 rounded-full border border-primary/20">
                Karya Warga Desa Ciawiasih
            </span>
            <h2 class="text-3xl sm:text-4xl font-bold text-on-surface tracking-tight">Katalog Produk Daur Ulang</h2>
            <p class="text-sm sm:text-base text-on-surface-variant leading-relaxed">
                Temukan kreasi kerajinan tangan bernilai ekonomi dan pupuk organik ramah lingkungan hasil olahan bank sampah desa.
            </p>
        </div>

        <!-- Product Cards (Centered Flex Grid) -->
        <div class="flex flex-wrap justify-center gap-6 sm:gap-8">
            @forelse ($products as $product)
            <div class="w-full sm:w-[280px] md:w-[320px] bg-surface-container-lowest rounded-2xl overflow-hidden border border-outline-variant/60 shadow-sm hover:shadow-xl hover:border-primary/40 transition-all duration-300 flex flex-col group hover:-translate-y-1.5">
                
                <!-- Image & Badges -->
                <div class="relative aspect-[4/3] bg-surface-container overflow-hidden">
                    <img class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-500"
                         src="{{ $product->image_url }}"
                         alt="{{ $product->name }}"/>
                    
                    <!-- Category Badge -->
                    <div class="absolute top-3 left-3 bg-primary/90 text-white backdrop-blur-md px-3 py-1 rounded-full text-[11px] font-bold shadow-sm flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs">sell</span>
                        <span>{{ $product->category->name ?? 'Produk' }}</span>
                    </div>

                    <!-- Stock Indicator Badge -->
                    <div class="absolute top-3 right-3 {{ $product->stock > 0 ? 'bg-black/60 text-white' : 'bg-error text-white' }} backdrop-blur-md px-2.5 py-0.5 rounded-full text-[10px] font-semibold">
                        {{ $product->stock > 0 ? 'Stok: '.$product->stock : 'Habis' }}
                    </div>
                </div>

                <!-- Product Body -->
                <div class="p-5 flex flex-col flex-grow justify-between space-y-4">
                    <div class="space-y-1.5">
                        <a href="{{ route('catalog.show', $product->slug) }}" class="block font-bold text-base text-on-surface hover:text-primary transition-colors line-clamp-1">
                            {{ $product->name }}
                        </a>
                        <p class="text-xs text-outline flex items-center gap-1">
                            <span class="material-symbols-outlined text-xs text-primary">person</span>
                            <span>Pengrajin: {{ $product->seller_name }}</span>
                        </p>
                        <p class="text-lg font-extrabold text-primary pt-1">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                    </div>

                    <!-- Actions -->
                    <div class="space-y-2 pt-2 border-t border-outline-variant/30">
                        @php
                            $orderPhone = preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $product->seller_phone ?: \App\Models\Setting::get('wa_utama', '0895337067978')));
                            $orderText = urlencode("Halo, saya ingin memesan produk daur ulang *{$product->name}* (Rp " . number_format($product->price, 0, ',', '.') . ") dari website Desa Ciawiasih. Apakah stok masih tersedia?");
                        @endphp
                        <a href="https://wa.me/{{ $orderPhone }}?text={{ $orderText }}" target="_blank"
                           class="w-full bg-[#25D366] hover:bg-[#1EBE5D] text-white font-bold py-2.5 px-4 rounded-xl text-xs flex items-center justify-center gap-2 shadow-sm transition-all hover:scale-[1.02]">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.698c.969.531 1.936.812 2.802.812 3.178 0 5.768-2.587 5.768-5.766 0-3.181-2.59-5.767-5.774-5.767zm0 10.362c-.774 0-1.533-.207-2.196-.601l-.157-.093-1.63.428.435-1.588-.102-.162c-.435-.694-.666-1.503-.665-2.346 0-2.535 2.062-4.597 4.597-4.597 2.537 0 4.601 2.062 4.601 4.597 0 2.535-2.064 4.597-4.598 4.597z"/></svg>
                            <span>Pesan via WhatsApp</span>
                        </a>
                        <a href="{{ route('catalog.show', $product->slug) }}" 
                           class="w-full py-2 px-3 rounded-xl text-center text-xs font-semibold text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors block">
                            Lihat Detail Produk
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="w-full max-w-lg mx-auto bg-surface-container-lowest border-2 border-dashed border-outline-variant/60 rounded-2xl p-12 text-center shadow-sm">
                <div class="w-16 h-16 bg-primary/10 text-primary rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <span class="material-symbols-outlined text-3xl">inventory_2</span>
                </div>
                <h3 class="text-lg font-bold text-on-surface mb-2">Katalog Sedang Dipersiapkan</h3>
                <p class="text-xs text-on-surface-variant leading-relaxed">
                    Produk-produk daur ulang dari pengrajin Desa Ciawiasih akan segera hadir di sini.
                </p>
            </div>
            @endforelse
        </div>

        <!-- View All Button -->
        <div class="text-center mt-12">
            <a href="{{ route('catalog.index') }}" 
               class="inline-flex items-center gap-2 bg-surface-container-low hover:bg-primary hover:text-white border border-primary text-primary font-bold px-8 py-3 rounded-full text-xs shadow-sm hover:shadow-md transition-all duration-300 group">
                <span>Jelajahi Semua Produk Katalog</span>
                <span class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </a>
        </div>
    </section>

    <!-- Educational Banner -->
    <section class="max-w-[1200px] mx-auto px-8 py-xl mb-12">
        <div class="bg-primary rounded-2xl p-8 md:p-12 shadow-md relative overflow-hidden text-white">
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-white via-transparent to-transparent pointer-events-none"></div>
            <div class="relative z-10 grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div class="space-y-4">
                    <h2 class="text-3xl sm:text-4xl font-bold tracking-tight text-white">Mari Pilah Sampah dari Rumah</h2>
                    <p class="text-sm sm:text-base text-white leading-relaxed">Pemisahan sampah organik dan anorganik adalah langkah awal menciptakan nilai ekonomi dari limbah keluarga.</p>
                    <div class="pt-2">
                        <a href="{{ route('education.index') }}"
                           class="inline-block bg-white text-primary text-sm px-6 py-3 rounded-xl hover:bg-surface-container-low transition-colors font-bold shadow-sm">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white/15 p-5 rounded-2xl backdrop-blur-md border border-white/30 text-white flex flex-col justify-between space-y-2">
                        <span class="material-symbols-outlined text-4xl text-white block">compost</span>
                        <div>
                            <h4 class="text-base font-bold text-white mb-0.5">Organik</h4>
                            <p class="text-xs text-white leading-normal">Sisa makanan, daun (Untuk Kompos)</p>
                        </div>
                    </div>
                    <div class="bg-white/15 p-5 rounded-2xl backdrop-blur-md border border-white/30 text-white flex flex-col justify-between space-y-2">
                        <span class="material-symbols-outlined text-4xl text-white block">recycling</span>
                        <div>
                            <h4 class="text-base font-bold text-white mb-0.5">Anorganik</h4>
                            <p class="text-xs text-white leading-normal">Plastik, kertas, kaca (Untuk Kerajinan)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-public-layout>
