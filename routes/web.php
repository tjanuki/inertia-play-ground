<?php

use App\Http\Controllers\ContactRememberedController;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
    Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
    Route::get('/contact-remembered', [ContactRememberedController::class, 'show'])->name('contact.show');

});

Route::get('/users', function () {
    return Inertia::render('Users', [
        'users' => fn () => User::paginate(5),
        'companies' => fn () => \App\Models\Company::all(),
    ]);
})->name('users.index');
