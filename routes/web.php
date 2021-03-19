<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\DataController;
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

Route::get('/', function(){
    return view('nonreg');
})->name('noAuth');

// Route::get('/nonreg', function(){
//     return redirect()->route('mainpage');
// })->name('nonreg');

Route::middleware(['auth:sanctum', 'verified'])->post('/create', [DataController::class, 'Submit']);

Route::middleware(['auth:sanctum', 'verified'])->get('/create', function () {
    return view('create');
})->name('create');




Route::middleware(['auth:sanctum', 'verified'])->get('/history',[DataController::class, 'OutputAll'])->name('history');

Route::middleware(['auth:sanctum', 'verified'])->get('/history/{id}/delete',[DataController::class, 'Delete'])->name('delete');
Route::middleware(['auth:sanctum', 'verified'])->get('/last/{id}',[DataController::class, 'SelectData'])->name('selectData');




Route::middleware(['auth:sanctum', 'verified'])->get('/last',[DataController::class, 'OutputLast'])->name('last');

Route::middleware(['auth:sanctum', 'verified'])->get('/last/{id}/download-variant', [DataController::class, 'VariantDownload'])->name('download-variant');
Route::middleware(['auth:sanctum', 'verified'])->get('/last/{id}/download-vidpovidi', [DataController::class, 'VidpodidiDownload'])->name('download-vidpovidi');
Route::middleware(['auth:sanctum', 'verified'])->get('/last/{id}/download-data', [DataController::class, 'DataDownload'])->name('download-data');



Route::middleware(['auth:sanctum', 'verified'])->get('/home', function () {
    return view('welcome');
})->name('home');
