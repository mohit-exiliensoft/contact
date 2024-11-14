<?php

use Exiliensoft\Contact\Http\Controllers\ContactController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// Route::group(['namespace' => 'Exiliensoft\Contact\Http\Controllers'], function(){


Route::get('contact', [ContactController::class, 'index']);
Route::post('/send', [ContactController::class, 'send'])->name('send');
// });
