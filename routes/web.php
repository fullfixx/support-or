<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/tickets', [\App\Http\Controllers\TicketController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('ticket.index');

Route::get('/tickets/create', [\App\Http\Controllers\TicketController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('ticket.create');

Route::post('/tickets', [\App\Http\Controllers\TicketController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('ticket.store');

Route::get('/tickets/{ticket}', [\App\Http\Controllers\TicketController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('ticket.show');

Route::get('/tickets/{ticket}/edit', [\App\Http\Controllers\TicketController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('ticket.edit');

Route::patch('/tickets/{ticket}', [\App\Http\Controllers\TicketController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('ticket.update');

Route::get('/tickets/{ticket}/status/2', [\App\Http\Controllers\TicketController::class, 'working'])
    ->middleware(['auth', 'verified'])
    ->name('ticket.working');

Route::get('/tickets/{ticket}/status/3', [\App\Http\Controllers\TicketController::class, 'done'])
    ->middleware(['auth', 'verified'])
    ->name('ticket.done');

Route::get('/tickets/{ticket}/status/4', [\App\Http\Controllers\TicketController::class, 'closed'])
    ->middleware(['auth', 'verified'])
    ->name('ticket.closed');

Route::delete('/tickets/{ticket}', [\App\Http\Controllers\TicketController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('ticket.destroy');

Route::post('/comments', [\App\Http\Controllers\CommentController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('comments.store');

require __DIR__.'/auth.php';
