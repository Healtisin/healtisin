<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Http\Requests\StoreMessageRequest;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function create()
    {
        return view('partials.contact');
    }

    public function store(StoreMessageRequest $request)
    {
        Message::create($request->validated());

        return redirect()->back()->with('success', 'Pesan Anda telah berhasil dikirim!');
    }
}
