<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\MetaDataHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MetaDataController extends Controller
{
    public function index()
    {
        // Ambil semua metadata dari database
        $metaData = DB::table('meta_data')->get()->keyBy('key');
        
        return view('admin.meta_data.index', compact('metaData'));
    }

    public function update(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:70',
            'description' => 'required|string|max:160',
            'keywords' => 'required|string|max:255',
            'charset' => 'required|string|in:UTF-8,ISO-8859-1',
            'author' => 'nullable|string|max:100',
            'viewport' => 'nullable|string|max:100',
            'robots' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Update atau insert metadata
        $metaKeys = ['title', 'description', 'keywords', 'charset', 'author', 'viewport', 'robots'];
        
        foreach ($metaKeys as $key) {
            if ($request->has($key)) {
                DB::table('meta_data')->updateOrInsert(
                    ['key' => $key],
                    [
                        'value' => $request->input($key),
                        'updated_at' => now()
                    ]
                );
            }
        }

        // Refresh cache metadata
        MetaDataHelper::refreshCache();

        return redirect()->route('admin.meta-data.index')
            ->with('success', 'Metadata berhasil diperbarui');
    }
} 