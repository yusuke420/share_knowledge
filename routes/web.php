<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReadController;


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
    return view('welcome');
});

Route::get('/dashboard', [PostController::class, 'index'])
->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('/dashboard', [App\Http\Controllers\Admin\Auth\PostController::class, 'index'])
    ->middleware(['auth:admin'])->name('dashboard');
    
    require __DIR__.'/admin.php';
});

Route::get('/admin/post', [App\Http\Controllers\Admin\Auth\PostController::class, 'create'])->name('admin.post.create');
Route::post('/admin/post', [App\Http\Controllers\Admin\Auth\PostController::class, 'store'])->name('admin.post.store');
Route::post('/post/edit',[PostController::class,'edit']);
Route::post('/post/delete',[PostController::class,'delete']);

Route::get('/dashboard/read/{post}', [ReadController::class, 'read'])->name('read');
Route::get('/dashboard/unread/{post}', [ReadController::class, 'unread'])->name('unread');
Route::get('/admin/dashboard/read{post}', [ReadController::class, 'read'])->name('read');
Route::get('/admin/dashboard/unread/{post}', [ReadController::class, 'unread'])->name('unread');

Route::get('/admin/detail/{id}', [App\Http\Controllers\Admin\Auth\PostController::class, 'detail'])->name('admin.detail');

Route::get('searchResultPost', [PostController::class, 'controllerSearchPost'])->name('searchResultPost');
Route::get('/admin/searchResultPost', [App\Http\Controllers\Admin\Auth\PostController::class, 'controllerSearchPost'])->name('admin.searchResultPost');

Route::get('sortResultPost', [PostController::class, 'controllerSortPost'])->name('sortResultPost');
Route::get('/admin/sortResultPost', [App\Http\Controllers\Admin\Auth\PostController::class, 'controllerSortPost'])->name('admin.sortResultPost');

Route::get('searchResultUser', [UserController::class, 'controllerSearchUser'])->name('searchResultUser');

Route::get('/admin/users-list', [UserController::class, 'show'])->name('admin.user-list.show');
Route::post('/users-list/edit',[UserController::class,'edit']);
Route::post('/users-list/delete',[UserController::class,'delete']);

require __DIR__.'/auth.php';

