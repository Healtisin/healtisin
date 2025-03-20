<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class LogoController extends Controller
{
    public function index()
    {
        // Cek apakah file logo ada - perbaiki path file
        $defaultLogo = file_exists(public_path('images/logo.png')) ? asset('images/logo.png') : null;
        $whiteLogo = file_exists(public_path('images/logo-white.png')) ? asset('images/logo-white.png') : null;
        $favicon = file_exists(public_path('favicon.ico')) ? asset('favicon.ico') : 
                  (file_exists(public_path('images/favicon2.ico')) ? asset('images/favicon2.ico') : null);
        
        return view('admin.logo.index', compact('defaultLogo', 'whiteLogo', 'favicon'));
    }

    public function update(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'default_logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'white_logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'favicon' => 'nullable|file|mimes:ico|max:1024',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Update default logo
        if ($request->hasFile('default_logo')) {
            // Hapus file logo lama jika ada
            if (File::exists(public_path('images/logo.png'))) {
                File::delete(public_path('images/logo.png'));
            }
            
            $logo = $request->file('default_logo');
            $logo->move(public_path('images'), 'logo.png');
        }

        // Update white logo
        if ($request->hasFile('white_logo')) {
            // Hapus file logo putih lama jika ada
            if (File::exists(public_path('images/logo-white.png'))) {
                File::delete(public_path('images/logo-white.png'));
            }
            
            $logo = $request->file('white_logo');
            $logo->move(public_path('images'), 'logo-white.png');
        }

        // Update favicon
        if ($request->hasFile('favicon')) {
            // Hapus file favicon lama jika ada
            if (File::exists(public_path('favicon.ico'))) {
                File::delete(public_path('favicon.ico'));
            }
            
            $favicon = $request->file('favicon');
            $favicon->move(public_path('/'), 'favicon.ico');
        }

        return redirect()->route('admin.logo.index')
            ->with('success', 'Logo website berhasil diperbarui');
    }
} 