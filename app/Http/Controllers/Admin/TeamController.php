<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    /**
     * Display a listing of team members and partners.
     */
    public function index(Request $request)
    {
        $query = TeamMember::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('role', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $members = $query->orderBy('order')->latest()->paginate(12)->withQueryString();

        return view('admin.tim.index', compact('members'));
    }

    /**
     * Store a newly created team member or partner.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'type' => 'required|in:pengurus,mitra',
            'photo' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        $member = new TeamMember();
        $member->name = $validated['name'];
        $member->role = $validated['role'];
        $member->type = $validated['type'];
        $member->description = $validated['description'] ?? null;
        $member->order = $validated['order'] ?? 0;
        $member->is_active = $request->has('is_active');

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('team', 'public');
            $member->photo_path = $path;
        }

        $member->save();

        return redirect()->route('admin.tim.index')->with('success', 'Data profil pengurus/mitra berhasil ditambahkan.');
    }

    /**
     * Update the specified team member or partner.
     */
    public function update(Request $request, string $id)
    {
        $member = TeamMember::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'type' => 'required|in:pengurus,mitra',
            'photo' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        $member->name = $validated['name'];
        $member->role = $validated['role'];
        $member->type = $validated['type'];
        $member->description = $validated['description'] ?? null;
        $member->order = $validated['order'] ?? 0;
        $member->is_active = $request->has('is_active');

        if ($request->hasFile('photo')) {
            if ($member->photo_path) {
                Storage::disk('public')->delete($member->photo_path);
            }
            $path = $request->file('photo')->store('team', 'public');
            $member->photo_path = $path;
        }

        $member->save();

        return redirect()->route('admin.tim.index')->with('success', 'Data profil pengurus/mitra berhasil diperbarui.');
    }

    /**
     * Remove the specified team member or partner.
     */
    public function destroy(string $id)
    {
        $member = TeamMember::findOrFail($id);

        if ($member->photo_path) {
            Storage::disk('public')->delete($member->photo_path);
        }

        $member->delete();

        return redirect()->route('admin.tim.index')->with('success', 'Data berhasil dihapus.');
    }
}
