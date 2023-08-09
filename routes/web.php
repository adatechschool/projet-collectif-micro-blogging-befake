<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\APIController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewPostController;
use App\Http\Controllers\CommentsController;

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
    return redirect('login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/login', function() {
    return view('login');
});
Route::middleware('auth')->group(function () {
    // A l'avenir on veut que la premiere route n'affiche que les posts du logged user
    Route::get('/dashboard', [PostController::class, 'index'])->name('feed');
    Route::get('/profile', [PostController::class, 'allMyPosts'])->name('profile');
    Route::get('/profile/mypost', [PostController::class, 'show'])->name('profile.mypost');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/edit', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/api', [APIController::class, 'compareDate'])->name('word');
Route::get('/date', [APIController::class, 'compareDate'])->name('currentDate');
Route::post('/api/post', [APIController::class, 'fetchAPI'])->name('create.word');



Route::middleware(['auth'])->group(function () {
    Route::post('/newpost', [NewPostController::class, 'store'])->name('newpost.store');
    Route::post('/newcomment', [CommentsController::class, 'store'])->name('comment.store');
    Route::get('/listcomment', [CommentsController::class, 'show'])->name('comment.show');
    Route::delete('/listcomment/{comment}', [CommentsController::class, 'delete'])->name('comment.delete');
    
});



Route::resource('/posts', PostController::class);
require __DIR__.'/auth.php';
