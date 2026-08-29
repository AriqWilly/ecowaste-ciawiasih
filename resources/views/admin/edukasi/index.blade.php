<x-admin-layout>
    <x-slot name="pageTitle">Kelola Edukasi & Berita</x-slot>

    <div x-data="{ 
        openModal: false, 
        editMode: false,
        actionUrl: '',
        articleId: '',
        title: '',
        category_id: '',
        content: '',
        status: 'diterbitkan',
        imagePreview: null,
        
        openCreate() {
            this.editMode = false;
            this.actionUrl = '{{ route('admin.edukasi.store') }}';
            this.articleId = '';
            this.title = '';
            this.category_id = '';
            this.content = '';
            this.status = 'diterbitkan';
            this.imagePreview = null;
            this.openModal = true;
        },
        
        openEdit(article) {
            this.editMode = true;
            this.actionUrl = '{{ url('admin/edukasi') }}/' + article.id;
            this.articleId = article.id;
            this.title = article.title;
            this.category_id = article.category_id;
            this.content = article.content;
            this.status = article.published_at ? 'diterbitkan' : 'draft';
            this.imagePreview = article.media_url;
            this.openModal = true;
        }
    }" class="p-6 lg:p-8">
        <div class="max-w-[1200px] mx-auto space-y-6">

            <!-- Toast Notifications -->
            @if(session('success'))
            <div class="bg-primary-container text-on-primary-container p-4 rounded-xl border border-outline-variant flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-xl">check_circle</span>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
            </div>
            @endif

            @if($errors->any())
            <div class="bg-error-container text-on-error-container p-4 rounded-xl border border-error/20 flex flex-col gap-1 shadow-sm">
                <div class="flex items-center gap-2 font-bold mb-1">
                    <span class="material-symbols-outlined text-xl">error</span>
                    <span class="text-sm">Gagal Menyimpan Artikel:</span>
                </div>
                <ul class="list-disc pl-6 text-xs space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Page Header -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h1 class="text-headline-lg font-bold text-on-surface">Kelola Artikel Edukasi & Berita Desa</h1>
                    <p class="text-body-md text-on-surface-variant mt-1">Publikasikan artikel pemilahan sampah, tips lingkungan, dan informasi kegiatan BUMDes Ciawiasih.</p>
                </div>
                <button @click="openCreate()" class="bg-primary hover:bg-primary-container text-on-primary hover:text-on-primary-container px-6 py-3 rounded-lg text-label-md font-semibold flex items-center justify-center gap-2 shadow-sm transition-colors shrink-0">
                    <span class="material-symbols-outlined text-sm">add</span>
                    Tulis Artikel Baru
                </button>
            </div>

            <!-- Filters -->
            <div class="bg-surface-container-lowest p-4 rounded-xl shadow-sm border border-outline-variant flex flex-col md:flex-row gap-4 items-center justify-between">
                <form method="GET" action="{{ route('admin.edukasi.index') }}" class="relative w-full md:w-96">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-sm">search</span>
                    <input type="text" name="search" value="{{ request('search') }}"
                           class="w-full pl-10 pr-4 py-2 rounded-lg bg-surface-container-low border border-outline-variant focus:ring-1 focus:ring-primary focus:border-primary text-sm outline-none transition-all" 
                           placeholder="Cari judul artikel..."/>
                    @if(request('status'))
                        <input type="hidden" name="status" value="{{ request('status') }}"/>
                    @endif
                </form>

                <div class="flex space-x-2 overflow-x-auto w-full md:w-auto pb-2 md:pb-0 hide-scrollbar">
                    <a href="{{ route('admin.edukasi.index', request()->only('search')) }}" 
                       class="px-4 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap transition-colors
                              {{ !request('status') ? 'bg-primary-container text-on-primary-container border border-primary/20' : 'border border-outline-variant text-on-surface-variant hover:bg-surface-container-low' }}">
                        Semua Status
                    </a>
                    <a href="{{ route('admin.edukasi.index', array_merge(request()->only('search'), ['status' => 'diterbitkan'])) }}" 
                       class="px-4 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap transition-colors
                              {{ request('status') === 'diterbitkan' ? 'bg-primary-container text-on-primary-container border border-primary/20' : 'border border-outline-variant text-on-surface-variant hover:bg-surface-container-low' }}">
                        Diterbitkan
                    </a>
                    <a href="{{ route('admin.edukasi.index', array_merge(request()->only('search'), ['status' => 'draft'])) }}" 
                       class="px-4 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap transition-colors
                              {{ request('status') === 'draft' ? 'bg-primary-container text-on-primary-container border border-primary/20' : 'border border-outline-variant text-on-surface-variant hover:bg-surface-container-low' }}">
                        Draft
                    </a>
                </div>
            </div>

            <!-- Table -->
            <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-surface-container-low border-b border-outline-variant">
                            <tr>
                                <th class="py-3 px-4 text-xs font-semibold text-on-surface-variant w-[100px]">Cover</th>
                                <th class="py-3 px-4 text-xs font-semibold text-on-surface-variant">Judul Artikel</th>
                                <th class="py-3 px-4 text-xs font-semibold text-on-surface-variant hidden md:table-cell">Kategori</th>
                                <th class="py-3 px-4 text-xs font-semibold text-on-surface-variant hidden lg:table-cell">Tanggal</th>
                                <th class="py-3 px-4 text-xs font-semibold text-on-surface-variant">Status</th>
                                <th class="py-3 px-4 text-xs font-semibold text-on-surface-variant text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant text-sm">
                            @forelse($articles as $article)
                            <tr class="hover:bg-surface-container-low/50 transition-colors group">
                                <td class="py-3 px-4">
                                    <div class="w-16 h-12 rounded-md bg-surface-variant overflow-hidden shrink-0 border border-outline-variant flex items-center justify-center">
                                        @if($article->media_path)
                                            <img class="w-full h-full object-cover" 
                                                 src="{{ Storage::url($article->media_path) }}" 
                                                 alt="{{ $article->title }}"/>
                                        @else
                                            <span class="material-symbols-outlined text-outline-variant">article</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <p class="font-medium text-on-surface line-clamp-1">{{ $article->title }}</p>
                                    <p class="text-xs text-on-surface-variant mt-0.5 lg:hidden">
                                        {{ $article->published_at ? $article->published_at->format('d M Y') : 'Draft' }}
                                    </p>
                                </td>
                                <td class="py-3 px-4 hidden md:table-cell">
                                    <span class="px-2.5 py-1 bg-surface-variant text-on-surface-variant rounded-md text-xs font-medium">
                                        {{ $article->category->name ?? 'Edukasi Umum' }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 hidden lg:table-cell text-xs text-on-surface-variant">
                                    {{ $article->published_at ? $article->published_at->format('d M Y, H:i') : '-' }}
                                </td>
                                <td class="py-3 px-4">
                                    @if($article->published_at)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-primary-container text-on-primary-container text-xs font-semibold">
                                            <span class="w-1.5 h-1.5 rounded-full bg-primary mr-1.5"></span>
                                            Diterbitkan
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-secondary-container/30 text-secondary text-xs font-semibold">
                                            <span class="w-1.5 h-1.5 rounded-full bg-secondary mr-1.5"></span>
                                            Draft
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <a href="{{ route('education.show', $article->slug) }}" target="_blank" class="p-1.5 rounded-lg text-on-surface-variant hover:text-primary hover:bg-primary-container/20 transition-colors" title="Lihat di Publik">
                                            <span class="material-symbols-outlined text-[20px]">visibility</span>
                                        </a>
                                        <button @click="openEdit(@js([
                                            'id' => $article->id,
                                            'title' => $article->title,
                                            'category_id' => $article->category_id,
                                            'content' => $article->content,
                                            'published_at' => (bool) $article->published_at,
                                            'media_url' => $article->media_path ? Storage::url($article->media_path) : null
                                        ]))" class="p-1.5 rounded-lg text-on-surface-variant hover:text-primary hover:bg-primary-container/20 transition-colors" title="Edit Artikel">
                                            <span class="material-symbols-outlined text-[20px]">edit</span>
                                        </button>
                                        <form method="POST" action="{{ route('admin.edukasi.destroy', $article->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 rounded-lg text-on-surface-variant hover:text-error hover:bg-error-container/40 transition-colors" title="Hapus Artikel">
                                                <span class="material-symbols-outlined text-[20px]">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-on-surface-variant">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        <span class="material-symbols-outlined text-4xl text-outline-variant">article</span>
                                        <p class="font-medium">Tidak ada artikel edukasi ditemukan.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($articles->hasPages())
                <div class="p-4 border-t border-outline-variant bg-surface flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-xs text-on-surface-variant">
                        Menampilkan {{ $articles->firstItem() }}-{{ $articles->lastItem() }} dari {{ $articles->total() }} artikel
                    </p>
                    <div class="flex items-center gap-1">
                        {{ $articles->links('pagination::tailwind') }}
                    </div>
                </div>
                @endif
            </div>

            <!-- Modal: Tulis/Edit Artikel Baru -->
            <div x-show="openModal" 
                 class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto" 
                 style="display: none;">
                <!-- Backdrop -->
                <div x-show="openModal" 
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     @click="openModal = false"
                     class="fixed inset-0 bg-on-background/50 backdrop-blur-sm transition-opacity"></div>

                <!-- Modal Dialog -->
                <div x-show="openModal" 
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="relative bg-surface rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col z-10 border border-outline-variant overflow-hidden">
                    
                    <form :action="actionUrl" method="POST" enctype="multipart/form-data" class="flex flex-col h-full overflow-hidden">
                        @csrf
                        <input type="hidden" name="_method" :value="editMode ? 'PUT' : 'POST'">
                        
                        <!-- Header -->
                        <div class="flex items-center justify-between p-6 border-b border-outline-variant bg-surface-container-lowest">
                            <h2 class="text-lg font-bold text-on-surface" x-text="editMode ? 'Edit Artikel Edukasi' : 'Tulis Artikel Baru'"></h2>
                            <button type="button" class="text-on-surface-variant hover:text-on-surface p-1.5 rounded-full hover:bg-surface-container-low transition-colors" @click="openModal = false">
                                <span class="material-symbols-outlined">close</span>
                            </button>
                        </div>

                        <!-- Form Content -->
                        <div class="p-6 overflow-y-auto flex-1 space-y-4">
                            <!-- Judul Artikel -->
                            <div>
                                <label class="block text-xs font-semibold text-on-surface mb-1">Judul Artikel</label>
                                <input type="text" name="title" x-model="title" required
                                       class="w-full px-4 py-2.5 rounded-lg bg-surface-container-low border border-outline-variant focus:ring-1 focus:ring-primary focus:border-primary text-sm text-on-surface outline-none transition-all" 
                                       placeholder="Masukkan judul artikel yang informatif..."/>
                            </div>

                            <!-- Kategori -->
                            <div>
                                <label class="block text-xs font-semibold text-on-surface mb-1">Kategori</label>
                                <select name="category_id" x-model="category_id" required
                                        class="w-full px-4 py-2.5 rounded-lg bg-surface-container-low border border-outline-variant focus:ring-1 focus:ring-primary focus:border-primary text-sm text-on-surface outline-none transition-all">
                                    <option value="" disabled>Pilih Kategori...</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Gambar Cover -->
                            <div>
                                <label class="block text-xs font-semibold text-on-surface mb-1">Gambar Cover</label>
                                <div @click="$refs.mediaFile.click()" class="border-2 border-dashed border-outline-variant rounded-xl p-5 text-center bg-surface-container-low hover:bg-surface-container transition-colors cursor-pointer flex flex-col items-center justify-center relative overflow-hidden h-36">
                                    <input type="file" name="media" x-ref="mediaFile" class="hidden" accept="image/*"
                                           @change="
                                               const file = $event.target.files[0];
                                               if (file) {
                                                   const reader = new FileReader();
                                                   reader.onload = (e) => { imagePreview = e.target.result; };
                                                   reader.readAsDataURL(file);
                                               }
                                           ">
                                    
                                    <template x-if="imagePreview">
                                        <div class="absolute inset-0 w-full h-full bg-surface-variant">
                                            <img :src="imagePreview" class="w-full h-full object-cover"/>
                                            <div class="absolute inset-0 bg-black/40 opacity-0 hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-semibold gap-1">
                                                <span class="material-symbols-outlined">edit</span> Ganti Gambar Cover
                                            </div>
                                        </div>
                                    </template>
                                    
                                    <template x-if="!imagePreview">
                                        <div class="flex flex-col items-center">
                                            <span class="material-symbols-outlined text-3xl text-on-surface-variant mb-1">cloud_upload</span>
                                            <p class="text-xs font-semibold text-on-surface">Klik untuk unggah atau seret gambar ke sini</p>
                                            <p class="text-[10px] text-on-surface-variant mt-1">Format: JPG, PNG (Maksimal 5MB)</p>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <!-- Konten Artikel -->
                            <div>
                                <label class="block text-xs font-semibold text-on-surface mb-1">Konten Lengkap Artikel</label>
                                <textarea name="content" x-model="content" rows="7" required
                                          class="w-full p-3.5 rounded-lg bg-surface-container-low border border-outline-variant focus:ring-1 focus:ring-primary focus:border-primary text-sm text-on-surface outline-none transition-all resize-none" 
                                          placeholder="Tuliskan isi edukasi atau berita lengkap di sini..."></textarea>
                            </div>
                        </div>

                        <!-- Footer Actions -->
                        <div class="p-6 border-t border-outline-variant bg-surface-container-lowest flex items-center justify-between">
                            <div>
                                <select name="status" x-model="status" class="bg-surface-container-low border border-outline-variant rounded-lg px-3 py-2 text-xs text-on-surface focus:ring-1 focus:ring-primary outline-none">
                                    <option value="diterbitkan">Status: Diterbitkan Langsung</option>
                                    <option value="draft">Status: Simpan sebagai Draft</option>
                                </select>
                            </div>
                            <div class="flex gap-2">
                                <button type="button" class="px-4 py-2 rounded-lg border border-outline-variant text-on-surface text-xs font-medium hover:bg-surface-container-low transition-colors" @click="openModal = false">
                                    Batal
                                </button>
                                <button type="submit" class="px-5 py-2 rounded-lg bg-primary text-on-primary text-xs font-semibold hover:bg-primary-container hover:text-on-primary-container transition-colors shadow-sm" x-text="editMode ? 'Simpan Perubahan' : 'Simpan Artikel'">
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>
