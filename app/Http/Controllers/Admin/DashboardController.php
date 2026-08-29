<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\EducationalContent;
use App\Models\Category;
use App\Models\TeamMember;
use App\Models\ContactMessage;
use App\Models\Setting;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalEducations = EducationalContent::count();
        $totalCategories = Category::count();
        $totalTeam = TeamMember::count();
        $unreadMessages = ContactMessage::unread()->count();
        $totalMessages = ContactMessage::count();

        $recentProducts = Product::with('category')->latest()->take(5)->get();
        $recentMessages = ContactMessage::latest()->take(4)->get();
        $recentEducations = EducationalContent::with('category')->latest()->take(3)->get();

        $villageWa = Setting::get('wa_utama', '0895337067978');

        return view('admin.dashboard', compact(
            'totalProducts', 
            'totalEducations', 
            'totalCategories', 
            'totalTeam',
            'unreadMessages',
            'totalMessages',
            'recentProducts',
            'recentMessages',
            'recentEducations',
            'villageWa'
        ));
    }
}
