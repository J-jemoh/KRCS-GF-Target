<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
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

class FisherFolkController extends Controller
{
    //
    public function indexFF(){
            $loggedregion=Auth()->user()->region;
    if($loggedregion=='HQ'){
        $srCount = Demographics::where('kp_type','FISHERFOLK')->distinct()->count('sr_name');
        $counties = Demographics::where('kp_type','FISHERFOLK')->distinct()->count('county');
        $region = Demographics::where('kp_type','FISHERFOLK')->distinct()->count('region');
        $enrolled = Demographics::where('kp_type','FISHERFOLK')->count('unique_identifier');
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
            ->where('kp_type','FISHERFOLK')->count();
            $results[$range] = $count;
        }
        #hiv status at enrollment
        $hivstatus = Demographics::select('hiv_status_enrol', DB::raw('COUNT(*) as count'))
        ->where('kp_type','FISHERFOLK')
        ->groupBy('hiv_status_enrol')
        ->get();
        #defined package
        $definedPackage = Typology::where(function ($query) {
        $query->where('received_peer_education', 'Yes')
            ->orWhere('rssh', 'Yes');
            })
            ->where('sti_screened', 'Yes')
            ->where(DB::raw('CAST(condom_distributed_nmbr AS INTEGER)'), '>', 0)
            ->where('kp_type','FISHERFOLK')
            ->distinct('peer_educator_code')
            ->count();
        $prepInitiated= Typology::where('prep_initated','Yes')->where('kp_type','FISHERFOLK')->count();
        $hivTested= Typology::where('hiv_tested','Yes')->where('kp_type','FISHERFOLK')->count();
        $hivFreq = Typology::select('hiv_test_freq', DB::raw('COUNT(*) as count'))
        ->where('kp_type','FISHERFOLK')
        ->groupBy('hiv_test_freq')
        ->get();
        $definedPackageTarget=29915;
        $prepInitiatedTarget=6591;
        $hivTestedTarget=20000;
        $hivExposure72 = Typology::select('hiv_exposure_72hr', DB::raw('COUNT(*) as count'))
        ->where('kp_type','FISHERFOLK')
        ->groupBy('hiv_exposure_72hr')
        ->get();
        $Pep72 = Typology::select('pep_72', DB::raw('COUNT(*) as count'))
        ->where('kp_type','FISHERFOLK')
        ->groupBy('pep_72')
        ->get();
         $CareOutcome = Typology::select('hiv_care_outcome', DB::raw('COUNT(*) as count'))
         ->where('kp_type','FISHERFOLK')
        ->groupBy('hiv_care_outcome')
        ->get();
        $ArtOutcome = Typology::select('art_outcome', DB::raw('COUNT(*) as count'))
        ->where('kp_type','FISHERFOLK')
        ->groupBy('art_outcome')
        ->get();
        $vlDue = Typology::select('due_vl', DB::raw('COUNT(*) as count'))
        ->where('kp_type','FISHERFOLK')
        ->groupBy('due_vl')
        ->get();
        $vlDone = Typology::select('vl_done', DB::raw('COUNT(*) as count'))
        ->where('kp_type','FISHERFOLK')
        ->groupBy('vl_done')
        ->get();
        $ReceivedVl = Typology::select('vl_result_received', DB::raw('COUNT(*) as count'))
        ->where('kp_type','FISHERFOLK')
        ->groupBy('vl_result_received')
        ->get();
        $hivStatus = Typology::select('hiv_status', DB::raw('COUNT(*) as count'))
        ->where('kp_type','FISHERFOLK')
        ->groupBy('hiv_status')
        ->get();
        $Cart = Typology::select('currently_art', DB::raw('COUNT(*) as count'))
        ->where('kp_type','FISHERFOLK')
        ->groupBy('currently_art')
        ->get();

        }
        else{

        $srCount = Demographics::where('region',$loggedregion)->where('kp_type','FISHERFOLK')->distinct()->count('sr_name');
        $counties = Demographics::where('region',$loggedregion)->where('kp_type','FISHERFOLK')->distinct()->count('county');
        $region = Demographics::where('region',$loggedregion)->where('kp_type','FISHERFOLK')->distinct()->count('region');
        $enrolled = Demographics::where('region',$loggedregion)->where('kp_type','FISHERFOLK')->distinct()->count('uic');
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
            ->where('kp_type','FISHERFOLK')->count();
            $results[$range] = $count;
        }
        #hiv status at enrollment
        $hivstatus = Demographics::where('region',$loggedregion)->select('hiv_status_enrol', DB::raw('COUNT(*) as count'))
        ->where('kp_type','FISHERFOLK')
        ->groupBy('hiv_status_enrol')
        ->get();
        #defined package
        $definedPackage = Typology::where('region',$loggedregion)->where(function ($query) {
        $query->where('received_peer_education', 'Yes')
            ->orWhere('rssh', 'Yes');
            })
            ->where('sti_screened', 'Yes')
            ->where(DB::raw('CAST(condom_distributed_nmbr AS INTEGER)'), '>', 0)
            ->where('kp_type','FISHERFOLK')
            ->distinct('peer_educator_code')
            ->count();
        $prepInitiated= Typology::where('region',$loggedregion)->where('prep_initated','Yes')->where('kp_type','FISHERFOLK')->count();
        $hivTested= Typology::where('region',$loggedregion)->where('hiv_tested','Yes')->where('kp_type','FISHERFOLK')->count();
        $hivFreq = Typology::where('region',$loggedregion)->select('hiv_test_freq', DB::raw('COUNT(*) as count'))
        ->where('kp_type','FISHERFOLK')
        ->groupBy('hiv_test_freq')
        ->get();
        $definedPackageTarget=29915;
        $prepInitiatedTarget=6591;
        $hivTestedTarget=20000;
        $hivExposure72 = Typology::where('region',$loggedregion)->select('hiv_exposure_72hr', DB::raw('COUNT(*) as count'))
        ->where('kp_type','FISHERFOLK')
        ->groupBy('hiv_exposure_72hr')
        ->get();
        $Pep72 = Typology::where('region',$loggedregion)->select('pep_72', DB::raw('COUNT(*) as count'))
        ->where('kp_type','FISHERFOLK')
        ->groupBy('pep_72')
        ->get();
         $CareOutcome = Typology::where('region',$loggedregion)->select('hiv_care_outcome', DB::raw('COUNT(*) as count'))
         ->where('kp_type','FISHERFOLK')
        ->groupBy('hiv_care_outcome')
        ->get();
        $ArtOutcome = Typology::where('region',$loggedregion)->select('art_outcome', DB::raw('COUNT(*) as count'))
        ->where('kp_type','FISHERFOLK')
        ->groupBy('art_outcome')
        ->get();
        $vlDue = Typology::where('region',$loggedregion)->select('due_vl', DB::raw('COUNT(*) as count'))
        ->where('kp_type','FISHERFOLK')
        ->groupBy('due_vl')
        ->get();
        $vlDone = Typology::where('region',$loggedregion)->select('vl_done', DB::raw('COUNT(*) as count'))
        ->where('kp_type','FISHERFOLK')
        ->groupBy('vl_done')
        ->get();
        $ReceivedVl = Typology::where('region',$loggedregion)->select('vl_result_received', DB::raw('COUNT(*) as count'))
        ->where('kp_type','FISHERFOLK')
        ->groupBy('vl_result_received')
        ->get();
        $hivStatus = Typology::where('region',$loggedregion)->select('hiv_status', DB::raw('COUNT(*) as count'))
        ->where('kp_type','FISHERFOLK')
        ->groupBy('hiv_status')
        ->get();
        $Cart = Typology::where('region',$loggedregion)->select('currently_art', DB::raw('COUNT(*) as count'))
        ->where('kp_type','FISHERFOLK')
        ->groupBy('currently_art')
        ->get();

        }
        
        return view('pages.typology.report_ff',compact('srCount','counties','region','enrolled','results','hivstatus','definedPackage','prepInitiated','hivTested','hivFreq','hivExposure72','Pep72','CareOutcome','ArtOutcome','vlDue','vlDone','ReceivedVl','hivStatus','Cart','definedPackageTarget','prepInitiatedTarget','hivTestedTarget'));
    }
    public function FetchFFData(){
        // Set batch size
        $batchSize = 3000; // Adjust as needed

        // Set headers for CSV file
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="FisherFolk_Consolidated.csv"',
        ];

        // Stream CSV file content directly to response
        $callback = function () use ($batchSize, $headers) {
            $file = fopen('php://output', 'w');

            // Add column headers
            $columnsToExport = [
                'sno',
                'month',
                'year',
                'region',
                'county',
                'sr_name',
                'kp_name',
                'hotspot',
                'hotspot_typology',
                'other_hotspot',
                'subcounty',
                'ward',
                'kp_phone',
                'kp_type',
                'uic',
                'age',
                'yob',
                'sex',
                'first_contact_date',
                'enrol_date',
                'hiv_status_enrol',
                'peer_educator',
                'peer_educator_code',

                // Columns from typologies table
                'received_peer_education',
                'clinical_services',
                'hiv_tested',
                'hts_service_point',
                'hiv_test_freq',
                'hiv_status',
                'self_test_hiv',
                'pre_art',
                'art_started',
                'currently_art',
                'current_facility_care',
                'hiv_care_outcome',
                'art_outcome',
                'due_vl',
                'vl_done',
                'vl_result_received',
                'att_vl_suppression',
                'tb_screened',
                'tb_diagonised',
                'tb_treatment_started',
                'hiv_exposure_72hr',
                'pep_72',
                'completed_pep',
                'condom_nmbr_reqr',
                'condom_distributed_nmbr',
                'condom_prov_as_per_need',
                'lubricant_req_nbr',
                'lubricant_distr_nbr',
                'lubricant_prov_per_need',
                'nssp_nmbr',
                'nssp_distributed_nbr',
                'received_nssp_need',
                'hepc_screened',
                'hepc_status',
                'hepc_treated',
                'hepb_screening',
                'hepb_status',
                'on_hepb_treatment',
                'hepb_vaccination',
                'sti_screened',
                'sti_diagnosied',
                'sti_treated',
                'drug_abuse_screened',
                'prep_initated',
                'on_prep',
                'modern_fp_services',
                'rssh',
                'ebi',
                'exp_violence',
                'post_violence_support',
                'program_status',
                'tca',

            ];
            fputcsv($file, $columnsToExport);

            // Paginate demographics data
            $regions = [];

            // Check if the logged-in user's region is HQ
            $loggedRegion = Auth::user()->region;
            if ($loggedRegion === 'HQ') {
                // If HQ, retrieve all regions
                $regions = Demographics::select('region')->distinct()->pluck('region');
            } else {
                // If not HQ, retrieve only the logged-in user's region
                $regions = [$loggedRegion];
            }

    // Loop through each region
    foreach ($regions as $region) {
        // Paginate demographics data for the current region
        $demographicsPage = 1;
        do {
            $demographicsData = Demographics::where('region', $region)
                ->where('kp_type','FISHERFOLK')
                ->paginate($batchSize, ['*'], 'page', $demographicsPage);
            $demographicsPage++;

            // Retrieve typologies data for the current region
            // Retrieve typologies data for the current region
            $typologiesData = Typology::whereIn('unique_identifier', $demographicsData->pluck('unique_identifier'))
                ->get();

            // Create a dictionary of typologies data for efficient lookup
            $typologiesDict = [];
            foreach ($typologiesData as $typology) {
                $typologiesDict[$typology->unique_identifier] = $typology->toArray();
            }

            // Merge and output data
            foreach ($demographicsData as $demographic) {
                  $uniqueIdentifier = $demographic->unique_identifier;
                    $typologyRow = $typologiesDict[$uniqueIdentifier] ?? [];

                    // Merge demographics and typology data
                    $mergedRow = array_merge($demographic->toArray(), $typologyRow);

                    // Select only the specified columns
                    $selectedColumns = array_intersect_key($mergedRow, array_flip($columnsToExport));
                    fputcsv($file, $selectedColumns);
            }
        } while ($demographicsData->hasMorePages());
    }

    fclose($file);
};

return response()->stream($callback, 200, $headers);



    }
}
