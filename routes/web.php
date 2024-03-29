<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pages\PagesController;
use App\Http\Controllers\Pages\TargetController;
use App\Http\Controllers\Pages\RegionController;
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
            Route::get('target/reports',[PagesController::class,'TargetReports'])->name('admin.target.reports');
            #indicator reports
            Route::get('target/reports/msm',[PagesController::class,'msmdata'])->name('admin.target.reports.msm');
              Route::get('target/reports/fsw',[PagesController::class,'fswdata'])->name('admin.target.reports.fsw');
              Route::get('target/reports/pwid',[PagesController::class,'pwiddata'])->name('admin.target.reports.pwid');
              Route::get('target/reports/tg',[PagesController::class,'tgdata'])->name('admin.target.reports.tg');
              Route::get('target/reports/tcs',[PagesController::class,'tcsdata'])->name('admin.target.reports.tcs');

            // Target Contoller routes here...
            Route::post('/target/save',[TargetController::class,'uploadTarget'])->name('target.save');

            #regions route
            Route::get('/regions', [PagesController::class,'regions'])->name('admin.regions');
            Route::get('/regions/add', [PagesController::class,'addRegion'])->name('admin.regions.add');
            Route::post('/regions/add', [RegionController::class,'saveRegion'])->name('admin.regions.save');

    });


});
