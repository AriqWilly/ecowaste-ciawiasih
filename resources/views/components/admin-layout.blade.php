<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle ?? 'Admin Dashboard' }} - Ciawiasih</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "outline": "#707a6c",
                        "secondary-container": "#feb300",
                        "surface-container": "#edeeef",
                        "tertiary": "#1f6223",
                        "on-tertiary-fixed-variant": "#0c5216",
                        "on-tertiary-fixed": "#002203",
                        "primary-fixed-dim": "#88d982",
                        "on-surface": "#191c1d",
                        "tertiary-container": "#3a7b39",
                        "on-secondary-container": "#6a4800",
                        "on-primary-container": "#cbffc2",
                        "outline-variant": "#bfcaba",
                        "surface-tint": "#1b6d24",
                        "surface-variant": "#e1e3e4",
                        "tertiary-fixed-dim": "#91d78a",
                        "surface": "#f8f9fa",
                        "on-tertiary-container": "#c8ffbf",
                        "surface-container-high": "#e7e8e9",
                        "on-background": "#191c1d",
                        "surface-container-highest": "#e1e3e4",
                        "on-secondary-fixed": "#281900",
                        "on-tertiary": "#ffffff",
                        "error-container": "#ffdad6",
                        "background": "#f8f9fa",
                        "secondary-fixed-dim": "#ffba38",
                        "inverse-primary": "#88d982",
                        "tertiary-fixed": "#acf4a4",
                        "surface-bright": "#f8f9fa",
                        "surface-container-lowest": "#ffffff",
                        "on-error-container": "#93000a",
                        "error": "#ba1a1a",
                        "on-surface-variant": "#40493d",
                        "secondary": "#7e5700",
                        "primary-container": "#2e7d32",
                        "on-error": "#ffffff",
                        "primary-fixed": "#a3f69c",
                        "secondary-fixed": "#ffdeac",
                        "surface-dim": "#d9dadb",
                        "inverse-on-surface": "#f0f1f2",
                        "on-primary-fixed": "#002204",
                        "inverse-surface": "#2e3132",
                        "on-secondary": "#ffffff",
                        "on-primary": "#ffffff",
                        "on-primary-fixed-variant": "#005312",
                        "surface-container-low": "#f3f4f5",
                        "primary": "#0d631b",
                        "on-secondary-fixed-variant": "#604100"
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .material-symbols-outlined.filled {
            font-variation-settings: 'FILL' 1;
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f3f5;
        }
        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
    </style>
</head>
<body class="bg-background text-on-background font-sans min-h-screen flex antialiased" 
      x-data="{ 
          mobileSidebarOpen: false, 
          sidebarCollapsed: localStorage.getItem('sidebar_collapsed') === 'true',
          toggleSidebar() {
              this.sidebarCollapsed = !this.sidebarCollapsed;
              localStorage.setItem('sidebar_collapsed', this.sidebarCollapsed);
          }
      }">

    <!-- Sidebar -->
    <aside :class="[
               mobileSidebarOpen ? 'translate-x-0' : '-translate-x-full',
               sidebarCollapsed ? 'md:w-20' : 'md:w-64'
           ]" 
           class="w-64 bg-surface-container-highest border-r border-outline-variant flex-shrink-0 flex flex-col fixed md:sticky inset-y-0 left-0 z-40 md:translate-x-0 transition-all duration-300 ease-in-out h-screen">
        
        <!-- Sidebar Header -->
        <div class="p-4 sm:p-5 border-b border-outline-variant flex items-center justify-between min-h-[64px]">
            <div class="flex items-center gap-2.5 overflow-hidden" :class="sidebarCollapsed ? 'md:justify-center md:w-full' : ''">
                <div class="w-9 h-9 rounded-xl bg-primary text-white flex items-center justify-center shrink-0 shadow-sm">
                    <span class="material-symbols-outlined text-xl" style="font-variation-settings: 'FILL' 1;">eco</span>
                </div>
                <div x-show="!sidebarCollapsed" x-transition.opacity class="hidden md:block overflow-hidden whitespace-nowrap">
                    <h1 class="text-sm font-bold text-on-surface leading-tight">Daur Ulang</h1>
                    <p class="text-[10px] font-semibold text-on-surface-variant leading-tight">Desa Ciawiasih</p>
                </div>
                <div class="md:hidden">
                    <h1 class="text-sm font-bold text-on-surface leading-tight">Daur Ulang</h1>
                    <p class="text-[10px] font-semibold text-on-surface-variant leading-tight">Desa Ciawiasih</p>
                </div>
            </div>

            <!-- Mobile Close Button -->
            <button @click="mobileSidebarOpen = false" class="md:hidden text-on-surface-variant p-1.5 hover:bg-surface-container-low rounded-lg transition-colors">
                <span class="material-symbols-outlined text-lg">close</span>
            </button>
        </div>

        <!-- Sidebar Navigation -->
        <nav class="flex-1 overflow-y-auto py-4 px-2.5 space-y-1.5">
            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors text-sm relative group {{ request()->routeIs('admin.dashboard') ? 'bg-primary-container text-on-primary-container font-semibold shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-low' }}"
               :class="sidebarCollapsed ? 'md:justify-center md:px-2' : ''">
                <span class="material-symbols-outlined text-xl shrink-0 {{ request()->routeIs('admin.dashboard') ? 'filled' : '' }}">dashboard</span>
                <span x-show="!sidebarCollapsed" class="whitespace-nowrap">Dashboard</span>
                <!-- Tooltip for Collapsed Mode -->
                <div x-show="sidebarCollapsed" class="hidden md:group-hover:flex absolute left-full ml-3 px-3 py-1.5 bg-[#191c1d] text-white text-xs font-semibold rounded-lg shadow-xl whitespace-nowrap z-50 pointer-events-none items-center">
                    Dashboard
                </div>
            </a>

            <!-- Kelola Katalog -->
            <a href="{{ route('admin.katalog.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors text-sm relative group {{ request()->routeIs('admin.katalog.*') ? 'bg-primary-container text-on-primary-container font-semibold shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-low' }}"
               :class="sidebarCollapsed ? 'md:justify-center md:px-2' : ''">
                <span class="material-symbols-outlined text-xl shrink-0 {{ request()->routeIs('admin.katalog.*') ? 'filled' : '' }}">inventory_2</span>
                <span x-show="!sidebarCollapsed" class="whitespace-nowrap">Kelola Katalog</span>
                <div x-show="sidebarCollapsed" class="hidden md:group-hover:flex absolute left-full ml-3 px-3 py-1.5 bg-[#191c1d] text-white text-xs font-semibold rounded-lg shadow-xl whitespace-nowrap z-50 pointer-events-none items-center">
                    Kelola Katalog
                </div>
            </a>

            <!-- Edukasi Sampah -->
            <a href="{{ route('admin.edukasi.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors text-sm relative group {{ request()->routeIs('admin.edukasi.*') ? 'bg-primary-container text-on-primary-container font-semibold shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-low' }}"
               :class="sidebarCollapsed ? 'md:justify-center md:px-2' : ''">
                <span class="material-symbols-outlined text-xl shrink-0 {{ request()->routeIs('admin.edukasi.*') ? 'filled' : '' }}">article</span>
                <span x-show="!sidebarCollapsed" class="whitespace-nowrap">Edukasi Sampah</span>
                <div x-show="sidebarCollapsed" class="hidden md:group-hover:flex absolute left-full ml-3 px-3 py-1.5 bg-[#191c1d] text-white text-xs font-semibold rounded-lg shadow-xl whitespace-nowrap z-50 pointer-events-none items-center">
                    Edukasi Sampah
                </div>
            </a>

            <!-- Kelola Kategori -->
            <a href="{{ route('admin.kategori.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors text-sm relative group {{ request()->routeIs('admin.kategori.*') ? 'bg-primary-container text-on-primary-container font-semibold shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-low' }}"
               :class="sidebarCollapsed ? 'md:justify-center md:px-2' : ''">
                <span class="material-symbols-outlined text-xl shrink-0 {{ request()->routeIs('admin.kategori.*') ? 'filled' : '' }}">category</span>
                <span x-show="!sidebarCollapsed" class="whitespace-nowrap">Kelola Kategori</span>
                <div x-show="sidebarCollapsed" class="hidden md:group-hover:flex absolute left-full ml-3 px-3 py-1.5 bg-[#191c1d] text-white text-xs font-semibold rounded-lg shadow-xl whitespace-nowrap z-50 pointer-events-none items-center">
                    Kelola Kategori
                </div>
            </a>

            <!-- Pengurus & Mitra -->
            <a href="{{ route('admin.tim.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors text-sm relative group {{ request()->routeIs('admin.tim.*') ? 'bg-primary-container text-on-primary-container font-semibold shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-low' }}"
               :class="sidebarCollapsed ? 'md:justify-center md:px-2' : ''">
                <span class="material-symbols-outlined text-xl shrink-0 {{ request()->routeIs('admin.tim.*') ? 'filled' : '' }}">group</span>
                <span x-show="!sidebarCollapsed" class="whitespace-nowrap">Pengurus & Mitra</span>
                <div x-show="sidebarCollapsed" class="hidden md:group-hover:flex absolute left-full ml-3 px-3 py-1.5 bg-[#191c1d] text-white text-xs font-semibold rounded-lg shadow-xl whitespace-nowrap z-50 pointer-events-none items-center">
                    Pengurus & Mitra
                </div>
            </a>

            <!-- Pesan Masuk -->
            @php
                $unreadMsgCount = \App\Models\ContactMessage::unread()->count();
            @endphp
            <a href="{{ route('admin.pesan.index') }}"
               class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-colors text-sm relative group {{ request()->routeIs('admin.pesan.*') ? 'bg-primary-container text-on-primary-container font-semibold shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-low' }}"
               :class="sidebarCollapsed ? 'md:justify-center md:px-2' : ''">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-xl shrink-0 {{ request()->routeIs('admin.pesan.*') ? 'filled' : '' }}">inbox</span>
                    <span x-show="!sidebarCollapsed" class="whitespace-nowrap">Pesan Masuk</span>
                </div>
                @if($unreadMsgCount > 0)
                    <span x-show="!sidebarCollapsed" class="px-2 py-0.5 text-[10px] font-bold bg-error text-white rounded-full">{{ $unreadMsgCount }}</span>
                    <!-- Small Red Dot indicator when Collapsed -->
                    <span x-show="sidebarCollapsed" class="hidden md:block absolute top-2 right-2 w-2 h-2 bg-error rounded-full ring-2 ring-white"></span>
                @endif
                <div x-show="sidebarCollapsed" class="hidden md:group-hover:flex absolute left-full ml-3 px-3 py-1.5 bg-[#191c1d] text-white text-xs font-semibold rounded-lg shadow-xl whitespace-nowrap z-50 pointer-events-none items-center gap-1.5">
                    <span>Pesan Masuk</span>
                    @if($unreadMsgCount > 0)
                        <span class="px-1.5 py-0.2 bg-error text-white rounded text-[10px] font-bold">{{ $unreadMsgCount }}</span>
                    @endif
                </div>
            </a>

            <!-- Section Divider -->
            <div x-show="!sidebarCollapsed" class="pt-4 pb-1 px-3 text-[10px] font-bold text-outline uppercase tracking-wider">Sistem</div>
            <div x-show="sidebarCollapsed" class="hidden md:block h-px bg-outline-variant/60 my-3 mx-2"></div>

            <!-- Pengaturan -->
            <a href="{{ route('admin.pengaturan.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors text-sm relative group {{ request()->routeIs('admin.pengaturan.*') ? 'bg-primary-container text-on-primary-container font-semibold shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-low' }}"
               :class="sidebarCollapsed ? 'md:justify-center md:px-2' : ''">
                <span class="material-symbols-outlined text-xl shrink-0 {{ request()->routeIs('admin.pengaturan.*') ? 'filled' : '' }}">settings</span>
                <span x-show="!sidebarCollapsed" class="whitespace-nowrap">Pengaturan</span>
                <div x-show="sidebarCollapsed" class="hidden md:group-hover:flex absolute left-full ml-3 px-3 py-1.5 bg-[#191c1d] text-white text-xs font-semibold rounded-lg shadow-xl whitespace-nowrap z-50 pointer-events-none items-center">
                    Pengaturan
                </div>
            </a>
        </nav>

        <!-- Sidebar Footer -->
        <div class="p-3 border-t border-outline-variant space-y-1">
            <!-- Lihat Website -->
            <a href="{{ route('home') }}" target="_blank"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-on-surface-variant hover:bg-surface-container-low hover:text-primary transition-colors text-xs font-semibold relative group"
               :class="sidebarCollapsed ? 'md:justify-center md:px-2' : ''">
                <span class="material-symbols-outlined text-xl shrink-0">open_in_new</span>
                <span x-show="!sidebarCollapsed" class="whitespace-nowrap">Lihat Website</span>
                <div x-show="sidebarCollapsed" class="hidden md:group-hover:flex absolute left-full ml-3 px-3 py-1.5 bg-[#191c1d] text-white text-xs font-semibold rounded-lg shadow-xl whitespace-nowrap z-50 pointer-events-none items-center">
                    Lihat Website
                </div>
            </a>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Apakah Anda yakin ingin keluar dari panel admin?')">
                @csrf
                <button type="submit"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-error hover:bg-error-container/50 transition-colors text-xs font-semibold w-full text-left relative group cursor-pointer"
                        :class="sidebarCollapsed ? 'md:justify-center md:px-2' : ''">
                    <span class="material-symbols-outlined text-xl shrink-0">logout</span>
                    <span x-show="!sidebarCollapsed" class="whitespace-nowrap">Keluar</span>
                    <div x-show="sidebarCollapsed" class="hidden md:group-hover:flex absolute left-full ml-3 px-3 py-1.5 bg-[#ba1a1a] text-white text-xs font-semibold rounded-lg shadow-xl whitespace-nowrap z-50 pointer-events-none items-center">
                        Keluar
                    </div>
                </button>
            </form>
        </div>
    </aside>

    <!-- Overlay back drop for mobile sidebar -->
    <div x-show="mobileSidebarOpen" @click="mobileSidebarOpen = false" 
         class="fixed inset-0 bg-black/40 z-30 md:hidden transition-opacity" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"></div>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col min-w-0 h-screen overflow-hidden">
        <!-- Top Header -->
        <header class="bg-surface border-b border-outline-variant h-16 flex items-center justify-between px-6 lg:px-8 flex-shrink-0 z-20">
            <!-- Left: 3-Lines Toggle Button & Page Title Breadcrumb -->
            <div class="flex items-center gap-3">
                <button @click="if (window.innerWidth >= 768) { toggleSidebar() } else { mobileSidebarOpen = !mobileSidebarOpen }" 
                        class="text-on-surface-variant hover:text-primary hover:bg-surface-container-low p-2 rounded-xl transition-colors flex items-center justify-center cursor-pointer"
                        title="Buka / Tutup Menu Sidebar">
                    <span class="material-symbols-outlined text-2xl">menu</span>
                </button>
                <div class="flex items-center gap-2 text-xs text-on-surface-variant font-medium">
                    <span class="text-primary font-semibold hidden sm:inline">Desa Ciawiasih</span>
                    <span class="text-outline-variant hidden sm:inline">/</span>
                    <span class="text-on-surface font-bold text-sm">{{ $pageTitle ?? 'Panel Administrator' }}</span>
                </div>
            </div>

            <!-- Right: Functional Notification Dropdown & Admin Profile -->
            @php
                $headerUnreadCount = \App\Models\ContactMessage::unread()->count();
                $headerRecentMessages = \App\Models\ContactMessage::unread()->latest()->take(4)->get();
            @endphp
            <div class="flex items-center gap-3" x-data="{ notifOpen: false }">
                
                <!-- Notification Bell & Dropdown Popover -->
                <div class="relative">
                    <button @click="notifOpen = !notifOpen" 
                            class="relative p-2 text-on-surface-variant hover:text-primary hover:bg-surface-container-low rounded-full transition-colors"
                            title="Notifikasi Pesan Masuk">
                        <span class="material-symbols-outlined text-xl">notifications</span>
                        @if($headerUnreadCount > 0)
                            <span class="absolute top-1.5 right-1.5 w-2.5 h-2.5 bg-error rounded-full ring-2 ring-surface"></span>
                        @endif
                    </button>

                    <!-- Dropdown Content -->
                    <div x-show="notifOpen" 
                         @click.outside="notifOpen = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         style="display: none;"
                         class="absolute right-0 mt-2 w-80 sm:w-96 bg-surface-container-lowest rounded-2xl shadow-xl border border-outline-variant overflow-hidden z-50">
                        
                        <div class="p-4 border-b border-outline-variant bg-surface-container-low flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-lg">mail</span>
                                <h3 class="text-xs font-bold text-on-surface">Pesan Masuk Terbaru</h3>
                            </div>
                            @if($headerUnreadCount > 0)
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-error text-white">{{ $headerUnreadCount }} Baru</span>
                            @endif
                        </div>

                        <div class="divide-y divide-outline-variant/40 max-h-72 overflow-y-auto">
                            @forelse($headerRecentMessages as $notifMsg)
                            <a href="{{ route('admin.pesan.index') }}" class="p-3.5 hover:bg-surface-container-low transition-colors block space-y-1">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="font-bold text-on-surface">{{ $notifMsg->name }}</span>
                                    <span class="text-[10px] text-outline">{{ $notifMsg->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-xs font-medium text-primary line-clamp-1">{{ $notifMsg->subject }}</p>
                                <p class="text-xs text-on-surface-variant line-clamp-1">{{ $notifMsg->message }}</p>
                            </a>
                            @empty
                            <div class="p-6 text-center text-xs text-on-surface-variant">
                                <span class="material-symbols-outlined text-3xl text-outline mb-1">notifications_off</span>
                                <p class="font-medium">Tidak ada pesan baru yang belum dibaca.</p>
                            </div>
                            @endforelse
                        </div>

                        <div class="p-3 bg-surface-container-low border-t border-outline-variant text-center">
                            <a href="{{ route('admin.pesan.index') }}" class="text-xs font-semibold text-primary hover:underline flex items-center justify-center gap-1">
                                <span>Buka Kotak Masuk (Inbox)</span>
                                <span class="material-symbols-outlined text-sm">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="h-6 w-px bg-outline-variant mx-1"></div>

                <!-- Admin Profile Badge (Clickable to Edit Profile) -->
                <a href="{{ route('admin.pengaturan.index', ['tab' => 'security']) }}" 
                   class="flex items-center gap-2.5 p-1.5 pr-2.5 rounded-2xl hover:bg-surface-container-low transition-colors group cursor-pointer"
                   title="Kelola Profil & Kata Sandi">
                    <div class="w-8 h-8 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center font-bold text-xs shadow-sm group-hover:scale-105 transition-transform">
                        {{ strtoupper(substr(auth()->user()->name ?? 'Admin', 0, 2)) }}
                    </div>
                    <div class="hidden sm:block text-left">
                        <p class="text-xs font-bold text-on-surface leading-tight group-hover:text-primary transition-colors">{{ auth()->user()->name ?? 'Admin BUMDes' }}</p>
                        <p class="text-[10px] text-primary font-semibold leading-tight">Administrator</p>
                    </div>
                </a>

            </div>
        </header>

        <!-- Content Area -->
        <div class="flex-grow overflow-y-auto">
            {{ $slot }}
        </div>
    </main>

</body>
</html>
