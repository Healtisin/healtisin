<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Helpers\LogHelper;

class NewsController extends Controller
{
    /**
     * Menampilkan daftar berita
     */
    public function index()
    {
        $news = News::latest('published_at')->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    /**
     * Menampilkan form untuk membuat berita baru
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Menyimpan berita baru
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published_at' => 'required|date',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
        ]);

        // Generate slug dari judul
        $validatedData['slug'] = Str::slug($validatedData['title']);

        // Upload gambar
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('news', 'public');
        }

        // Simpan berita
        $news = News::create($validatedData);

        // Log aktivitas
        LogHelper::info('news', "Berita baru dibuat: {$news->title}", [
            'news_id' => $news->id,
        ]);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Berita berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail berita
     */
    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    /**
     * Menampilkan form untuk mengedit berita
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Mengupdate berita
     */
    public function update(Request $request, News $news)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published_at' => 'required|date',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
        ]);

        // Generate slug dari judul
        $validatedData['slug'] = Str::slug($validatedData['title']);

        // Upload gambar baru jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            
            $validatedData['image'] = $request->file('image')->store('news', 'public');
        }

        // Update berita
        $news->update($validatedData);

        // Log aktivitas
        LogHelper::info('news', "Berita diperbarui: {$news->title}", [
            'news_id' => $news->id,
        ]);

        return redirect()
            ->route('admin.news.edit', $news)
            ->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Menghapus berita
     */
    public function destroy(News $news)
    {
        // Hapus gambar jika ada
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        // Log aktivitas sebelum menghapus
        LogHelper::info('news', "Berita dihapus: {$news->title}", [
            'news_id' => $news->id,
        ]);

        // Hapus berita
        $news->delete();

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Berita berhasil dihapus!');
    }
} 