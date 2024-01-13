<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [FeedbackController::class, 'index']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

/**
 * Frontend Routes
 */
Route::prefix('feedbacks')->name('feedbacks.')->group(function () {

    Route::controller(FeedbackController::class)->group(function () {

        Route::get('feedbacks', 'index')->name('feedback.index');
        Route::get('feedback/view/{id}/{title}', 'show')->name('feedback.show');

        Route::middleware(['auth', 'verified'])->group(function () {
            Route::post('feedback/add', 'store')->name('feedback.store');
            Route::put('feedback/update/{id}', 'update')->name('feedback.update');
            Route::get('feedback/delete/{id}', 'destroy')->name('feedback.delete');
        });
    });
});

/**
 * Comments Routes
 */
Route::name('comments.')->group(function () {

    Route::controller(CommentController::class)
        ->middleware(['auth', 'verified'])
        ->group(function () {

            Route::post('comments/comment/add', 'store')->name('comment.store');
            Route::put('comments/comment/update/{id}', 'update')->name('comment.update');
            Route::get('comments/comment/delete/{id}', 'destroy')->name('comment.delete');

    });
});

require __DIR__.'/auth.php';
