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

class MSMController extends Controller
{
    //
    public function indexMSM(){
        $loggedregion=Auth()->user()->region;
    if($loggedregion=='HQ'){
        $srCount = Demographics::where('kp_type','MSM')->distinct()->count('sr_name');
        $counties = Demographics::where('kp_type','MSM')->distinct()->count('county');
        $region = Demographics::where('kp_type','MSM')->distinct()->count('region');
        $enrolled = Demographics::where('kp_type','MSM')->distinct()->count('uic');
        $monthyear=Typology::select('month','year')->distinct()->get();
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
            ->where('kp_type','MSM')->count();
            $results[$range] = $count;
        }
        #hiv status at enrollment
        $hivstatus = Demographics::select('hiv_status_enrol', DB::raw('COUNT(*) as count'))
        ->where('kp_type','MSM')
        ->groupBy('hiv_status_enrol')
        ->get();
        #defined package
        $definedPackage = Typology::where(function ($query) {
        $query->where('received_peer_education', 'Yes')
            ->orWhere('rssh', 'Yes');
            })
            ->where('sti_screened', 'Yes')
            ->where(DB::raw('CAST(condom_distributed_nmbr AS INTEGER)'), '>', 0)
            ->where('kp_type','MSM')
            ->distinct('peer_educator_code')
            ->count();
        $prepInitiated= Typology::where('prep_initated','Yes')->where('kp_type','MSM')->distinct('peer_educator_code')->count('peer_educator_code');
        $hivTested= Typology::where('hiv_tested','Yes')->where('kp_type','MSM')->distinct('peer_educator_code')->count('peer_educator_code');
        $hivFreq = Typology::select('hiv_test_freq', DB::raw('COUNT(*) as count'))
        ->where('kp_type','MSM')
        ->groupBy('hiv_test_freq')
        ->get();
        $definedPackageTarget=29915;
        $prepInitiatedTarget=6591;
        $hivTestedTarget=27849;
        $hivExposure72 = Typology::select('hiv_exposure_72hr', DB::raw('COUNT(*) as count'))
        ->where('kp_type','MSM')
        ->groupBy('hiv_exposure_72hr')
        ->get();
        $Pep72 = Typology::select('pep_72', DB::raw('COUNT(*) as count'))
        ->where('kp_type','MSM')
        ->groupBy('pep_72')
        ->get();
         $CareOutcome = Typology::select('hiv_care_outcome', DB::raw('COUNT(*) as count'))
         ->where('kp_type','MSM')
        ->groupBy('hiv_care_outcome')
        ->get();
        $ArtOutcome = Typology::select('art_outcome', DB::raw('COUNT(*) as count'))
        ->where('kp_type','MSM')
        ->groupBy('art_outcome')
        ->get();
        $vlDue = Typology::select('due_vl', DB::raw('COUNT(*) as count'))
        ->where('kp_type','MSM')
        ->groupBy('due_vl')
        ->get();
        $vlDone = Typology::select('vl_done', DB::raw('COUNT(*) as count'))
        ->where('kp_type','MSM')
        ->groupBy('vl_done')
        ->get();
        $ReceivedVl = Typology::select('vl_result_received', DB::raw('COUNT(*) as count'))
        ->where('kp_type','MSM')
        ->groupBy('vl_result_received')
        ->get();
        $hivStatus = Typology::select('hiv_status', DB::raw('COUNT(*) as count'))
        ->where('kp_type','MSM')
        ->groupBy('hiv_status')
        ->get();
        $Cart = Typology::select('currently_art', DB::raw('COUNT(*) as count'))
        ->where('kp_type','MSM')
        ->groupBy('currently_art')
        ->get();

        }
        else{

        $srCount = Demographics::where('region',$loggedregion)->where('kp_type','MSM')->distinct()->count('sr_name');
        $counties = Demographics::where('region',$loggedregion)->where('kp_type','MSM')->distinct()->count('county');
        $region = Demographics::where('region',$loggedregion)->where('kp_type','MSM')->distinct()->count('region');
        $enrolled = Demographics::where('region',$loggedregion)->where('kp_type','MSM')->distinct()->count('uic');
        $monthyear=Typology::select('month','year')->distinct()->get();
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
            $count = Demographics::where('region',$loggedregion)->whereBetween('age', $limits)
            ->where('kp_type','MSM')->count();
            $results[$range] = $count;
        }
        #hiv status at enrollment
        $hivstatus = Demographics::where('region',$loggedregion)->select('hiv_status_enrol', DB::raw('COUNT(*) as count'))
        ->where('kp_type','MSM')
        ->groupBy('hiv_status_enrol')
        ->get();
        #defined package
        $definedPackage = Typology::where('region',$loggedregion)->where(function ($query) {
        $query->where('received_peer_education', 'Yes')
            ->orWhere('rssh', 'Yes');
            })
            ->where('sti_screened', 'Yes')
            ->where(DB::raw('CAST(condom_distributed_nmbr AS INTEGER)'), '>', 0)
            ->where('kp_type','MSM')
            ->distinct('peer_educator_code')
            ->count();
        $prepInitiated= Typology::where('region',$loggedregion)->where('prep_initated','Yes')->where('kp_type','MSM')->count();
        $hivTested= Typology::where('region',$loggedregion)->where('hiv_tested','Yes')->where('kp_type','MSM')->count();
        $hivFreq = Typology::where('region',$loggedregion)->select('hiv_test_freq', DB::raw('COUNT(*) as count'))
        ->where('kp_type','MSM')
        ->groupBy('hiv_test_freq')
        ->get();
        $definedPackageTarget=29915;
        $prepInitiatedTarget=6591;
        $hivTestedTarget=27849;
        $hivExposure72 = Typology::where('region',$loggedregion)->select('hiv_exposure_72hr', DB::raw('COUNT(*) as count'))
        ->where('kp_type','MSM')
        ->groupBy('hiv_exposure_72hr')
        ->get();
        $Pep72 = Typology::where('region',$loggedregion)->select('pep_72', DB::raw('COUNT(*) as count'))
        ->where('kp_type','MSM')
        ->groupBy('pep_72')
        ->get();
         $CareOutcome = Typology::where('region',$loggedregion)->select('hiv_care_outcome', DB::raw('COUNT(*) as count'))
         ->where('kp_type','MSM')
        ->groupBy('hiv_care_outcome')
        ->get();
        $ArtOutcome = Typology::where('region',$loggedregion)->select('art_outcome', DB::raw('COUNT(*) as count'))
        ->where('kp_type','MSM')
        ->groupBy('art_outcome')
        ->get();
        $vlDue = Typology::where('region',$loggedregion)->select('due_vl', DB::raw('COUNT(*) as count'))
        ->where('kp_type','MSM')
        ->groupBy('due_vl')
        ->get();
        $vlDone = Typology::where('region',$loggedregion)->select('vl_done', DB::raw('COUNT(*) as count'))
        ->where('kp_type','MSM')
        ->groupBy('vl_done')
        ->get();
        $ReceivedVl = Typology::where('region',$loggedregion)->select('vl_result_received', DB::raw('COUNT(*) as count'))
        ->where('kp_type','MSM')
        ->groupBy('vl_result_received')
        ->get();
        $hivStatus = Typology::where('region',$loggedregion)->select('hiv_status', DB::raw('COUNT(*) as count'))
        ->where('kp_type','MSM')
        ->groupBy('hiv_status')
        ->get();
        $Cart = Typology::where('region',$loggedregion)->select('currently_art', DB::raw('COUNT(*) as count'))
        ->where('kp_type','MSM')
        ->groupBy('currently_art')
        ->get();

        }
        
        return view('pages.typology.report_msm',compact('srCount','counties','region','enrolled','results','hivstatus','definedPackage','prepInitiated','hivTested','hivFreq','hivExposure72','Pep72','CareOutcome','ArtOutcome','vlDue','vlDone','ReceivedVl','hivStatus','Cart','definedPackageTarget','prepInitiatedTarget','hivTestedTarget','monthyear'));
    }
}
