<?php


use App\Http\Controllers\StudentController;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::group(['prefix' => 'student', 'middleware' => ['auth']], function () {
        Route::get('/questions', [StudentController::class, 'questions'])->name('student.questions');
    });
});
