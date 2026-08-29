<x-admin-layout>
    <x-slot name="pageTitle">Pesan Masuk (Inbox)</x-slot>

    <div x-data="{ 
        openModal: false, 
        currentMessage: {
            id: '',
            name: '',
            phone: '',
            subject: '',
            message: '',
            created_at: '',
            is_read: false,
            wa_reply_url: ''
        },
        
        viewMessage(msg) {
            this.currentMessage = msg;
            
            // Clean sender phone number
            let cleanPhone = msg.phone.replace(/[^0-9]/g, '');
            if (cleanPhone.startsWith('0')) {
                cleanPhone = '62' + cleanPhone.substring(1);
            }
            
            let replyText = `Halo Bpk/Ibu *${msg.name}*, terima kasih telah menghubungi Tim Pengelola Daur Ulang Desa Ciawiasih mengenai *${msg.subject}*.\n\n`;
            this.currentMessage.wa_reply_url = `https://api.whatsapp.com/send?phone=${cleanPhone}&text=${encodeURIComponent(replyText)}`;
            
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

            <!-- Page Header -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h1 class="text-headline-lg font-bold text-on-surface flex items-center gap-3">
                        <span>Pesan Masuk (Inbox)</span>
                        @if($unreadCount > 0)
                        <span class="px-2.5 py-0.5 bg-error text-white rounded-full text-xs font-bold">{{ $unreadCount }} Pesan Baru</span>
                        @endif
                    </h1>
                    <p class="text-body-md text-on-surface-variant mt-1">Daftar pertanyaan dan pesan warga yang masuk melalui formulir kontak website desa.</p>
                </div>
            </div>

            <!-- Filters -->
            <div class="bg-surface-container-lowest p-4 rounded-xl shadow-sm border border-outline-variant flex flex-col md:flex-row gap-4 items-center justify-between">
                <form method="GET" action="{{ route('admin.pesan.index') }}" class="relative w-full md:w-96">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-sm">search</span>
                    <input type="text" name="search" value="{{ request('search') }}"
                           class="w-full pl-10 pr-4 py-2 rounded-lg bg-surface-container-low border border-outline-variant focus:ring-1 focus:ring-primary focus:border-primary text-sm outline-none transition-all" 
                           placeholder="Cari pengirim, no WA, atau pesan..."/>
                    @if(request('status'))
                        <input type="hidden" name="status" value="{{ request('status') }}"/>
                    @endif
                </form>

                <div class="flex space-x-2 overflow-x-auto w-full md:w-auto pb-2 md:pb-0 hide-scrollbar">
                    <a href="{{ route('admin.pesan.index', request()->only('search')) }}" 
                       class="px-4 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap transition-colors
                              {{ !request('status') ? 'bg-primary-container text-on-primary-container border border-primary/20' : 'border border-outline-variant text-on-surface-variant hover:bg-surface-container-low' }}">
                        Semua Pesan
                    </a>
                    <a href="{{ route('admin.pesan.index', array_merge(request()->only('search'), ['status' => 'unread'])) }}" 
                       class="px-4 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap transition-colors
                              {{ request('status') === 'unread' ? 'bg-primary-container text-on-primary-container border border-primary/20' : 'border border-outline-variant text-on-surface-variant hover:bg-surface-container-low' }}">
                        Belum Dibaca ({{ $unreadCount }})
                    </a>
                    <a href="{{ route('admin.pesan.index', array_merge(request()->only('search'), ['status' => 'read'])) }}" 
                       class="px-4 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap transition-colors
                              {{ request('status') === 'read' ? 'bg-primary-container text-on-primary-container border border-primary/20' : 'border border-outline-variant text-on-surface-variant hover:bg-surface-container-low' }}">
                        Sudah Dibaca
                    </a>
                </div>
            </div>

            <!-- Table -->
            <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-surface-container-low border-b border-outline-variant">
                            <tr>
                                <th class="py-3 px-4 text-xs font-semibold text-on-surface-variant">Pengirim & WhatsApp</th>
                                <th class="py-3 px-4 text-xs font-semibold text-on-surface-variant">Topik / Subjek</th>
                                <th class="py-3 px-4 text-xs font-semibold text-on-surface-variant">Isi Pesan</th>
                                <th class="py-3 px-4 text-xs font-semibold text-on-surface-variant">Waktu Masuk</th>
                                <th class="py-3 px-4 text-xs font-semibold text-on-surface-variant">Status</th>
                                <th class="py-3 px-4 text-xs font-semibold text-on-surface-variant text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant text-sm">
                            @forelse($messages as $msg)
                            <tr class="hover:bg-surface-container-low/50 transition-colors group {{ !$msg->is_read ? 'bg-primary-container/5 font-medium' : '' }}">
                                <td class="py-3.5 px-4">
                                    <div>
                                        <p class="font-semibold text-on-surface">{{ $msg->name }}</p>
                                        <p class="text-xs text-primary font-mono">{{ $msg->phone }}</p>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4 text-xs font-semibold text-on-surface">
                                    {{ $msg->subject }}
                                </td>
                                <td class="py-3.5 px-4 text-xs text-on-surface-variant max-w-xs truncate">
                                    {{ $msg->message }}
                                </td>
                                <td class="py-3.5 px-4 text-xs text-on-surface-variant whitespace-nowrap">
                                    {{ $msg->created_at->format('d M Y, H:i') }}
                                </td>
                                <td class="py-3.5 px-4">
                                    @if(!$msg->is_read)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-error/10 text-error text-[11px] font-bold">
                                            <span class="w-1.5 h-1.5 rounded-full bg-error mr-1.5"></span>
                                            Baru
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-surface-variant text-on-surface-variant text-[11px] font-semibold">
                                            Dibaca
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-2">
                                        <!-- Tombol Baca -->
                                        <button @click="viewMessage({
                                            id: '{{ $msg->id }}',
                                            name: '{{ addslashes($msg->name) }}',
                                            phone: '{{ $msg->phone }}',
                                            subject: '{{ addslashes($msg->subject) }}',
                                            message: '{{ addslashes($msg->message) }}',
                                            created_at: '{{ $msg->created_at->format('d M Y, H:i WIB') }}',
                                            is_read: {{ $msg->is_read ? 'true' : 'false' }}
                                        })" class="text-on-surface-variant hover:text-primary transition-colors p-1" title="Baca Lengkap">
                                            <span class="material-symbols-outlined text-[20px]">visibility</span>
                                        </button>

                                        <!-- Toggle Status Dibaca -->
                                        <form method="POST" action="{{ route('admin.pesan.read', $msg->id) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="text-on-surface-variant hover:text-primary transition-colors p-1" title="{{ $msg->is_read ? 'Tandai Belum Dibaca' : 'Tandai Sudah Dibaca' }}">
                                                <span class="material-symbols-outlined text-[20px]">{{ $msg->is_read ? 'mark_chat_unread' : 'mark_chat_read' }}</span>
                                            </button>
                                        </form>

                                        <!-- Hapus -->
                                        <form method="POST" action="{{ route('admin.pesan.destroy', $msg->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-on-surface-variant hover:text-error transition-colors p-1" title="Hapus Pesan">
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
                                        <span class="material-symbols-outlined text-4xl text-outline-variant">inbox</span>
                                        <p class="font-medium">Belum ada pesan masuk dari warga.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($messages->hasPages())
                <div class="p-4 border-t border-outline-variant bg-surface flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-xs text-on-surface-variant">
                        Menampilkan {{ $messages->firstItem() }}-{{ $messages->lastItem() }} dari {{ $messages->total() }} pesan
                    </p>
                    <div class="flex items-center gap-1">
                        {{ $messages->links('pagination::tailwind') }}
                    </div>
                </div>
                @endif
            </div>

            <!-- Modal: Baca Detail Pesan -->
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
                     class="relative bg-surface rounded-xl shadow-2xl w-full max-w-lg z-10 border border-outline-variant overflow-hidden flex flex-col">
                    
                    <!-- Header -->
                    <div class="flex items-center justify-between p-6 border-b border-outline-variant bg-surface-container-lowest">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-2xl">mail</span>
                            <h2 class="text-lg font-bold text-on-surface">Detail Pesan Masuk</h2>
                        </div>
                        <button type="button" class="text-on-surface-variant hover:text-on-surface p-1.5 rounded-full hover:bg-surface-container-low transition-colors" @click="openModal = false">
                            <span class="material-symbols-outlined">close</span>
                        </button>
                    </div>

                    <!-- Body -->
                    <div class="p-6 space-y-4 text-sm overflow-y-auto">
                        <div class="bg-surface-container-low p-4 rounded-xl border border-outline-variant space-y-2">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-on-surface-variant">Dari: <strong class="text-on-surface" x-text="currentMessage.name"></strong></span>
                                <span class="text-on-surface-variant" x-text="currentMessage.created_at"></span>
                            </div>
                            <div class="text-xs">
                                <span class="text-on-surface-variant">Nomor WhatsApp: </span>
                                <a :href="'https://wa.me/' + currentMessage.phone" target="_blank" class="text-primary font-bold hover:underline" x-text="currentMessage.phone"></a>
                            </div>
                            <div class="text-xs pt-1 border-t border-outline-variant/50">
                                <span class="text-on-surface-variant">Topik / Subjek: </span>
                                <strong class="text-on-surface" x-text="currentMessage.subject"></strong>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-on-surface mb-1">Isi Pesan:</label>
                            <div class="p-4 bg-white rounded-xl border border-outline-variant text-on-surface text-sm whitespace-pre-wrap leading-relaxed" x-text="currentMessage.message"></div>
                        </div>
                    </div>

                    <!-- Footer Actions -->
                    <div class="p-6 border-t border-outline-variant bg-surface-container-lowest flex items-center justify-between gap-3">
                        <button type="button" class="px-4 py-2 rounded-lg border border-outline-variant text-on-surface text-xs font-medium hover:bg-surface-container-low transition-colors" @click="openModal = false">
                            Tutup
                        </button>
                        <a :href="currentMessage.wa_reply_url" target="_blank" 
                           class="px-5 py-2.5 rounded-lg bg-[#25D366] hover:bg-[#1EBE5D] text-white text-xs font-semibold shadow-sm transition-all flex items-center gap-2">
                            <span class="material-symbols-outlined text-base">chat</span>
                            <span>Balas via WhatsApp</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>
