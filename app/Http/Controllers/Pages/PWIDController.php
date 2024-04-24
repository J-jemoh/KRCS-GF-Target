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
use Auth;

class PWIDController extends Controller
{
    
    public function indexPWID(){
        
        $loggeduser=Auth::user()->region;

        if($loggeduser == 'HQ'){
        $srCount = Demographics::where('kp_type','PWID')
                                ->distinct()->count('sr_name');
        $counties = Demographics::where('kp_type','PWID')
                                ->distinct()->count('county');
        $region = Demographics::where('kp_type','PWID')
                                ->distinct()->count('region');
        $enrolled = Demographics::where('kp_type','PWID')
                                ->distinct()->count('uic');
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
            ->where('kp_type','PWID')
            ->distinct('uic')
            ->count();
            $results[$range] = $count;
        }
        #hiv status at enrollment
        $hivstatus = Demographics::select('hiv_status_enrol', DB::raw('COUNT(*) as count'))
        ->where('kp_type','PWID')
        ->groupBy('hiv_status_enrol')
        ->get();
        #defined package
        $definedPackage = Typology::where(function ($query) {
        $query->where('received_peer_education', 'Yes')
            ->orWhere('rssh', 'Yes');
            })
            ->where('sti_screened', 'Yes')
            ->where(DB::raw('CAST(condom_distributed_nmbr AS INTEGER)'), '>', 0)
            ->where('kp_type','PWID')
            ->distinct('peer_educator_code')
            ->count();
        $prepInitiated= Typology::where('prep_initated','Yes')
                        ->where('kp_type','PWID')
                        ->distinct('peer_educator_code')
                        ->count();
        $hivTested= Typology::where('hiv_tested','Yes')
                    ->where('kp_type','PWID')
                    ->distinct('peer_educator_code')
                    ->count();
        $hivFreq = Typology::select('hiv_test_freq', DB::raw('COUNT(*) as count'))
        ->where('kp_type','PWID')
        ->groupBy('hiv_test_freq')
        ->get();
        $definedPackageTarget=17483;
        $prepInitiatedTarget=2081;
        $hivTestedTarget=14869;
        $hivExposure72 = Typology::select('hiv_exposure_72hr', DB::raw('COUNT(*) as count'))
        ->where('kp_type','PWID')
        ->groupBy('hiv_exposure_72hr')
        ->get();
        $Pep72 = Typology::select('pep_72', DB::raw('COUNT(*) as count'))
        ->where('kp_type','PWID')
        ->groupBy('pep_72')
        ->get();
         $CareOutcome = Typology::select('hiv_care_outcome', DB::raw('COUNT(*) as count'))
         ->where('kp_type','PWID')
        ->groupBy('hiv_care_outcome')
        ->get();
        $ArtOutcome = Typology::select('art_outcome', DB::raw('COUNT(*) as count'))
        ->where('kp_type','PWID')
        ->groupBy('art_outcome')
        ->get();
        $vlDue = Typology::select('due_vl', DB::raw('COUNT(*) as count'))
        ->where('kp_type','PWID')
        ->groupBy('due_vl')
        ->get();
        $vlDone = Typology::select('vl_done', DB::raw('COUNT(*) as count'))
        ->where('kp_type','PWID')
        ->groupBy('vl_done')
        ->get();
        $ReceivedVl = Typology::select('vl_result_received', DB::raw('COUNT(*) as count'))
        ->where('kp_type','PWID')
        ->groupBy('vl_result_received')
        ->get();
        $hivStatus = Typology::select('hiv_status', DB::raw('COUNT(*) as count'))
        ->where('kp_type','PWID')
        ->groupBy('hiv_status')
        ->get();
        $Cart = Typology::select('currently_art', DB::raw('COUNT(*) as count'))
        ->where('kp_type','PWID')
        ->groupBy('currently_art')
        ->get();
        }
        else{

        $srCount = Demographics::where('region',$loggeduser)->where('kp_type','PWID')
                                ->distinct()->count('sr_name');
        $counties = Demographics::where('region',$loggeduser)->where('kp_type','PWID')
                                ->distinct()->count('county');
        $region = Demographics::where('region',$loggeduser)->where('kp_type','PWID')
                                ->distinct()->count('region');
        $enrolled = Demographics::where('region',$loggeduser)->where('kp_type','PWID')
                                ->distinct()->count('uic');
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
            ->where('kp_type','PWID')
            ->where('region',$loggeduser)
            ->distinct('uic')
            ->count();
            $results[$range] = $count;
        }
        #hiv status at enrollment
        $hivstatus = Demographics::select('hiv_status_enrol', DB::raw('COUNT(*) as count'))
        ->where('kp_type','PWID')
        ->where('region',$loggeduser)
        ->groupBy('hiv_status_enrol')
        ->get();
        #defined package
        $definedPackage = Typology::where(function ($query) {
        $query->where('received_peer_education', 'Yes')
            ->orWhere('rssh', 'Yes');
            })
            ->where('sti_screened', 'Yes')
            ->where(DB::raw('CAST(condom_distributed_nmbr AS INTEGER)'), '>', 0)
            ->where('kp_type','PWID')
            ->where('region',$loggeduser)
            ->distinct('peer_educator_code')
            ->count();
        $prepInitiated= Typology::where('prep_initated','Yes')
                        ->where('kp_type','PWID')
                        ->distinct('peer_educator_code')
                        ->where('region',$loggeduser)
                        ->count();
        $hivTested= Typology::where('hiv_tested','Yes')
                    ->where('kp_type','PWID')
                    ->distinct('peer_educator_code')
                    ->where('region',$loggeduser)
                    ->count();
        $hivFreq = Typology::select('hiv_test_freq', DB::raw('COUNT(*) as count'))
        ->where('kp_type','PWID')
        ->where('region',$loggeduser)
        ->groupBy('hiv_test_freq')
        ->get();
        $definedPackageTarget=17483;
        $prepInitiatedTarget=2081;
        $hivTestedTarget=14869;
        $hivExposure72 = Typology::select('hiv_exposure_72hr', DB::raw('COUNT(*) as count'))
        ->where('kp_type','PWID')
        ->where('region',$loggeduser)
        ->groupBy('hiv_exposure_72hr')
        ->get();
        $Pep72 = Typology::select('pep_72', DB::raw('COUNT(*) as count'))
        ->where('kp_type','PWID')
        ->where('region',$loggeduser)
        ->groupBy('pep_72')
        ->get();
         $CareOutcome = Typology::select('hiv_care_outcome', DB::raw('COUNT(*) as count'))
         ->where('kp_type','PWID')
         ->where('region',$loggeduser)
        ->groupBy('hiv_care_outcome')
        ->get();
        $ArtOutcome = Typology::select('art_outcome', DB::raw('COUNT(*) as count'))
        ->where('kp_type','PWID')
        ->where('region',$loggeduser)
        ->groupBy('art_outcome')
        ->get();
        $vlDue = Typology::select('due_vl', DB::raw('COUNT(*) as count'))
        ->where('kp_type','PWID')
         ->where('region',$loggeduser)
        ->groupBy('due_vl')
        ->get();
        $vlDone = Typology::select('vl_done', DB::raw('COUNT(*) as count'))
        ->where('kp_type','PWID')
        ->where('region',$loggeduser)
        ->groupBy('vl_done')
        ->get();
        $ReceivedVl = Typology::select('vl_result_received', DB::raw('COUNT(*) as count'))
        ->where('kp_type','PWID')
        ->where('region',$loggeduser)
        ->groupBy('vl_result_received')
        ->get();
        $hivStatus = Typology::select('hiv_status', DB::raw('COUNT(*) as count'))
        ->where('kp_type','PWID')
        ->where('region',$loggeduser)
        ->groupBy('hiv_status')
        ->get();
        $Cart = Typology::select('currently_art', DB::raw('COUNT(*) as count'))
        ->where('kp_type','PWID')
        ->where('region',$loggeduser)
        ->groupBy('currently_art')
        ->get();
        }


        #show age distribution
        // Define age ranges
       

        return view('pages.typology.pwid',compact('srCount','counties','region','enrolled','results','hivstatus','definedPackage','prepInitiated','hivTested','hivFreq','hivExposure72','Pep72','CareOutcome','ArtOutcome','vlDue','vlDone','ReceivedVl','hivStatus','Cart','definedPackageTarget','prepInitiatedTarget','hivTestedTarget'));
    }
}
