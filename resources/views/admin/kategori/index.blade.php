<x-admin-layout>
    <x-slot name="pageTitle">Kelola Kategori</x-slot>

    <div x-data="{ 
        openModal: false, 
        editMode: false,
        actionUrl: '',
        categoryId: '',
        name: '',
        description: '',
        
        openCreate() {
            this.editMode = false;
            this.actionUrl = '{{ route('admin.kategori.store') }}';
            this.categoryId = '';
            this.name = '';
            this.description = '';
            this.openModal = true;
        },
        
        openEdit(cat) {
            this.editMode = true;
            this.actionUrl = '{{ url('admin/kategori') }}/' + cat.id;
            this.categoryId = cat.id;
            this.name = cat.name;
            this.description = cat.description;
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
                    <span class="text-sm">Pemberitahuan:</span>
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
                    <h1 class="text-headline-lg font-bold text-on-surface">Kelola Kategori Produk & Edukasi</h1>
                    <p class="text-body-md text-on-surface-variant mt-1">Atur kategori klasifikasi kerajinan daur ulang dan modul materi bank sampah.</p>
                </div>
                <button @click="openCreate()" class="bg-primary hover:bg-primary-container text-on-primary hover:text-on-primary-container px-6 py-3 rounded-lg text-label-md font-semibold flex items-center justify-center gap-2 shadow-sm transition-colors shrink-0">
                    <span class="material-symbols-outlined text-sm">add</span>
                    Tambah Kategori Baru
                </button>
            </div>

            <!-- Filters -->
            <div class="bg-surface-container-lowest p-4 rounded-xl shadow-sm border border-outline-variant flex flex-col md:flex-row gap-4 items-center justify-between">
                <form method="GET" action="{{ route('admin.kategori.index') }}" class="relative w-full md:w-96">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-sm">search</span>
                    <input type="text" name="search" value="{{ request('search') }}"
                           class="w-full pl-10 pr-4 py-2 rounded-lg bg-surface-container-low border border-outline-variant focus:ring-1 focus:ring-primary focus:border-primary text-sm outline-none transition-all" 
                           placeholder="Cari nama kategori..."/>
                </form>
                @if(request('search'))
                    <a href="{{ route('admin.kategori.index') }}" class="text-xs text-primary font-semibold hover:underline">Reset Pencarian</a>
                @endif
            </div>

            <!-- Table -->
            <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-surface-container-low border-b border-outline-variant">
                            <tr>
                                <th class="py-3 px-4 text-xs font-semibold text-on-surface-variant">Nama Kategori</th>
                                <th class="py-3 px-4 text-xs font-semibold text-on-surface-variant">Slug (URL)</th>
                                <th class="py-3 px-4 text-xs font-semibold text-on-surface-variant">Deskripsi</th>
                                <th class="py-3 px-4 text-xs font-semibold text-on-surface-variant text-center">Produk Terkait</th>
                                <th class="py-3 px-4 text-xs font-semibold text-on-surface-variant text-center">Edukasi Terkait</th>
                                <th class="py-3 px-4 text-xs font-semibold text-on-surface-variant text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant text-sm">
                            @forelse($categories as $cat)
                            <tr class="hover:bg-surface-container-low/50 transition-colors group">
                                <td class="py-3.5 px-4 font-semibold text-on-surface">
                                    <div class="flex items-center gap-2">
                                        <span class="w-2.5 h-2.5 rounded-full bg-primary"></span>
                                        <span>{{ $cat->name }}</span>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4 text-xs font-mono text-on-surface-variant">
                                    {{ $cat->slug }}
                                </td>
                                <td class="py-3.5 px-4 text-xs text-on-surface-variant max-w-xs truncate">
                                    {{ $cat->description ?: '-' }}
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <span class="px-2.5 py-1 bg-surface-variant text-on-surface font-semibold rounded-md text-xs">
                                        {{ $cat->products_count }} Produk
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <span class="px-2.5 py-1 bg-surface-variant text-on-surface font-semibold rounded-md text-xs">
                                        {{ $cat->educational_contents_count }} Artikel
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <button @click="openEdit(@js([
                                            'id' => $cat->id,
                                            'name' => $cat->name,
                                            'description' => $cat->description ?? ''
                                        ]))" class="p-1.5 rounded-lg text-on-surface-variant hover:text-primary hover:bg-primary-container/20 transition-colors" title="Edit Kategori">
                                            <span class="material-symbols-outlined text-[20px]">edit</span>
                                        </button>
                                        <form method="POST" action="{{ route('admin.kategori.destroy', $cat->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 rounded-lg text-on-surface-variant hover:text-error hover:bg-error-container/40 transition-colors" title="Hapus Kategori">
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
                                        <span class="material-symbols-outlined text-4xl text-outline-variant">category</span>
                                        <p class="font-medium">Tidak ada kategori ditemukan.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($categories->hasPages())
                <div class="p-4 border-t border-outline-variant bg-surface flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-xs text-on-surface-variant">
                        Menampilkan {{ $categories->firstItem() }}-{{ $categories->lastItem() }} dari {{ $categories->total() }} kategori
                    </p>
                    <div class="flex items-center gap-1">
                        {{ $categories->links('pagination::tailwind') }}
                    </div>
                </div>
                @endif
            </div>

            <!-- Modal: Tambah/Edit Kategori -->
            <div x-show="openModal" 
                 class="fixed inset-0 z-50 flex items-center justify-center p-4" 
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
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="relative bg-surface rounded-xl shadow-2xl w-full max-w-lg z-10 border border-outline-variant overflow-hidden">
                    
                    <form :action="actionUrl" method="POST" class="flex flex-col">
                        @csrf
                        <input type="hidden" name="_method" :value="editMode ? 'PUT' : 'POST'">
                        
                        <!-- Header -->
                        <div class="flex items-center justify-between p-6 border-b border-outline-variant bg-surface-container-lowest">
                            <h2 class="text-lg font-bold text-on-surface" x-text="editMode ? 'Edit Kategori' : 'Tambah Kategori Baru'"></h2>
                            <button type="button" class="text-on-surface-variant hover:text-on-surface p-1.5 rounded-full hover:bg-surface-container-low transition-colors" @click="openModal = false">
                                <span class="material-symbols-outlined">close</span>
                            </button>
                        </div>

                        <!-- Form Content -->
                        <div class="p-6 space-y-4">
                            <div>
                                <label class="block text-xs font-semibold text-on-surface mb-1">Nama Kategori</label>
                                <input type="text" name="name" x-model="name" required
                                       class="w-full px-4 py-2.5 rounded-lg bg-surface-container-low border border-outline-variant focus:ring-1 focus:ring-primary focus:border-primary text-sm text-on-surface outline-none transition-all" 
                                       placeholder="Misal: Kerajinan Kaca, Minyak Jelantah..."/>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-on-surface mb-1">Deskripsi Kategori (Opsional)</label>
                                <textarea name="description" x-model="description" rows="3"
                                          class="w-full p-3.5 rounded-lg bg-surface-container-low border border-outline-variant focus:ring-1 focus:ring-primary focus:border-primary text-sm text-on-surface outline-none transition-all resize-none" 
                                          placeholder="Penjelasan singkat mengenai jenis limbah atau material yang diolah..."></textarea>
                            </div>
                        </div>

                        <!-- Footer Actions -->
                        <div class="p-6 border-t border-outline-variant bg-surface-container-lowest flex justify-end gap-3">
                            <button type="button" class="px-4 py-2 rounded-lg border border-outline-variant text-on-surface text-xs font-medium hover:bg-surface-container-low transition-colors" @click="openModal = false">
                                Batal
                            </button>
                            <button type="submit" class="px-5 py-2 rounded-lg bg-primary text-on-primary text-xs font-semibold hover:bg-primary-container hover:text-on-primary-container transition-colors shadow-sm" x-text="editMode ? 'Simpan Perubahan' : 'Simpan Kategori'">
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>
