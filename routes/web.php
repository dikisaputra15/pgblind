<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\StatistikController::class, 'index']);
Route::get('/incidenttype', [App\Http\Controllers\IncidenttypeController::class, 'index']);
Route::get('/subincidenttype', [App\Http\Controllers\SubincidenttypeController::class, 'index']);
Route::get('/socialconflict', [App\Http\Controllers\SocialconflictController::class, 'index']);
Route::get('/weapontype', [App\Http\Controllers\WeapontypeController::class, 'index']);
Route::get('/actor', [App\Http\Controllers\ActorController::class, 'index']);
Route::get('/actortype', [App\Http\Controllers\ActortypeController::class, 'index']);
Route::get('/target', [App\Http\Controllers\TargetController::class, 'index']);
Route::get('/targettype', [App\Http\Controllers\TargettypeController::class, 'index']);
Route::get('/tanggal', [App\Http\Controllers\TanggalController::class, 'index']);
Route::get('/subactortype', [App\Http\Controllers\SubactortypeController::class, 'index']);
Route::get('/explosivetype', [App\Http\Controllers\ExplosivetypeController::class, 'index']);
Route::get('/violence', [App\Http\Controllers\ViolenceController::class, 'index']);