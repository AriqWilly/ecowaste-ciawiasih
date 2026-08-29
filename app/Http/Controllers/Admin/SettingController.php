<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display settings page.
     */
    public function index()
    {
        $settings = [
            'nama_sistem' => Setting::get('nama_sistem', 'Katalog Daur Ulang Desa Ciawiasih'),
            'logo_desa' => Setting::get('logo_desa', null),
            'wa_utama' => Setting::get('wa_utama', '+62 812-3456-7890'),
            'email_pengelola' => Setting::get('email_pengelola', 'info@ciawiasihdaurulang.id'),
            'alamat' => Setting::get('alamat', 'Jl. Raya Ciawiasih No. 1, Kecamatan Susukanlebak, Kabupaten Cirebon, Jawa Barat 45185'),
            'jam_operasional' => Setting::get('jam_operasional', 'Senin - Sabtu: 08.00 - 15.00 WIB'),
            'deskripsi' => Setting::get('deskripsi', 'Katalog Daur Ulang Desa Ciawiasih adalah inisiatif BUMDes untuk mengelola sampah plastik dan organik menjadi produk bernilai guna tinggi, memberdayakan masyarakat lokal sekaligus menjaga kelestarian lingkungan.'),
        ];

        return view('admin.pengaturan.index', compact('settings'));
    }

    /**
     * Update settings.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama_sistem' => 'nullable|string|max:255',
            'wa_utama' => 'nullable|string|max:50',
            'email_pengelola' => 'nullable|email|max:255',
            'alamat' => 'nullable|string',
            'jam_operasional' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'logo_desa' => 'nullable|image|max:2048',
        ]);

        foreach (['nama_sistem', 'wa_utama', 'email_pengelola', 'alamat', 'jam_operasional', 'deskripsi'] as $key) {
            if ($request->has($key)) {
                Setting::set($key, $request->input($key));
            }
        }

        // Handle logo upload
        if ($request->hasFile('logo_desa')) {
            $oldLogo = Setting::get('logo_desa');
            if ($oldLogo) {
                Storage::disk('public')->delete($oldLogo);
            }
            $path = $request->file('logo_desa')->store('settings', 'public');
            Setting::set('logo_desa', $path);
        }

        return redirect()->route('admin.pengaturan.index')->with('success', 'Pengaturan profil desa berhasil diperbarui.');
    }
}
