<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\postController;
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



Auth::routes();

Route::group(['middleware' => ['auth']], function() {
Route::get('createPost' , [App\Http\Controllers\postController::class, 'create']);
Route::post('store' , [App\Http\Controllers\postController::class, 'store']);
Route::get('home' , [App\Http\Controllers\postController::class, 'index']);
Route::get('' , [App\Http\Controllers\postController::class, 'dashboard']);
Route::get('home/like/{id}' , 'App\Http\Controllers\postController@like');
Route::get('users', [App\Http\Controllers\userController::class, 'index']);
Route::get('user/show/{id}', [App\Http\Controllers\userController::class, 'show']);
Route::get('createAgenda', [App\Http\Controllers\agendaController::class, 'index']);
Route::post('createAgenda/store', [App\Http\Controllers\agendaController::class, 'store']);
Route::get('agendaIndex', [App\Http\Controllers\agendaController::class, 'agendaIndex']);
Route::get('addUser/{id}/{agendaId}', [App\Http\Controllers\agendaController::class, 'adduser']);
Route::get('agendaIndex/pending/{id}', [App\Http\Controllers\agendaController::class, 'pending']);
Route::get('acceptAgenda/{id}/{us}', [App\Http\Controllers\agendaController::class, 'accept']);
Route::get('declineAgenda/{id}/{us}', [App\Http\Controllers\agendaController::class, 'decline']);
Route::get('kick/{us}/{id}', [App\Http\Controllers\agendaController::class, 'kick']);
Route::post('changePfp/{id}', [App\Http\Controllers\userController::class, 'changePfp']);
Route::get('post/{id}/{uuid}', [App\Http\Controllers\userController::class, 'showPost']);
Route::get('/createComment/{postUuid}', [ App\Http\Controllers\postController::class, 'createComment']);
});



