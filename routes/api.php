<?php

use App\Http\Controllers\Api\App\ApartmentController;
use App\Http\Controllers\Api\App\ApartmentImageController;
use App\Http\Controllers\Api\App\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\App\BannerController;
use App\Http\Controllers\Api\App\CompoundController;
use App\Http\Controllers\Api\App\CompoundImageController;
use App\Http\Controllers\Api\App\FeaturedController;
use App\Http\Controllers\Api\App\OutdoorFacilitiesController;
use App\Http\Controllers\Api\App\ParentCatController;
use App\Http\Controllers\auth\ForgotPasswordController;
use App\Http\Controllers\auth\ResetPasswordController;
use App\Models\Apartment;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware(['ApiRequest' , 'LangCheck'])->group(function(){
    Route::controller(AuthController::class)->group(function(){

        Route::post('profile','profile')->middleware('auth:sanctum');
        Route::post('register','register')->middleware('unAuth');
        Route::post('login','login')->middleware('unAuth');
        Route::post('update-me','updateMe')->middleware('auth:sanctum');
        Route::post('change-password','changePassword')->middleware('auth:sanctum');
        Route::post('logout','logout')->middleware('auth:sanctum');
        Route::post('forgot-password','forgotPassword')->middleware('unAuth');

    });
    Route::controller(ParentCatController::class)->group(function(){
        Route::get('parent-cats','index');
        Route::get('parent-cats/{id}','show'); // dev
        Route::post('parent-cats','store'); // dev
        Route::put('parent-cats/{id}','update'); // dev
        // Route::delete('parent-cats/{id}','destroy'); // dev
    });
    Route::controller(CategoryController::class)->group(function(){
        Route::get('categories','index');
        Route::get('categories/{id}','show'); //dev
        Route::post('categories','store'); // dev
        Route::put('categories/{id}','update'); // dev
        Route::delete('categories/{id}','destroy'); // dev
    });
    Route::controller(BannerController::class)->group(function(){
        Route::get('banners','index');
        Route::get('banners/{id}','show'); // dev
        Route::post('banners','store'); // dev
        Route::put('banners/{id}','update'); //dev
        Route::delete('banners/{id}','destroy'); //dev
    });
    Route::controller(CompoundController::class)->group(function(){
        Route::get('compounds','index');
        Route::get('compounds/{id}','show'); // dev
        Route::post('compounds','store'); // dev
        Route::put('compounds/{id}','update'); // dev
        Route::delete('compounds/{id}','destroy'); // dev
    });
    Route::controller(CompoundImageController::class)->group(function(){
        Route::get('compound-images','index');
        Route::get('compound-images/{id}','show'); // dev
        Route::post('compound-images','store'); // dev
        Route::put('compound-images/{id}','update'); // dev
        Route::delete('compound-images/{id}','destroy'); // dev
    });
    Route::controller(ApartmentController::class)->group(function(){
        Route::get('apartments','index');
        Route::get('apartments/{id}','show'); // dev
        Route::post('apartments','store'); // dev
        Route::put('apartments/{id}','update'); // dev
        Route::delete('apartments/{id}','destroy'); // dev
        Route::post('apartments-by-category/{id}','getApartmentsByCategoryId');
    });
    Route::controller(ApartmentImageController::class)->group(function(){
        Route::get('apartment-images','index');
        Route::get('apartment-images/{id}','show'); // dev
        Route::post('apartment-images','store'); // dev
        Route::put('apartment-images/{id}','update'); // dev
        Route::delete('apartment-images/{id}','destroy'); // dev
    });
    Route::controller(OutdoorFacilitiesController::class)->group(function(){
        Route::get('outdoor-facilities','index');
        Route::get('outdoor-facilities/{id}','show'); // dev
        Route::post('outdoor-facilities','store'); // dev
        Route::put('outdoor-facilities/{id}','update'); // dev
        Route::delete('outdoor-facilities/{id}','destroy'); // dev
        Route::get('outdoor-facilities-by-apartment/{id}','getOutdoorFacilitiesByApartmentId'); // dev
    });
    Route::controller(FeaturedController::class)->group(function(){
        Route::get('featureds' , 'index');
        Route::post('featureds' , 'store');
        Route::put('featureds/{id}' , 'update');
        Route::delete('featured/{id}' , 'delete');
    });

});
