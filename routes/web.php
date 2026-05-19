<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\CharacterImageController;
use App\Http\Controllers\BackgroundController;

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
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/story',[StoryController::class,'index'])->name('story.index');
    Route::get('/stories/create', [StoryController::class, 'create']);
    Route::post('/stories', [StoryController::class, 'store']);
    Route::delete('/stories/{story}', [StoryController::class, 'destroy'])->name('stories.destroy');
    Route::get('/stories/{id}', [StoryController::class, 'show']);

    Route::get('/characters',[CharacterController::class,'index'])->name('characters.index');
    Route::get('/characters/create', [CharacterController::class, 'create'])->name('characters.create');
    Route::post('/characters', [CharacterController::class, 'store'])->name('characters.store');
    Route::delete('/characters/{character}',[CharacterController::class, 'destroy'])->name('characters.destroy');
    Route::get('/characters/{character}/edit', [CharacterController::class, 'edit'])->name('characters.edit');
    Route::put('/characters/{character}', [CharacterController::class, 'update'])->name('characters.update');
    Route::get('/characters/{character}/edit', [CharacterController::class, 'edit'])->name('characters.edit');
    Route::put('/characters/{character}', [CharacterController::class, 'update'])->name('characters.update');


    // キャラ画像追加
    Route::get('/character-images/create', [CharacterImageController::class, 'create'])
        ->name('character-images.create');
    Route::post('/character-images', [CharacterImageController::class, 'store'])
        ->name('character-images.store');

    // キャラ画像編集
    Route::get('/character-images/{image}/edit', [CharacterImageController::class, 'edit'])
        ->name('character-images.edit');
    Route::put('/character-images/{image}', [CharacterImageController::class, 'update'])
        ->name('character-images.update');

    // キャラ画像削除
    Route::delete('/character-images/{image}', [CharacterImageController::class, 'destroy'])
        ->name('character-images.destroy');

    
    Route::resource('backgrounds', BackgroundController::class);



});