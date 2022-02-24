<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LojaController;
use App\Http\Controllers\SetorController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\HomeController;

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

Route::get('/404', function () {return view('layouts.404');});

/****  Routes  Access and register ****/
Auth::routes();

/****  Routes  home ****/
Route::get('/', [LojaController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/index', [LojaController::class, 'index'])->middleware('auth');
Route::get('/create', [LojaController::class, 'create'])->middleware('auth');
Route::post('/add', [LojaController::class, 'store']);

/****  Routes  setor ****/
Route::get('/create-setor', [SetorController::class, 'create'])->middleware('auth');
Route::post('/add-setor', [SetorController::class, 'store']);


