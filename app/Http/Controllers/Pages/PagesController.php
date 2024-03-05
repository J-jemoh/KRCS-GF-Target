<?php

namespace App\Http\Controllers\Pages;
use ConsoleTVs\Charts\Classes\Chartjs\BarChart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Target;
use App\Models\Regions;
use App\Models\GC7Coverage;

class PagesController extends Controller
{

    public function dashboard():View{
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
         return view('dashboard',compact('barData','barDataHts','barDataPrep'));

    }
    public function targetIndex():View{
        return view('pages.target.index');
    }
    public function AllTargets():View{
        $targets=Target::get();
        return view('pages.target.allTargets',compact('targets'));
    }
    public function TargetReports():View{

        return view('pages.target.reports');
    }
    public function msmdata(){
        $msmdata=Target::where('module','MSM')->get();
        return view('pages.target.msm',compact('msmdata'));
    }
    public function fswdata(){
        $fswdata=Target::where('module','FSW')->get();
        return view('pages.target.fsw',compact('fswdata'));
    }
    public function pwiddata(){
        $pwiddata=Target::where('module','PWID')->get();
        return view('pages.target.pwid',compact('pwiddata'));
    }
    public function tgdata(){
        $tgdata=Target::where('module','TG')->get();
        return view('pages.target.tg',compact('tgdata'));
    }
    public function tcsdata(){
        $tcsdata=Target::where('module','TCS')->get();
        return view('pages.target.tcs',compact('tcsdata'));
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
}
