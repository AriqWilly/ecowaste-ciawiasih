<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display incoming contact messages.
     */
    public function index(Request $request)
    {
        $query = ContactMessage::query();

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('phone', 'like', '%' . $request->search . '%')
                  ->orWhere('subject', 'like', '%' . $request->search . '%')
                  ->orWhere('message', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('status')) {
            if ($request->status === 'unread') {
                $query->where('is_read', false);
            } elseif ($request->status === 'read') {
                $query->where('is_read', true);
            }
        }

        $messages = $query->latest()->paginate(10)->withQueryString();
        $unreadCount = ContactMessage::where('is_read', false)->count();

        return view('admin.pesan.index', compact('messages', 'unreadCount'));
    }

    /**
     * Mark message as read/unread.
     */
    public function toggleRead(string $id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->is_read = !$message->is_read;
        $message->save();

        return back()->with('success', 'Status pesan berhasil diubah.');
    }

    /**
     * Remove the specified message.
     */
    public function destroy(string $id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.pesan.index')->with('success', 'Pesan berhasil dihapus.');
    }
}
