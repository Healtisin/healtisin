@extends('admin.app')

@section('content')
@include('components.breadcrumbs')

<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div class="flex justify-between mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Detail Berita</h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.news.edit', $news) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white py-2 px-4 rounded-md flex items-center">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Berita
                </a>
                <a href="{{ route('admin.news.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded-md flex items-center">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-2">
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-gray-200 mb-4">{{ $news->title }}</h1>
                        
                        <div class="flex items-center mb-4">
                            <span class="inline-block px-2 py-1 text-xs font-semibold text-blue-800 bg-blue-100 dark:bg-blue-800 dark:text-blue-100 rounded-full mr-3">{{ $news->category }}</span>
                            <span class="text-sm text-gray-600 dark:text-gray-400">{{ $news->published_at->format('d M Y, H:i') }}</span>
                        </div>
                        
                        <div class="prose dark:prose-invert max-w-none mb-6">
                            {!! $news->content !!}
                        </div>
                    </div>
                    
                    <div class="md:col-span-1 space-y-6">
                        <div>
                            <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="w-full rounded-lg shadow-md">
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3">Informasi Berita</h3>
                            
                            <div class="space-y-3">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300">Slug URL</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 break-all">{{ $news->slug }}</p>
                                </div>
                                
                                <div>
                                    <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Dibuat</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $news->created_at->format('d M Y, H:i') }}</p>
                                </div>
                                
                                <div>
                                    <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300">Terakhir Diperbarui</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $news->updated_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3">Meta SEO</h3>
                            
                            <div class="space-y-3">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300">Meta Description</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $news->meta_description ?? 'Tidak ada' }}</p>
                                </div>
                                
                                <div>
                                    <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300">Meta Keywords</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $news->meta_keywords ?? 'Tidak ada' }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex justify-between">
                            <a href="{{ route('news.show', $news->slug) }}" target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md inline-flex items-center">
                                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                                Lihat di Situs
                            </a>
                            
                            <form action="{{ route('admin.news.destroy', $news) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md inline-flex items-center">
                                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 