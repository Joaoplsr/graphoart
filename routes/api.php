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
    Route::get('/', 'indexPublic')->name('api.articlesguest.index-public');
    Route::get('/{article}', 'show')->name('api.articlesguest.show');
    Route::get('/download/{article}', 'download')->name('api.articlesguest.download');
});

// Rotas Protegidas
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');

    Route::controller(ArticleController::class)
    ->prefix('articles')
    ->group(function () {
        //Rotas de Listagem de Artigos Privados
        Route::get('/', 'index')->name('api.articles.index');
        Route::get('/index-draft', 'indexDraft')->name('api.articles.index-draft');
        Route::get('/index-inreview', 'indexInReview')->name('api.articles.index-inreview');
        Route::get('/index-reviewed', 'indexReviewed')->name('api.articles.index-reviewed');

        //Rotas de Atualização de Status dos Artigos
        Route::post('/inreview/{article}', 'inReview')->name('api.articles.inreview');
        Route::post('/reviewed/{article}', 'reviewed')->name('api.articles.reviewed');
        Route::post('/published/{article}', 'published')->name('api.articles.published');

        //Rotas de Manipulação de Artigos
        Route::post('/store', 'store')->name('api.articles.store');
        Route::post('/update/{article}', 'update')->name('api.articles.update');
        Route::delete('/destroy/{article}', 'destroy')->name('api.articles.destroy');
        
    });
});

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
