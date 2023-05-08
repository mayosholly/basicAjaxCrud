<?php

use App\Http\Controllers\StudentController;
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
Route::get('students', [StudentController::class, 'index']);
Route::post('students', [StudentController::class, 'store']);
Route::get('fetchStudent', [StudentController::class, 'fetchStudent']);
Route::get('students/{student}', [StudentController::class, 'edit']);
Route::put('students/{student}', [StudentController::class, 'update']);
Route::delete('students/{student}', [StudentController::class, 'destroy']);