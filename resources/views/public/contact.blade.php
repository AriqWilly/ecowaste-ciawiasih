<x-public-layout>
    <!-- Hero Section -->
    <section class="bg-surface-container-low py-16 px-4 md:px-8">
        <div class="max-w-[1200px] mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-primary mb-4">Hubungi Kami</h1>
            <p class="text-lg text-on-surface-variant max-w-2xl mx-auto">
                Punya pertanyaan seputar produk daur ulang atau ingin menyetor sampah terpilah? Hubungi tim kami.
            </p>
        </div>
    </section>

    <!-- Contact Split Section -->
    <section class="py-16 px-4 md:px-8">
        <div class="max-w-[1200px] mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Left Column: Info & Map -->
            <div class="flex flex-col gap-8">
                <div class="bg-surface p-8 rounded-xl shadow-sm border border-surface-container-highest">
                    <div class="flex items-start gap-4 mb-6">
                        <span class="material-symbols-outlined text-primary text-3xl">location_on</span>
                        <div>
                            <h3 class="text-xl font-semibold mb-2">Alamat</h3>
                            <p class="text-base text-on-surface-variant">{{ \App\Models\Setting::get('alamat', 'Kantor Desa Ciawiasih, Kecamatan Susukan Lebak, Kabupaten Cirebon.') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 mb-6">
                        <span class="material-symbols-outlined text-primary text-3xl">call</span>
                        <div>
                            <h3 class="text-xl font-semibold mb-2">WhatsApp</h3>
                            <p class="text-base text-on-surface-variant">{{ \App\Models\Setting::get('wa_utama', '+62 812 3456 7890') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 mb-6">
                        <span class="material-symbols-outlined text-primary text-3xl">mail</span>
                        <div>
                            <h3 class="text-xl font-semibold mb-2">Email</h3>
                            <p class="text-base text-on-surface-variant">{{ \App\Models\Setting::get('email_pengelola', 'info@ciawiasihdaurulang.id') }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-surface p-8 rounded-xl shadow-sm border border-surface-container-highest">
                    <div class="flex items-center gap-4">
                        <span class="material-symbols-outlined text-primary text-3xl">schedule</span>
                        <div>
                            <h3 class="text-xl font-semibold mb-2">Jam Operasional</h3>
                            <p class="text-base text-on-surface-variant font-medium">{{ \App\Models\Setting::get('jam_operasional', 'Senin - Sabtu: 08.00 - 15.00 WIB') }}</p>
                        </div>
                    </div>
                </div>
                <!-- Map Embed -->
                <div class="rounded-xl overflow-hidden shadow-sm h-64 relative bg-surface-container-low border border-surface-container-highest">
                    <iframe 
                        class="w-full h-full border-0" 
                        src="https://maps.google.com/maps?q=Desa%20Ciawiasih,%20Susukan%20Lebak,%20Cirebon&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
            </div>
            <!-- Right Column: Contact Form -->
            <div class="bg-surface p-8 rounded-xl shadow-sm border border-surface-container-highest">
                <h2 class="text-2xl font-bold mb-2 text-on-surface">Kirim Pesan</h2>
                <p class="text-xs text-on-surface-variant mb-6">Pesan Anda akan otomatis tersimpan dan diteruskan langsung ke WhatsApp Pengelola BUMDes.</p>

                @if($errors->any())
                <div class="mb-5 bg-error-container text-on-error-container p-3.5 rounded-xl text-xs flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">error</span>
                    <span>{{ $errors->first() }}</span>
                </div>
                @endif

                <form method="POST" action="{{ route('contact.send') }}" class="flex flex-col gap-5">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-on-surface mb-1.5" for="nama">Nama Lengkap</label>
                        <input class="w-full bg-surface-container-low border border-surface-container-highest rounded-lg px-4 py-2.5 text-sm text-on-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" 
                               id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap anda" type="text" required/>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-on-surface mb-1.5" for="whatsapp">Nomor WhatsApp Anda</label>
                        <input class="w-full bg-surface-container-low border border-surface-container-highest rounded-lg px-4 py-2.5 text-sm text-on-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" 
                               id="whatsapp" name="whatsapp" value="{{ old('whatsapp') }}" placeholder="Contoh: 081234567890" type="tel" required/>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-on-surface mb-1.5" for="subjek">Subjek / Topik Pesan</label>
                        <input class="w-full bg-surface-container-low border border-surface-container-highest rounded-lg px-4 py-2.5 text-sm text-on-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" 
                               id="subjek" name="subjek" value="{{ old('subjek') }}" placeholder="Contoh: Tanya Beli Produk Kerajinan / Setor Sampah" type="text" required/>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-on-surface mb-1.5" for="pesan">Isi Pesan / Pertanyaan</label>
                        <textarea class="w-full bg-surface-container-low border border-surface-container-highest rounded-lg px-4 py-2.5 text-sm text-on-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all resize-none" 
                                  id="pesan" name="pesan" placeholder="Tuliskan pesan atau pertanyaan anda secara detail..." rows="4" required>{{ old('pesan') }}</textarea>
                    </div>

                    <!-- Anti-Bot Math Captcha -->
                    <div class="bg-surface-container-low p-3.5 rounded-xl border border-surface-container-highest">
                        <label class="block text-xs font-semibold text-on-surface mb-2 flex items-center justify-between" for="captcha">
                            <span class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-primary text-base">verified_user</span>
                                Verifikasi Keamanan (Anti-Spam)
                            </span>
                            <span class="text-[11px] text-on-surface-variant">Berapa hasil: <strong class="bg-primary/10 text-primary px-2 py-0.5 rounded font-mono font-bold text-xs">{{ $captchaQuestion ?? '3 + 4' }}</strong> ?</span>
                        </label>
                        <input class="w-full bg-white border border-surface-container-highest rounded-lg px-4 py-2 text-sm text-on-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" 
                               id="captcha" name="captcha" placeholder="Ketik hasil penjumlahan angka..." type="number" required/>
                    </div>

                    <button class="bg-primary hover:bg-primary-container text-on-primary hover:text-on-primary-container font-semibold py-3 rounded-lg transition-all w-full mt-1 flex items-center justify-center gap-2 shadow-sm" type="submit">
                        <span class="material-symbols-outlined text-xl">send</span>
                        <span>Kirim Pesan & Hubungi WhatsApp</span>
                    </button>
                </form>
            </div>
        </div>
    </section>
</x-public-layout>
