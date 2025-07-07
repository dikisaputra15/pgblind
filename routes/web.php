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
Route::get('/target', [App\Http\Controllers\TargetController::class, 'index']);
Route::get('/targettype', [App\Http\Controllers\TargettypeController::class, 'index']);
Route::get('/tanggal', [App\Http\Controllers\TanggalController::class, 'index']);
Route::get('/explosivetype', [App\Http\Controllers\ExplosivetypeController::class, 'index']);
Route::get('/violence', [App\Http\Controllers\ViolenceController::class, 'index']);
Route::get('/articlelink', [App\Http\Controllers\ArticlelinkController::class, 'index']);
Route::get('/business', [App\Http\Controllers\BusinessController::class, 'index']);
Route::get('/civilian', [App\Http\Controllers\CivilianController::class, 'index']);
Route::get('/community', [App\Http\Controllers\CommunityController::class, 'index']);
Route::get('/crimegroup', [App\Http\Controllers\CrimegroupController::class, 'index']);
Route::get('/intellegence', [App\Http\Controllers\IntellegenceController::class, 'index']);
Route::get('/military', [App\Http\Controllers\MilitaryController::class, 'index']);
Route::get('/police', [App\Http\Controllers\PoliceController::class, 'index']);
Route::get('/separatist', [App\Http\Controllers\SeparatistgroupController::class, 'index']);
Route::get('/vested', [App\Http\Controllers\VestedController::class, 'index']);
