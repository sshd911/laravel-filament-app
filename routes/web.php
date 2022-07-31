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

Route::get('/', function() {
    return view('welcome');
});

Route::get('/users/index', [UserController::class, 'index'])->middleware(['auth', 'web'])->name('users.index');

Route::group([
    'prefix' => 'users/blogs', 
    'middleware' => 'web', 
    'controller' => UserController::class
    ], function () {
        Route::get('edit/{blog_id}','edit')->name('users.blogs.edit');
        Route::get('delete/{blog_id}', 'delete')->name('users.blogs.delete');
        Route::get('others', 'others')->name('users.blogs.others');
        Route::post('create','create')->name('users.blogs.create');
        Route::get('open', 'open')->name('users.blogs.open');
        Route::get('archive', 'archive')->name('users.blogs.archive');
        Route::get('warning', 'warning')->name('users.blogs.warning');
        Route::get('destory', 'destory')->name('users.blogs.destory');
        Route::get('restore/{blog_id}', 'restore')->name('users.blogs.restore');
        Route::get('comment', 'comment')->name('users.blogs.comment');
        Route::get('change/{id}/{open}', 'change')->name('users.blogs.change');
        Route::post('update', 'update')->name('users.blogs.update');
        Route::get('unsubscribe', 'unsubscribe')->name('users.blogs.unsubscribe');
        Route::get('post', 'post')->name('users.blogs.post');
});
