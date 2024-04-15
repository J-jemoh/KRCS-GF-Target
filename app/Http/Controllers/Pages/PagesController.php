<?php

namespace App\Http\Controllers\Pages;
use ConsoleTVs\Charts\Classes\Chartjs\BarChart;
use Illuminate\Support\Facades\Schema;
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
use App\Models\Demographics;
use App\Models\Typology;
use DataTables;
use App\Models\pfTarget;
use Illuminate\Support\Facades\DB;
use App\Models\AYP;
use App\Models\PMTCT;
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
    public function fswIndex(){

        return view('pages.typology.index');
    }
    public function fswReports(){
        $srCount = Demographics::where('kp_type','FSW')->distinct()->count('sr_name');
        $counties = Demographics::where('kp_type','FSW')->distinct()->count('county');
        $region = Demographics::where('kp_type','FSW')->distinct()->count('region');
        $enrolled = Demographics::where('kp_type','FSW')->distinct()->count('uic');
        #show age distribution
        // Define age ranges
        $ageRanges = [
            '0-18' => [0, 18],
            '19-24' => [19, 24],
            '25-50' => [25, 50],
            'Above 50' => [51, 999], // Adjust upper limit accordingly
        ];

        // Group by age ranges and count occurrences
        $results = [];
        foreach ($ageRanges as $range => $limits) {
            $count = Demographics::whereBetween('age', $limits)->
            where('kp_type','FSW')->count();
            $results[$range] = $count;
        }
        #hiv status at enrollment
        $hivstatus = Demographics::select('hiv_status_enrol', DB::raw('COUNT(*) as count'))
        ->groupBy('hiv_status_enrol')
        ->where('kp_type','FSW')
        ->get();
        #defined package
        $definedPackage = Typology::where(function ($query) {
        $query->where('received_peer_education', 'yes')
            ->orWhere('rssh', 'yes');
            })
            ->where('sti_screened', 'yes')
            ->where(DB::raw('CAST(condom_distributed_nmbr AS UNSIGNED)'), '>', 0)
            ->where('kp_type','FSW')
            ->distinct()
            ->count('peer_educator_code');
        $prepInitiated= Typology::where('prep_initated','Yes')->where('kp_type','FSW')->distinct()->count('peer_educator_code');
        $hivTested= Typology::where('hiv_tested','Yes')->where('kp_type','FSW')->distinct()->count('peer_educator_code');
        $hivFreq = Typology::select('hiv_test_freq', DB::raw('COUNT(*) as count'))
        ->where('kp_type','FSW')
        ->whereIn('peer_educator_code', function($query) {
                        $query->select('peer_educator_code')
                              ->distinct()
                              ->from('typologies');
                    })
        ->groupBy('hiv_test_freq')
        ->distinct()
        ->get();

        $definedPackageTarget=91029;
        $prepInitiatedTarget=23862;
        $hivTestedTarget=20000;
        $hivExposure72 = Typology::select('hiv_exposure_72hr', DB::raw('COUNT(*) as count'))
        ->where('kp_type','FSW')
        ->whereIn('peer_educator_code', function($query) {
                        $query->select('peer_educator_code')
                              ->distinct()
                              ->from('typologies');
                    })
        ->groupBy('hiv_exposure_72hr')
        ->get();
        $Pep72 = Typology::select('pep_72', DB::raw('COUNT(*) as count'))
        ->where('kp_type','FSW')
        ->groupBy('pep_72')
        ->get();
         $CareOutcome = Typology::select('hiv_care_outcome', DB::raw('COUNT(*) as count'))
        ->where('kp_type','FSW')
        ->groupBy('hiv_care_outcome')
        ->get();
        $ArtOutcome = Typology::select('art_outcome', DB::raw('COUNT(*) as count'))
        ->where('kp_type','FSW')
        ->groupBy('art_outcome')
        ->get();
        $vlDue = Typology::select('due_vl', DB::raw('COUNT(*) as count'))
        ->where('kp_type','FSW')
        ->groupBy('due_vl')
        ->get();
        $vlDone = Typology::select('vl_done', DB::raw('COUNT(*) as count'))
        ->where('kp_type','FSW')
        ->groupBy('vl_done')
        ->get();
        $ReceivedVl = Typology::select('vl_result_received', DB::raw('COUNT(*) as count'))
        ->where('kp_type','FSW')
        ->groupBy('vl_result_received')
        ->get();
        $hivStatus = Typology::select('hiv_status', DB::raw('COUNT(*) as count'))
         ->where('kp_type','FSW')
        ->groupBy('hiv_status')
        ->get();
        $Cart = Typology::select('currently_art', DB::raw('COUNT(*) as count'))
         ->where('kp_type','FSW')
        ->groupBy('currently_art')
        ->get();

        return view('pages.typology.report',compact('srCount','counties','region','enrolled','results','hivstatus','definedPackage','prepInitiated','hivTested','hivFreq','hivExposure72','Pep72','CareOutcome','ArtOutcome','vlDue','vlDone','ReceivedVl','hivStatus','Cart','definedPackageTarget','prepInitiatedTarget','hivTestedTarget'));
    }
    public function demoTemplate(){

        return view('pages.typology.demographic');
    }
     public function fswTemplate(){

        return view('pages.typology.typologyTemplate');
    }
    public function fetchDemographics(Request $request)
    {
    try {
        // Get all columns from the Demographics table
        $columns = Schema::getColumnListing('demographics');

        // Fetch data with pagination
        $data = Demographics::paginate(100);

        // Prepare data for DataTables
        $formattedData = [];
        foreach ($data->items() as $item) {
            $rowData = [];
            foreach ($columns as $column) {
                $rowData[$column] = $item->$column;
            }
            $formattedData[] = $rowData;
        }

        // Pass data and columns to the view
        return view('pages.typology.report', compact('formattedData', 'columns'));
    } catch (\Exception $e) {
        // Log or handle any exceptions
        return response()->json(['error' => $e->getMessage()], 500);
    }
    }

    public function export()
    {
        $data = Demographics::all();

        // Logic to export data as CSV or Excel
    }
    public function backups(){
        return view('pages.backup');
    }
    public function pfTarget(){
        $pftargets=pfTarget::get();
        return view('pages.gc7.pfTarget',compact('pftargets'));
    }
     public function vpIndex(){

        return view('pages.vp.index');
    }

    public function CommunityReached(){
        $kpTypes = Demographics::select('kp_type')
                        ->groupBy('kp_type')
                        ->pluck('kp_type');
         $kpTypeCounts = [];
            foreach ($kpTypes as $kpType) {
                $kpTypeCounts[$kpType]['kp_type'] = $kpType;
                $kpTypeCounts[$kpType]['male_count5'] = DB::table('demographics')
                    ->whereBetween('age', [0, 5])
                    ->where('sex', 'Male')
                    ->where('kp_type', $kpType)
                    ->count('uic');
                $kpTypeCounts[$kpType]['female_count5'] = DB::table('demographics')
                    ->whereBetween('age', [0, 5])
                    ->where('sex', 'Female')
                    ->where('kp_type', $kpType)
                    ->count('uic');
                $kpTypeCounts[$kpType]['male_count12'] = DB::table('demographics')
                    ->whereBetween('age', [6, 12])
                    ->where('sex', 'Male')
                    ->where('kp_type', $kpType)
                    ->count('uic');
                $kpTypeCounts[$kpType]['female_count12'] = DB::table('demographics')
                    ->whereBetween('age', [6, 12])
                    ->where('sex', 'Female')
                    ->where('kp_type', $kpType)
                    ->count('uic');
                $kpTypeCounts[$kpType]['female_count'] = DB::table('demographics')
                    ->whereBetween('age', [13, 17])
                    ->where('sex', 'Female')
                    ->where('kp_type', $kpType)
                    ->count('uic');

                $kpTypeCounts[$kpType]['male_count'] = DB::table('demographics')
                    ->whereBetween('age', [13, 17])
                    ->where('sex', 'Male')
                    ->where('kp_type', $kpType)
                    ->count('uic');
                $kpTypeCounts[$kpType]['male_count29'] = DB::table('demographics')
                    ->whereBetween('age', [18, 29])
                    ->where('sex', 'Male')
                    ->where('kp_type', $kpType)
                    ->count('uic');
                $kpTypeCounts[$kpType]['Female_count29'] = DB::table('demographics')
                    ->whereBetween('age', [18, 29])
                    ->where('sex', 'Female')
                    ->where('kp_type', $kpType)
                    ->count('uic');
                $kpTypeCounts[$kpType]['m_count39'] = DB::table('demographics')
                    ->whereBetween('age', [30, 39])
                    ->where('sex', 'Male')
                    ->where('kp_type', $kpType)
                    ->count('uic');
                $kpTypeCounts[$kpType]['f_count39'] = DB::table('demographics')
                    ->whereBetween('age', [30, 39])
                    ->where('sex', 'Female')
                    ->where('kp_type', $kpType)
                    ->count('uic');
                $kpTypeCounts[$kpType]['m_count49'] = DB::table('demographics')
                    ->whereBetween('age', [40, 49])
                    ->where('sex', 'Male')
                    ->where('kp_type', $kpType)
                    ->count('uic');
                $kpTypeCounts[$kpType]['f_count49'] = DB::table('demographics')
                    ->whereBetween('age', [40, 49])
                    ->where('sex', 'Female')
                    ->where('kp_type', $kpType)
                    ->count('uic');
                $kpTypeCounts[$kpType]['m_count59'] = DB::table('demographics')
                    ->whereBetween('age', [50, 59])
                    ->where('sex', 'Male')
                    ->where('kp_type', $kpType)
                    ->count('uic');
                 $kpTypeCounts[$kpType]['f_count59'] = DB::table('demographics')
                    ->whereBetween('age', [50, 59])
                    ->where('sex', 'Female')
                    ->where('kp_type', $kpType)
                    ->count('uic');
                 $kpTypeCounts[$kpType]['m_count69'] = DB::table('demographics')
                    ->whereBetween('age', [60, 69])
                    ->where('sex', 'Male')
                    ->where('kp_type', $kpType)
                    ->count('uic');
                $kpTypeCounts[$kpType]['f_count69'] = DB::table('demographics')
                    ->whereBetween('age', [60, 69])
                    ->where('sex', 'Male')
                    ->where('kp_type', $kpType)
                    ->count('uic');
                 $kpTypeCounts[$kpType]['m_count79'] = DB::table('demographics')
                    ->whereBetween('age', [70, 49])
                    ->where('sex', 'Male')
                    ->where('kp_type', $kpType)
                    ->count('uic');
                $kpTypeCounts[$kpType]['f_count79'] = DB::table('demographics')
                    ->whereBetween('age', [70, 79])
                    ->where('sex', 'Female')
                    ->where('kp_type', $kpType)
                    ->count('uic');
                $kpTypeCounts[$kpType]['countm80'] = DB::table('demographics')
                    ->where('age','>=',80)
                    ->where('sex', 'Male')
                    ->where('kp_type', $kpType)
                    ->count('uic');
                 $kpTypeCounts[$kpType]['countf80'] = DB::table('demographics')
                    ->where('age','>=',80)
                    ->where('sex', 'Female')
                    ->where('kp_type', $kpType)
                    ->count('uic');
                $kpTypeCounts[$kpType]['countmm'] = DB::table('demographics')
                    ->where('age','>=',0)
                    ->where('sex', 'Male')
                    ->where('kp_type', $kpType)
                    ->count('uic');
                $kpTypeCounts[$kpType]['countff'] = DB::table('demographics')
                    ->where('age','>=',0)
                    ->where('sex', 'Female')
                    ->where('kp_type', $kpType)
                    ->count('uic');
            }
        // $kpTypes = ['MSM', 'FSW','TG', 'PWID','TRANS WOMAN','TRANS MAN'];
        $countsPMTCT = [];
            $ageRanges = [[0,5],[6,12],[13,17],[18,29],[30,39],[40,49],[50,59],[60,69],[70,79],[80,150],[0,150]];
            $sexes = ['Male', 'Female'];
            foreach ($ageRanges as $range) {
                foreach ($sexes as $sex) {
                    $countsPMTCT["pmtct{$range[0]}{$range[1]}{$sex[0]}"] = PMTCT::whereBetween('age', $range)
                        ->where('sex', $sex)
                        ->count('unique_identifier');
                }
            }

        $ayp5m=AYP::whereBetween('age',[0,5])->Where('sex','Male')->count('peer_name');
        $ayp5f=AYP::whereBetween('age',[0,5])->Where('sex','Female')->count('peer_name');
        $ayp12m=AYP::whereBetween('age',[6,12])->Where('sex','Male')->count('peer_name');
        $ayp12f=AYP::whereBetween('age',[6,12])->Where('sex','Female')->count('peer_name');
        $ayp17m=AYP::whereBetween('age',[13,17])->Where('sex','Male')->count('peer_name');
        $ayp17f=AYP::whereBetween('age',[13,17])->Where('sex','Female')->count('peer_name');
        $ayp29m=AYP::whereBetween('age',[18,29])->Where('sex','Male')->count('peer_name');
        $ayp29f=AYP::whereBetween('age',[18,29])->Where('sex','Female')->count('peer_name');
        $ayp39m=AYP::whereBetween('age',[30,39])->Where('sex','Male')->count('peer_name');
        $ayp39f=AYP::whereBetween('age',[30,39])->Where('sex','Female')->count('peer_name');
        $ayp49m=AYP::whereBetween('age',[40,49])->Where('sex','Male')->count('peer_name');
        $ayp49f=AYP::whereBetween('age',[40,49])->Where('sex','Female')->count('peer_name');
        $ayp59m=AYP::whereBetween('age',[50,59])->Where('sex','Male')->count('peer_name');
        $ayp59f=AYP::whereBetween('age',[50,59])->Where('sex','Female')->count('peer_name');
        $ayp69m=AYP::whereBetween('age',[60,69])->Where('sex','Male')->count('peer_name');
        $ayp69f=AYP::whereBetween('age',[60,69])->Where('sex','Female')->count('peer_name');
        $ayp79m=AYP::whereBetween('age',[70,79])->Where('sex','Male')->count('peer_name');
        $ayp79f=AYP::whereBetween('age',[70,79])->Where('sex','Female')->count('peer_name');
        $ayp80m=AYP::where('age','>=',80)->where('sex','Male')->count('peer_name');
        $ayp80f=AYP::where('age','>=',80)->where('sex','Female')->count('peer_name');
        $ayptotalm=AYP::where('age','>=',0)->where('sex','Male')->count('peer_name');
        $ayptotalf=AYP::where('age','>=',0)->where('sex','Female')->count('peer_name');

        return view('reports.community_Members_reached',compact('kpTypes','kpTypeCounts','ayp5m','ayp5f','ayp12m','ayp12f','ayp17m','ayp17f','ayp29m','ayp29f','ayp39m','ayp39f','ayp49m','ayp49f','ayp59m','ayp59f','ayp69m','ayp69f','ayp79m','ayp79f','ayp80m','ayp80f','ayptotalf','ayptotalm','countsPMTCT'));
    }
    


}
