<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [PostController::class, "index"])->name("posts.index");
Route::get('posts', [PostController::class, "create"])->name("posts.create");
Route::post('/', [PostController::class, "store"])->name("posts.store");
Route::get('posts/{post}/edit', [PostController::class, "edit"])->name("posts.edit");
Route::put('posts/{post}', [PostController::class, "update"])->name("posts.update");
Route::delete('posts/{post}', [PostController::class, "destroy"])->name("posts.destroy");
Route::get('posts/{post}', [PostController::class, "show"])->name("posts.show");
