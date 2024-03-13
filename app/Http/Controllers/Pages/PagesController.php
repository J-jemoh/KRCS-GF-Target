<?php

namespace App\Http\Controllers\Pages;
use ConsoleTVs\Charts\Classes\Chartjs\BarChart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Target;
use App\Models\Regions;
use App\Models\User;
use App\Models\GC7Coverage;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use App\Models\QPMM;
use App\Models\GBV;

class PagesController extends Controller
{

    public function dashboard():View{
        $threshold = Carbon::now()->subMinutes(5); 
        $barData = Target::select('reqion', 'module')
                        ->selectRaw('avg(defined_performance) as avg_performance')
                        ->groupBy('reqion', 'module')
                        ->get();
        $barDataHts = Target::select('reqion', 'module')
                        ->selectRaw('avg(hts_performance) as avg_performance_hts')
                        ->groupBy('reqion', 'module')
                        ->get();
        $barDataPrep = Target::select('reqion', 'module')
                        ->selectRaw('avg(prep_performance) as avg_performance_prep')
                        ->groupBy('reqion', 'module')
                        ->get();
        $users=User::orderBy('created_at','desc')->limit(5)->get();
         return view('dashboard',compact('barData','barDataHts','barDataPrep','users','threshold'));

    }
    public function targetIndex():View{
        return view('pages.target.index');
    }
    public function AllTargets():View{
        $targets=Target::get();
        $counties = $targets->pluck('county')->unique()->count();
        $regions = $targets->pluck('reqion')->unique()->count();
        $sr = $targets->pluck('sr')->unique()->count();
        $barALL = Target::select('reqion', 'module')
                        ->selectRaw('avg(defined_performance) as avg_performance')
                        ->groupBy('reqion','module')
                        ->get();
        return view('pages.target.allTargets',compact('targets','counties','regions','sr','barALL'));
    }
    public function TargetReports():View{

        return view('pages.target.reports');
    }
    public function msmdata(){
        $msmdata=Target::where('module','MSM')->get();
        $counties = $msmdata->pluck('county')->unique()->count();
        $regions = $msmdata->pluck('reqion')->unique()->count();
        $sr = $msmdata->pluck('sr')->unique()->count();
        $barMSM = Target::select('reqion', 'module')
                        ->where('module','MSM')
                        ->selectRaw('avg(defined_performance) as avg_performance')
                        ->groupBy('reqion','module')
                        ->get();
        $barMSMCounty = Target::select('county', 'module')
                        ->where('module','MSM')
                        ->selectRaw('avg(defined_performance) as avg_performance')
                        ->groupBy('module','county')
                        ->get();
        return view('pages.target.msm',compact('msmdata','counties','regions','sr','barMSM','barMSMCounty'));
    }
    public function fswdata(){
        $fswdata=Target::where('module','FSW')->get();
        $counties = $fswdata->pluck('county')->unique()->count();
        $regions = $fswdata->pluck('reqion')->unique()->count();
        $sr = $fswdata->pluck('sr')->unique()->count();
        $barFSW = Target::select('reqion', 'module')
                        ->where('module','FSW')
                        ->selectRaw('avg(defined_performance) as avg_performance')
                        ->groupBy('reqion','module')
                        ->get();
        $barFSWCounty = Target::select('county', 'module')
                        ->where('module','FSW')
                        ->selectRaw('avg(defined_performance) as avg_performance')
                        ->groupBy('module','county')
                        ->get();
        return view('pages.target.fsw',compact('fswdata','counties','regions','sr','barFSW','barFSWCounty'));
    }
    public function pwiddata(){
        $pwiddata=Target::where('module','PWID')->get();
        $counties = $pwiddata->pluck('county')->unique()->count();
        $regions = $pwiddata->pluck('reqion')->unique()->count();
        $sr = $pwiddata->pluck('sr')->unique()->count();
        $barPWID = Target::select('reqion', 'module')
                        ->where('module','PWID')
                        ->selectRaw('avg(defined_performance) as avg_performance')
                        ->groupBy('reqion','module')
                        ->get();
        $barPWIDCounty = Target::select('county', 'module')
                        ->where('module','PWID')
                        ->selectRaw('avg(defined_performance) as avg_performance')
                        ->groupBy('module','county')
                        ->get();
        return view('pages.target.pwid',compact('pwiddata','counties','regions','sr','barPWID','barPWIDCounty'));
    }
    public function tgdata(){
        $tgdata=Target::where('module','TG')->get();
        $counties = $tgdata->pluck('county')->unique()->count();
        $regions = $tgdata->pluck('reqion')->unique()->count();
        $sr = $tgdata->pluck('sr')->unique()->count();
        $barTG = Target::select('reqion', 'module')
                        ->where('module','TG')
                        ->selectRaw('avg(defined_performance) as avg_performance')
                        ->groupBy('reqion','module')
                        ->get();
        $barTGCounty = Target::select('county', 'module')
                        ->where('module','TG')
                        ->selectRaw('avg(defined_performance) as avg_performance')
                        ->groupBy('module','county')
                        ->get();
        return view('pages.target.tg',compact('tgdata','counties','regions','sr','barTG','barTGCounty'));
    }
    public function tcsdata(){
        $tcsdata=Target::where('module','TCS')->get();
        $counties = $tcsdata->pluck('county')->unique()->count();
        $regions = $tcsdata->pluck('reqion')->unique()->count();
        $sr = $tcsdata->pluck('sr')->unique()->count();
        $barTCS = Target::select('reqion', 'module')
                        ->where('module','TCS')
                        ->selectRaw('avg(defined_performance) as avg_performance')
                        ->groupBy('reqion','module')
                        ->get();
        $barTCSCounty = Target::select('county', 'module')
                        ->where('module','TCS')
                        ->selectRaw('avg(defined_performance) as avg_performance')
                        ->groupBy('module','county')
                        ->get();
        return view('pages.target.tcs',compact('tcsdata','counties','regions','sr','barTCS','barTCSCounty'));
    }
    public function regions(){
        $regions=Regions::get();
        return view('regions.index',compact('regions'));
    }
    public function addRegion(){
        $regionNumber = random_int(0, 999);
        return view('regions.addRegion',compact('regionNumber'));
    }
    public function gc7(){
        return view('pages.gc7.index');
    }
    public function coverage(){
        $coverages=GC7Coverage::get();
        $dhts = GC7Coverage::where('dhts', 'Yes')->select('county')->distinct()->count();
        $tcs = GC7Coverage::where('tcs', 'Yes')->select('county')->distinct()->count();
        $pmtct = GC7Coverage::where('pmtct', 'Yes')->select('county')->distinct()->count();
        $ayp = GC7Coverage::where('ayp', 'Yes')->select('county')->distinct()->count();
        $msm = GC7Coverage::where('msm', 'Yes')->select('county')->distinct()->count();
        $fsw = GC7Coverage::where('fsw', 'Yes')->select('county')->distinct()->count();
        $tg = GC7Coverage::where('tg', 'Yes')->select('county')->distinct()->count();
        $pwid = GC7Coverage::where('pwid', 'Yes')->select('county')->distinct()->count();
        $hrg = GC7Coverage::where('hrg', 'Yes')->select('county')->distinct()->count();
        $ff = GC7Coverage::where('ff', 'Yes')->select('county')->distinct()->count();
        $truckers = GC7Coverage::where('truckers', 'Yes')->select('county')->distinct()->count();
        $dc = GC7Coverage::where('dc', 'Yes')->select('county')->distinct()->count();
        $prison = GC7Coverage::where('prison', 'Yes')->select('county')->distinct()->count();
        $total = $dhts + $tcs + $pmtct + $ayp + $msm + $fsw + $tg + $pwid + $hrg + $ff + $truckers + $dc + $prison;

        #for bar chart
        $modules = [
        'dhts' => GC7Coverage::where('dhts', 'Yes')->select('county')->distinct()->count(),
        'tcs' => GC7Coverage::where('tcs', 'Yes')->select('county')->distinct()->count(),
        'pmtct' => GC7Coverage::where('pmtct', 'Yes')->select('county')->distinct()->count(),
        'ayp' => GC7Coverage::where('ayp', 'Yes')->select('county')->distinct()->count(),
        'msm' => GC7Coverage::where('msm', 'Yes')->select('county')->distinct()->count(),
        'fsw' => GC7Coverage::where('fsw', 'Yes')->select('county')->distinct()->count(),
        'tg' => GC7Coverage::where('tg', 'Yes')->select('county')->distinct()->count(),
        'pwid' => GC7Coverage::where('pwid', 'Yes')->select('county')->distinct()->count(),
        'hrg' => GC7Coverage::where('hrg', 'Yes')->select('county')->distinct()->count(),
        'ff' => GC7Coverage::where('ff', 'Yes')->select('county')->distinct()->count(),
        'truckers' => GC7Coverage::where('truckers', 'Yes')->select('county')->distinct()->count(),
        'dc' => GC7Coverage::where('dc', 'Yes')->select('county')->distinct()->count(),
        'prison' => GC7Coverage::where('prison', 'Yes')->select('county')->distinct()->count(),
    ];

    $totalm = array_sum($modules);
        #
        return view('pages.gc7.coverage',compact('coverages','dhts','tcs','pmtct','ayp','msm','fsw','tg','pwid','hrg','ff','truckers','dc','prison','total','modules','totalm'));
    }
    public function userManagement(){
        $users=User::get();
        return view('pages.users.index',compact('users'));
    }
    public function addUser(){
        $regions=Regions::get();
        $roles = Role::get();
        return view('pages.users.newUser',compact('regions','roles'));
    }
    public function qpmm(){
        return view('pages.qpmm.index');
    }
    public function qpmmReports(){
        return view('pages.qpmm.reports');
    }
    public function agywReport(){
        $agyw=QPMM::where('target_group','AGYW')->get();
        $barPt = QPMM::select('region', 'target_group')
                        ->where('target_group','AGYW')
                        ->selectRaw('avg(pt_total) as avg_pt_total')
                        ->groupBy('region','target_group')
                        ->get();
        $barPa = QPMM::select('region', 'target_group')
                        ->where('target_group','AGYW')
                        ->selectRaw('avg(pa_total) as avg_pa_total')
                        ->groupBy('region','target_group')
                        ->get();
        $barCombined = QPMM::select('region', 'target_group')
                        ->where('target_group','AGYW')
                        ->selectRaw('avg(pa_total) as avg_pa_total')
                        ->selectRaw('avg(pt_total) as avg_pt_total')
                        ->groupBy('region','target_group')
                        ->get();
        return view('pages.qpmm.agyw',compact('agyw','barPt','barPa','barCombined'));
    }
    public function allReports(){
        $qpmms=QPMM::get();
        $barPt = QPMM::select('region', 'target_group')
                        ->selectRaw('avg(pt_total) as avg_pt_total')
                        ->groupBy('region','target_group')
                        ->get();
        $barPa = QPMM::select('region', 'target_group')
                        ->selectRaw('avg(pa_total) as avg_pa_total')
                        ->groupBy('region','target_group')
                        ->get();
        $barCombined = QPMM::select('region', 'target_group')
                        ->selectRaw('avg(pa_total) as avg_pa_total')
                        ->selectRaw('avg(pt_total) as avg_pt_total')
                        ->groupBy('region','target_group')
                        ->get();
        return view('pages.qpmm.allReports',compact('qpmms','barPt','barPa','barCombined'));
    }
    public function TargetTemplate(){
        return view('pages.target.template');
    }
    public function TcsReport(){
        $tcs=QPMM::where('target_group','TCS')->get();
        $barPt = QPMM::select('region', 'target_group')
                        ->where('target_group','TCS')
                        ->selectRaw('avg(pt_total) as avg_pt_total')
                        ->groupBy('region','target_group')
                        ->get();
        $barPa = QPMM::select('region', 'target_group')
                        ->where('target_group','TCS')
                        ->selectRaw('avg(pa_total) as avg_pa_total')
                        ->groupBy('region','target_group')
                        ->get();
        $barCombined = QPMM::select('region', 'target_group')
                        ->where('target_group','TCS')
                        ->selectRaw('avg(pa_total) as avg_pa_total')
                        ->selectRaw('avg(pt_total) as avg_pt_total')
                        ->groupBy('region','target_group')
                        ->get();
        return view('pages.qpmm.tcs',compact('tcs','barPt','barPa','barCombined'));
    }
    public function PmtcTReport(){
        $pmtct=QPMM::where('target_group','PMTCT')->get();
        $barPt = QPMM::select('region', 'target_group')
                        ->where('target_group','PMTCT')
                        ->selectRaw('avg(pt_total) as avg_pt_total')
                        ->groupBy('region','target_group')
                        ->get();
        $barPa = QPMM::select('region', 'target_group')
                        ->where('target_group','PMTCT')
                        ->selectRaw('avg(pa_total) as avg_pa_total')
                        ->groupBy('region','target_group')
                        ->get();
        $barCombined = QPMM::select('region', 'target_group')
                        ->where('target_group','PMTCT')
                        ->selectRaw('avg(pa_total) as avg_pa_total')
                        ->selectRaw('avg(pt_total) as avg_pt_total')
                        ->groupBy('region','target_group')
                        ->get();
        return view('pages.qpmm.pmtct',compact('pmtct','barPt','barPa','barCombined'));
    }
    public function FswReport(){
        $fsw=QPMM::where('target_group','FSW')->get();
        $barPt = QPMM::select('region', 'target_group')
                        ->where('target_group','FSW')
                        ->selectRaw('avg(pt_total) as avg_pt_total')
                        ->groupBy('region','target_group')
                        ->get();
        $barPa = QPMM::select('region', 'target_group')
                        ->where('target_group','FSW')
                        ->selectRaw('avg(pa_total) as avg_pa_total')
                        ->groupBy('region','target_group')
                        ->get();
        $barCombined = QPMM::select('region', 'target_group')
                        ->where('target_group','FSW')
                        ->selectRaw('avg(pa_total) as avg_pa_total')
                        ->selectRaw('avg(pt_total) as avg_pt_total')
                        ->groupBy('region','target_group')
                        ->get();
        return view('pages.qpmm.fsw',compact('fsw','barPt','barPa','barCombined'));
    }
    public function MsmReport(){
        $msm=QPMM::where('target_group','MSM')->get();
        $barPt = QPMM::select('region', 'target_group')
                        ->where('target_group','MSM')
                        ->selectRaw('avg(pt_total) as avg_pt_total')
                        ->groupBy('region','target_group')
                        ->get();
        $barPa = QPMM::select('region', 'target_group')
                        ->where('target_group','MSM')
                        ->selectRaw('avg(pa_total) as avg_pa_total')
                        ->groupBy('region','target_group')
                        ->get();
        $barCombined = QPMM::select('region', 'target_group')
                        ->where('target_group','MSM')
                        ->selectRaw('avg(pa_total) as avg_pa_total')
                        ->selectRaw('avg(pt_total) as avg_pt_total')
                        ->groupBy('region','target_group')
                        ->get();
        return view('pages.qpmm.msm',compact('msm','barPt','barPa','barCombined'));
    }
     public function PwidReport(){
        $pwid=QPMM::where('target_group','PWID')->get();
        $barPt = QPMM::select('region', 'target_group')
                        ->where('target_group','PWID')
                        ->selectRaw('avg(pt_total) as avg_pt_total')
                        ->groupBy('region','target_group')
                        ->get();
        $barPa = QPMM::select('region', 'target_group')
                        ->where('target_group','PWID')
                        ->selectRaw('avg(pa_total) as avg_pa_total')
                        ->groupBy('region','target_group')
                        ->get();
        $barCombined = QPMM::select('region', 'target_group')
                        ->where('target_group','PWID')
                        ->selectRaw('avg(pa_total) as avg_pa_total')
                        ->selectRaw('avg(pt_total) as avg_pt_total')
                        ->groupBy('region','target_group')
                        ->get();
        return view('pages.qpmm.pwid',compact('pwid','barPt','barPa','barCombined'));
    }
    public function TgReport(){
        $tg=QPMM::where('target_group','TG')->get();
        $barPt = QPMM::select('region', 'target_group')
                        ->where('target_group','TG')
                        ->selectRaw('avg(pt_total) as avg_pt_total')
                        ->groupBy('region','target_group')
                        ->get();
        $barPa = QPMM::select('region', 'target_group')
                        ->where('target_group','TG')
                        ->selectRaw('avg(pa_total) as avg_pa_total')
                        ->groupBy('region','target_group')
                        ->get();
        $barCombined = QPMM::select('region', 'target_group')
                        ->where('target_group','TG')
                        ->selectRaw('avg(pa_total) as avg_pa_total')
                        ->selectRaw('avg(pt_total) as avg_pt_total')
                        ->groupBy('region','target_group')
                        ->get();
        return view('pages.qpmm.tg',compact('tg','barPt','barPa','barCombined'));
    }
    public function TruckersReport(){
        $truckers=QPMM::where('target_group','TRUCKERS')->get();
        $barPt = QPMM::select('region', 'target_group')
                        ->where('target_group','TRUCKERS')
                        ->selectRaw('avg(pt_total) as avg_pt_total')
                        ->groupBy('region','target_group')
                        ->get();
        $barPa = QPMM::select('region', 'target_group')
                        ->where('target_group','TRUCKERS')
                        ->selectRaw('avg(pa_total) as avg_pa_total')
                        ->groupBy('region','target_group')
                        ->get();
        $barCombined = QPMM::select('region', 'target_group')
                        ->where('target_group','TRUCKERS')
                        ->selectRaw('avg(pa_total) as avg_pa_total')
                        ->selectRaw('avg(pt_total) as avg_pt_total')
                        ->groupBy('region','target_group')
                        ->get();
        return view('pages.qpmm.truckers',compact('truckers','barPt','barPa','barCombined'));
    }
    public function FisherfolksReport(){
        $fisherfolk=QPMM::where('target_group','FISHERFOLKS')->get();
        $barPt = QPMM::select('region', 'target_group')
                        ->where('target_group','FISHERFOLKS')
                        ->selectRaw('avg(pt_total) as avg_pt_total')
                        ->groupBy('region','target_group')
                        ->get();
        $barPa = QPMM::select('region', 'target_group')
                        ->where('target_group','FISHERFOLKS')
                        ->selectRaw('avg(pa_total) as avg_pa_total')
                        ->groupBy('region','target_group')
                        ->get();
        $barCombined = QPMM::select('region', 'target_group')
                        ->where('target_group','FISHERFOLKS')
                        ->selectRaw('avg(pa_total) as avg_pa_total')
                        ->selectRaw('avg(pt_total) as avg_pt_total')
                        ->groupBy('region','target_group')
                        ->get();
        return view('pages.qpmm.fisherfolk',compact('fisherfolk','barPt','barPa','barCombined'));
    }
    public function DcReport(){
        $dc=QPMM::where('target_group','DCS')->get();
        $barPt = QPMM::select('region', 'target_group')
                        ->where('target_group','DCS')
                        ->selectRaw('avg(pt_total) as avg_pt_total')
                        ->groupBy('region','target_group')
                        ->get();
        $barPa = QPMM::select('region', 'target_group')
                        ->where('target_group','DCS')
                        ->selectRaw('avg(pa_total) as avg_pa_total')
                        ->groupBy('region','target_group')
                        ->get();
        $barCombined = QPMM::select('region', 'target_group')
                        ->where('target_group','DCS')
                        ->selectRaw('avg(pa_total) as avg_pa_total')
                        ->selectRaw('avg(pt_total) as avg_pt_total')
                        ->groupBy('region','target_group')
                        ->get();
        return view('pages.qpmm.dc',compact('dc','barPt','barPa','barCombined'));
    }
    public function MhrsReport(){
        $mhrs=QPMM::where('target_group','MHRS')->get();
        $barPt = QPMM::select('region', 'target_group')
                        ->where('target_group','MHRS')
                        ->selectRaw('avg(pt_total) as avg_pt_total')
                        ->groupBy('region','target_group')
                        ->get();
        $barPa = QPMM::select('region', 'target_group')
                        ->where('target_group','MHRS')
                        ->selectRaw('avg(pa_total) as avg_pa_total')
                        ->groupBy('region','target_group')
                        ->get();
        $barCombined = QPMM::select('region', 'target_group')
                        ->where('target_group','MHRS')
                        ->selectRaw('avg(pa_total) as avg_pa_total')
                        ->selectRaw('avg(pt_total) as avg_pt_total')
                        ->groupBy('region','target_group')
                        ->get();
        return view('pages.qpmm.mhrs',compact('mhrs','barPt','barPa','barCombined'));
    }
    public function hrgIndex(){

        return view('pages.hrg.index');
    }
    public function hrgConsolidated(){

        return view('pages.hrg.allhrg');
    }
    public function gbvIndex(){

        return view('pages.gbv.index');
    }
    public function gbvTemplate(){
        return view('pages.gbv.template');
    }
    public function gbvConsolidated(){
        $gbvdata=GBV::get();
        $barData = GBV::select('region', 'typology')
                        ->selectRaw('count(*) as count_topology')
                        ->groupBy('region','typology')
                        ->get();
        return view('pages.gbv.consolidated',compact('gbvdata','barData'));
    }
    public function gbvVisualize(){
        $regions=GBV::distinct()->pluck('region');
        $barData = GBV::select('region', 'typology')
                        ->selectRaw('count(*) as count_topology')
                        ->groupBy('region','typology')
                        ->get();
        $barSR = GBV::select('region', 'typology','sr_name')
                        ->selectRaw('count(*) as count_topology')
                        ->groupBy('region','typology','sr_name')
                        ->get();
        return view('pages.gbv.visualize',compact('barData','barSR','regions'));
    }



}
