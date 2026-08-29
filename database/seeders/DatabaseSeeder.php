<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\EducationalContent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Admin User
        User::updateOrCreate(
            ['email' => 'admin@ciawiasih.desa.id'],
            [
                'name' => 'Administrator Ciawiasih',
                'password' => bcrypt('password123'),
                'role' => 'admin',
                'phone_number' => '6281234567890'
            ]
        );

        // Seed Categories
        $catPlastik = Category::updateOrCreate(['slug' => 'kerajinan-plastik'], ['name' => 'Kerajinan Plastik', 'description' => 'Kerajinan tangan daur ulang berbahan dasar sampah plastik kemasan, botol, sedotan, dsb.']);
        $catKompos = Category::updateOrCreate(['slug' => 'kompos-organik'], ['name' => 'Kompos Organik', 'description' => 'Pupuk organik dan kompos cair hasil pengolahan limbah sampah organik rumah tangga dan daun kering.']);
        $catKertas = Category::updateOrCreate(['slug' => 'kertas'], ['name' => 'Kertas', 'description' => 'Produk daur ulang kertas bekas, koran, karton menjadi kerajinan atau wadah kreatif.']);
        $catAksesoris = Category::updateOrCreate(['slug' => 'aksesoris'], ['name' => 'Aksesoris', 'description' => 'Gantungan kunci, hiasan dinding, dan aksesoris lainnya dari tutup botol atau sampah residu yang dibentuk kembali.']);



        // Seed Educational Contents
        EducationalContent::updateOrCreate(
            ['slug' => 'cara-praktis-mengolah-sisa-dapur-menjadi-pupuk-kompos'],
            [
                'category_id' => $catKompos->id,
                'title' => 'Cara Praktis Mengolah Sisa Dapur Menjadi Pupuk Kompos',
                'content' => "Sampah dapur Anda sebenarnya adalah sumber nutrisi berharga bagi tanaman Anda. Dengan cara composting sederhana, kita bisa memotong volume pembuangan sampah ke TPA hingga 50%. Berikut langkahnya:\n\n1. Siapkan Wadah Komposter: Gunakan ember bekas cat atau wadah yang diberi lubang-lubang kecil di bawahnya untuk sirkulasi udara.\n2. Lapisan Dasar: Masukkan sekam padi atau daun kering sebagai lapisan penyeimbang kelembapan di bagian terbawah.\n3. Masukkan Sampah Dapur: Masukkan sisa potongan sayur, sisa buah, cangkang telur, dan ampas kopi ke dalam wadah.\n4. Tambahkan Aktivator: Siram sedikit cairan EM4 yang telah dilarutkan air gula untuk mempercepat pembusukan bakteri.\n5. Tutup Rapat: Tutup wadah dan diamkan selama 4-6 minggu dengan diaduk sesekali setiap minggunya.\n\nSelamat mencoba membuat kompos mandiri di rumah!",
                'media_path' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&w=800&q=80',
                'published_at' => now(),
            ]
        );

        EducationalContent::updateOrCreate(
            ['slug' => 'mengubah-botol-plastik-bekas-menjadi-karya-bernilai-jual'],
            [
                'category_id' => $catPlastik->id,
                'title' => 'Mengubah Botol Plastik Bekas Menjadi Karya Bernilai Jual',
                'content' => "Botol plastik sekali pakai adalah salah satu penyumbang limbah terbesar di lingkungan kita. Namun, dengan sentuhan kreativitas, botol bekas bisa diubah menjadi tempat pensil, vas bunga gantung, hingga lampion cantik yang bernilai ekonomis.\n\nKunci utamanya terletak pada teknik pemotongan yang halus dan pewarnaan menggunakan cat akrilik agar terlihat premium. Warga Desa Ciawiasih kini dapat menjual produk kreasi daur ulang botol plastik di website katalog BUMDes untuk penghasilan tambahan.",
                'media_path' => 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?auto=format&fit=crop&w=800&q=80',
                'published_at' => now(),
            ]
        );

        EducationalContent::updateOrCreate(
            ['slug' => 'jadwal-setor-bank-sampah-bulan-ini-ayo-berpartisipasi'],
            [
                'category_id' => $catAksesoris->id,
                'title' => 'Jadwal Setor Bank Sampah Bulan Ini: Ayo Berpartisipasi!',
                'content' => "Bank Sampah Desa Ciawiasih resmi membuka penyetoran berkala untuk bulan ini. Dapatkan saldo tabungan yang bisa ditukar dengan sembako atau uang tunai!\n\nJadwal Penyetoran:\n- Setiap hari Sabtu (Pukul 08.00 - 12.00 WIB)\n- Lokasi: Depan Kantor BUMDes Ciawiasih\n\nSyarat Penyetoran:\n1. Sampah sudah dipilah sesuai kategorinya (Plastik, Kertas, Logam/Kaca).\n2. Sampah plastik/botol harus dalam keadaan bersih dan kering agar bernilai tinggi.\n3. Membawa Buku Tabungan Bank Sampah.\n\nMari jaga kebersihan desa kita!",
                'media_path' => 'https://images.unsplash.com/photo-1611284446314-60a58ac0deb9?auto=format&fit=crop&w=800&q=80',
                'published_at' => now(),
            ]
        );

        // Seed Waste Reports
        \App\Models\WasteReport::updateOrCreate(
            ['report_date' => '2026-08-01'],
            [
                'organic_weight_kg' => 120.50,
                'anorganic_weight_kg' => 85.20,
                'notes' => 'Penyetoran minggu pertama Agustus'
            ]
        );

        \App\Models\WasteReport::updateOrCreate(
            ['report_date' => '2026-08-08'],
            [
                'organic_weight_kg' => 140.00,
                'anorganic_weight_kg' => 95.80,
                'notes' => 'Penyetoran minggu kedua Agustus'
            ]
        );
    }
}
