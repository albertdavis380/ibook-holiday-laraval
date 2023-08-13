<?php

use App\Http\Controllers\LocaleController;
use App\Http\Controllers\Admin\ProductController;

/*
 * Global Routes
 *
 * Routes that are used between both frontend and backend.
 */

// Switch between the included languages
Route::get('lang/{lang}', [LocaleController::class, 'change'])->name('locale.change');

/*
 * Frontend Routes
 */
Route::group(['as' => 'frontend.'], function () {
    includeRouteFiles(__DIR__.'/frontend/');
});

/*
 * Backend Routes
 *
 * These routes can only be accessed by users with type `admin`
 */
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    includeRouteFiles(__DIR__.'/backend/');
});


// routes/web.php

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard/greeting', function () {
        return 'Hello World';
    });
    Route::get('/dashboard/product/create', 'Admin\ProductController@create')->name('dashboard.product.create');
    Route::post('/dashboard/product', 'Admin\ProductController@store')->name('dashboard.product.store');
    Route::get('/dashboard/product/{product}/edit', 'Admin\ProductController@edit')->name('dashboard.product.edit');
    Route::put('/dashboard/product/{product}', 'Admin\ProductController@update')->name('dashboard.product.update');
});
