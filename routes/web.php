<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AttachController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\MyController;
use App\Http\Controllers\PostController;

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

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::resources([
    'user' => UserController::class,
    'forum' => ForumController::class,
    'attach' => AttachController::class,
    'thread' => ThreadController::class,
    'my' => MyController::class,
    'post' => PostController::class,
]);
