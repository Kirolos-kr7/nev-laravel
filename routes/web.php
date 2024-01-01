<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\PostsController;
use App\Models\Post;
use App\Models\Tag;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

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

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
// });


Route::controller(PostsController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/t/{tag}', 'with_tag')->name('tags');
    Route::get('/p/{post}', 'show')->name('post');
});
