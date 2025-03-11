<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\Forum\ForumController;
use App\Http\Controllers\Forum\LikeController;
use App\Http\Controllers\Forum\ThemeController;
use App\Http\Controllers\ListController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Home ===========================================================================================

Route::get('/home', [ListController::class, 'index'])->name('home');
Route::get('/statuses', [ListController::class, 'statuses'])->name('statuses');

Route::post('/edit/{id}', [ListController::class, 'edit'])->name('edit');
Route::post('/create', [ListController::class, 'create'])->name('create');

Route::delete('/tasks/{id}', [ListController::class, 'destroy'])->name('delete');

// /Home

// Files and folders ===========================================================================================

Route::get('/files', [FileController::class,'index'])->name('files');
Route::post('/files-store', [FileController::class, 'store'])->name('store');

Route::post('/folders-store', [FileController::class, 'folderStore'])->name('folder.store');
Route::post('/folders-add', [FileController::class, 'folderAdd'])->name('folder.add');

Route::delete('/files/{id}', [FileController::class,'destroy'])->name('destroy.file');
Route::delete('/folders/{id}', [FileController::class,'destroyFolder'])->name('destroy.folder');

Route::post('/folder/edit', [FileController::class, 'folderEdit'])->name('folder.edit');
Route::post('/file/edit', [FileController::class, 'fileEdit'])->name('file.edit');

Route::post('/files/move', [FileController::class, 'move'])->name('files.move');

// /Files and folders

// CALENDAR ===========================================================================================

Route::resource('calendars', CalendarController::class);

// /CALENDAR



// Forum ================================================================================

Route::post('/post/{id}/like', [LikeController::class, 'like'])->name('post.like');
Route::delete('/post/{id}/unlike', [LikeController::class, 'unlike'])->name('post.unlike');






Route::get('/theme/home',[ThemeController::class,'index'])->name('theme.index');
Route::get('/theme/form/create',[ThemeController::class,'form'])->name('theme.FormCreate'); 
Route::post('/theme/create/{id}',[ThemeController::class,'create'])->name('theme.create');
Route::get('/theme/form/edit/{id}',[ThemeController::class,'formedit'])->name('theme.FormEdit'); 
Route::post('/theme/edit/{id}',[ThemeController::class,'edit'])->name('theme.edit');

Route::get('/forum/{id}',[ForumController::class,'index'])->name('forum.home');
Route::post('/forum/create/{id}',[ForumController::class,'create'])->name('forum.create');
Route::post('/forum/{id}',[ForumController::class,'status'])->name('forum.status');


// END FORUM ===========================================================================================