<?php

use App\Http\Controllers\Supervisors\ExpertiseController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\TitleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::group(['middleware' => 'auth'], function() {
    Route::group(['middleware' => 'role:student', 'prefix' => 'student', 'as' => 'student.'], function() {
        Route::get('viewExpertise', [ExpertiseController::class, 'indexStudent']);
        Route::resource('viewTitle', App\Http\Controllers\Students\TitleController::class);


    });

    Route::group(['middleware' => 'role:supervisor', 'prefix' => 'supervisor', 'as' => 'supervisor.'], function() {
        Route::resource('expertises', SupervisorController::class);
        Route::resource('titles', TitleController::class);

    });

    Route::group(['middleware' => 'role:coordinator', 'prefix' => 'coordinator', 'as' => 'coordinator.'], function() {

    });
});
