<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoryController;

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

Route::get('/story',[StoryController::class,'index'])->name('story.index');
Route::get('/stories/create', [StoryController::class, 'create']);
Route::post('/stories', [StoryController::class, 'store']);
