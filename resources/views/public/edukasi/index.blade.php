<x-public-layout>
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-primary via-[#1b6d24] to-[#2e7d32] text-white py-20 relative overflow-hidden shadow-sm">
        <div class="absolute inset-0 opacity-10 pointer-events-none"
             style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 24px 24px;"></div>
        <div class="max-w-[1200px] mx-auto px-md md:px-8 relative z-10 text-center space-y-4">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold tracking-tight text-white">Edukasi &amp; Panduan Pilah Sampah</h1>
            <p class="text-sm sm:text-base max-w-2xl mx-auto text-white leading-relaxed">
                Mari tingkatkan kesadaran lingkungan dengan memilah sampah dari rumah tangga kita. Langkah kecil untuk dampak besar bagi Desa Ciawiasih yang asri.
            </p>
        </div>
    </section>

    <!-- Waste Categorization Guide -->
    <section class="py-16 md:py-24 max-w-[1200px] mx-auto px-md md:px-8">
        <div class="text-center mb-12 md:mb-16">
            <h2 class="text-headline-lg-mobile md:text-headline-lg font-bold text-on-background mb-4">Kenali Jenis Sampahmu</h2>
            <p class="text-body-md text-on-surface-variant max-w-2xl mx-auto">Pemisahan sampah dari sumbernya adalah kunci keberhasilan daur ulang. Berikut panduan sederhana memilah sampah di rumah.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
            <!-- Card 1: Organik -->
            <div class="bg-surface-container-lowest rounded-xl p-8 border border-surface-variant shadow-[0_4px_12px_rgba(0,0,0,0.05)] hover:-translate-y-1 transition-transform duration-300">
                <div class="w-16 h-16 rounded-full bg-tertiary-container/20 flex items-center justify-center mb-6 text-tertiary">
                    <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">compost</span>
                </div>
                <h3 class="text-headline-md font-semibold text-on-background mb-3">Sampah Organik</h3>
                <p class="text-body-md text-on-surface-variant mb-6">Sisa makanan, daun kering, sayuran busuk, dan bahan alami lainnya.</p>
                <div class="bg-surface-container rounded-lg p-4 flex items-start gap-3">
                    <span class="material-symbols-outlined text-primary mt-0.5">check_circle</span>
                    <div>
                        <span class="text-label-md block text-on-surface font-semibold mb-1">Tujuan:</span>
                        <span class="text-body-md text-on-surface-variant text-sm">Olah jadi Kompos / Pupuk Cair</span>
                    </div>
                </div>
            </div>
            <!-- Card 2: Anorganik -->
            <div class="bg-surface-container-lowest rounded-xl p-8 border border-surface-variant shadow-[0_4px_12px_rgba(0,0,0,0.05)] hover:-translate-y-1 transition-transform duration-300">
                <div class="w-16 h-16 rounded-full bg-secondary-container/20 flex items-center justify-center mb-6 text-secondary-container">
                    <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">recycling</span>
                </div>
                <h3 class="text-headline-md font-semibold text-on-background mb-3">Sampah Anorganik</h3>
                <p class="text-body-md text-on-surface-variant mb-6">Plastik kemasan, botol minuman, kaleng, kardus, dan kertas bekas.</p>
                <div class="bg-surface-container rounded-lg p-4 flex items-start gap-3">
                    <span class="material-symbols-outlined text-secondary mt-0.5">check_circle</span>
                    <div>
                        <span class="text-label-md block text-on-surface font-semibold mb-1">Tujuan:</span>
                        <span class="text-body-md text-on-surface-variant text-sm">Daur ulang jadi Kerajinan / Bank Sampah</span>
                    </div>
                </div>
            </div>
            <!-- Card 3: B3/Residu -->
            <div class="bg-surface-container-lowest rounded-xl p-8 border border-surface-variant shadow-[0_4px_12px_rgba(0,0,0,0.05)] hover:-translate-y-1 transition-transform duration-300">
                <div class="w-16 h-16 rounded-full bg-error-container/40 flex items-center justify-center mb-6 text-error">
                    <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">warning</span>
                </div>
                <h3 class="text-headline-md font-semibold text-on-background mb-3">Sampah B3 / Residu</h3>
                <p class="text-body-md text-on-surface-variant mb-6">Baterai bekas, lampu kaca, obat-obatan medis, dan bahan berbahaya.</p>
                <div class="bg-surface-container rounded-lg p-4 flex items-start gap-3">
                    <span class="material-symbols-outlined text-error mt-0.5">info</span>
                    <div>
                        <span class="text-label-md block text-on-surface font-semibold mb-1">Tujuan:</span>
                        <span class="text-body-md text-on-surface-variant text-sm">Panduan pembuangan khusus &amp; aman</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Educational Articles Grid -->
    <section class="py-16 bg-surface-container-low border-y border-surface-variant">
        <div class="max-w-[1200px] mx-auto px-md md:px-8">
            <div class="flex flex-col md:flex-row md:justify-between md:items-end mb-10 gap-4">
                <div>
                    <h2 class="text-headline-lg-mobile md:text-headline-lg font-bold text-on-background mb-2">Artikel &amp; Tips Pengelolaan Lingkungan</h2>
                    <p class="text-body-md text-on-surface-variant">Inspirasi harian untuk gaya hidup lebih hijau.</p>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
                @forelse ($contents as $content)
                <article class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-[0_4px_12px_rgba(0,0,0,0.05)] border border-surface-variant group cursor-pointer">
                    <a href="{{ route('education.show', $content->slug) }}" class="block">
                        <div class="relative h-48 w-full overflow-hidden">
                            @php
                                $imgSrc = $content->media_path 
                                    ? (Str::startsWith($content->media_path, ['http://', 'https://']) ? $content->media_path : Storage::url($content->media_path))
                                    : 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?auto=format&fit=crop&w=800&q=80';
                            @endphp
                            <div class="w-full h-full bg-cover bg-center transition-transform duration-500 group-hover:scale-105"
                                 style="background-image: url('{{ $imgSrc }}')"></div>
                            <div class="absolute top-4 left-4 bg-primary/90 backdrop-blur-sm text-on-primary text-label-sm px-3 py-1 rounded-full uppercase tracking-wider font-semibold">
                                {{ $content->category->name ?? 'Umum' }}
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-3 text-on-surface-variant text-label-sm">
                                <span class="material-symbols-outlined" style="font-size:16px;">edit_document</span>
                                <span>BUMDes Ciawiasih</span>
                                @if($content->published_at)
                                <span>•</span>
                                <span>{{ $content->published_at->translatedFormat('d M Y') }}</span>
                                @endif
                            </div>
                            <h3 class="text-xl font-semibold text-on-background mb-3 group-hover:text-primary transition-colors line-clamp-2">{{ $content->title }}</h3>
                            <span class="text-label-md text-primary font-semibold inline-flex items-center gap-1 mt-2 group-hover:gap-2 transition-all">
                                Baca Selengkapnya <span class="material-symbols-outlined" style="font-size:16px;">arrow_forward</span>
                            </span>
                        </div>
                    </a>
                </article>
                @empty
                {{-- Empty state --}}
                <div class="col-span-1 md:col-span-2 lg:col-span-3">
                    <div class="bg-surface-container-lowest border border-dashed border-outline-variant rounded-2xl py-20 px-8 flex flex-col items-center justify-center text-center gap-4">
                        <div class="w-20 h-20 rounded-full bg-surface-container flex items-center justify-center">
                            <span class="material-symbols-outlined text-outline" style="font-size:48px;">menu_book</span>
                        </div>
                        <div>
                            <h3 class="text-headline-md font-semibold text-on-surface mb-2">Konten Edukasi Segera Hadir</h3>
                            <p class="text-body-md text-on-surface-variant max-w-sm">
                                Artikel dan panduan seputar pengelolaan sampah dari tim BUMDes Ciawiasih akan segera tersedia.
                            </p>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($contents->hasPages())
            <div class="mt-10 flex justify-center items-center gap-2">
                @if($contents->onFirstPage())
                <button disabled class="w-10 h-10 rounded-full flex items-center justify-center border border-surface-container-highest text-on-surface-variant opacity-50 cursor-not-allowed">
                    <span class="material-symbols-outlined" style="font-size:18px;">chevron_left</span>
                </button>
                @else
                <a href="{{ $contents->previousPageUrl() }}" class="w-10 h-10 rounded-full flex items-center justify-center border border-surface-container-highest text-on-surface-variant hover:bg-surface-container-low transition-colors">
                    <span class="material-symbols-outlined" style="font-size:18px;">chevron_left</span>
                </a>
                @endif

                @foreach($contents->getUrlRange(1, $contents->lastPage()) as $page => $url)
                <a href="{{ $url }}"
                   class="w-10 h-10 rounded-full flex items-center justify-center text-label-md font-semibold transition-colors
                          {{ $page == $contents->currentPage() ? 'bg-primary text-on-primary' : 'border border-surface-container-highest text-on-surface-variant hover:bg-surface-container-low' }}">
                    {{ $page }}
                </a>
                @endforeach

                @if($contents->hasMorePages())
                <a href="{{ $contents->nextPageUrl() }}" class="px-4 h-10 rounded-full flex items-center justify-center border border-surface-container-highest text-on-surface-variant hover:bg-surface-container-low transition-colors text-label-md gap-1">
                    Selanjutnya <span class="material-symbols-outlined" style="font-size:18px;">chevron_right</span>
                </a>
                @endif
            </div>
            @endif
        </div>
    </section>

    <!-- CTA Banner -->
    <section class="max-w-[1200px] mx-auto px-md md:px-8 py-16">
        <div class="bg-primary rounded-2xl p-8 md:p-12 relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-8 shadow-[0_8px_24px_rgba(46,125,50,0.2)]">
            <div class="absolute top-0 right-0 w-64 h-64 bg-primary-fixed/20 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-primary-fixed/20 rounded-full blur-3xl translate-y-1/2 -translate-x-1/4"></div>
            <div class="relative z-10 md:max-w-xl text-center md:text-left">
                <h2 class="text-headline-md text-on-primary md:text-3xl font-bold mb-4">Sudah Memilah Sampah Hari Ini?</h2>
                <p class="text-body-md text-on-primary/90 text-lg">
                    Terapkan ilmu dari artikel edukasi ini dan dukung warga Desa Ciawiasih dengan membeli produk daur ulang berkualitas dari katalog kami!
                </p>
            </div>
            <div class="relative z-10 shrink-0">
                <a href="{{ route('catalog.index') }}"
                   class="bg-surface-container-lowest text-primary text-label-md px-8 py-4 rounded-xl font-bold hover:bg-surface transition-colors shadow-lg flex items-center gap-2">
                    <span class="material-symbols-outlined">storefront</span>
                    Lihat Katalog Produk
                </a>
            </div>
        </div>
    </section>
</x-public-layout>
