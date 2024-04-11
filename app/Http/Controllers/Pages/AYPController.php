<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AYP;
use App\Models\Typology;
use Illuminate\Support\Facades\DB;
use App\Jobs\ProcessCsvChunk;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Schema;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\File;
use Auth;
use Illuminate\Support\Facades\Log;


class AYPController extends Controller
{
    
    public function AYPindex(){

        return view('pages.typology.ayp');
    }

    public function aypTemplate(){
        return view('pages.typology.aypTemplate');
    }

    public function uploadDemo(Request $request)
    {
    $request->validate([
        'aypF' => 'required|mimes:csv',
    ]);

    if ($request->file('aypF')->isValid()) {
        $file = $request->file('aypF');
        $path = $file->getRealPath();

        // Log the file path for debugging
        Log::info('File path: ' . $path);

        // Open the CSV file for reading
        if (($handle = fopen($path, 'r')) !== false) {
            // Remove header if exists and store it
            $headers = fgetcsv($handle);

            if (!$headers) {
                return redirect()->route('admin.ayp.index')->with('error', 'CSV file is empty.');
            }

            // Define mapping between CSV headers and database columns
            $mapping = [
            'SNo' => 'sno',
            'Month' => 'month',
            'Year' => 'year',
            'Region' => 'region',
            'SR Name' => 'sr_name',
            'County' => 'county',
            'Sub County' => 'subcounty',
            'Ward' => 'ward',
            'Reporting Month' => 'reporting_month',
            'Outreach Date' => 'outreach_date',
            'Outreach Venue' => 'outreach_venue',
            'PE Name' => 'pe_name',
            'Peer Name' => 'peer_name',
            'DOB' => 'dob',
            'Age' => 'age',
            'Sex' => 'sex',
            'Disabled' => 'disabled',
            'Disability Type' => 'disability_type',
            'Phone' => 'phone',
            'Attended EBI' => 'attended_ebi',
            'Attended Outreach Within 3 Months' => 'attended_outreach',
            'Provided Health Education' => 'provided_health_edu',
            'Provided Other SRH Information' => 'provided_srh_info',
            'Counseling on Safe Behaviour' => 'counseled_safe_behavior',
            'Family Planning Information' => 'family_planning_info',
            'Offered FP services' => 'offered_fp_services',
            'Risk Assesment' => 'risk_assessment',
            'IEC Material Offered' => 'iec_material_offered',
            'Tested for HIV' => 'tested_hiv',
            'HIV Results' => 'hiv_results',
            'ART Initiated' => 'art_initiated',
            'ART HF Linked to' => 'art_hf_linked_to',
            'CCC Number' => 'ccc_number',
            'Linked to CATS' => 'linked_to_cats',
            'STI Screening' => 'sti_screening',
            'Treated for STI' => 'treated_sti',
            'TB Screened' => 'tb_screened',
            'Referred for TB Treatment' => 'referred_tb_treatment',
            'Screened for SGBV' => 'screened_sgbv',
            'Referred for SGBV Tx' => 'referred_sgbv_tx',
            'Offered Cervical Cancer Screening' => 'cervical_cancer_screening',
            'Referred for Cancer Treatment' => 'referred_cancer_treatment',
            'Offered PEP' => 'offered_pep',
            'Offered PrEP' => 'offered_prep',
            'Offered Condoms(Y/N)' => 'offered_condoms',
            'Number of Condoms Offered' => 'num_condoms_offered',
            'Post Rape  Care Services' => 'post_rape_care_services',
            'Post Abortion Care' => 'post_abortion_care',
            'Treated for Other Ailments' => 'treated_other_ailments',
            'If Yes, specify' => 'if_yes_specify'
            ];

            $user_id = Auth::id();
            $batchSize = 1000; // Adjust the batch size as needed

            // Process CSV data in batches
            while (($data = fgetcsv($handle)) !== false) {
                $batch = [];
                for ($i = 0; $i < $batchSize && $data !== false; $i++) {
                    $rowData = [];
                    foreach ($headers as $index => $header) {
                        $columnName = $mapping[$header] ?? null;
                        if ($columnName) {
                            // Convert encoding to UTF-8
                            $rowData[$columnName] = mb_convert_encoding($data[$index], 'UTF-8', 'UTF-8');
                        }
                    }
                    $uniqueIdentifier = $rowData['sno'] . '-' . $rowData['month'] . '-' . $rowData['year'] . '-' . $rowData['region'] . '-' . $rowData['peer_name'];
                    $rowData['unique_identifier'] = $uniqueIdentifier;
                    $rowData['user_id'] = $user_id;
                    $batch[] = $rowData;
                    $data = fgetcsv($handle);
                }
                

                // Insert batch data into the database
                AYP::upsert($batch, uniqueBy:['unique_identifier'], update:array_keys($batch[0]));
            }

            fclose($handle);

            return redirect()->route('admin.ayp.index')->with('success', 'Your AYP Data file has been uploaded successfully.');
        } else {
            return redirect()->route('admin.ayp.index')->with('error', 'Unable to open the CSV file.');
        }
    }

    return redirect()->route('admin.ayp.index')->with('error', 'Invalid file.');
}

 public function aypReports(){
        $srCount = AYP::distinct()->count('sr_name');
        $counties = AYP::distinct()->count('county');
        $region = AYP::distinct()->count('region');
        $enrolled = AYP::distinct()->count('peer_name');
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
            $count = AYP::whereBetween('age', $limits)->
            distinct()->count('peer_name');
            $results[$range] = $count;
        }
        #hiv status at enrollment
        $disabledstatus = AYP::select('disabled', DB::raw('COUNT(*) as count'))
                    ->whereIn('ccc_number', function($query) {
                        $query->select('ccc_number')
                              ->distinct()
                              ->from('a_y_p_s');
                    })
                    ->groupBy('disabled')
                    ->get();
        $testedHivStatus = AYP::select('tested_hiv', DB::raw('COUNT(*) as count'))
                    ->whereIn('ccc_number', function($query) {
                        $query->select('ccc_number')
                              ->distinct()
                              ->from('a_y_p_s');
                    })
                    ->groupBy('tested_hiv')
                    ->get();
        $artInitiated = AYP::select('art_initiated', DB::raw('COUNT(*) as count'))
                    ->whereIn('ccc_number', function($query) {
                        $query->select('ccc_number')
                              ->distinct()
                              ->from('a_y_p_s');
                    })
                    ->groupBy('art_initiated')
                    ->get();
        $stiScreeneed = AYP::select('sti_screening', DB::raw('COUNT(*) as count'))
                    ->whereIn('ccc_number', function($query) {
                        $query->select('ccc_number')
                              ->distinct()
                              ->from('a_y_p_s');
                    })
                    ->groupBy('sti_screening')
                    ->get();
         $stiTreated = AYP::select('treated_sti', DB::raw('COUNT(*) as count'))
                    ->whereIn('ccc_number', function($query) {
                        $query->select('ccc_number')
                              ->distinct()
                              ->from('a_y_p_s');
                    })
                    ->groupBy('treated_sti')
                    ->get();
       $tbScreenedd = AYP::select('tb_screened', DB::raw('COUNT(*) as count'))
                    ->whereIn('ccc_number', function($query) {
                        $query->select('ccc_number')
                              ->distinct()
                              ->from('a_y_p_s');
                    })
                    ->groupBy('tb_screened')
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

        return view('pages.typology.aypReport',compact('srCount','counties','region','enrolled','results','disabledstatus','testedHivStatus','artInitiated','stiScreeneed','stiTreated','tbScreenedd','vlDue','vlDone','ReceivedVl','hivStatus','Cart'));
}

public function AYPData()
{
    // Set batch size
    $batchSize = 3000; // Adjust as needed

    // Set headers for CSV file
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="AYP_Consolidated.csv"',
    ];

    // Stream CSV file content directly to response
    $callback = function () use ($batchSize) {
        $file = fopen('php://output', 'w');

        // Add column headers
        $columnsToExport = [
            'sno',
            'month',
            'year',
            'region',
            'sr_name',
            'county',
            'subcounty',
            'ward',
            'reporting_month',
            'outreach_date',
            'outreach_venue',
            'pe_name',
            'peer_name',
            'dob',
            'age',
            'sex',
            'disabled',
            'disability_type',
            'phone',
            'attended_ebi',
            'attended_outreach',
            'provided_health_edu',
            'provided_srh_info',
            'counseled_safe_behavior',
            'family_planning_info',
            'offered_fp_services',
            'risk_assessment',
            'iec_material_offered',
            'tested_hiv',
            'hiv_results',
            'art_initiated',
            'art_hf_linked_to',
            'ccc_number',
            'linked_to_cats',
            'sti_screening',
            'treated_sti',
            'tb_screened',
            'referred_tb_treatment',
            'screened_sgbv',
            'referred_sgbv_tx',
            'cervical_cancer_screening',
            'referred_cancer_treatment',
            'offered_pep',
            'offered_prep',
            'offered_condoms',
            'num_condoms_offered',
            'post_rape_care_services',
            'post_abortion_care',
            'treated_other_ailments',
            'if_yes_specify'
        ];
        fputcsv($file, $columnsToExport);

        // Paginate and output AYP data
       $demographicsPage = 1;
        do {
            $demographicsData = AYP::paginate($batchSize, $columnsToExport, 'page', $demographicsPage);
            $demographicsPage++;

            foreach ($demographicsData as $demographic) {
                fputcsv($file, $demographic->toArray());
            }
        } while ($demographicsData->hasMorePages());

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}


}
