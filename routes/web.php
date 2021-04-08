<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatsController;

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

Route::get('/{n}', [CatsController::class, 'showCats'])->where('n', '[1-9][0-9]{0,5}|10{6}');
