<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('contact.index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $validated = $request->validated();
        // tel1, tel2, tel3 を結合して tel を追加
        $validated['tel'] = $validated['tel1'] . '-' . $validated['tel2'] . '-' . $validated['tel3'];
        $categories = Category::all();
        return view('contact.confirm', compact('validated', 'categories'));
    }

    public function store(ContactRequest $request)
    {
        $validated = $request->validated();
        $validated['tel'] = $validated['tel1'] . '-' . $validated['tel2'] . '-' . $validated['tel3'];
        Contact::create($validated);
        return view('contact.thanks');
    }
}