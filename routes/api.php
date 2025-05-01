<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Rotas Auth
Route::controller(AuthController::class)
->prefix('auth')
->group(function () {
    Route::post('/register', 'register')->name('api.auth.register');
    Route::post('/login', 'login')->name('api.auth.login');
});

// Rotas de Artigos Públicos
Route::controller(ArticleController::class)
->prefix('articlesguest')
->group(function () {
    Route::get('/', 'index-public')->name('api.articlesguest.index-public');
    Route::get('/{article}', 'show')->name('api.articlesguest.show');
});

// Rotas Protegidas
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');

    Route::controller(ArticleController::class)
    ->prefix('articles')
    ->group(function () {
        //Rotas de Listagem de Artigos Privados
        Route::get('/', 'index')->name('api.articles.index');
        Route::get('/', 'index-inreview')->name('api.articles.index-inreview');
        Route::get('/', 'index-reviewed')->name('api.articles.index-reviewed');
        
    });
});

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
