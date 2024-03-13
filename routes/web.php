<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pages\PagesController;
use App\Http\Controllers\Pages\TargetController;
use App\Http\Controllers\Pages\RegionController;
use App\Http\Controllers\Pages\GC7Controller;
use App\Http\Controllers\Pages\UserController;
use App\Http\Controllers\Pages\QPMMController;
use App\Http\Controllers\Pages\HRGController;
use App\Http\Controllers\Pages\GBVController;
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

Auth::routes(['register' => false]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

#Dashboard routes
Route::group(['middleware' => ['auth','activity']], function () {

    Route::group(['prefix' => 'admin/dashboard'],function(){
            #dashboard routes
            Route::get('/',[PagesController::class,'dashboard'])
            ->name('admin.dashboard');
            Route::get('/target', [PagesController::class,'targetIndex'])
            ->name('admin.target');
            Route::get('/target/template', [PagesController::class,'TargetTemplate'])
            ->name('admin.target.template');
            Route::get('/target/all', [PagesController::class,'AllTargets'])
            ->name('admin.target.all');
            Route::get('target/reports',[PagesController::class,'TargetReports'])
            ->name('admin.target.reports');
            #indicator reports
            Route::get('target/reports/msm',[PagesController::class,'msmdata'])
            ->name('admin.target.reports.msm');
            Route::get('target/reports/fsw',[PagesController::class,'fswdata'])
              ->name('admin.target.reports.fsw');
            Route::get('target/reports/pwid',[PagesController::class,'pwiddata'])
            ->name('admin.target.reports.pwid');
            Route::get('target/reports/tg',[PagesController::class,'tgdata'])
            ->name('admin.target.reports.tg');
            Route::get('target/reports/tcs',[PagesController::class,'tcsdata'])
            ->name('admin.target.reports.tcs');

            // Target Contoller routes here...
            Route::post('/target/save',[TargetController::class,'uploadTarget'])
            ->name('target.save');

            #regions route
            Route::get('/regions', [PagesController::class,'regions'])
            ->name('admin.regions');
            Route::get('/regions/add', [PagesController::class,'addRegion'])
            ->name('admin.regions.add');
            Route::post('/regions/add', [RegionController::class,'saveRegion'])
            ->name('admin.regions.save');

            #GC7 COVERAHE ROUTES
            Route::get('/gc7-coverage', [PagesController::class,'gc7'])
            ->name('admin.gc7');
            Route::get('/gc7-coverage/areas', [PagesController::class,'coverage'])
            ->name('admin.coverage');
            Route::post('/gc7-coverage/post',[GC7Controller::class,'uploadCoverage'])
            ->name('admin.coverage.post');

            #user management routes
            Route::get('/users',[PagesController::class,'userManagement'])
            ->name('admin.users');
            Route::get('/users/newUser',[PagesController::class,'addUser'])
            ->name('admin.users.new');
            Route::post('/users/newUser/create', [UserController::class, 'createUser'])
            ->name('admin.user.save');
            Route::get('/users/edit/{id}',[UserController::class,'editUser'])->name('admin.user.edit');
            Route::post('/users/edit/{id}',[UserController::class,'UpdateUser'])->name('admin.user.update');

            #QPMM routes
            Route::get('/qpmm', [PagesController::class, 'qpmm'])
            ->name('admin.qpmm');
            Route::get('/qpmm/reports', [PagesController::class, 'qpmmReports'])
            ->name('admin.reports');
            Route::get('/qpmm/reports/agyw', [PagesController::class, 'agywReport'])
            ->name('admin.reports.agyw');
            Route::get('/qpmm/reports/all',[PagesController::class,'allReports'])
            ->name('admin.qpmm.allreports');
             Route::post('/qpmm/upload', [QPMMController::class, 'uploadQpmm'])
            ->name('admin.qpmm.upload');
            Route::get('/qpmm/reports/tcs', [PagesController::class, 'TcsReport'])
            ->name('admin.reports.tcs');
             Route::get('/qpmm/reports/pmtct', [PagesController::class, 'PmtcTReport'])
            ->name('admin.reports.pmtct');
            Route::get('/qpmm/reports/fsw', [PagesController::class, 'FswReport'])
            ->name('admin.reports.fsw');
            Route::get('/qpmm/reports/msm', [PagesController::class, 'MsmReport'])
            ->name('admin.reports.msm');
            Route::get('/qpmm/reports/pwid', [PagesController::class, 'PwidReport'])
            ->name('admin.reports.pwid');
            Route::get('/qpmm/reports/tg', [PagesController::class, 'TgReport'])
            ->name('admin.reports.tg');
            Route::get('/qpmm/reports/truckers', [PagesController::class, 'TruckersReport'])
            ->name('admin.reports.truckers');
            Route::get('/qpmm/reports/fisherfolk', [PagesController::class, 'FisherfolksReport'])
            ->name('admin.reports.fisherfolk');
            Route::get('/qpmm/reports/dc', [PagesController::class, 'DcReport'])
            ->name('admin.reports.dc');
            Route::get('/qpmm/reports/mhrs', [PagesController::class, 'MhrsReport'])
            ->name('admin.reports.mhrs');

            #hrg routes
             Route::get('/hrg', [PagesController::class, 'hrgIndex'])
            ->name('admin.hrg.index');
            Route::get('/hrg/consolidated', [PagesController::class, 'hrgConsolidated'])
            ->name('admin.hrg.consolidated');

            #GBV data routes
            Route::get('/gbv', [PagesController::class, 'gbvIndex'])
            ->name('admin.gbv.index');
            Route::get('/gbv/consolidated', [PagesController::class, 'gbvConsolidated'])
            ->name('admin.gbv.consolidated');
            Route::get('/gbv/template', [PagesController::class, 'gbvTemplate'])
            ->name('admin.gbv.template');
            Route::get('/gbv/visualization', [PagesController::class, 'gbvVisualize'])
            ->name('admin.gbv.visualize');
             Route::post('/gbv/upload', [GBVController::class, 'uploadGBV'])
            ->name('admin.gbv.post');




    });
    #User activity Logs
    Route::group(['prefix' => 'activity', 'namespace' => 'jeremykenedy\LaravelLogger\App\Http\Controllers', 'middleware' => ['auth', 'activity']], function () {

    // Dashboards
    Route::get('/', 'LaravelLoggerController@showAccessLog')->name('activity');
    Route::get('/cleared', ['uses' => 'LaravelLoggerController@showClearedActivityLog'])->name('cleared');

    // Drill Downs
    Route::get('/log/{id}', 'LaravelLoggerController@showAccessLogEntry');
    Route::get('/cleared/log/{id}', 'LaravelLoggerController@showClearedAccessLogEntry');

    // Forms
    Route::delete('/clear-activity', ['uses' => 'LaravelLoggerController@clearActivityLog'])->name('clear-activity');
    Route::delete('/destroy-activity', ['uses' => 'LaravelLoggerController@destroyActivityLog'])->name('destroy-activity');
    Route::post('/restore-log', ['uses' => 'LaravelLoggerController@restoreClearedActivityLog'])->name('restore-activity');
});


});

