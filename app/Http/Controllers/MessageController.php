<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Http\Requests\StoreMessageRequest;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::orderBy('created_at', 'desc')->get();
        return view('admin.messages', compact('messages'));
    }

    public function create()
    {
        return view('partials.contact');
    }

    public function store(StoreMessageRequest $request)
    {
        Message::create($request->validated());

        return redirect()->back()->with('success', 'Pesan Anda telah berhasil dikirim!');
    }

    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();
        return redirect()->route('admin.messages')->with('success', 'Pesan berhasil dihapus!');
    }
}
