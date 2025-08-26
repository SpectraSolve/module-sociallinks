<?php

use Illuminate\Support\Facades\Route;
use Modules\SocialLinks\Http\Controllers\SocialLinksController;

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

Route::middleware(['auth', 'permission:admin.view'])->group(function () {
    Route::get('/admin/sociallinks', [SocialLinksController::class, 'index']);

    Route::get('/discord', function () {
        return redirect(settings('sociallinks::discord', '/'));
    });
    Route::get('/github', function () {
        return redirect(settings('sociallinks::github', '/'));
    });
    Route::get('/twitter', function () {
        return redirect(settings('sociallinks::twitter', '/'));
    });
    Route::get('/tiktok', function () {
        return redirect(settings('sociallinks::tiktok', '/'));
    });
    Route::get('/gamepanel', function () {
        return redirect(settings('sociallinks::gamepanel', '/'));
    });
    Route::get('/instagram', function () {
        return redirect(settings('sociallinks::instagram', '/'));
    });
    Route::get('/youtube', function () {
        return redirect(settings('sociallinks::youtube', '/'));
    });





});