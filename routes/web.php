<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pages\PagesController;
use App\Http\Controllers\Pages\TargetController;
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


Route::get('/',function(){
    return view('auth.login');
});


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

#Dashboard routes
Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'admin/dashboard'],function(){
            #dashboard routes
            Route::get('/',[PagesController::class,'dashboard'])->name('admin.dashboard');
            Route::get('/target', [PagesController::class,'targetIndex'])->name('admin.target');
            Route::get('/target/all', [PagesController::class,'AllTargets'])->name('admin.target.all');
            // Target Contoller routes here...
            Route::post('/target/save',[TargetController::class,'uploadTarget'])->name('target.save');

    });


});
