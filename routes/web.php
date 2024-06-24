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
use App\Http\Controllers\Pages\TypologyController;
use App\Http\Controllers\Pages\BackupController;
use App\Http\Controllers\Pages\MSMController;
use App\Http\Controllers\Pages\TGController;
use App\Http\Controllers\Pages\PWIDController;
use App\Http\Controllers\Pages\AYPController;
use App\Http\Controllers\Pages\TCSController;
use App\Http\Controllers\Pages\PMTCTController;
use App\Http\Controllers\Pages\VPController;
use App\Http\Controllers\Pages\FisherFolkController;
use App\Http\Controllers\Pages\SettingsController;
use App\Http\Controllers\Pages\TwoFactorAuthController;
use App\Http\Controllers\Pages\KPIController;
use App\Http\Controllers\Users\RoleController;
use App\Http\Controllers\Users\PermissionController;

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
Route::group(['middleware' => ['auth','google2fa','activity']], function () {

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
            Route::get('reports/community_members-reached',[PagesController::class,'CommunityReached'])
            ->name('admin.reports.CommunityReached');
            Route::get('users/profile/changePassword',[PagesController::class,'changePassword'])
            ->name('admin.user.passwordchange');
            Route::post('users/profile/changePassword',[PagesController::class,'PasswordChange'])
            ->name('admin.user.password.change');

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
            Route::get('/pftarget',[PagesController::class,'pfTarget'])->name('admin.pftarget');
            Route::post('/pftarget',[GC7Controller::class,'uploadPFTarget'])->name('admin.pftarget.post');
            Route::post('/pftarget/{id}',[GC7Controller::class,'updateTarget'])->name('admin.pftarget.update');

            #user management routes
            Route::get('/users',[PagesController::class,'userManagement'])
            ->name('admin.users');
            Route::get('/users/newUser',[PagesController::class,'addUser'])
            ->name('admin.users.new');
            Route::get('/users/profile',[UserController::class,'userProfile'])
            ->name('admin.users.profile');
            Route::post('/users/newUser/create', [UserController::class, 'createUser'])
            ->name('admin.user.save');
            Route::get('/users/edit/{id}',[UserController::class,'editUser'])->name('admin.user.edit');
            Route::post('/users/edit/{id}',[UserController::class,'UpdateUser'])->name('admin.user.update');
            Route::post('user/delete/{id}',[UserController::class,'SoftDelete'])->name('admin.user.delete');
            Route::get('users/Trashed',[UserController::class,'viewDeleted'])->name('admin.user.trashed');
            Route::post('user/restore/{id}',[UserController::class,'restoreDeleted'])->name('admin.user.restore');
            Route::post('user/delete/parmanent/{id}',[UserController::class,'deleteParmanently'])->name('admin.user.delete.all');



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
            Route::get('/gbv/download/csv', [GBVController::class, 'downloadGBV'])
            ->name('admin.gbv.download');

            #Typology dataset
            Route::get('/typology/fsw', [PagesController::class, 'fswIndex'])
            ->name('admin.fsw.index');
            Route::get('/typology/reports', [PagesController::class, 'fswReports'])
            ->name('admin.fsw.report');
            Route::get('/typology/template/demo', [PagesController::class, 'demoTemplate'])
            ->name('admin.fsw.template.demo');
             Route::get('/typology/template/fsw', [PagesController::class, 'fswTemplate'])
            ->name('admin.fsw.template.fsw');
            Route::post('/typology/demo/upload', [TypologyController::class, 'uploadDemo'])
            ->name('admin.fsw.demo.post')->middleware('check.upload.period');
            Route::post('/typology/fsw/upload', [TypologyController::class, 'uploadPartInfo'])
            ->name('admin.fsw.fsw.post')->middleware('check.upload.period');
            Route::get('/typology/demo/download-csv', [TypologyController::class, 'downloadCSV'])
            ->name('fsw.download-demographics-csv');
            Route::get('/typology/demo/download-excel', [TypologyController::class, 'downloadExcel'])->name('fsw.download-demographics-excel');
            Route::get('typology/data', [PagesController::class, 'fetchDemographics'])->name('demographics.data');
            Route::get('typology/export', [PagesController::class, 'export'])->name('demographics.export');

            #DOWNLOADING DATASET
            Route::get('typology/consolidated', [TypologyController::class, 'RetrieveAllData'])->name('admin.fsw.consolidated');
            Route::get('typology/msm/consolidated', [TypologyController::class, 'FetchMSMData'])->name('admin.msm.consolidated');
            Route::get('typology/tg/consolidated', [TypologyController::class, 'FetchTGData'])->name('admin.tg.consolidated');
            Route::get('typology/pwid/consolidated', [TypologyController::class, 'FetchPWIDData'])->name('admin.pwid.consolidated');

            #MSM routes
            Route::get('/typology/msm/reports', [MSMController::class, 'indexMSM'])
            ->name('admin.msm.report');

            #PWID ROUTES
            Route::get('/typology/pwid/home', [PWIDController::class, 'indexPWID'])
            ->name('admin.pwid.index');

            #VP routes
            Route::get('/typology/vp/home', [PagesController::class, 'vpIndex'])
            ->name('admin.vp.index');
             Route::get('/typology/VP/dcTemplate', [VPController::class, 'dcTemplate'])
            ->name('admin.vp.dc.template');
            Route::post('/typology/VP/upload', [VPController::class, 'uploadDC'])
            ->name('admin.vp.dc.upload')->middleware('check.upload.period');
            Route::get('/typology/VP/reports', [VPController::class, 'DCReports'])
            ->name('admin.vp.dc.reports');
            Route::get('/typology/VP/reports/download', [VPController::class, 'DCData'])
            ->name('admin.vp.dc.reports.download');
            Route::get('/typology/VP/Eban/demoTemplate', [VPController::class, 'EbanDemo'])
            ->name('admin.vp.eban.demo');
            Route::get('/typology/VP/Eban/serviceTemplate', [VPController::class, 'ServiceDemo'])
            ->name('admin.vp.eban.service');
            Route::get('/typology/VP/reports/Eban', [VPController::class, 'EbanReport'])
            ->name('admin.vp.eban.reports');
            Route::post('/typology/VP/Eban/demo/upload', [VPController::class, 'uploadEbanDemo'])
            ->name('admin.vp.eban.demo.upload')->middleware('check.upload.period');
             Route::post('/typology/VP/Eban/service/upload', [VPController::class, 'uploadEbanService'])
            ->name('admin.vp.eban.service.upload')->middleware('check.upload.period');
            Route::get('/typology/VP/reports/eban/download', [VPController::class, 'ebanDownload'])
            ->name('admin.vp.reports.eban.download');

            ##VP Fisherfolkes route
            Route::get('/typology/vp/fisherfolks',[FisherFolkController::class,'indexFF'])
            ->name('admin.typology.vp.ff');
             Route::get('/typology/vp/report/fisherfolks',[FisherFolkController::class,'FetchFFData'])
            ->name('admin.typology.vp.ff.download');


            #reions Route
            Route::get('/region/home',[RegionController::class,'index'])->name('admin.region.index');
            Route::get('/get-counts', [RegionController::class, 'getCounts'])->name('get-counts');
            Route::get('/update-chart', [RegionController::class, 'displayageChart'])->name('agechart.fetch');
            Route::get('/update-region', [RegionController::class, 'fetchByRegion'])->name('regionchart.fetch');
            Route::get('/update-hiv-freq', [RegionController::class, 'fetchByHivFreq'])->name('hivfreqchart.fetch');
            Route::get('/update-hiv-status', [RegionController::class, 'fetchByHivStatus'])->name('hivStatuschart.fetch');
            Route::get('/update-currently-art', [RegionController::class, 'CurrentlyArt'])->name('cartchart.fetch');
            Route::get('/update-care-outcome', [RegionController::class, 'CareOutcome'])->name('carechart.fetch');
            Route::get('/update-peer-education', [RegionController::class, 'PeerEducation'])->name('peereducation.fetch');
            Route::get('/update-sti-screened', [RegionController::class, 'StiScreened'])->name('stiscreened.fetch');
            Route::get('/update-tb-screened', [RegionController::class, 'TbScreened'])->name('tbscreened.fetch');
            Route::get('/update-sr-names', [RegionController::class, 'SRnames'])->name('srname.fetch');

            #TG Routes
            Route::get('/typology/TG/home', [TGController::class, 'indexTG'])
            ->name('admin.tg.index');

            #AYP ROUTES
            Route::get('/typology/AYP/home', [AYPController::class, 'AYPindex'])
            ->name('admin.ayp.index');
            Route::post('/typology/AYP/demo', [AYPController::class, 'uploadDemo'])
            ->name('admin.ayp.post.demo')->middleware('check.upload.period');
            Route::get('/typology/AYP/template', [AYPController::class, 'aypTemplate'])
            ->name('admin.ayp.template');
            Route::get('/typology/AYP/reports', [AYPController::class, 'aypReports'])
            ->name('admin.ayp.reports');
            Route::get('/typology/AYP/reports/download', [AYPController::class, 'AYPData'])
            ->name('admin.ayp.reports.download');
            Route::get('/typology/AYP/template/Mentorship', [AYPController::class, 'aypMentorshipTemplate'])
            ->name('admin.ayp.template.mentorship');
            Route::post('/typology/AYP/upload/Mentorship', [AYPController::class, 'uploadAYPMentorship'])
            ->name('admin.ayp.upload.mentorship')->middleware('check.upload.period');
            Route::get('/typology/AYP/mentorship/download', [AYPController::class, 'AYPMentorshipData'])
            ->name('admin.ayp.reports.mentorship');
            Route::get('/typology/AYP/Template/HCBF',[AYPController::class,'aypHCBFTemplate'])
            ->name('admin.ayp.template.hcbf');
            Route::post('/typology/AYP/upload/HCBF',[AYPController::class,'uploadHCBF'])
            ->name('admin.ayp.upload.hcbf')->middleware('check.upload.period');
            Route::get('/typology/AYP/Reports/HCBF',[AYPController::class,'AYPHCBFData'])
            ->name('admin.ayp.download.hcbf');
            Route::get('/typology/AYP/Template/MHMC',[AYPController::class,'aypMHMCTemplate'])
            ->name('admin.ayp.template.mhmc');
            Route::post('/typology/AYP/upload/MHMC',[AYPController::class,'uploadMHMC'])
            ->name('admin.ayp.upload.mhmc')->middleware('check.upload.period');
            Route::get('/typology/AYP/Reports/MHMC',[AYPController::class,'AYPMHMCData'])
            ->name('admin.ayp.download.mhmc');



            #TCS Routes
            Route::get('/typology/TCS/home', [TCSController::class, 'indexTCS'])
            ->name('admin.tcs.index');
            Route::get('/typology/TCS/reports', [TCSController::class, 'TCSReports'])
            ->name('admin.tcs.reports');
            Route::get('/typology/TCS/template', [TCSController::class, 'tcsTemplate'])
            ->name('admin.tcs.template');
            Route::post('/typology/TCS/upload', [TCSController::class, 'uploadTCS'])
            ->name('admin.tcs.data.upload')->middleware('check.upload.period');
            Route::get('/typology/TCS/visualize', [TCSController::class, 'tcsvisualize'])
            ->name('admin.tcs.data.visualize');
            Route::get('/typology/TCS/download', [TCSController::class, 'TCSdata'])
            ->name('admin.tcs.data.download');

            #PMTCT Routes
            Route::get('/typology/PMTCT/home', [PMTCTController::class, 'pmtctTemplate'])
            ->name('admin.pmtct.index');
            Route::post('/typology/PMTCT/home', [PMTCTController::class, 'uploadPmtct'])
            ->name('admin.pmtct.post')->middleware('check.upload.period');
            Route::get('/typology/PMTCT/report', [PMTCTController::class, 'pmtctReports'])
            ->name('admin.pmtct.reports');
            Route::get('/typology/PMTCT/report/download', [PMTCTController::class, 'PMTCTData'])
            ->name('admin.pmtct.reports.download');

            #VP ROUTES
           

#backup routes
            Route::get('/database/backup',[PagesController::class,'backups'])->name('admin.db.backup');
            Route::post('/database/backup',[BackupController::class,'backup'])->name('admin.db.backup.post');

        #for settings controller
            Route::get('/admin/manage/settings',[SettingsController::class,'index'])
            ->name('admin.manage.settings');
            Route::post('/admin/manage/settings',[SettingsController::class,'storeUploadSetting'])
            ->name('admin.manage.settings.save');
            Route::post('/admin/update/settings/{id}',[SettingsController::class,'updateSetting'])
            ->name('admin.manage.settings.update');

            #KPI CONTROLLER
            Route::get('/admin/kpi',[KPIController::class,'index'])->name('kpi.index');

            #ROLE CONTRLLER SETTINGS
            Route::get('/users/roles',[RoleController::class,'index'])->name('admin.users.role.index');
            Route::get('/users/roles/create',[RoleController::class,'create'])->name('admin.users.role.create');
            Route::post('/users/roles/store',[RoleController::class,'store'])->name('admin.users.role.store');
            Route::get('/users/roles/edit/{id}',[RoleController::class,'edit'])->name('admin.users.role.edit');
            Route::put('/users/roles/edit/{id}',[RoleController::class,'update'])->name('admin.users.role.update');
            Route::post('/users/roles/destroy/{id}',[RoleController::class,'destroy'])->name('admin.users.role.destroy');
            
              #PERMISSION CONTRLLER SETTINGS
            Route::get('/users/permissions',[PermissionController::class,'index'])->name('admin.users.permission.index');
            Route::get('/users/permission/create',[PermissionController::class,'create'])->name('admin.users.permission.create');
            Route::post('/users/permission/store',[PermissionController::class,'store'])->name('admin.users.permission.store');
            Route::get('/users/permission/edit/{id}',[PermissionController::class,'edit'])->name('admin.users.permission.edit');
            Route::put('/users/permission/edit/{id}',[PermissionController::class,'update'])->name('admin.users.permission.update');
            Route::post('/users/permission/destroy/{id}',[PermissionController::class,'destroy'])->name('admin.users.permission.destroy');


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

    #TWO factor aunthenticatoom

    Route::get('/2fa/setup', [TwoFactorAuthController::class,'show2faForm'])->name('2fa.setup');
    Route::post('/2fa/setup', [TwoFactorAuthController::class,'verifyGoogleAuthenticator'])->name('2fa.verify');

   




});

