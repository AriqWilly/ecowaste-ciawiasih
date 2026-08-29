<x-public-layout>
    <style>
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    <!-- Header Banner -->
    <section class="bg-surface-container-low py-xl px-md md:px-gutter relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 pointer-events-none"
             style="background-image: radial-gradient(#2e7d32 1px, transparent 1px); background-size: 20px 20px;"></div>
        <div class="max-w-[1200px] mx-auto text-center relative z-10">
            <h1 class="text-headline-xl font-bold text-primary mb-sm">Katalog Produk Daur Ulang Desa Ciawiasih</h1>
            <p class="text-body-lg text-on-surface-variant max-w-2xl mx-auto">
                Jelajahi kerajinan tangan berkualitas dan pupuk organik hasil karya warga Desa Ciawiasih.
            </p>
        </div>
    </section>

    <!-- Search & Filter Bar -->
    <div class="px-md md:px-gutter max-w-[1200px] mx-auto -mt-lg relative z-20">
        <div class="bg-surface rounded-xl shadow-[0px_4px_12px_rgba(0,0,0,0.05)] border border-surface-container-highest px-lg py-lg space-y-4">
            <!-- Row 1: Search + Sort -->
            <form method="GET" action="{{ route('catalog.index') }}" class="flex flex-col sm:flex-row gap-3 items-center">
                <!-- Keep current category if filtering -->
                @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}"/>
                @endif
                <!-- Search -->
                <div class="relative w-full sm:flex-grow">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline" style="font-size:20px;">search</span>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari produk daur ulang..."
                           class="w-full pl-10 pr-4 py-3 bg-surface-container-low border border-surface-container-highest focus:border-primary focus:ring-1 focus:ring-primary rounded-lg text-body-md text-on-surface outline-none transition-colors"/>
                </div>
                <!-- Sort -->
                <div class="flex items-center gap-sm w-full sm:w-auto flex-shrink-0">
                    <span class="text-label-md text-on-surface-variant whitespace-nowrap">Urutkan:</span>
                    <select name="sort" onchange="this.form.submit()"
                            class="bg-surface-container-low border border-surface-container-highest focus:border-primary focus:ring-1 focus:ring-primary rounded-lg text-body-md text-on-surface outline-none py-2.5 pl-3 pr-8 w-full sm:w-auto">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Termurah</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Termahal</option>
                    </select>
                </div>
                <button type="submit" class="bg-primary text-on-primary text-label-md px-5 py-3 rounded-lg hover:opacity-80 transition-opacity font-semibold flex-shrink-0 hidden sm:block">
                    Cari
                </button>
            </form>

            <!-- Row 2: Category Chips -->
            <div class="flex gap-2 overflow-x-auto pb-1 hide-scrollbar" id="category-chips">
                @php
                    $currentCat = request('category');
                    $baseParams = request()->only(['search', 'sort']);
                @endphp
                <a href="{{ route('catalog.index', $baseParams) }}"
                   data-category=""
                   class="category-chip whitespace-nowrap px-4 py-2 rounded-full text-label-md font-semibold transition-colors
                          {{ !$currentCat ? 'bg-primary-container text-on-primary-container active-chip' : 'bg-surface-container text-on-surface-variant hover:bg-surface-container-high border border-outline-variant' }}">
                    Semua
                </a>
                @foreach($categories as $cat)
                <a href="{{ route('catalog.index', array_merge($baseParams, ['category' => $cat->slug])) }}"
                   data-category="{{ $cat->slug }}"
                   class="category-chip whitespace-nowrap px-4 py-2 rounded-full text-label-md font-semibold transition-colors
                          {{ $currentCat == $cat->slug ? 'bg-primary-container text-on-primary-container active-chip' : 'bg-surface-container text-on-surface-variant hover:bg-surface-container-high border border-outline-variant' }}">
                    {{ $cat->name }}
                </a>
                @endforeach
            </div>
            <script>
                // Ensure correct active state based on URL param (fixes Tailwind CDN dynamic class issue)
                document.addEventListener('DOMContentLoaded', function () {
                    const urlCategory = new URLSearchParams(window.location.search).get('category') || '';
                    document.querySelectorAll('.category-chip').forEach(function (chip) {
                        const chipCat = chip.getAttribute('data-category');
                        chip.classList.remove(
                            'bg-primary-container', 'text-on-primary-container',
                            'bg-surface-container', 'text-on-surface-variant',
                            'hover:bg-surface-container-high', 'border', 'border-outline-variant'
                        );
                        if (chipCat === urlCategory) {
                            chip.classList.add('bg-primary-container', 'text-on-primary-container');
                        } else {
                            chip.classList.add(
                                'bg-surface-container', 'text-on-surface-variant',
                                'hover:bg-surface-container-high', 'border', 'border-outline-variant'
                            );
                        }
                    });
                });
            </script>
        </div>
    </div>

    <!-- Product Grid -->
    <section class="py-xl px-md md:px-gutter max-w-[1200px] mx-auto">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-gutter">
            @forelse ($products as $product)
            <div class="bg-surface-container-lowest rounded-[16px] shadow-[0px_4px_12px_rgba(0,0,0,0.05)] border border-surface-container-highest overflow-hidden flex flex-col group hover:shadow-[0px_8px_24px_rgba(0,0,0,0.10)] transition-shadow">
                <a href="{{ route('catalog.show', $product->slug) }}" class="block">
                    <div class="h-48 w-full bg-surface-container-low relative overflow-hidden">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                             src="{{ $product->image_url }}"
                             alt="{{ $product->name }}"/>
                        <span class="absolute top-2 right-2 bg-primary-fixed text-on-primary-fixed-variant px-2 py-1 rounded-full text-label-sm font-semibold">
                            {{ $product->category->name ?? 'Produk' }}
                        </span>
                    </div>
                    <div class="p-md flex flex-col flex-grow">
                        <h3 class="text-[18px] leading-[24px] font-semibold text-on-surface mb-xs line-clamp-2">{{ $product->name }}</h3>
                        <p class="text-[14px] leading-[20px] text-on-surface-variant mb-md flex-grow line-clamp-2">{{ $product->description }}</p>
                        <div class="text-[20px] leading-[28px] font-bold text-primary mb-md">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                    </div>
                </a>
                <div class="px-md pb-md">
                    @if($product->stock > 0)
                    @php
                        $waPhone = $product->seller_phone;
                        $waMsg   = urlencode("Halo, saya tertarik dengan produk *{$product->name}* (Rp " . number_format($product->price, 0, ',', '.') . ") dari Katalog Daur Ulang Desa Ciawiasih. Apakah stoknya masih tersedia?");
                        $waLink  = "https://wa.me/{$waPhone}?text={$waMsg}";
                    @endphp
                    <a href="{{ $waLink }}" target="_blank"
                       class="w-full bg-[#25D366] hover:bg-[#1DA851] text-white text-label-md py-3 px-lg rounded-lg flex items-center justify-center gap-sm transition-colors active:scale-95 shadow-[0px_4px_12px_rgba(37,211,102,0.2)]">
                        <span class="material-symbols-outlined" style="font-size:20px;">chat</span>
                        Pesan via WhatsApp
                    </a>
                    @else
                    <button disabled class="w-full bg-surface-container text-on-surface-variant text-label-md py-3 px-lg rounded-lg flex items-center justify-center gap-sm cursor-not-allowed">
                        Stok Habis
                    </button>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-span-1 sm:col-span-2 md:col-span-3 lg:col-span-4">
                <div class="bg-surface-container-lowest border border-dashed border-outline-variant rounded-2xl py-20 px-8 flex flex-col items-center justify-center text-center gap-4">
                    <div class="w-20 h-20 rounded-full bg-surface-container flex items-center justify-center">
                        <span class="material-symbols-outlined text-outline" style="font-size:48px;">inventory_2</span>
                    </div>
                    <div>
                        <h3 class="text-headline-md font-semibold text-on-surface mb-2">Katalog Sedang Dipersiapkan</h3>
                        <p class="text-body-md text-on-surface-variant max-w-sm">
                            Produk-produk daur ulang dari warga Desa Ciawiasih akan segera hadir. Pantau terus halaman ini!
                        </p>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
    </section>

    <!-- Pagination -->
    @if($products->hasPages())
    <section class="pb-xl px-md md:px-gutter max-w-[1200px] mx-auto flex justify-center items-center gap-2">
        {{-- Prev --}}
        @if($products->onFirstPage())
        <button disabled class="w-10 h-10 rounded-full flex items-center justify-center border border-surface-container-highest text-on-surface-variant opacity-50 cursor-not-allowed">
            <span class="material-symbols-outlined" style="font-size:18px;">chevron_left</span>
        </button>
        @else
        <a href="{{ $products->previousPageUrl() }}"
           class="w-10 h-10 rounded-full flex items-center justify-center border border-surface-container-highest text-on-surface-variant hover:bg-surface-container-low transition-colors">
            <span class="material-symbols-outlined" style="font-size:18px;">chevron_left</span>
        </a>
        @endif

        {{-- Page Numbers --}}
        @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
        <a href="{{ $url }}"
           class="w-10 h-10 rounded-full flex items-center justify-center text-label-md font-semibold transition-colors
                  {{ $page == $products->currentPage() ? 'bg-primary text-on-primary' : 'border border-surface-container-highest text-on-surface-variant hover:bg-surface-container-low' }}">
            {{ $page }}
        </a>
        @endforeach

        {{-- Next --}}
        @if($products->hasMorePages())
        <a href="{{ $products->nextPageUrl() }}"
           class="px-4 h-10 rounded-full flex items-center justify-center border border-surface-container-highest text-on-surface-variant hover:bg-surface-container-low transition-colors text-label-md gap-1">
            Selanjutnya
            <span class="material-symbols-outlined" style="font-size:18px;">chevron_right</span>
        </a>
        @else
        <button disabled class="px-4 h-10 rounded-full flex items-center justify-center border border-surface-container-highest text-on-surface-variant opacity-50 cursor-not-allowed text-label-md gap-1">
            Selanjutnya
            <span class="material-symbols-outlined" style="font-size:18px;">chevron_right</span>
        </button>
        @endif
    </section>
    @endif

</x-public-layout>
