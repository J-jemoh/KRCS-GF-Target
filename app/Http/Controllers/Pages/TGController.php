<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
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

class TGController extends Controller
{
    
       public function indexTG(){
        $srCount = Demographics::where('kp_type','TG')
                                ->orWhere('kp_type','TRANS MAN')
                                ->orWhere('kp_type','TRANS WOMAN')
                                ->distinct()->count('sr_name');
        $counties = Demographics::where('kp_type','TG')
                                ->orWhere('kp_type','TRANS MAN')
                                ->orWhere('kp_type','TRANS WOMAN')
                                ->distinct()->count('county');
        $region = Demographics::where('kp_type','TG')
                                ->orWhere('kp_type','TRANS MAN')
                                ->orWhere('kp_type','TRANS WOMAN')
                                ->distinct()->count('region');
        $enrolled = Demographics::where('kp_type','TG')
                                ->orWhere('kp_type','TRANS MAN')
                                ->orWhere('kp_type','TRANS WOMAN')
                                ->distinct()->count('uic');
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
            $count = Demographics::whereBetween('age', $limits)
            ->where('kp_type','TG')
            ->orWhere('kp_type','TRANS WOMAN')
            ->orWhere('kp_type','TRANS MAN')->count();
            $results[$range] = $count;
        }
        #hiv status at enrollment
        $hivstatus = Demographics::select('hiv_status_enrol', DB::raw('COUNT(*) as count'))
        ->where('kp_type','TG')
        ->orWhere('kp_type','TRANS MAN')
        ->orWhere('kp_type','TRANS WOMAN')
        ->groupBy('hiv_status_enrol')
        ->get();
        #defined package
        $definedPackage = Typology::where(function ($query) {
        $query->where('received_peer_education', 'yes')
            ->orWhere('rssh', 'yes');
            })
            ->where('sti_screened', 'yes')
            ->where(DB::raw('CAST(condom_distributed_nmbr AS UNSIGNED)'), '>', 0)
            ->where('kp_type','TG')
            ->orWhere('kp_type','TRANS MAN')
            ->orWhere('kp_type','TRANS WOMAN')
            ->count();
        $prepInitiated= Typology::where('prep_initated','Yes')
                        ->where('kp_type','TG')
                        ->orWhere('kp_type','TRANS MAN')
                        ->orWhere('kp_type','TRANS WOMAN')
                        ->count();
        $hivTested= Typology::where('hiv_tested','Yes')
                    ->where('kp_type','TG')
                    ->orWhere('kp_type','TRANS MAN')
                    ->orWhere('kp_type','TRANS WOMAN')
                    ->count();
        $hivFreq = Typology::select('hiv_test_freq', DB::raw('COUNT(*) as count'))
        ->where('kp_type','TG')
        ->orWhere('kp_type','TRANS MAN')
        ->orWhere('kp_type','TRANS WOMAN')
        ->groupBy('hiv_test_freq')
        ->get();
        $definedPackageTarget=2803;
        $prepInitiatedTarget=400;
        $hivTestedTarget=400;
        $hivExposure72 = Typology::select('hiv_exposure_72hr', DB::raw('COUNT(*) as count'))
        ->where('kp_type','TG')
        ->orWhere('kp_type','TRANS MAN')
        ->orWhere('kp_type','TRANS WOMAN')
        ->groupBy('hiv_exposure_72hr')
        ->get();
        $Pep72 = Typology::select('pep_72', DB::raw('COUNT(*) as count'))
        ->where('kp_type','TG')
        ->orWhere('kp_type','TRANS MAN')
        ->orWhere('kp_type','TRANS WOMAN')
        ->groupBy('pep_72')
        ->get();
         $CareOutcome = Typology::select('hiv_care_outcome', DB::raw('COUNT(*) as count'))
         ->where('kp_type','TG')
         ->orWhere('kp_type','TRANS MAN')
         ->orWhere('kp_type','TRANS WOMAN')
        ->groupBy('hiv_care_outcome')
        ->get();
        $ArtOutcome = Typology::select('art_outcome', DB::raw('COUNT(*) as count'))
        ->where('kp_type','TG')
        ->orWhere('kp_type','TRANS MAN')
        ->orWhere('kp_type','TRANS WOMAN')
        ->groupBy('art_outcome')
        ->get();
        $vlDue = Typology::select('due_vl', DB::raw('COUNT(*) as count'))
        ->where('kp_type','TG')
        ->orWhere('kp_type','TRANS MAN')
        ->orWhere('kp_type','TRANS WOMAN')
        ->groupBy('due_vl')
        ->get();
        $vlDone = Typology::select('vl_done', DB::raw('COUNT(*) as count'))
        ->where('kp_type','TG')
        ->orWhere('kp_type','TRANS MAN')
        ->orWhere('kp_type','TRANS WOMAN')
        ->groupBy('vl_done')
        ->get();
        $ReceivedVl = Typology::select('vl_result_received', DB::raw('COUNT(*) as count'))
        ->where('kp_type','TG')
        ->orWhere('kp_type','TRANS MAN')
        ->orWhere('kp_type','TRANS WOMAN')
        ->groupBy('vl_result_received')
        ->get();
        $hivStatus = Typology::select('hiv_status', DB::raw('COUNT(*) as count'))
        ->where('kp_type','TG')
        ->orWhere('kp_type','TRANS MAN')
        ->orWhere('kp_type','TRANS WOMAN')
        ->groupBy('hiv_status')
        ->get();
        $Cart = Typology::select('currently_art', DB::raw('COUNT(*) as count'))
        ->where('kp_type','TG')
        ->orWhere('kp_type','TRANS MAN')
        ->orWhere('kp_type','TRANS WOMAN')
        ->groupBy('currently_art')
        ->get();

        return view('pages.typology.tg',compact('srCount','counties','region','enrolled','results','hivstatus','definedPackage','prepInitiated','hivTested','hivFreq','hivExposure72','Pep72','CareOutcome','ArtOutcome','vlDue','vlDone','ReceivedVl','hivStatus','Cart','definedPackageTarget','prepInitiatedTarget','hivTestedTarget'));
    }
}
