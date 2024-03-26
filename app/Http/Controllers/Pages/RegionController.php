<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Regions;
use App\Models\Typology;
use App\Models\Demographics;
use Illuminate\Support\Facades\DB;

class RegionController extends Controller
{
    //

    public function saveRegion(Request $request){

        $request->validate([
            'region_code'=>'required',
            'regionName'=>'required'

        ]);
        $userID=auth()->user()->id;

        $region=new Regions;
        $region->region_code=$request->region_code;
        $region->user_id=$userID;
        $region->regionName=$request->regionName;
        $region->save();
        return redirect()->route('admin.regions')->with('success','Region Created successfully');
    }
    public function index(Request $request){
         $regions=Demographics::distinct()->pluck('region');
         $typology=Demographics::distinct()->pluck('kp_type');
        $srCount = Demographics::distinct()->count('sr_name');
        $counties = Demographics::distinct()->count('county');
        $pe = Demographics::distinct()->count('peer_educator');
        $enrolled = Demographics::distinct()->count('uic');
        $selectedRegion = $request->input('region');

         $ageRanges = [
            '0-18' => [0, 18],
            '19-24' => [19, 24],
            '25-50' => [25, 50],
            'Above 50' => [51, 999], // Adjust upper limit accordingly
        ];

        // Group by age ranges and count occurrences
        $results = [];
        foreach ($ageRanges as $range => $limits) {
            $count = Demographics::whereBetween('age', $limits)->count();
            $results[$range] = $count;
        }
        $hivstatus = Demographics::select('hiv_status_enrol', DB::raw('COUNT(*) as count'))
        ->groupBy('hiv_status_enrol')
        ->get();
        $hivFreq = Typology::select('hiv_test_freq', DB::raw('COUNT(*) as count'))
        ->groupBy('hiv_test_freq')
        ->get();
        $hivStatus = Typology::select('hiv_status', DB::raw('COUNT(*) as count'))
        ->groupBy('hiv_status')
        ->get();
        $Cart = Typology::select('currently_art', DB::raw('COUNT(*) as count'))
        ->groupBy('currently_art')
        ->get();
        $Careoutcome = Typology::select('hiv_care_outcome', DB::raw('COUNT(*) as count'))
        ->groupBy('hiv_care_outcome')
        ->get();
        $PeEd = Typology::select('received_peer_education', DB::raw('COUNT(*) as count'))
        ->groupBy('received_peer_education')
        ->get();
        $StiScreened = Typology::select('sti_screened', DB::raw('COUNT(*) as count'))
        ->groupBy('sti_screened')
        ->get();
        $TbScreened = Typology::select('tb_screened', DB::raw('COUNT(*) as count'))
        ->groupBy('tb_screened')
        ->get();
         $SRnames = Demographics::select('sr_name', DB::raw('COUNT(*) as count'))
        ->groupBy('sr_name')
        ->where('region',$selectedRegion)
        ->get();

        return view('pages.region.index',compact('regions','typology','srCount','counties','pe','enrolled','results','hivstatus','hivFreq','hivStatus','Cart','Careoutcome','PeEd','StiScreened','TbScreened','SRnames'));
    }
     public function getCounts(Request $request)
    {
        $region = $request->input('region');

        // Fetch counts based on the selected region
        $srCount = Demographics::where('region', $region)->distinct()->count('sr_name');
        $counties = Demographics::where('region', $region)->distinct()->count('county');
        $pe = Demographics::where('region', $region)->distinct()->count('peer_educator');
        $enrolled = Demographics::where('region', $region)->distinct()->count('uic');

        return response()->json([
            'srCount' => $srCount,
            'counties' => $counties,
            'pe' => $pe,
            'enrolled' => $enrolled,
        ]);
    }
    public function displayAgeChart(Request $request)
{
    $selectedRegion = $request->input('region');

    $ageRanges = [
        '0-18' => [0, 18],
        '19-24' => [19, 24],
        '25-50' => [25, 50],
        'Above 50' => [51, 999], // Adjust upper limit accordingly
    ];

    // Initialize results array with counts set to zero for each age range
    $results = array_fill_keys(array_keys($ageRanges), 0);

    // Query demographics data based on the selected region
    $demographics = Demographics::where('region', $selectedRegion)->get();

    // Iterate over each record and count occurrences in the respective age range
    foreach ($demographics as $record) {
        foreach ($ageRanges as $range => $limits) {
            if ($record->age >= $limits[0] && $record->age <= $limits[1]) {
                $results[$range]++;
                break; // Break the inner loop once the age range is found
            }
        }
    }

    return response()->json($results);
}
public function fetchByRegion(Request $request)
    {
        $selectedRegion = $request->input('region');

        // Query HIV status data based on the selected region
        $hivstatus = Demographics::select('hiv_status_enrol', DB::raw('COUNT(*) as count'))
        ->groupBy('hiv_status_enrol')
        ->where('region',$selectedRegion)
        ->get();

        // Prepare data for the pie chart
        $labels = $hivstatus->pluck('hiv_status_enrol');
        $values = $hivstatus->pluck('count');

        // Return the data in JSON format
        return response()->json([
            'labels' => $labels,
            'values' => $values
        ]);
    }
    public function fetchByHivFreq(Request $request)
    {
        $selectedRegion = $request->input('region');

        // Query HIV status data based on the selected region
        $hivFreq = Typology::select('hiv_test_freq', DB::raw('COUNT(*) as count'))
        ->groupBy('hiv_test_freq')
        ->where('region',$selectedRegion)
        ->get();

        // Prepare data for the pie chart
        $labels = $hivFreq->pluck('hiv_test_freq');
        $values = $hivFreq->pluck('count');

        // Return the data in JSON format
        return response()->json([
            'labels' => $labels,
            'values' => $values
        ]);
    }
    public function fetchByHivStatus(Request $request)
    {
        $selectedRegion = $request->input('region');

        // Query HIV status data based on the selected region
        $hivStatus = Typology::select('hiv_status', DB::raw('COUNT(*) as count'))
        ->groupBy('hiv_status')
        ->where('region',$selectedRegion)
        ->get();

        // Prepare data for the pie chart
        $labels = $hivStatus->pluck('hiv_status');
        $values = $hivStatus->pluck('count');

        // Return the data in JSON format
        return response()->json([
            'labels' => $labels,
            'values' => $values
        ]);
    }
     public function CurrentlyArt(Request $request)
    {
        $selectedRegion = $request->input('region');

        // Query HIV status data based on the selected region
        $Cart = Typology::select('currently_art', DB::raw('COUNT(*) as count'))
        ->groupBy('currently_art')
        ->where('region',$selectedRegion)
        ->get();

        // Prepare data for the pie chart
        $labels = $Cart->pluck('currently_art');
        $values = $Cart->pluck('count');

        // Return the data in JSON format
        return response()->json([
            'labels' => $labels,
            'values' => $values
        ]);
    }
        public function CareOutcome(Request $request)
    {
        $selectedRegion = $request->input('region');

        // Query HIV status data based on the selected region
        $Careoutcome = Typology::select('hiv_care_outcome', DB::raw('COUNT(*) as count'))
        ->groupBy('hiv_care_outcome')
        ->where('region',$selectedRegion)
        ->get();

        // Prepare data for the pie chart
        $labels = $Careoutcome->pluck('hiv_care_outcome');
        $values = $Careoutcome->pluck('count');

        // Return the data in JSON format
        return response()->json([
            'labels' => $labels,
            'values' => $values
        ]);
    }
        public function PeerEducation(Request $request)
    {
        $selectedRegion = $request->input('region');

        // Query HIV status data based on the selected region
        $PeEd = Typology::select('received_peer_education', DB::raw('COUNT(*) as count'))
        ->groupBy('received_peer_education')
        ->where('region',$selectedRegion)
        ->get();

        // Prepare data for the pie chart
        $labels = $PeEd->pluck('received_peer_education');
        $values = $PeEd->pluck('count');

        // Return the data in JSON format
        return response()->json([
            'labels' => $labels,
            'values' => $values
        ]);
    }
        public function StiScreened(Request $request)
    {
        $selectedRegion = $request->input('region');

        // Query HIV status data based on the selected region
        $StiScreened = Typology::select('sti_screened', DB::raw('COUNT(*) as count'))
        ->groupBy('sti_screened')
        ->where('region',$selectedRegion)
        ->get();

        // Prepare data for the pie chart
        $labels = $StiScreened->pluck('sti_screened');
        $values = $StiScreened->pluck('count');

        // Return the data in JSON format
        return response()->json([
            'labels' => $labels,
            'values' => $values
        ]);
    }
    public function TbScreened(Request $request)
    {
        $selectedRegion = $request->input('region');

        // Query HIV status data based on the selected region
        $TbScreened = Typology::select('tb_screened', DB::raw('COUNT(*) as count'))
        ->groupBy('tb_screened')
        ->where('region',$selectedRegion)
        ->get();

        // Prepare data for the pie chart
        $labels = $TbScreened->pluck('tb_screened');
        $values = $TbScreened->pluck('count');

        // Return the data in JSON format
        return response()->json([
            'labels' => $labels,
            'values' => $values
        ]);
    }
    public function SRnames(Request $request)
    {
        $selectedRegion = $request->input('region');

        // Query HIV status data based on the selected region
        $SRnames = Demographics::select('sr_name', DB::raw('COUNT(*) as count'))
        ->groupBy('sr_name')
        ->where('region',$selectedRegion)
        ->get();

        // Return the data in JSON format
        return response()->json($SRnames);
    }


}
