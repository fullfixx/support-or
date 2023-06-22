<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\MoyskladController;
use App\Http\Controllers\PrestashopController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TicketController;
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

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/tickets', [TicketController::class, 'index'])
        ->name('ticket.index');

    Route::get('/tickets/group/{status_id}', [TicketController::class, 'indexGroup'])
        ->name('ticket.index.group');

    Route::get('/tickets/create', [TicketController::class, 'create'])
        ->name('ticket.create');

    Route::post('/tickets', [TicketController::class, 'store'])
        ->name('ticket.store');

    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])
        ->name('ticket.show');

    Route::get('/tickets/{ticket}/edit', [TicketController::class, 'edit'])
        ->name('ticket.edit');

    Route::patch('/tickets/{ticket}', [TicketController::class, 'update'])
        ->name('ticket.update');

    Route::get('/tickets/{ticket}/status/2', [TicketController::class, 'working'])
        ->name('ticket.working');

    Route::get('/tickets/{ticket}/status/3', [TicketController::class, 'done'])
        ->name('ticket.done');

    Route::get('/tickets/{ticket}/status/4', [TicketController::class, 'closed'])
        ->name('ticket.closed');

    Route::delete('/tickets/{ticket}', [TicketController::class, 'delete'])
        ->name('ticket.delete');

    Route::post('/comments', [CommentController::class, 'store'])
        ->name('comment.store');

    Route::get('/tickets/{ticket}/files/create', [FileController::class, 'create'])
        ->name('file.create');

    Route::post('/files', [FileController::class, 'store'])
        ->name('file.store');

    Route::get('/goals', [GoalController::class, 'index'])
        ->name('goal.index');

    Route::post('/goals', [GoalController::class, 'store'])
        ->name('goal.store');

    Route::post('/tasks', [TaskController::class, 'store'])
        ->name('task.store');

    Route::delete('/goals/{goal}', [GoalController::class, 'delete'])
        ->name('goal.delete');

    Route::delete('/tasks/{task}', [TaskController::class, 'delete'])
        ->name('task.delete');

    Route::patch('/tasks/{task}', [TaskController::class, 'changeStatus'])
        ->name('task.changeStatus');

    Route::get('/moysklad/import', [MoyskladController::class, 'import'])
        ->name('moysklad.import');

    Route::get('/moysklads', [MoyskladController::class, 'index'])
        ->name('moysklad.index');

    Route::get('/moysklads/store', [MoyskladController::class, 'store'])
        ->name('moysklad.store');

    Route::get('/test', [MoyskladController::class, 'test']);

    Route::get('prestashop', [PrestashopController::class, 'index']);

});


require __DIR__.'/auth.php';
