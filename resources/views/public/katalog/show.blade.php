<x-public-layout>
    <div class="container mx-auto px-4 lg:px-0 py-8 lg:py-12 max-w-[1200px]">
        
        <div class="mb-6">
            <a href="{{ route('catalog.index') }}" class="text-sm font-medium text-[#707a6c] hover:text-primary transition flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Katalog
            </a>
        </div>

        <div class="bg-white rounded-[16px] shadow-sm flex flex-col md:flex-row overflow-hidden border border-gray-100">
            <!-- Product Image -->
            <div class="w-full md:w-1/2 h-[400px] md:h-auto bg-[#F8F9FA] flex items-center justify-center p-4">
                <img src="{{ $product->image_path ? Storage::url($product->image_path) : 'https://placehold.co/600x400/e1e3e4/707a6c?text=Foto+Produk+Belum+Tersedia' }}" alt="{{ $product->name }}" class="w-full h-full object-cover object-center rounded-lg shadow-sm">
            </div>
            
            <!-- Product Info -->
            <div class="w-full md:w-1/2 p-6 md:p-10 flex flex-col justify-center">
                <span class="text-[#0d631b] font-medium text-sm tracking-wider uppercase mb-2">{{ $product->category->name ?? 'Kategori' }}</span>
                <h1 class="text-3xl lg:text-4xl font-bold text-[#191c1d] mb-4 font-['Inter'] leading-tight">{{ $product->name }}</h1>
                
                <p class="text-2xl font-semibold text-[#2e7d32] mb-6">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </p>
                
                <div class="prose text-[#40493d] mb-8 leading-[28px]">
                    {{ $product->description }}
                </div>
                
                <div class="bg-[#F1F3F5] rounded-lg p-4 mb-8">
                    <p class="text-sm text-[#40493d]"><span class="font-semibold text-[#191c1d]">Penjual:</span> {{ $product->seller_name }} (Warga Ciawiasih)</p>
                    <p class="text-sm text-[#40493d] mt-1 flex items-center gap-2">
                        <span class="font-semibold text-[#191c1d]">Stok Tersedia:</span> 
                        <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold rounded-full {{ $product->stock > 0 ? 'bg-[#cbffc2] text-[#005312]' : 'bg-[#ffdad6] text-[#93000a]' }}">
                            {{ $product->stock }} Unit
                        </span>
                    </p>
                </div>
                
                <!-- CTA WhatsApp -->
                @if($product->stock > 0)
                <a href="{{ $waLink ?? '#' }}" target="_blank" 
                   class="inline-flex items-center justify-center bg-[#0d631b] hover:bg-[#2e7d32] text-white font-medium py-3 px-8 rounded-lg transition-colors duration-200 w-full sm:w-auto">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
                    Pesan via WhatsApp
                </a>
                @else
                <button disabled class="inline-flex items-center justify-center bg-[#e1e3e4] text-[#707a6c] font-medium py-3 px-8 rounded-lg cursor-not-allowed w-full sm:w-auto">
                    Stok Habis
                </button>
                @endif
            </div>
        </div>
    </div>
</x-public-layout>
