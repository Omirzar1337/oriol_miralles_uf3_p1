<?php

use App\Http\Controllers\FilmController;
use App\Http\Middleware\ValidateYear;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActorController;



Route::get('/', function () {
    return view('welcome');
});

Route::middleware('year')->group(function () {
    Route::group(['prefix' => 'filmout'], function () {

        Route::get('oldFilms/{year?}', [FilmController::class, "listOldFilms"])->name('oldFilms');
        Route::get('newFilms/{year?}', [FilmController::class, "listNewFilms"])->name('newFilms');
        Route::get('films/{year?}/{genre?}', [FilmController::class, "listFilms"])->name('listFilms');
        Route::get('filmsByYear/{year?}', [FilmController::class, "filmsByYear"])->name('listByYear');
        Route::get('filmsByGenre/{genre?}', [FilmController::class, "filmsByGenre"])->name('listByGenre');
        Route::get('sortFilms', [FilmController::class, "sortByYear"])->name('sortByYear');
        Route::get('countFilms', [FilmController::class, "countFilms"])->name('listCount');
    });
});

Route::prefix('filmin')->group(function () {
    Route::post('/createFilm', [FilmController::class, 'addFilm'])
        ->name('createFilm')
        ->middleware('validateUrl');
});


Route::prefix('actorout')->group(function () {
    Route::get('/listactors', [ActorController::class, 'listActors'])->name('listActors');
    Route::get('/listActorsByDecade', [ActorController::class, 'listActorsByDecade'])->name('listActorsByDecade');
    Route::get('/countactors', [ActorController::class, 'countActors'])->name('countActors');
});
