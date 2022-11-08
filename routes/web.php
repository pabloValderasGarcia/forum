<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;

use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;

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
    $categories = Category::all();
    $posts = Post::all();
    $comments = Comment::all();
    return view('index',
    [
        'categories' => $categories
    ]);
});

Route::resource('category', CategoryController::class);

Route::resource('post', PostController::class);

Route::resource('comment', CommentController::class);

Route::resource('user', UserController::class);
Route::put('picture/{user}', [UserController::class, 'picture']);

Route::post('register', [UserController::class, 'store']);
Route::post('login', [UserController::class, 'login']);
Route::get('logout', [UserController::class, 'logout']);