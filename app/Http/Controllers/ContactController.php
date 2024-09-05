<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function show()
    {
        return Inertia::render('Contact');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|integer|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);


        return back()->with('success', 'Your message has been sent!');
    }
}
