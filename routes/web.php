<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TranslationController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('categories', CategoryController::class)->names('categories');
    Route::resource('questions', QuestionController::class)->names('questions');


    Route::group(['prefix' => 'translation', 'namespace' => 'Translation',], function () {
        Route::get('translations', [TranslationController::class, 'index'])->name('translations.index');
        Route::get('jsonTranslation', [TranslationController::class, 'jsonTranslation'])->name('jsonTranslation');
        Route::get('translations-search', [TranslationController::class, 'search'])->name('translations.search');
        Route::post('translations-add-custom-key', [TranslationController::class, 'addCustomKey'])->name('translations.addCustomKey');

        Route::get('translations-item/{id?}', [TranslationController::class, 'show'])->name('translations-item');
        Route::post('translations-update', [TranslationController::class, 'update'])->name('translations.update');
        Route::post('translations-update-global', [TranslationController::class, 'updateGlobal'])->name('translations.updateGlobal');
        Route::get('translations-scan', [TranslationController::class, 'scanTranslation'])->name('translations.scan');
        Route::get('translations-publish', [TranslationController::class, 'publishTranslation'])->name('translations.publish');
        Route::get('translations-unpublished', [TranslationController::class, 'unpublishedTranslation'])->name('translations.unpublished');
        Route::get('translations-create', [TranslationController::class, 'newTranslation'])->name('translations.create');

        Route::get('translate-all/{code?}', [TranslationController::class, 'translateAll'])->name('translate-all');
        Route::get('initiate/{code?}', [TranslationController::class, 'initiate'])->name('initiate');
    });
});

Route::post('/data-by-nid', [ProfileController::class, 'dataByNid'])->name('auth.get-user-by-nid');

require __DIR__.'/auth.php';
