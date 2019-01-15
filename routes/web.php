<?php

Auth::routes();

Route::get('/', 'FrontendController@index')->name('feontend.home');

Route::namespace('Backend')->group(function () {
    Route::middleware('auth')->prefix('admin')->group(function () {
        // Dashboard (My URLs)
        Route::get('/', 'DashboardController@view')->name('admin');

        // Berita
        Route::get('/berita', 'BeritaController@index')->name('admin.berita');
        Route::post('/berita', 'BeritaController@store')->name('admin.berita.store');
        Route::delete('/berita', 'BeritaController@destroy')->name('admin.berita.destroy');
        // History pemakaian
        Route::get('/history-pemakaian', 'HistoryPemakaianController@index')->name('admin.history-pemakaian');

        // User
        Route::namespace('User')->prefix('user')->group(function () {
            Route::get('/', 'UserController@index')->name('user.index');
            Route::get('/user/getdata', 'UserController@getData');

            // History pemakaian
            Route::get('/history-pemakaian', 'HistoryPemakaianController@index')->name('user.history-pemakaian');
            Route::post('/history-pemakaian', 'HistoryPemakaianController@store')->name('user.history.store');


            Route::get('{user}/edit', 'UserController@edit')->name('user.edit');
            Route::post('{user_hashId}/edit', 'UserController@update')->name('user.update');

            Route::get('{user}/changepassword', 'ChangePasswordController@view')->name('user.change-password');
            Route::post('{user_hashId}/changepassword', 'ChangePasswordController@update')->name('user.change-password.post');
        });
    });
});
