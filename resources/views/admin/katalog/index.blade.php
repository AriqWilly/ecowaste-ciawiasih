<x-admin-layout>
    <x-slot name="pageTitle">Kelola Katalog Produk</x-slot>

    <div x-data="{ 
        open: false, 
        editMode: false,
        actionUrl: '',
        productId: '',
        name: '',
        category_id: '',
        price: '',
        stock: '',
        description: '',
        seller_name: '',
        seller_phone: '',
        is_published: true,
        imagePreview: null,
        
        openCreate() {
            this.editMode = false;
            this.actionUrl = '{{ route('admin.katalog.store') }}';
            this.productId = '';
            this.name = '';
            this.category_id = '';
            this.price = '';
            this.stock = '';
            this.description = '';
            this.seller_name = '';
            this.seller_phone = '';
            this.is_published = true;
            this.imagePreview = null;
            this.open = true;
        },
        
        openEdit(product) {
            this.editMode = true;
            this.actionUrl = '{{ url('admin/katalog') }}/' + product.id;
            this.productId = product.id;
            this.name = product.name;
            this.category_id = product.category_id;
            this.price = Math.round(product.price);
            this.stock = product.stock;
            this.description = product.description;
            this.seller_name = product.seller_name;
            this.seller_phone = product.seller_phone;
            this.is_published = !!product.is_published;
            this.imagePreview = product.image_url;
            this.open = true;
        }
    }" class="p-6 lg:p-8">
        <div class="max-w-[1200px] mx-auto space-y-6">
            
            <!-- Toast Notifications -->
            @if(session('success'))
            <div class="bg-primary-container text-on-primary-container p-4 rounded-xl border border-outline-variant flex items-center justify-between mb-4 shadow-sm">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-xl">check_circle</span>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
            </div>
            @endif

            @if($errors->any())
            <div class="bg-error-container text-on-error-container p-4 rounded-xl border border-error/20 flex flex-col gap-1 mb-4 shadow-sm">
                <div class="flex items-center gap-2 font-bold mb-1">
                    <span class="material-symbols-outlined text-xl">error</span>
                    <span class="text-sm">Gagal Menyimpan Produk:</span>
                </div>
                <ul class="list-disc pl-6 text-xs space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Content Header -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="text-headline-lg font-bold text-on-surface">Kelola Katalog Produk Daur Ulang</h2>
                    <p class="text-body-md text-on-surface-variant mt-1">Tambah, edit, hapus, dan atur ketersediaan produk daur ulang warga desa Ciawiasih.</p>
                </div>
                <button @click="openCreate()" class="bg-primary hover:bg-primary-container text-on-primary hover:text-on-primary-container px-6 py-3 rounded-lg text-label-md font-semibold flex items-center gap-2 transition-colors shadow-sm whitespace-nowrap shrink-0">
                    <span class="material-symbols-outlined text-sm">add</span>
                    Tambah Produk Baru
                </button>
            </div>

            <!-- Main Card (Filters & Table) -->
            <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant overflow-hidden">
                
                <!-- Filter Section -->
                <form method="GET" action="{{ route('admin.katalog.index') }}" class="p-4 border-b border-outline-variant bg-surface-bright flex flex-col md:flex-row gap-4 items-center justify-between">
                    <div class="relative w-full md:w-80">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-sm">search</span>
                        <input type="text" name="search" value="{{ request('search') }}"
                               class="w-full bg-surface-container-low border border-outline-variant rounded-lg pl-10 pr-4 py-2 text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" 
                               placeholder="Cari nama produk..."/>
                    </div>
                    <div class="flex gap-3 w-full md:w-auto">
                        <select name="category" onchange="this.form.submit()"
                                class="bg-surface-container-low border border-outline-variant rounded-lg px-4 py-2 text-sm text-on-surface focus:border-primary focus:ring-1 focus:ring-primary flex-1 md:w-48 appearance-none bg-[url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22none%22%20stroke%3D%22%2340493d%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpolyline%20points%3D%226%209%2012%2015%2018%209%22%3E%3C%2Fpolyline%3E%3C%2Fsvg%3E')] bg-[length:1.2em_1.2em] bg-[right_0.5rem_center] bg-no-repeat pr-10 outline-none">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <select name="status" onchange="this.form.submit()"
                                class="bg-surface-container-low border border-outline-variant rounded-lg px-4 py-2 text-sm text-on-surface focus:border-primary focus:ring-1 focus:ring-primary flex-1 md:w-40 appearance-none bg-[url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22none%22%20stroke%3D%22%2340493d%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpolyline%20points%3D%226%209%2012%2015%2018%209%22%3E%3C%2Fpolyline%3E%3C%2Fsvg%3E')] bg-[length:1.2em_1.2em] bg-[right_0.5rem_center] bg-no-repeat pr-10 outline-none">
                            <option value="">Semua Status</option>
                            <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @if(request()->anyFilled(['search', 'category', 'status']))
                            <a href="{{ route('admin.katalog.index') }}" class="border border-outline text-on-surface-variant hover:bg-surface-container-low px-4 py-2 rounded-lg text-sm flex items-center justify-center font-medium transition-colors">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>

                <!-- Data Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-surface-container-highest border-b border-outline-variant">
                                <th class="py-3 px-4 font-label-md text-on-surface-variant font-semibold">Produk</th>
                                <th class="py-3 px-4 font-label-md text-on-surface-variant font-semibold">Kategori</th>
                                <th class="py-3 px-4 font-label-md text-on-surface-variant font-semibold">Harga (Rp)</th>
                                <th class="py-3 px-4 font-label-md text-on-surface-variant font-semibold">Stok</th>
                                <th class="py-3 px-4 font-label-md text-on-surface-variant font-semibold">Pengrajin</th>
                                <th class="py-3 px-4 font-label-md text-on-surface-variant font-semibold">Status</th>
                                <th class="py-3 px-4 font-label-md text-on-surface-variant font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant text-sm">
                            @forelse($products as $product)
                            <tr class="hover:bg-surface-container-low transition-colors group">
                                <td class="py-3 px-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-md bg-surface-variant overflow-hidden shrink-0 border border-outline-variant">
                                            <img class="w-full h-full object-cover" 
                                                 src="{{ $product->image_url }}" 
                                                 alt="{{ $product->name }}"/>
                                        </div>
                                        <div>
                                            <p class="font-medium text-on-surface line-clamp-1">{{ $product->name }}</p>
                                            <p class="text-on-surface-variant text-xs mt-0.5">Slug: {{ $product->slug }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <span class="inline-flex items-center px-2 py-1 rounded-md bg-surface-variant text-on-surface-variant text-xs font-medium">
                                        {{ $product->category->name ?? 'Tanpa Kategori' }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 font-medium text-on-surface">
                                    {{ number_format($product->price, 0, ',', '.') }}
                                </td>
                                <td class="py-3 px-4">
                                    <span class="text-xs font-semibold {{ $product->stock > 0 ? 'text-primary' : 'text-error' }}">
                                        {{ $product->stock }} Pcs
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    <div>
                                        <p class="text-xs font-medium text-on-surface">{{ $product->seller_name }}</p>
                                        <p class="text-[10px] text-on-surface-variant">{{ $product->seller_phone }}</p>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    @if($product->is_published)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-primary-container text-on-primary-container text-xs font-semibold">Aktif</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-surface-container-highest text-on-surface-variant text-xs font-semibold">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-right">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <button @click="openEdit(@js([
                                            'id' => $product->id,
                                            'name' => $product->name,
                                            'category_id' => $product->category_id,
                                            'price' => $product->price,
                                            'stock' => $product->stock,
                                            'description' => $product->description,
                                            'seller_name' => $product->seller_name,
                                            'seller_phone' => $product->seller_phone,
                                            'is_published' => (bool) $product->is_published,
                                            'image_url' => $product->image_path ? Storage::url($product->image_path) : null
                                        ]))" class="p-1.5 rounded-lg text-on-surface-variant hover:text-primary hover:bg-primary-container/20 transition-colors" title="Edit Produk">
                                            <span class="material-symbols-outlined text-[20px]">edit</span>
                                        </button>
                                        <form method="POST" action="{{ route('admin.katalog.destroy', $product->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini dari katalog?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 rounded-lg text-on-surface-variant hover:text-error hover:bg-error-container/40 transition-colors" title="Hapus Produk">
                                                <span class="material-symbols-outlined text-[20px]">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-on-surface-variant">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        <span class="material-symbols-outlined text-4xl text-outline-variant">inventory_2</span>
                                        <p class="font-medium">Tidak ada produk daur ulang ditemukan.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($products->hasPages())
                <div class="p-4 border-t border-outline-variant bg-surface flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-xs text-on-surface-variant">
                        Menampilkan {{ $products->firstItem() }}-{{ $products->lastItem() }} dari {{ $products->total() }} produk
                    </p>
                    <div class="flex items-center gap-1">
                        {{ $products->links('pagination::tailwind') }}
                    </div>
                </div>
                @endif
            </div>

            <!-- Slide-over Overlay for Add/Edit -->
            <div x-show="open" 
                 class="fixed inset-0 z-50 overflow-hidden" 
                 style="display: none;">
                <div class="absolute inset-0 overflow-hidden">
                    <!-- Overlay backdrop -->
                    <div x-show="open" 
                         x-transition:enter="ease-in-out duration-300"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="ease-in-out duration-300"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         @click="open = false"
                         class="absolute inset-0 bg-on-background/40 backdrop-blur-sm transition-opacity"></div>

                    <!-- Slide-over Container -->
                    <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                        <div x-show="open" 
                             x-transition:enter="transform transition ease-in-out duration-300"
                             x-transition:enter-start="translate-x-full"
                             x-transition:enter-end="translate-x-0"
                             x-transition:leave="transform transition ease-in-out duration-300"
                             x-transition:leave-start="translate-x-0"
                             x-transition:leave-end="translate-x-full"
                             class="pointer-events-auto w-screen max-w-md">
                            
                            <form :action="actionUrl" method="POST" enctype="multipart/form-data" class="flex h-full flex-col bg-surface shadow-2xl">
                                @csrf
                                <input type="hidden" name="_method" :value="editMode ? 'PUT' : 'POST'">
                                
                                <!-- Header -->
                                <div class="px-6 py-5 border-b border-outline-variant bg-surface-container-lowest flex items-center justify-between">
                                    <h2 class="text-lg font-bold text-on-surface" x-text="editMode ? 'Edit Produk' : 'Tambah Produk Baru'"></h2>
                                    <button type="button" class="text-on-surface-variant hover:text-on-surface p-2 rounded-full hover:bg-surface-container-low transition-colors" @click="open = false">
                                        <span class="material-symbols-outlined">close</span>
                                    </button>
                                </div>

                                <!-- Form Content -->
                                <div class="flex-1 overflow-y-auto p-6 space-y-5">
                                    
                                    <!-- Image Upload -->
                                    <div>
                                        <label class="block text-label-md text-on-surface mb-2">Foto Utama Produk</label>
                                        <div @click="$refs.imageFile.click()" class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-outline-variant border-dashed rounded-xl hover:border-primary hover:bg-surface-container-low transition-colors cursor-pointer group relative overflow-hidden h-40 items-center">
                                            <input type="file" name="image" x-ref="imageFile" class="hidden" accept="image/*"
                                                   @change="
                                                       const file = $event.target.files[0];
                                                       if (file) {
                                                           const reader = new FileReader();
                                                           reader.onload = (e) => { imagePreview = e.target.result; };
                                                           reader.readAsDataURL(file);
                                                       }
                                                   ">
                                            
                                            <!-- Preview State -->
                                            <template x-if="imagePreview">
                                                <div class="absolute inset-0 w-full h-full bg-surface-variant">
                                                    <img :src="imagePreview" class="w-full h-full object-cover"/>
                                                    <div class="absolute inset-0 bg-black/40 opacity-0 hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-semibold gap-1">
                                                        <span class="material-symbols-outlined">edit</span> Ubah Foto
                                                    </div>
                                                </div>
                                            </template>
                                            
                                            <!-- Empty State -->
                                            <template x-if="!imagePreview">
                                                <div class="space-y-1 text-center">
                                                    <span class="material-symbols-outlined text-4xl text-on-surface-variant group-hover:text-primary transition-colors">add_photo_alternate</span>
                                                    <div class="flex text-sm text-on-surface-variant justify-center mt-2 font-medium">
                                                        <span class="text-primary">Unggah file</span>
                                                        <p class="pl-1">atau drag and drop</p>
                                                    </div>
                                                    <p class="text-xs text-on-surface-variant mt-1">PNG, JPG up to 5MB</p>
                                                </div>
                                            </template>
                                        </div>
                                    </div>

                                    <!-- Nama Produk -->
                                    <div>
                                        <label class="block text-label-md text-on-surface mb-1" for="product_name">Nama Produk</label>
                                        <input class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2 text-sm text-on-surface focus:border-primary focus:ring-1 focus:ring-primary transition-all outline-none" 
                                               id="product_name" name="name" x-model="name" placeholder="Misal: Tas Anyaman Kopi" type="text" required/>
                                    </div>

                                    <!-- Kategori & Harga Grid -->
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-label-md text-on-surface mb-1" for="category_select">Kategori</label>
                                            <select class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2 text-sm text-on-surface focus:border-primary focus:ring-1 focus:ring-primary transition-all outline-none" 
                                                    id="category_select" name="category_id" x-model="category_id" required>
                                                <option value="" disabled>Pilih Kategori</option>
                                                @foreach($categories as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-label-md text-on-surface mb-1" for="price_input">Harga (Rp)</label>
                                            <input class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2 text-sm text-on-surface focus:border-primary focus:ring-1 focus:ring-primary transition-all outline-none" 
                                                   id="price_input" name="price" x-model="price" placeholder="0" type="number" min="0" required/>
                                        </div>
                                    </div>

                                    <!-- Stok & Publish Status -->
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-label-md text-on-surface mb-1" for="stock_input">Stok Awal</label>
                                            <input class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2 text-sm text-on-surface focus:border-primary focus:ring-1 focus:ring-primary transition-all outline-none" 
                                                   id="stock_input" name="stock" x-model="stock" placeholder="0" type="number" min="0" required/>
                                        </div>
                                        <div class="flex items-center pt-6 pl-2">
                                            <label class="relative flex items-center gap-2 cursor-pointer select-none">
                                                <input type="checkbox" name="is_published" x-model="is_published" class="rounded border-outline-variant text-primary focus:ring-primary w-5 h-5"/>
                                                <span class="text-sm font-semibold text-on-surface">Publish Publik</span>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Pengrajin Info -->
                                    <div class="bg-surface-container-low p-4 rounded-xl border border-outline-variant space-y-4">
                                        <h3 class="text-xs font-bold text-on-surface uppercase tracking-wider">Informasi Pengrajin Warga</h3>
                                        
                                        <div>
                                            <label class="block text-xs font-semibold text-on-surface mb-1" for="seller_name">Nama Lengkap</label>
                                            <input class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-3 py-1.5 text-xs text-on-surface focus:border-primary focus:ring-1 focus:ring-primary transition-all outline-none" 
                                                   id="seller_name" name="seller_name" x-model="seller_name" placeholder="Nama warga pembuat produk" type="text" required/>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-on-surface mb-1" for="seller_phone">No. WhatsApp</label>
                                            <input class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-3 py-1.5 text-xs text-on-surface focus:border-primary focus:ring-1 focus:ring-primary transition-all outline-none" 
                                                   id="seller_phone" name="seller_phone" x-model="seller_phone" placeholder="Contoh: 628123456789" type="text" required/>
                                            <p class="text-[10px] text-on-surface-variant mt-1">Harus diawali kode negara tanpa tanda +, contoh: 6281234...</p>
                                        </div>
                                    </div>

                                    <!-- Deskripsi -->
                                    <div>
                                        <label class="block text-label-md text-on-surface mb-1" for="description_input">Deskripsi Singkat</label>
                                        <textarea class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2 text-sm text-on-surface focus:border-primary focus:ring-1 focus:ring-primary transition-all outline-none resize-none" 
                                                  id="description_input" name="description" x-model="description" placeholder="Jelaskan bahan daur ulang yang digunakan dan manfaat produk..." rows="4" required></textarea>
                                    </div>
                                </div>

                                <!-- Footer Actions -->
                                <div class="p-6 border-t border-outline-variant bg-surface-container-lowest flex justify-end gap-3">
                                    <button type="button" class="px-5 py-2.5 rounded-lg border border-outline-variant text-on-surface text-label-md font-medium hover:bg-surface-container-low transition-colors" @click="open = false">
                                        Batal
                                    </button>
                                    <button type="submit" class="px-5 py-2.5 rounded-lg bg-primary text-on-primary text-label-md font-medium hover:bg-primary-container hover:text-on-primary-container transition-colors shadow-sm" x-text="editMode ? 'Simpan Perubahan' : 'Simpan Produk'"></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</x-admin-layout>
