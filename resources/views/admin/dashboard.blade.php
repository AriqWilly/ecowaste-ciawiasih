<x-admin-layout>
    <x-slot name="pageTitle">Dashboard Utama</x-slot>

    <div class="p-6 lg:p-8 space-y-8 max-w-[1400px] mx-auto">

        <!-- Welcome Hero Banner -->
        <div class="relative bg-gradient-to-r from-primary via-[#1b6d24] to-[#2e7d32] rounded-2xl p-6 sm:p-8 text-white shadow-md overflow-hidden">
            <div class="absolute -right-12 -bottom-12 w-64 h-64 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
            <div class="absolute top-0 right-1/4 w-32 h-32 bg-white/5 rounded-full blur-xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="space-y-2 max-w-xl">
                    <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-md px-3 py-1 rounded-full text-xs font-semibold border border-white/20">
                        <span class="material-symbols-outlined text-sm">eco</span>
                        <span>Portal Manajemen Daur Ulang Desa</span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-bold tracking-tight">Selamat Datang, Administrator 👋</h1>
                    <p class="text-xs sm:text-sm text-white/85 leading-relaxed">
                        Kelola katalog produk kerajinan warga, publikasi materi edukasi bank sampah, dan pantau pesan warga dari satu pusat kendali terpadu.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3 shrink-0">
                    <a href="{{ route('admin.katalog.index') }}" class="px-4 py-2.5 bg-white text-primary hover:bg-surface-container-low font-semibold text-xs rounded-xl shadow-sm transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-base">add</span>
                        <span>Tambah Produk</span>
                    </a>
                    <a href="{{ route('admin.edukasi.index') }}" class="px-4 py-2.5 bg-white/15 hover:bg-white/25 text-white font-semibold text-xs rounded-xl border border-white/30 backdrop-blur-sm transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-base">post_add</span>
                        <span>Tulis Edukasi</span>
                    </a>
                    <a href="{{ route('home') }}" target="_blank" class="px-4 py-2.5 bg-white/10 hover:bg-white/20 text-white font-semibold text-xs rounded-xl border border-white/20 transition-all flex items-center gap-1.5" title="Buka Website Publik">
                        <span class="material-symbols-outlined text-base">open_in_new</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- 4 Key Stat Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- Stat 1: Total Produk -->
            <a href="{{ route('admin.katalog.index') }}" class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant/50 shadow-sm hover:border-primary/50 hover:shadow-md transition-all group flex items-center justify-between">
                <div class="space-y-1">
                    <p class="text-xs font-semibold text-on-surface-variant">Total Produk Katalog</p>
                    <p class="text-3xl font-bold text-on-surface group-hover:text-primary transition-colors">{{ $totalProducts }}</p>
                    <p class="text-[11px] text-outline flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs text-primary">check_circle</span>
                        <span>Kerajinan Daur Ulang</span>
                    </p>
                </div>
                <div class="w-13 h-13 w-12 h-12 rounded-2xl bg-primary/10 text-primary flex items-center justify-center group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-2xl">inventory_2</span>
                </div>
            </a>

            <!-- Stat 2: Modul Edukasi -->
            <a href="{{ route('admin.edukasi.index') }}" class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant/50 shadow-sm hover:border-primary/50 hover:shadow-md transition-all group flex items-center justify-between">
                <div class="space-y-1">
                    <p class="text-xs font-semibold text-on-surface-variant">Materi Edukasi & Berita</p>
                    <p class="text-3xl font-bold text-on-surface group-hover:text-primary transition-colors">{{ $totalEducations }}</p>
                    <p class="text-[11px] text-outline flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs text-secondary">menu_book</span>
                        <span>Artikel Bank Sampah</span>
                    </p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-secondary-container/30 text-secondary flex items-center justify-center group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-2xl">article</span>
                </div>
            </a>

            <!-- Stat 3: Kategori Klasifikasi -->
            <a href="{{ route('admin.kategori.index') }}" class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant/50 shadow-sm hover:border-primary/50 hover:shadow-md transition-all group flex items-center justify-between">
                <div class="space-y-1">
                    <p class="text-xs font-semibold text-on-surface-variant">Kategori Produk</p>
                    <p class="text-3xl font-bold text-on-surface group-hover:text-primary transition-colors">{{ $totalCategories }}</p>
                    <p class="text-[11px] text-outline flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs text-primary">sell</span>
                        <span>Klasifikasi Sampah</span>
                    </p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-primary-container/15 text-primary flex items-center justify-center group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-2xl">category</span>
                </div>
            </a>

            <!-- Stat 4: Pesan Masuk -->
            <a href="{{ route('admin.pesan.index') }}" class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant/50 shadow-sm hover:border-primary/50 hover:shadow-md transition-all group flex items-center justify-between">
                <div class="space-y-1">
                    <p class="text-xs font-semibold text-on-surface-variant">Pesan Masuk (Inbox)</p>
                    <div class="flex items-baseline gap-2">
                        <p class="text-3xl font-bold text-on-surface group-hover:text-primary transition-colors">{{ $totalMessages }}</p>
                        @if($unreadMessages > 0)
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-error/10 text-error">{{ $unreadMessages }} Baru</span>
                        @endif
                    </div>
                    <p class="text-[11px] text-outline flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs text-primary">chat</span>
                        <span>Pertanyaan Warga</span>
                    </p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-primary/10 text-primary flex items-center justify-center group-hover:scale-110 transition-transform relative">
                    <span class="material-symbols-outlined text-2xl">inbox</span>
                    @if($unreadMessages > 0)
                        <span class="absolute top-2 right-2 w-2.5 h-2.5 bg-error rounded-full ring-2 ring-white"></span>
                    @endif
                </div>
            </a>
        </div>

        <!-- 2 Column Layout: Main Activity & Sidebar Status -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left 2 Cols: Recent Products & Articles -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- Recent Products Card -->
                <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/50 shadow-sm overflow-hidden">
                    <div class="p-5 border-b border-outline-variant/40 flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <span class="material-symbols-outlined text-primary text-xl">inventory_2</span>
                            <h2 class="text-base font-bold text-on-surface">Produk Daur Ulang Terbaru</h2>
                        </div>
                        <a href="{{ route('admin.katalog.index') }}" class="text-xs font-semibold text-primary hover:underline flex items-center gap-1">
                            <span>Kelola Semua</span>
                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm border-collapse">
                            <thead class="bg-surface-container-low/60 text-xs font-semibold text-on-surface-variant border-b border-outline-variant/30">
                                <tr>
                                    <th class="py-3 px-4">Produk</th>
                                    <th class="py-3 px-4">Kategori</th>
                                    <th class="py-3 px-4">Harga</th>
                                    <th class="py-3 px-4">Stok</th>
                                    <th class="py-3 px-4 text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant/30">
                                @forelse($recentProducts as $prod)
                                <tr class="hover:bg-surface-container-low/40 transition-colors">
                                    <td class="py-3 px-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-lg bg-surface-variant overflow-hidden shrink-0 border border-outline-variant/40">
                                                <img src="{{ $prod->image_path ? Storage::url($prod->image_path) : 'https://placehold.co/100/edeeef/40493d?text=Foto' }}" 
                                                     alt="{{ $prod->name }}" class="w-full h-full object-cover"/>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-on-surface line-clamp-1">{{ $prod->name }}</p>
                                                <p class="text-[11px] text-outline">Oleh {{ $prod->seller_name }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4 text-xs text-on-surface-variant">
                                        {{ $prod->category->name ?? '-' }}
                                    </td>
                                    <td class="py-3 px-4 font-semibold text-on-surface text-xs">
                                        Rp {{ number_format($prod->price, 0, ',', '.') }}
                                    </td>
                                    <td class="py-3 px-4 text-xs font-semibold {{ $prod->stock > 0 ? 'text-primary' : 'text-error' }}">
                                        {{ $prod->stock }} Pcs
                                    </td>
                                    <td class="py-3 px-4 text-right">
                                        @if($prod->is_published)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-primary-container/20 text-primary text-[10px] font-bold">Aktif</span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-surface-container-highest text-on-surface-variant text-[10px] font-bold">Nonaktif</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-xs text-on-surface-variant">
                                        Belum ada produk yang ditambahkan.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Recent Educations Card -->
                <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/50 shadow-sm overflow-hidden p-5 space-y-4">
                    <div class="flex items-center justify-between border-b border-outline-variant/40 pb-4">
                        <div class="flex items-center gap-2.5">
                            <span class="material-symbols-outlined text-primary text-xl">article</span>
                            <h2 class="text-base font-bold text-on-surface">Materi Edukasi & Artikel Terbaru</h2>
                        </div>
                        <a href="{{ route('admin.edukasi.index') }}" class="text-xs font-semibold text-primary hover:underline flex items-center gap-1">
                            <span>Lihat Semua</span>
                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        @forelse($recentEducations as $edu)
                        <div class="bg-surface-container-low/50 rounded-xl p-4 border border-outline-variant/30 flex flex-col justify-between hover:border-primary/40 transition-colors">
                            <div class="space-y-2">
                                <span class="inline-block px-2 py-0.5 rounded-md bg-white text-[10px] font-semibold text-primary border border-outline-variant/30">
                                    {{ $edu->category->name ?? 'Umum' }}
                                </span>
                                <h3 class="text-xs font-bold text-on-surface line-clamp-2 leading-snug">{{ $edu->title }}</h3>
                            </div>
                            <div class="pt-3 mt-2 border-t border-outline-variant/20 flex items-center justify-between text-[11px] text-outline">
                                <span>{{ $edu->published_at ? $edu->published_at->format('d M Y') : 'Draft' }}</span>
                                <a href="{{ route('education.show', $edu->slug) }}" target="_blank" class="text-primary hover:underline font-semibold flex items-center">
                                    <span class="material-symbols-outlined text-sm">visibility</span>
                                </a>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-3 py-6 text-center text-xs text-on-surface-variant">
                            Belum ada artikel edukasi.
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>

            <!-- Right 1 Col: Recent Citizen Messages & Village Profile Info -->
            <div class="space-y-8">
                
                <!-- Recent Messages Card -->
                <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/50 shadow-sm overflow-hidden">
                    <div class="p-5 border-b border-outline-variant/40 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-xl">mark_chat_unread</span>
                            <h2 class="text-base font-bold text-on-surface">Pesan Warga Terbaru</h2>
                        </div>
                        <a href="{{ route('admin.pesan.index') }}" class="text-xs font-semibold text-primary hover:underline">
                            Inbox
                        </a>
                    </div>

                    <div class="divide-y divide-outline-variant/30">
                        @forelse($recentMessages as $msg)
                        <div class="p-4 hover:bg-surface-container-low/40 transition-colors space-y-1.5 {{ !$msg->is_read ? 'bg-primary/5' : '' }}">
                            <div class="flex items-center justify-between">
                                <span class="font-bold text-xs text-on-surface">{{ $msg->name }}</span>
                                <span class="text-[10px] text-outline">{{ $msg->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-xs font-semibold text-primary line-clamp-1">{{ $msg->subject }}</p>
                            <p class="text-xs text-on-surface-variant line-clamp-2">{{ $msg->message }}</p>
                            <div class="pt-1 flex items-center justify-between">
                                <span class="text-[10px] font-mono text-outline">{{ $msg->phone }}</span>
                                <a href="{{ route('admin.pesan.index') }}" class="text-[11px] font-semibold text-primary hover:underline flex items-center gap-0.5">
                                    <span>Buka</span>
                                    <span class="material-symbols-outlined text-xs">chevron_right</span>
                                </a>
                            </div>
                        </div>
                        @empty
                        <div class="p-8 text-center text-xs text-on-surface-variant">
                            <span class="material-symbols-outlined text-3xl text-outline mb-1">inbox</span>
                            <p>Belum ada pesan masuk.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Village Integration Status Card -->
                <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/50 shadow-sm p-5 space-y-4">
                    <div class="flex items-center gap-2 pb-3 border-b border-outline-variant/40">
                        <span class="material-symbols-outlined text-primary text-xl">tune</span>
                        <h2 class="text-base font-bold text-on-surface">Status Konfigurasi Desa</h2>
                    </div>

                    <div class="space-y-3 text-xs">
                        <div class="flex items-center justify-between">
                            <span class="text-on-surface-variant">Nomor WhatsApp BUMDes:</span>
                            <span class="font-bold text-primary font-mono">{{ $villageWa }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-on-surface-variant">Pengurus & Mitra Terdaftar:</span>
                            <span class="font-bold text-on-surface">{{ $totalTeam }} Orang</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-on-surface-variant">Status Website:</span>
                            <span class="inline-flex items-center gap-1 font-bold text-primary">
                                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                                Online & Aktif
                            </span>
                        </div>
                    </div>

                    <div class="pt-2">
                        <a href="{{ route('admin.pengaturan.index') }}" class="w-full py-2.5 px-4 rounded-xl border border-outline-variant text-xs font-semibold text-on-surface hover:bg-surface-container-low flex items-center justify-center gap-2 transition-colors">
                            <span class="material-symbols-outlined text-sm">settings</span>
                            <span>Buka Pengaturan Profil Desa</span>
                        </a>
                    </div>
                </div>

            </div>

        </div>

    </div>
</x-admin-layout>
