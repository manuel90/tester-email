<?php

Route::middleware(['web'])->group(function () {
    Route::group(['prefix' => 'tester-email'], function () {
        Route::get('/','\Manuel90\TesterEmail\Http\Controller@index')->name('testeremail.index');
        Route::post('/send-email','\Manuel90\TesterEmail\Http\Controller@sendEmail')->name('testeremail.sending');

        Route::get('/assets','\Manuel90\TesterEmail\Http\Controller@assets')->name('testeremail.assets');
    });
});