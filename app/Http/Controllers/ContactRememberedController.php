<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactRememberedController extends Controller
{
    public function show()
    {
        return Inertia::render('ContactRemembered');
    }
}
