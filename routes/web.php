<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\blogController;

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
    Route::get('/users/index', [blogController::class, 'index'])->name('users.index');
    Route::get('/users/blogs/edit/{id}/{blog}/{body}', [blogController::class, 'edit'])->name('users.blogs.edit');
    Route::get('/users/blogs/delete', [blogController::class, 'delete'])->name('users.blogs.delete');
    Route::get('/users/blogs/others', [blogController::class, 'others'])->name('users.blogs.others');
    Route::get('/users/blogs/create', [blogController::class, 'create'])->name('users.blogs.create');
    Route::get('/users/blogs/open', [blogController::class, 'open'])->name('users.blogs.open');
    Route::get('/users/blogs/archive', [blogController::class, 'archive'])->name('users.blogs.archive');
    Route::get('/users/blogs/warning', [blogController::class, 'warning'])->name('users.blogs.warning');
    Route::get('/users/blogs/upgrade', [blogController::class, 'upgrade'])->name('users.blogs.upgrade');
    Route::get('/users/blogs/destory', [blogController::class, 'destory'])->name('users.blogs.destory');
    Route::get('/users/blogs/restore', [blogController::class, 'restore'])->name('users.blogs.restore');
    Route::get('/users/blogs/change', [blogController::class, 'change'])->name('users.blogs.change');
    Route::get('/users/blogs/unsubscribe', [blogController::class, 'unsubscribe'])->name('users.blogs.unsubscribe');

});

require __DIR__.'/auth.php';
