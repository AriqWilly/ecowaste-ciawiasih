<x-public-layout>
    <!-- Breadcrumb -->
    <div class="bg-surface-container-low border-b border-surface-variant">
        <div class="max-w-[1200px] mx-auto px-md md:px-8 py-4">
            <a href="{{ route('education.index') }}" class="text-label-md text-on-surface-variant hover:text-primary transition flex items-center gap-1 w-fit">
                <span class="material-symbols-outlined" style="font-size:18px;">arrow_back</span>
                Kembali ke Edukasi
            </a>
        </div>
    </div>

    <!-- Article Content -->
    <article class="max-w-3xl mx-auto px-md md:px-8 py-10 md:py-16">
        <!-- Category Badge -->
        <div class="mb-4">
            <span class="bg-primary/90 text-on-primary text-label-sm px-3 py-1 rounded-full uppercase tracking-wider font-semibold">
                {{ $content->category->name ?? 'Umum' }}
            </span>
        </div>

        <!-- Title -->
        <h1 class="text-headline-xl font-bold text-on-surface leading-tight mb-4">{{ $content->title }}</h1>

        <!-- Meta -->
        <div class="flex items-center gap-3 text-on-surface-variant text-label-md mb-8 pb-8 border-b border-surface-variant">
            <span class="material-symbols-outlined" style="font-size:18px;">edit_document</span>
            <span>BUMDes Ciawiasih</span>
            @if($content->published_at)
            <span>•</span>
            <span>{{ $content->published_at->translatedFormat('d F Y') }}</span>
            @endif
        </div>

        <!-- Media -->
        @if($content->media_path)
        <div class="mb-10 rounded-xl overflow-hidden border border-surface-variant shadow-[0_4px_12px_rgba(0,0,0,0.05)]">
            <img src="{{ Storage::url($content->media_path) }}" alt="{{ $content->title }}" class="w-full"/>
        </div>
        @endif

        <!-- Body -->
        <div class="prose prose-lg max-w-none text-on-surface-variant leading-[28px]
                    prose-headings:text-on-surface prose-headings:font-semibold
                    prose-a:text-primary prose-a:no-underline hover:prose-a:underline
                    prose-strong:text-on-surface">
            {!! nl2br(e($content->content)) !!}
        </div>

        <!-- Share / Back -->
        <div class="mt-12 pt-8 border-t border-surface-variant flex flex-col sm:flex-row items-center justify-between gap-4">
            <a href="{{ route('education.index') }}"
               class="text-label-md text-primary font-semibold inline-flex items-center gap-1 hover:gap-2 transition-all">
                <span class="material-symbols-outlined" style="font-size:18px;">arrow_back</span>
                Lihat Artikel Lainnya
            </a>
            <div class="flex items-center gap-3">
                <span class="text-label-md text-on-surface-variant">Bagikan:</span>
                <a href="https://wa.me/?text={{ urlencode($content->title . ' — ' . url()->current()) }}" target="_blank"
                   class="w-10 h-10 rounded-full bg-[#25D366] text-white flex items-center justify-center hover:opacity-80 transition-opacity">
                    <span class="material-symbols-outlined" style="font-size:20px;">chat</span>
                </a>
                <button onclick="navigator.clipboard.writeText(window.location.href)"
                        class="w-10 h-10 rounded-full bg-surface-container border border-outline-variant text-on-surface-variant flex items-center justify-center hover:bg-surface-container-high transition-colors">
                    <span class="material-symbols-outlined" style="font-size:20px;">content_copy</span>
                </button>
            </div>
        </div>
    </article>
</x-public-layout>
