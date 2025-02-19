<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest('published_at')->paginate(6);
        return view('news.index', compact('news'));
    }

    public function show($slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();
        
        // Ambil 3 artikel terkait dengan kategori yang sama
        $relatedNews = News::where('category', $news->category)
            ->where('id', '!=', $news->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('news.show', compact('news', 'relatedNews'));
    }
}
