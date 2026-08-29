<x-admin-layout>
    <x-slot name="pageTitle">Pengaturan Profil & Sistem Desa</x-slot>

    <div x-data="{ 
        activeTab: '{{ request('tab', 'general') }}',
        logoPreview: '{{ $settings['logo_desa'] ? Storage::url($settings['logo_desa']) : null }}',
        showCurrentPass: false,
        showNewPass: false,
        showConfirmPass: false
    }" class="p-6 lg:p-8">
        <div class="max-w-[850px] mx-auto space-y-6">

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
            <div>
                <h1 class="text-headline-lg font-bold text-on-surface mb-1">Pengaturan Profil & Sistem Desa</h1>
                <p class="text-body-md text-on-surface-variant">Kelola informasi desa, nomor WhatsApp kontak pemesanan, dan profil akun administrator.</p>
            </div>

            <!-- Tab Navigation Card -->
            <div class="bg-surface-container-lowest rounded-2xl shadow-sm overflow-hidden border border-outline-variant">
                <div class="flex overflow-x-auto border-b border-outline-variant bg-surface-container-low/50">
                    <button type="button" @click="activeTab = 'general'" 
                            :class="activeTab === 'general' ? 'text-primary border-b-2 border-primary font-bold bg-surface-container-lowest' : 'text-on-surface-variant hover:text-primary hover:bg-surface-container-low'"
                            class="px-6 py-3.5 text-sm font-medium whitespace-nowrap transition-colors outline-none flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">storefront</span>
                        <span>Informasi Umum Desa</span>
                    </button>
                    <button type="button" @click="activeTab = 'contact'" 
                            :class="activeTab === 'contact' ? 'text-primary border-b-2 border-primary font-bold bg-surface-container-lowest' : 'text-on-surface-variant hover:text-primary hover:bg-surface-container-low'"
                            class="px-6 py-3.5 text-sm font-medium whitespace-nowrap transition-colors outline-none flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">phone_iphone</span>
                        <span>Integrasi WhatsApp & Kontak</span>
                    </button>
                    <button type="button" @click="activeTab = 'security'" 
                            :class="activeTab === 'security' ? 'text-primary border-b-2 border-primary font-bold bg-surface-container-lowest' : 'text-on-surface-variant hover:text-primary hover:bg-surface-container-low'"
                            class="px-6 py-3.5 text-sm font-medium whitespace-nowrap transition-colors outline-none flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">manage_accounts</span>
                        <span>Profil Akun & Kata Sandi</span>
                    </button>
                </div>

                <!-- Form Content -->
                <div class="p-6 sm:p-8">

                    <!-- TAB 1 & TAB 2: INFORMASI DESA & KONTAK -->
                    <div x-show="activeTab === 'general' || activeTab === 'contact'">
                        <form action="{{ route('admin.pengaturan.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf

                            <!-- TAB 1: INFORMASI UMUM -->
                            <div x-show="activeTab === 'general'" class="space-y-5">
                                <!-- Nama Sistem -->
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1" for="nama_sistem">Nama Sistem / Website</label>
                                    <input class="w-full bg-surface-container-low border border-outline-variant rounded-xl px-4 py-2.5 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors" 
                                           id="nama_sistem" name="nama_sistem" type="text" value="{{ old('nama_sistem', $settings['nama_sistem']) }}" required/>
                                </div>

                                <!-- Logo Desa -->
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">Logo Desa / Inisiatif</label>
                                    <div class="flex items-start gap-4">
                                        <!-- Preview -->
                                        <div class="w-24 h-24 rounded-xl border border-outline-variant bg-surface-container flex items-center justify-center shrink-0 overflow-hidden relative">
                                            <template x-if="logoPreview">
                                                <img :src="logoPreview" class="w-full h-full object-contain p-1"/>
                                            </template>
                                            <template x-if="!logoPreview">
                                                <div class="flex flex-col items-center justify-center text-outline text-xs">
                                                    <span class="material-symbols-outlined text-3xl">image</span>
                                                    <span>Belum ada</span>
                                                </div>
                                            </template>
                                        </div>
                                        <!-- Upload Area -->
                                        <div @click="$refs.logoInput.click()" class="flex-1 border-2 border-dashed border-outline-variant rounded-xl p-4 text-center hover:border-primary hover:bg-surface-container-low transition-colors cursor-pointer group flex flex-col items-center justify-center">
                                            <input type="file" name="logo_desa" x-ref="logoInput" class="hidden" accept="image/*"
                                                   @change="
                                                       const file = $event.target.files[0];
                                                       if (file) {
                                                           const reader = new FileReader();
                                                           reader.onload = (e) => { logoPreview = e.target.result; };
                                                           reader.readAsDataURL(file);
                                                       }
                                                   ">
                                            <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary mb-1">upload_file</span>
                                            <p class="text-xs font-medium text-on-surface-variant group-hover:text-primary">Klik untuk mengunggah atau seret file ke sini</p>
                                            <p class="text-[10px] text-outline mt-0.5">PNG, JPG up to 2MB. Dimensi disarankan 512x512px.</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Deskripsi Singkat -->
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1" for="deskripsi">Deskripsi Singkat Desa / Visi Daur Ulang</label>
                                    <textarea class="w-full bg-surface-container-low border border-outline-variant rounded-xl px-4 py-2.5 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors resize-none" 
                                              id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $settings['deskripsi']) }}</textarea>
                                </div>
                            </div>

                            <!-- TAB 2: INTEGRASI WHATSAPP & KONTAK -->
                            <div x-show="activeTab === 'contact'" style="display: none;" class="space-y-5">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- WhatsApp -->
                                    <div>
                                        <label class="block text-xs font-semibold text-on-surface mb-1" for="wa_utama">Nomor WhatsApp Utama BUMDes</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-on-surface-variant">
                                                <span class="material-symbols-outlined text-lg">phone_iphone</span>
                                            </div>
                                            <input class="w-full bg-surface-container-low border border-outline-variant rounded-xl pl-10 pr-4 py-2.5 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors" 
                                                   id="wa_utama" name="wa_utama" type="text" value="{{ old('wa_utama', $settings['wa_utama']) }}" placeholder="0895337067978"/>
                                        </div>
                                        <p class="text-[11px] text-outline mt-1">Pesan dari form kontak publik otomatis diteruskan ke nomor ini.</p>
                                    </div>
                                    <!-- Email -->
                                    <div>
                                        <label class="block text-xs font-semibold text-on-surface mb-1" for="email_pengelola">Email Pengelola Desa</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-on-surface-variant">
                                                <span class="material-symbols-outlined text-lg">mail</span>
                                            </div>
                                            <input class="w-full bg-surface-container-low border border-outline-variant rounded-xl pl-10 pr-4 py-2.5 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors" 
                                                   id="email_pengelola" name="email_pengelola" type="email" value="{{ old('email_pengelola', $settings['email_pengelola']) }}"/>
                                        </div>
                                    </div>
                                </div>

                                <!-- Alamat -->
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1" for="alamat">Alamat Kantor Desa</label>
                                    <textarea class="w-full bg-surface-container-low border border-outline-variant rounded-xl px-4 py-2.5 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors resize-none" 
                                              id="alamat" name="alamat" rows="2">{{ old('alamat', $settings['alamat']) }}</textarea>
                                </div>

                                <!-- Jam Operasional -->
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1" for="jam_operasional">Jam Operasional Pelayanan</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-on-surface-variant">
                                            <span class="material-symbols-outlined text-lg">schedule</span>
                                        </div>
                                        <input class="w-full bg-surface-container-low border border-outline-variant rounded-xl pl-10 pr-4 py-2.5 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors" 
                                               id="jam_operasional" name="jam_operasional" type="text" value="{{ old('jam_operasional', $settings['jam_operasional']) }}"/>
                                    </div>
                                </div>
                            </div>

                            <!-- Buttons for General & Contact -->
                            <div class="flex justify-end gap-3 pt-3 border-t border-outline-variant/50">
                                <a href="{{ route('admin.dashboard') }}" class="px-5 py-2.5 text-xs font-semibold text-on-surface-variant bg-transparent border border-outline-variant rounded-xl hover:bg-surface-container-low transition-colors">
                                    Batal
                                </a>
                                <button type="submit" class="px-6 py-2.5 text-xs font-semibold text-on-primary bg-primary hover:bg-primary-container hover:text-on-primary-container rounded-xl shadow-sm transition-all flex items-center gap-2">
                                    <span class="material-symbols-outlined text-base">save</span>
                                    Simpan Pengaturan
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- TAB 3: PROFIL AKUN & KATA SANDI -->
                    <div x-show="activeTab === 'security'" style="display: none;">
                        <form action="{{ route('admin.profil.update') }}" method="POST" class="space-y-6">
                            @csrf

                            <!-- Info Box -->
                            <div class="bg-primary/5 p-4 rounded-xl border border-primary/20 flex items-start gap-3">
                                <span class="material-symbols-outlined text-primary text-2xl shrink-0">account_circle</span>
                                <div>
                                    <h3 class="text-xs font-bold text-on-surface">Kelola Akun Administrator</h3>
                                    <p class="text-xs text-on-surface-variant mt-0.5">Ubah nama pengguna, alamat email untuk login ke dashboard admin, serta perbarui kata sandi secara berkala.</p>
                                </div>
                            </div>

                            <!-- Biodata Akun -->
                            <div class="space-y-4">
                                <h4 class="text-xs font-bold text-primary uppercase tracking-wider">Informasi Akun</h4>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Nama -->
                                    <div>
                                        <label class="block text-xs font-semibold text-on-surface mb-1" for="admin_name">Nama Administrator</label>
                                        <div class="relative">
                                            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-on-surface-variant text-base">person</span>
                                            <input class="w-full bg-surface-container-low border border-outline-variant rounded-xl pl-10 pr-4 py-2.5 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors" 
                                                   id="admin_name" name="name" type="text" value="{{ old('name', auth()->user()->name ?? 'Administrator') }}" required/>
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div>
                                        <label class="block text-xs font-semibold text-on-surface mb-1" for="admin_email">Email Login</label>
                                        <div class="relative">
                                            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-on-surface-variant text-base">mail</span>
                                            <input class="w-full bg-surface-container-low border border-outline-variant rounded-xl pl-10 pr-4 py-2.5 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors" 
                                                   id="admin_email" name="email" type="email" value="{{ old('email', auth()->user()->email ?? 'admin@ciawiasih.desa.id') }}" required/>
                                        </div>
                                    </div>
                                </div>

                                <!-- No HP -->
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1" for="admin_phone">Nomor HP / WhatsApp Administrator (Opsional)</label>
                                    <div class="relative">
                                        <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-on-surface-variant text-base">call</span>
                                        <input class="w-full bg-surface-container-low border border-outline-variant rounded-xl pl-10 pr-4 py-2.5 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors" 
                                               id="admin_phone" name="phone_number" type="text" value="{{ old('phone_number', auth()->user()->phone_number ?? '') }}" placeholder="08xxxxxxxxxx"/>
                                    </div>
                                </div>
                            </div>

                            <!-- Ganti Password -->
                            <div class="space-y-4 pt-4 border-t border-outline-variant/40">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-xs font-bold text-primary uppercase tracking-wider">Ubah Kata Sandi (Opsional)</h4>
                                    <span class="text-[11px] text-outline">Kosongkan jika tidak ingin mengubah password</span>
                                </div>

                                <!-- Password Saat Ini -->
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1" for="current_password">Kata Sandi Saat Ini</label>
                                    <div class="relative">
                                        <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-on-surface-variant text-base">lock</span>
                                        <input :type="showCurrentPass ? 'text' : 'password'" 
                                               class="w-full bg-surface-container-low border border-outline-variant rounded-xl pl-10 pr-11 py-2.5 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors" 
                                               id="current_password" name="current_password" placeholder="Masukkan kata sandi lama Anda"/>
                                        <button type="button" @click="showCurrentPass = !showCurrentPass" 
                                                class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-primary p-1">
                                            <span class="material-symbols-outlined text-[18px]" x-text="showCurrentPass ? 'visibility_off' : 'visibility'"></span>
                                        </button>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Password Baru -->
                                    <div>
                                        <label class="block text-xs font-semibold text-on-surface mb-1" for="new_password">Kata Sandi Baru</label>
                                        <div class="relative">
                                            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-on-surface-variant text-base">key</span>
                                            <input :type="showNewPass ? 'text' : 'password'" 
                                                   class="w-full bg-surface-container-low border border-outline-variant rounded-xl pl-10 pr-11 py-2.5 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors" 
                                                   id="new_password" name="new_password" placeholder="Minimal 6 karakter"/>
                                            <button type="button" @click="showNewPass = !showNewPass" 
                                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-primary p-1">
                                                <span class="material-symbols-outlined text-[18px]" x-text="showNewPass ? 'visibility_off' : 'visibility'"></span>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Konfirmasi Password Baru -->
                                    <div>
                                        <label class="block text-xs font-semibold text-on-surface mb-1" for="new_password_confirmation">Konfirmasi Kata Sandi Baru</label>
                                        <div class="relative">
                                            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-on-surface-variant text-base">key</span>
                                            <input :type="showConfirmPass ? 'text' : 'password'" 
                                                   class="w-full bg-surface-container-low border border-outline-variant rounded-xl pl-10 pr-11 py-2.5 text-on-surface text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors" 
                                                   id="new_password_confirmation" name="new_password_confirmation" placeholder="Ulangi kata sandi baru"/>
                                            <button type="button" @click="showConfirmPass = !showConfirmPass" 
                                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-primary p-1">
                                                <span class="material-symbols-outlined text-[18px]" x-text="showConfirmPass ? 'visibility_off' : 'visibility'"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Buttons for Security Profile -->
                            <div class="flex justify-end gap-3 pt-3 border-t border-outline-variant/50">
                                <a href="{{ route('admin.dashboard') }}" class="px-5 py-2.5 text-xs font-semibold text-on-surface-variant bg-transparent border border-outline-variant rounded-xl hover:bg-surface-container-low transition-colors">
                                    Batal
                                </a>
                                <button type="submit" class="px-6 py-2.5 text-xs font-semibold text-on-primary bg-primary hover:bg-primary-container hover:text-on-primary-container rounded-xl shadow-sm transition-all flex items-center gap-2">
                                    <span class="material-symbols-outlined text-base">verified_user</span>
                                    Perbarui Profil & Sandi
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-admin-layout>
