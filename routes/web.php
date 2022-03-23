<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\ToursController;
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

Route::prefix('travel')->group(function () {
    Route::get('/', [ToursController::class, 'tourListAction'])->name('travel.list');
    Route::get('view/{id}', [ToursController::class, 'viewTourAction'])->name('travel.details');
    Route::get('form/{id}', [ToursController::class, 'formViewAction'])->name('travel.form');
    Route::post('/confirmSubmit', [ToursController::class, 'confirmFormAction'])->name('travel.confirm');
});

Route::prefix('home')->group(function () {
    Route::get('/', [HomeController::class, 'showHomepage'])->name('home.page');
    Route::get('view/{id}', [HomeController::class, 'viewContentAction'])->name('home.content');
});
