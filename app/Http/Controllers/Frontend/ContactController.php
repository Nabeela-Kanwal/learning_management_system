<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        Contact::create($request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:200', 'not_regex:/[\r\n]/'],
            'message' => ['required', 'string', 'max:10000'],
        ]));

        return redirect()->route('contact')->with('success', 'Thank you! Your message has been received.');
    }

    public function index()
    {
        $banner = Banner::where('page', 'contact')
            ->where('status', 1)
            ->orderBy('sort_order')
            ->latest()
            ->first();

        return view('frontend.contact', compact('banner'));
    }
}
