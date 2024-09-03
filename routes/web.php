<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;

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

$controller_path = 'App\Http\Controllers';

// Main Page Route

// pages forgot-password

Route::get('/register',function(){
    return redirect('/');
});
Route::get('/forgot-password',function(){
    return redirect('/');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    $controller_path = 'App\Http\Controllers';

    Route::get('/', $controller_path . '\pages\HomePage@index')->name('pages-home');


    //Users
    Route::get('/users', $controller_path . '\pages\Users@index')->name('pages-users');
    Route::get('/users/create', $controller_path . '\pages\Users@create')->name('pages-users-create');
    Route::post('/users/store', $controller_path . '\pages\Users@store')->name('pages-users-store');
    
    Route::get('/users/show/{user_id}', $controller_path . '\pages \Users@show')->name('pages-users-show');
    Route::post('/users/update', $controller_path . '\pages\Users@update')->name('pages-users-update');
    Route::get('/users/destroy/{user_id}', $controller_path . '\pages\Users@destroy')->name('pages-users-destroy');
    
    //Roles User
    Route::get('/roles/switch/{user_id}', $controller_path . '\pages\Users@switch')->name('pages-users-switch-role');

    //SDR    

    Route::get('/sdr',function(){
        return view('content.pages.pages-sdr-livewire');
    });
    
    Route::get('/sdr', $controller_path . '\SdrDaoController@index')->name('pages-sdr-livewire');

    //PDF SDR
    Route::get('/generate-pdf/{id}', [PdfController::class, 'generatePdf'])->name('generate.pdf');

    
    //Productos Inventario
   
    Route::get('/inventario', $controller_path . '\ProductoController@index')->name('pages-producto-livewire');

});
