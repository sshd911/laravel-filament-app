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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => 'web'], function () {
    Route::get('/users/index', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/blogs/edit/{id}/{blog}/{body}', [UserController::class, 'edit'])->name('users.blogs.edit');
    Route::get('/users/blogs/delete', [UserController::class, 'delete'])->name('users.blogs.delete');
    Route::get('/users/blogs/others', [UserController::class, 'others'])->name('users.blogs.others');
    Route::get('/users/blogs/create', [UserController::class, 'create'])->name('users.blogs.create');
    Route::get('/users/blogs/open', [UserController::class, 'open'])->name('users.blogs.open');
    Route::get('/users/blogs/archive', [UserController::class, 'archive'])->name('users.blogs.archive');
    Route::get('/users/blogs/warning', [UserController::class, 'warning'])->name('users.blogs.warning');
    Route::get('/users/blogs/upgrade', [UserController::class, 'upgrade'])->name('users.blogs.upgrade');
    Route::get('/users/blogs/destory', [UserController::class, 'destory'])->name('users.blogs.destory');
    Route::get('/users/blogs/restore', [UserController::class, 'restore'])->name('users.blogs.restore');
    Route::get('/users/blogs/comment', [UserController::class, 'comment'])->name('users.blogs.comment');
    Route::get('/users/blogs/change', [UserController::class, 'change'])->name('users.blogs.change');
    Route::get('/users/blogs/update', [UserController::class, 'update'])->name('users.blogs.update');
    Route::get('/users/blogs/unsubscribe', [UserController::class, 'unsubscribe'])->name('users.blogs.unsubscribe');

});

require __DIR__.'/auth.php';
