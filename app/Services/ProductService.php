<?php

namespace App\Services;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductService
{
    protected $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function createProduct(array $data, $imageFile = null)
    {
        if ($imageFile) {
            $data['image_path'] = $imageFile->store('products', 'public');
        }
        
        // Auto-generate slug dari nama produk
        $data['slug'] = Str::slug($data['name']);
        
        // Membersihkan nomor telepon (menghilangkan awalan 0 diganti 62)
        $data['seller_phone'] = $this->formatPhoneNumber($data['seller_phone']);
        
        return $this->productRepo->create($data);
    }

    public function generateWhatsAppLink($product)
    {
        $phone = $product->seller_phone;
        $message = "Halo, saya tertarik dengan produk daur ulang dari Desa Ciawiasih:\n\n";
        $message .= "*Nama Produk:* {$product->name}\n";
        $message .= "*Harga:* Rp " . number_format($product->price, 0, ',', '.') . "\n\n";
        $message .= "Apakah stoknya masih tersedia?";
        
        return "https://wa.me/{$phone}?text=" . urlencode($message);
    }

    private function formatPhoneNumber($phone)
    {
        // Pastikan nomor diawali dengan 62 (Kode Negara ID)
        if (substr($phone, 0, 1) === '0') {
            return '62' . substr($phone, 1);
        }
        return $phone;
    }
}
