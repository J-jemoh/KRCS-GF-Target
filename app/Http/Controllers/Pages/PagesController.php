<?php

namespace App\Http\Controllers\Pages;
use ConsoleTVs\Charts\Classes\Chartjs\BarChart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Target;

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

}
