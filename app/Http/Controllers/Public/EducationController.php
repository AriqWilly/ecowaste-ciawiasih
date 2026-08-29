<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\EducationalContent;

class EducationController extends Controller
{
    public function index()
    {
        $contents = EducationalContent::latest()->paginate(12);
        return view('public.edukasi.index', compact('contents'));
    }

    public function show($slug)
    {
        $content = EducationalContent::where('slug', $slug)->firstOrFail();
        return view('public.edukasi.show', compact('content'));
    }
}
