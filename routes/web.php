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

require __DIR__.'/auth.php';

Route::group(['middleware' => 'web'], function() {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/index', [UserController::class, 'index'])->name('users.index');
});

Route::group(['prefix' => 'users/blogs', 'middleware' => 'web'], function () {
    Route::get('edit/{blog_id}', [UserController::class, 'edit'])->name('users.blogs.edit');
    Route::get('delete/{blog_id}', [UserController::class, 'delete'])->name('users.blogs.delete');
    Route::get('others', [UserController::class, 'others'])->name('users.blogs.others');
    Route::post('create', [UserController::class, 'create'])->name('users.blogs.create');
    Route::get('open', [UserController::class, 'open'])->name('users.blogs.open');
    Route::get('archive', [UserController::class, 'archive'])->name('users.blogs.archive');
    Route::get('warning', [UserController::class, 'warning'])->name('users.blogs.warning');
    Route::get('destory', [UserController::class, 'destory'])->name('users.blogs.destory');
    Route::get('restore/{blog_id}', [UserController::class, 'restore'])->name('users.blogs.restore');
    Route::get('comment', [UserController::class, 'comment'])->name('users.blogs.comment');
    Route::get('change/{id}/{open}', [UserController::class, 'change'])->name('users.blogs.change');
    Route::post('update', [UserController::class, 'update'])->name('users.blogs.update');
    Route::get('unsubscribe', [UserController::class, 'unsubscribe'])->name('users.blogs.unsubscribe');
    Route::get('post', [UserController::class, 'post'])->name('users.blogs.post');
});
