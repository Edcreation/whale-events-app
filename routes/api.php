<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserTicketsController;
use App\Http\Middleware\CheckAdmin;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'auth'], function() {

    Route::get('/check', [AuthController::class,'index'])->middleware('auth:sanctum');
    Route::post('register',[AuthController::class,'register']);
    Route::post('login',[AuthController::class,'login']);
    Route::post('logout',[AuthController::class,'logout'])
        ->middleware('auth:sanctum');
});

Route::group(['prefix' => 'user'], function() {

    Route::post('/tickets',[UserTicketsController::class,'index'])
    ->middleware(['auth:sanctum', CheckAdmin::class]);
});

Route::group(['prefix' => 'events'], function() {
    Route::get('/', [EventController::class,'index']);
    Route::get('/{id}',[EventController::class,'show']);
    Route::get('/slug/{slug}',[EventController::class,'showBySlug']);
    Route::post('create',[EventController::class,'store'])
        ->middleware(['auth:sanctum', CheckAdmin::class]);
    Route::patch('update/{id}',[EventController::class,'update'])
        ->middleware(['auth:sanctum', CheckAdmin::class]);
    Route::delete('delete/{id}',[EventController::class,'destroy'])
        ->middleware(['auth:sanctum', CheckAdmin::class]);
    Route::post('assign-category/{event_id}/{category_id}',[EventController::class,'assignCategory'])
        ->middleware(['auth:sanctum', CheckAdmin::class]);
});

Route::group(['prefix' => 'tickets'], function() {
    Route::post('/', [TicketController::class, 'store']);
    Route::put('/{id}', [TicketController::class, 'update']);
    Route::delete('/{id}', [TicketController::class, 'destroy']);
});

Route::group(['prefix' => 'categories'], function() {
    Route::get('/', [CategoryController::class,'index']);
    Route::get('/{id}',[CategoryController::class,'show']);
    Route::post('create',[CategoryController::class,'store'])
        ->middleware(['auth:sanctum', CheckAdmin::class]);
    Route::patch('update/{id}',[CategoryController::class,'update'])
        ->middleware(['auth:sanctum', CheckAdmin::class]);
    Route::delete('delete/{id}',[CategoryController::class,'destroy'])
        ->middleware(['auth:sanctum', CheckAdmin::class]);
});
