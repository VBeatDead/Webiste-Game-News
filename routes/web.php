<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\newsController;
use App\Http\Controllers\detailController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\NfController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\BookmarkController;

Route::middleware(['auth'])->group(function () {
    route::get('/', [AdminController::class, 'index'])->name('admin')->middleware('userAkses:admin');
    route::get('/admin', [AdminController::class, 'admin'])->name('setting');

    route::get('/indah', [AdminController::class, 'black'])->name('black');
    route::get('/indahp', [AdminController::class, 'price'])->name('price');

    Route::get('/item/{id}/edit', [ItemController::class, 'edit'])->name('item.edit')->middleware('userAkses:admin');
    Route::put('/item/{id}', [ItemController::class, 'update'])->name('item.update')->middleware('userAkses:admin');
    Route::delete('/item/{id}', [newsController::class, 'destroy'])->name('item.delete')->middleware('userAkses:admin');

    Route::get('/item/create', [newsController::class, 'create'])->name('item.create')->middleware('userAkses:admin');
    Route::post('/item', [newsController::class, 'store'])->name('item.store');

    Route::get('/logout', [SesiController::class, 'logout'])->name('logout');

    route::get('/', [AdminController::class, 'user'])->name('user')->middleware('userAkses:user');

    Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/bookmark/{item}', [BookmarkController::class, 'toggle'])->name('bookmark.toggle');
    Route::patch('/bookmark/{item}/notes', [BookmarkController::class, 'updateNotes'])->name('bookmark.notes');
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmark.index');
    Route::get('/bookmark/{item}/notes', [BookmarkController::class, 'getNotes'])->name('bookmark.getNotes');
});


Route::get('/news/{id}/{title}', [DetailController::class, 'show'])->name('detail.show');
route::get('/', [newsController::class, 'show'])->name('item.home');
Route::get('/sidebar', [newsController::class, 'show'])->name('sidebar.show');
route::get('/disclamer', [AboutController::class, 'show'])->name('item.about');
route::get('/contact', [ContactController::class, 'show'])->name('item.contact');
route::post('/', [SesiController::class, 'login'])->name('login');
route::post('/regis', [SesiController::class, 'register'])->name('register');
Route::get('/{id}/{title}', [detailController::class, 'show'])->name('item.detail');
Route::get('/random-item', [detailController::class, 'showRandomItem'])->name('random.item');
Route::get('/comments/{itemId}', [CommentController::class, 'showComments'])->name('comments.show');
Route::get('/not-found', [NfController::class, 'notAllowed'])->name('nf');
Route::post('/ratings', [RatingController::class, 'store'])->name('rating.store')->middleware('auth');
Route::get('/ratings/{item}', [RatingController::class, 'index'])->name('rating.index');
Route::get('/search', [NewsController::class, 'search'])->name('item.search');
