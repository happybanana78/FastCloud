<?php

use App\Http\Controllers\FileController;
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

// Home page with file list
Route::get('/', function () {
    return view('files.index');
});

// Upload files create new folders
Route::get('/files/create', function () {
    return view('files.create');
});

Route::get('/confirmation', [FileController::class, 'toConfirmation']);

Route::post('/files/folder/create', [FileController::class, 'createFolder']);

Route::post('/files/upload', [FileController::class, 'uploadFile']);
