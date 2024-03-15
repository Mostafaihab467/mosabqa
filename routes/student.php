<?php


use App\Http\Controllers\StudentController;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::group(['prefix' => 'student', 'middleware' => ['auth']], function () {
        Route::get('/exam-questions', [StudentController::class, 'examQuestions'])->name('student.questions');
        Route::get('/user-answers', [StudentController::class, 'userAnswers'])->name('student.answers');
    });
});
