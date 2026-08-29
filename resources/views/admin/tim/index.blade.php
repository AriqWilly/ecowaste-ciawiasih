<x-admin-layout>
    <x-slot name="pageTitle">Kelola Pengurus & Mitra</x-slot>

    <div x-data="{ 
        openModal: false, 
        editMode: false,
        actionUrl: '',
        memberId: '',
        name: '',
        role: '',
        type: 'pengurus',
        description: '',
        order: 0,
        is_active: true,
        photoPreview: null,
        
        openCreate() {
            this.editMode = false;
            this.actionUrl = '{{ route('admin.tim.store') }}';
            this.memberId = '';
            this.name = '';
            this.role = '';
            this.type = 'pengurus';
            this.description = '';
            this.order = 0;
            this.is_active = true;
            this.photoPreview = null;
            this.openModal = true;
        },
        
        openEdit(member) {
            this.editMode = true;
            this.actionUrl = '{{ url('admin/tim') }}/' + member.id;
            this.memberId = member.id;
            this.name = member.name;
            this.role = member.role;
            this.type = member.type;
            this.description = member.description;
            this.order = member.order;
            this.is_active = !!member.is_active;
            this.photoPreview = member.photo_url;
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
                    <h1 class="text-headline-lg font-bold text-on-surface">Kelola Pengurus & Mitra Desa</h1>
                    <p class="text-body-md text-on-surface-variant mt-1">Kelola data profil tim pengelola desa dan mitra pendukung daur ulang desa yang tampil di halaman Tentang Kami.</p>
                </div>
                <button @click="openCreate()" class="bg-primary hover:bg-primary-container text-on-primary hover:text-on-primary-container px-6 py-3 rounded-lg text-label-md font-semibold flex items-center justify-center gap-2 shadow-sm transition-colors shrink-0">
                    <span class="material-symbols-outlined text-sm">add</span>
                    Tambah Profil Baru
                </button>
            </div>

            <!-- Filters -->
            <div class="bg-surface-container-lowest p-4 rounded-xl shadow-sm border border-outline-variant flex flex-col md:flex-row gap-4 items-center justify-between">
                <form method="GET" action="{{ route('admin.tim.index') }}" class="relative w-full md:w-96">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-sm">search</span>
                    <input type="text" name="search" value="{{ request('search') }}"
                           class="w-full pl-10 pr-4 py-2 rounded-lg bg-surface-container-low border border-outline-variant focus:ring-1 focus:ring-primary focus:border-primary text-sm outline-none transition-all" 
                           placeholder="Cari nama atau jabatan..."/>
                    @if(request('type'))
                        <input type="hidden" name="type" value="{{ request('type') }}"/>
                    @endif
                </form>

                <div class="flex space-x-2 overflow-x-auto w-full md:w-auto pb-2 md:pb-0 hide-scrollbar">
                    <a href="{{ route('admin.tim.index', request()->only('search')) }}" 
                       class="px-4 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap transition-colors
                              {{ !request('type') ? 'bg-primary-container text-on-primary-container border border-primary/20' : 'border border-outline-variant text-on-surface-variant hover:bg-surface-container-low' }}">
                        Semua
                    </a>
                    <a href="{{ route('admin.tim.index', array_merge(request()->only('search'), ['type' => 'pengurus'])) }}" 
                       class="px-4 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap transition-colors
                              {{ request('type') === 'pengurus' ? 'bg-primary-container text-on-primary-container border border-primary/20' : 'border border-outline-variant text-on-surface-variant hover:bg-surface-container-low' }}">
                        Pengurus Desa
                    </a>
                    <a href="{{ route('admin.tim.index', array_merge(request()->only('search'), ['type' => 'mitra'])) }}" 
                       class="px-4 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap transition-colors
                              {{ request('type') === 'mitra' ? 'bg-primary-container text-on-primary-container border border-primary/20' : 'border border-outline-variant text-on-surface-variant hover:bg-surface-container-low' }}">
                        Mitra / Pengrajin
                    </a>
                </div>
            </div>

            <!-- Table / Cards -->
            <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-surface-container-low border-b border-outline-variant">
                            <tr>
                                <th class="py-3 px-4 text-xs font-semibold text-on-surface-variant w-16">Foto</th>
                                <th class="py-3 px-4 text-xs font-semibold text-on-surface-variant">Nama Lengkap</th>
                                <th class="py-3 px-4 text-xs font-semibold text-on-surface-variant">Jabatan / Peran</th>
                                <th class="py-3 px-4 text-xs font-semibold text-on-surface-variant">Kategori</th>
                                <th class="py-3 px-4 text-xs font-semibold text-on-surface-variant text-center">Urutan</th>
                                <th class="py-3 px-4 text-xs font-semibold text-on-surface-variant">Status</th>
                                <th class="py-3 px-4 text-xs font-semibold text-on-surface-variant text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant text-sm">
                            @forelse($members as $member)
                            <tr class="hover:bg-surface-container-low/50 transition-colors group">
                                <td class="py-3 px-4">
                                    <div class="w-12 h-12 rounded-full bg-surface-variant overflow-hidden shrink-0 border border-outline-variant flex items-center justify-center">
                                        <img class="w-full h-full object-cover" 
                                             src="{{ $member->photo_url }}" 
                                             alt="{{ $member->name }}"/>
                                    </div>
                                </td>
                                <td class="py-3 px-4 font-semibold text-on-surface">
                                    {{ $member->name }}
                                </td>
                                <td class="py-3 px-4 text-xs text-on-surface-variant font-medium">
                                    {{ $member->role }}
                                </td>
                                <td class="py-3 px-4">
                                    @if($member->type === 'pengurus')
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-primary-container/20 text-primary text-xs font-semibold">
                                            Pengurus
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-secondary-container/30 text-secondary text-xs font-semibold">
                                            Mitra
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-center text-xs text-on-surface-variant">
                                    {{ $member->order }}
                                </td>
                                <td class="py-3 px-4">
                                    @if($member->is_active)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-primary-container text-on-primary-container text-[11px] font-semibold">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-surface-container-highest text-on-surface-variant text-[11px] font-semibold">
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <button @click="openEdit(@js([
                                            'id' => $member->id,
                                            'name' => $member->name,
                                            'role' => $member->role,
                                            'type' => $member->type,
                                            'description' => $member->description ?? '',
                                            'order' => $member->order,
                                            'is_active' => (bool) $member->is_active,
                                            'photo_url' => $member->photo_path ? Storage::url($member->photo_path) : null
                                        ]))" class="p-1.5 rounded-lg text-on-surface-variant hover:text-primary hover:bg-primary-container/20 transition-colors" title="Edit Profil">
                                            <span class="material-symbols-outlined text-[20px]">edit</span>
                                        </button>
                                        <form method="POST" action="{{ route('admin.tim.destroy', $member->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data profil ini?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 rounded-lg text-on-surface-variant hover:text-error hover:bg-error-container/40 transition-colors" title="Hapus Profil">
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
                                        <span class="material-symbols-outlined text-4xl text-outline-variant">group</span>
                                        <p class="font-medium">Belum ada data pengurus atau mitra desa.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($members->hasPages())
                <div class="p-4 border-t border-outline-variant bg-surface flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-xs text-on-surface-variant">
                        Menampilkan {{ $members->firstItem() }}-{{ $members->lastItem() }} dari {{ $members->total() }} data
                    </p>
                    <div class="flex items-center gap-1">
                        {{ $members->links('pagination::tailwind') }}
                    </div>
                </div>
                @endif
            </div>

            <!-- Modal: Tambah/Edit Anggota Tim -->
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
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="relative bg-surface rounded-xl shadow-2xl w-full max-w-lg z-10 border border-outline-variant overflow-hidden">
                    
                    <form :action="actionUrl" method="POST" enctype="multipart/form-data" class="flex flex-col">
                        @csrf
                        <input type="hidden" name="_method" :value="editMode ? 'PUT' : 'POST'">
                        
                        <!-- Header -->
                        <div class="flex items-center justify-between p-6 border-b border-outline-variant bg-surface-container-lowest">
                            <h2 class="text-lg font-bold text-on-surface" x-text="editMode ? 'Edit Profil Pengurus/Mitra' : 'Tambah Profil Baru'"></h2>
                            <button type="button" class="text-on-surface-variant hover:text-on-surface p-1.5 rounded-full hover:bg-surface-container-low transition-colors" @click="openModal = false">
                                <span class="material-symbols-outlined">close</span>
                            </button>
                        </div>

                        <!-- Form Content -->
                        <div class="p-6 space-y-4">
                            <!-- Foto Profil -->
                            <div>
                                <label class="block text-xs font-semibold text-on-surface mb-1">Foto Profil</label>
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 rounded-full border border-outline-variant bg-surface-container flex items-center justify-center shrink-0 overflow-hidden relative">
                                        <template x-if="photoPreview">
                                            <img :src="photoPreview" class="w-full h-full object-cover"/>
                                        </template>
                                        <template x-if="!photoPreview">
                                            <span class="material-symbols-outlined text-outline-variant text-3xl">person</span>
                                        </template>
                                    </div>
                                    <div @click="$refs.photoInput.click()" class="flex-1 border-2 border-dashed border-outline-variant rounded-lg p-3 text-center hover:border-primary hover:bg-surface-container-low transition-colors cursor-pointer group flex flex-col items-center justify-center">
                                        <input type="file" name="photo" x-ref="photoInput" class="hidden" accept="image/*"
                                               @change="
                                                   const file = $event.target.files[0];
                                                   if (file) {
                                                       const reader = new FileReader();
                                                       reader.onload = (e) => { photoPreview = e.target.result; };
                                                       reader.readAsDataURL(file);
                                                   }
                                               ">
                                        <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary text-xl">upload_file</span>
                                        <p class="text-xs font-medium text-on-surface-variant group-hover:text-primary">Unggah Foto</p>
                                        <p class="text-[10px] text-outline mt-0.5">JPG, PNG (Maks 2MB)</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Nama -->
                            <div>
                                <label class="block text-xs font-semibold text-on-surface mb-1">Nama Lengkap & Gelar</label>
                                <input type="text" name="name" x-model="name" required
                                       class="w-full px-4 py-2.5 rounded-lg bg-surface-container-low border border-outline-variant focus:ring-1 focus:ring-primary focus:border-primary text-sm text-on-surface outline-none transition-all" 
                                       placeholder="Contoh: H. Ahmad Supardi, S.Sos."/>
                            </div>

                            <!-- Jabatan & Kategori Grid -->
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">Jabatan / Peran</label>
                                    <input type="text" name="role" x-model="role" required
                                           class="w-full px-4 py-2.5 rounded-lg bg-surface-container-low border border-outline-variant focus:ring-1 focus:ring-primary focus:border-primary text-sm text-on-surface outline-none transition-all" 
                                           placeholder="Contoh: Direktur Desa Ciawiasih"/>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">Kategori Tim</label>
                                    <select name="type" x-model="type" required
                                            class="w-full px-4 py-2.5 rounded-lg bg-surface-container-low border border-outline-variant focus:ring-1 focus:ring-primary focus:border-primary text-sm text-on-surface outline-none transition-all">
                                        <option value="pengurus">Pengurus Desa</option>
                                        <option value="mitra">Mitra / Komunitas</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Urutan Tampilan & Status Aktif -->
                            <div class="grid grid-cols-2 gap-4 items-center">
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">Urutan Tampilan</label>
                                    <input type="number" name="order" x-model="order" min="0"
                                           class="w-full px-4 py-2.5 rounded-lg bg-surface-container-low border border-outline-variant focus:ring-1 focus:ring-primary focus:border-primary text-sm text-on-surface outline-none transition-all" 
                                           placeholder="0"/>
                                </div>
                                <div class="pt-5 pl-2">
                                    <label class="flex items-center gap-2 cursor-pointer select-none">
                                        <input type="checkbox" name="is_active" x-model="is_active" class="rounded border-outline-variant text-primary focus:ring-primary w-5 h-5"/>
                                        <span class="text-xs font-semibold text-on-surface">Tampilkan di Publik</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Deskripsi Singkat -->
                            <div>
                                <label class="block text-xs font-semibold text-on-surface mb-1">Keterangan / Deskripsi Singkat</label>
                                <textarea name="description" x-model="description" rows="2"
                                          class="w-full p-3 rounded-lg bg-surface-container-low border border-outline-variant focus:ring-1 focus:ring-primary focus:border-primary text-sm text-on-surface outline-none transition-all resize-none" 
                                          placeholder="Fokus tanggung jawab atau bidang kerja..."></textarea>
                            </div>
                        </div>

                        <!-- Footer Actions -->
                        <div class="p-6 border-t border-outline-variant bg-surface-container-lowest flex justify-end gap-3">
                            <button type="button" class="px-4 py-2 rounded-lg border border-outline-variant text-on-surface text-xs font-medium hover:bg-surface-container-low transition-colors" @click="openModal = false">
                                Batal
                            </button>
                            <button type="submit" class="px-5 py-2 rounded-lg bg-primary text-on-primary text-xs font-semibold hover:bg-primary-container hover:text-on-primary-container transition-colors shadow-sm" x-text="editMode ? 'Simpan Perubahan' : 'Simpan Profil'">
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>
