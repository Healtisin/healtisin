<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Footer;
use Illuminate\Support\Facades\Validator;

class FooterController extends Controller
{
    public function index()
    {
        $footer = Footer::first();
        return view('admin.footer.index', compact('footer'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string|max:1000',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'location' => 'required|string|max:255',
            'github_link' => 'nullable|url|max:255',
            'twitter_link' => 'nullable|url|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $footer = Footer::firstOrNew();
        $footer->fill($request->all());
        $footer->save();

        return redirect()->route('admin.footer.index')
            ->with('success', 'Footer berhasil diperbarui');
    }
} 