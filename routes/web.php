<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    return view('welcome');
});

Route::group(['middleware' => 'web'], function () {
    Route::get('/users/index', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/blogs/edit', [UserController::class, 'edit'])->name('users.blogs.edit');
    Route::get('/users/blogs/delete/{blog_id}', [UserController::class, 'delete'])->name('users.blogs.delete');
    Route::get('/users/blogs/others', [UserController::class, 'others'])->name('users.blogs.others');
    Route::post('/users/blogs/create', [UserController::class, 'create'])->name('users.blogs.create');
    Route::get('/users/blogs/open', [UserController::class, 'open'])->name('users.blogs.open');
    Route::get('/users/blogs/archive', [UserController::class, 'archive'])->name('users.blogs.archive');
    Route::get('/users/blogs/warning', [UserController::class, 'warning'])->name('users.blogs.warning');
    Route::get('/users/blogs/destory', [UserController::class, 'destory'])->name('users.blogs.destory');
    Route::get('/users/blogs/restore/{blog_id}', [UserController::class, 'restore'])->name('users.blogs.restore');
    Route::get('/users/blogs/comment', [UserController::class, 'comment'])->name('users.blogs.comment');
    Route::get('/users/blogs/change/{id}/{open}', [UserController::class, 'change'])->name('users.blogs.change');
    Route::get('/users/blogs/update', [UserController::class, 'update'])->name('users.blogs.update');
    Route::get('/users/blogs/unsubscribe', [UserController::class, 'unsubscribe'])->name('users.blogs.unsubscribe');
    Route::get('/users/blogs/post', [UserController::class, 'post'])->name('users.blogs.post');
});

require __DIR__.'/auth.php';
