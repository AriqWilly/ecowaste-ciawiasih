<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Update the admin's profile and/or password.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone_number' => ['nullable', 'string', 'max:25'],
            'current_password' => ['nullable', 'required_with:new_password', 'current_password'],
            'new_password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ], [
            'email.unique' => 'Email ini sudah digunakan oleh akun lain.',
            'current_password.current_password' => 'Kata sandi saat ini tidak cocok.',
            'new_password.confirmed' => 'Konfirmasi kata sandi baru tidak sama.',
            'new_password.min' => 'Kata sandi baru minimal harus 6 karakter.',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        if ($request->has('phone_number')) {
            $user->phone_number = $validated['phone_number'];
        }

        if (!empty($validated['new_password'])) {
            $user->password = Hash::make($validated['new_password']);
        }

        $user->save();

        return redirect()->route('admin.pengaturan.index', ['tab' => 'security'])
            ->with('success', 'Profil administrator dan kata sandi berhasil diperbarui.');
    }
}
