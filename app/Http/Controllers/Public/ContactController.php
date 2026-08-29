<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Setting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display the public contact page.
     */
    public function index()
    {
        $num1 = rand(1, 9);
        $num2 = rand(1, 9);
        session(['captcha_answer' => $num1 + $num2]);
        $captchaQuestion = "{$num1} + {$num2}";

        return view('public.contact', compact('captchaQuestion'));
    }

    /**
     * Store incoming contact message to database and redirect to village WhatsApp.
     */
    public function send(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:25',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string',
            'captcha' => 'required|numeric',
        ]);

        // Verify Anti-bot Math Captcha
        $correctAnswer = session('captcha_answer');
        if ((int)$request->captcha !== (int)$correctAnswer) {
            return back()->withErrors([
                'captcha' => 'Jawaban verifikasi angka tidak tepat. Silakan hitung kembali untuk memastikan Anda bukan robot.'
            ])->withInput();
        }

        // Clear captcha session after successful validation
        session()->forget('captcha_answer');

        // 1. Save to Database
        ContactMessage::create([
            'name' => $validated['nama'],
            'phone' => $validated['whatsapp'],
            'subject' => $validated['subjek'],
            'message' => $validated['pesan'],
            'is_read' => false,
        ]);

        // 2. Format Village Target WhatsApp Number
        $rawWa = Setting::get('wa_utama', '0895337067978');
        $cleanWa = preg_replace('/[^0-9]/', '', $rawWa);
        if (str_starts_with($cleanWa, '0')) {
            $cleanWa = '62' . substr($cleanWa, 1);
        }

        // 3. Construct WhatsApp Message Content
        $text = "Halo Pengelola BUMDes Desa Ciawiasih, perkenalkan saya *" . $validated['nama'] . "* (" . $validated['whatsapp'] . ").\n\n"
              . "*Topik / Subjek:* " . $validated['subjek'] . "\n"
              . "*Pesan:*\n" . $validated['pesan'] . "\n\n"
              . "---\n_Dikirim melalui formulir kontak website katalog daur ulang desa._";

        $waUrl = "https://api.whatsapp.com/send?phone=" . $cleanWa . "&text=" . urlencode($text);

        // 4. Redirect to WhatsApp
        return redirect()->away($waUrl);
    }
}
