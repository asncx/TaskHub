<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (auth()->check()) {
        return app(TaskController::class)->index(request());
    } else {
        return view('main');
    }
})->name('dashboard');


Route::post('/register', [UserController::class, 'register'])->name('register');
Route::get('/register', function () {
    return view('register');
});

Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::post('/newpost', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/settings', fn() => view('settings'))->name('settings');
    
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/filter', [TaskController::class, 'filterTasks'])->name('tasks.filter');

    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::post('/tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete');
    Route::get('/tasks-edit/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/task-update/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::post('/update-username', [UserController::class, 'updateUsername'])->name('updateUsername');
    Route::post('/delete-account', [UserController::class, 'deleteAccount'])->name('deleteAccount');
});

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin', [AdminController::class, 'users'])->name('admin.main');
    Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/{user}', [AdminController::class, 'show'])->middleware('auth')->name('users.show');
    Route::get('/users/update/{user}', [AdminController::class, 'show_p'])->middleware('auth')->name('users.update');
    Route::put('/users/{user}', [AdminController::class, 'update'])->name('user.update');
});





