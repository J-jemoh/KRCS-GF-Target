<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VP_DC;
use App\Models\PMTCT;
use App\Models\Typology;
use Illuminate\Support\Facades\DB;
use App\Jobs\ProcessCsvChunk;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Schema;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\File;
use Auth;
use App\Models\EbanDemographic;
use App\Models\EbanService;
use Illuminate\Support\Facades\Log;

class VPController extends Controller
{
    //
    public function dcTemplate(){

        return view('pages.vp.dcTemplate');
    }
public function uploadDC(Request $request)
    {
    $request->validate([
        'dcF' => 'required|mimes:csv',
    ]);

    if ($request->file('dcF')->isValid()) {
        $file = $request->file('dcF');
        $path = $file->getRealPath();

        // Log the file path for debugging
        Log::info('File path: ' . $path);

        // Open the CSV file for reading
        if (($handle = fopen($path, 'r')) !== false) {
            // Remove header if exists and store it
            $headers = fgetcsv($handle);

            if (!$headers) {
                return redirect()->route('admin.vp.index')->with('error', 'CSV file is empty.');
            }

            // Define mapping between CSV headers and database columns
          $mapping = [
                'SNo' => 'sno',
                'Month' => 'month',
                'Year' => 'year',
                'Implementing partner' => 'implementing_partner',
                'Region' => 'region',
                'County' => 'County',
                'Subcounty' => 'Subcounty',
                'Name of peer educator' => 'peer_educator',
                'Name of peer' => 'peer_name',
                'Facility' => 'facility',
                'Ward' => 'ward',
                'Disability' => 'disability',
                'Sex' => 'sex',
                'Age' => 'age',
                'Phone no' => 'phone_no',
                'First contact date' => 'first_contact_date',
                'Enrollment Date' => 'enrol_date',
                'HIV status at enrollment' => 'hiv_status_at_enrollment',
                'Received health education' => 'received_health_education',
                'Tested for HIV' => 'tested_hiv',
                'Frequency of HIV test' => 'frequency_of_hiv_test',
                'HIV status' => 'hiv_status',
                'Started on ART' => 'started_on_art',
                'Currently on ART' => 'currently_on_art',
                'Due for viral load' => 'due_for_vl',
                'Received viral load test' => 'received_vl_test',
                'Viral load copies' => 'vl_copies',
                'Screened for TB' => 'screened_for_tb',
                'Diagnosed with TB' => 'diagnosed_with_tb',
                'Started TB treatment' => 'started_tb_treatment',
                'Screened for STI' => 'screened_for_sti',
                'Diagnosed with STI' => 'diagnosed_with_sti',
                'Treated for STI' => 'treated_for_sti',
                'Initiated on PrEP' => 'initiated_on_prep',
                'Currently on PrEP' => 'currently_on_prep',
                'Issued with condoms' => 'issued_with_condoms',
                'Attended of PSSG' => 'tttended_of_pssg',
                'Reached with EBAN-K' => 'reached_with_eban',
                'Experienced violence' => 'experienced_violence',
                'Received post violence support' => 'received_post_violence_support',
                'Status in programme' => 'programme_status',
                'Remarks' => 'remarks'
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
                VP_DC::upsert($batch, uniqueBy:['unique_identifier'], update:array_keys($batch[0]));
            }

            fclose($handle);

            return redirect()->route('admin.vp.index')->with('success', 'Your DC Data file has been uploaded successfully.');
        } else {
            return redirect()->route('admin.vp.index')->with('error', 'Unable to open the CSV file.');
        }
    }

    return redirect()->route('admin.vp.index')->with('error', 'Invalid file.');
}
public function DCReports(){
        $srCount = VP_DC::distinct()->count('implementing_partner');
        $counties = VP_DC::distinct()->count('county');
        $region = VP_DC::distinct()->count('region');
        $enrolled = VP_DC::distinct()->count('peer_name');
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
            $count = VP_DC::whereBetween('age', $limits)->
            distinct()->count('peer_name');
            $results[$range] = $count;
        }
        #hiv status at enrollment
        $HIVstatEnrol = VP_DC::select('hiv_status_at_enrollment', DB::raw('COUNT(*) as count'))
                    ->whereIn('peer_name', function($query) {
                        $query->select('peer_name')
                              ->distinct()
                              ->from('v_p__d_c_s');
                    })
                    ->groupBy('hiv_status_at_enrollment')
                    ->get();
        $HEducation = VP_DC::select('received_health_education', DB::raw('COUNT(*) as count'))
                    ->whereIn('peer_name', function($query) {
                        $query->select('peer_name')
                              ->distinct()
                              ->from('v_p__d_c_s');
                    })
                    ->groupBy('received_health_education')
                    ->get();
        $HIVTested = VP_DC::select('tested_hiv', DB::raw('COUNT(*) as count'))
                    ->whereIn('peer_name', function($query) {
                        $query->select('peer_name')
                              ->distinct()
                              ->from('v_p__d_c_s');
                    })
                    ->groupBy('tested_hiv')
                    ->get();
        $TestFreq = VP_DC::select('frequency_of_hiv_test', DB::raw('COUNT(*) as count'))
                    ->whereIn('peer_name', function($query) {
                        $query->select('peer_name')
                              ->distinct()
                              ->from('v_p__d_c_s');
                    })
                    ->groupBy('frequency_of_hiv_test')
                    ->get();
        $HIVStatus = VP_DC::select('hiv_status', DB::raw('COUNT(*) as count'))
                    ->whereIn('peer_name', function($query) {
                        $query->select('peer_name')
                              ->distinct()
                              ->from('v_p__d_c_s');
                    })
                    ->groupBy('hiv_status')
                    ->get();
        $SART = VP_DC::select('started_on_art', DB::raw('COUNT(*) as count'))
                    ->whereIn('peer_name', function($query) {
                        $query->select('peer_name')
                              ->distinct()
                              ->from('v_p__d_c_s');
                    })
                    ->groupBy('started_on_art')
                    ->get();
        $CART = VP_DC::select('currently_on_art', DB::raw('COUNT(*) as count'))
                    ->whereIn('peer_name', function($query) {
                        $query->select('peer_name')
                              ->distinct()
                              ->from('v_p__d_c_s');
                    })
                    ->groupBy('currently_on_art')
                    ->get();
        $vlDue = VP_DC::select('due_for_vl', DB::raw('COUNT(*) as count'))
                    ->whereIn('peer_name', function($query) {
                        $query->select('peer_name')
                              ->distinct()
                              ->from('v_p__d_c_s');
                    })
                    ->groupBy('due_for_vl')
                    ->get();
       $vlReceived = VP_DC::select('received_vl_test', DB::raw('COUNT(*) as count'))
                    ->whereIn('peer_name', function($query) {
                        $query->select('peer_name')
                              ->distinct()
                              ->from('v_p__d_c_s');
                    })
                    ->groupBy('received_vl_test')
                    ->get();
        $vlReceivedC = VP_DC::select(
                    DB::raw('CASE
                                WHEN vl_copies = "LDL" THEN "LDL"
                                WHEN vl_copies = "AWAITING  RESULTS" THEN "Awaiting results"
                                WHEN vl_copies = "NOT SUPPRESSED" THEN "Suppressed"
                                WHEN vl_copies = "SUPPRESSED" THEN "Not Suppressed"
                                WHEN vl_copies = "NA" THEN "NA"
                                WHEN CAST(vl_copies AS UNSIGNED) < 200 THEN "< 200 copies"
                                WHEN CAST(vl_copies AS UNSIGNED) > 1000 THEN "> 200 copies"
                                ELSE vl_copies
                             END as vl_copies_category'),
                    DB::raw('COUNT(*) as count')
                )
                ->whereIn('peer_name', function($query) {
                    $query->select('peer_name')
                          ->distinct()
                          ->from('v_p__d_c_s');
                })
                ->groupBy('vl_copies_category')
                ->orderByRaw('CASE WHEN vl_copies_category = "LDL" THEN 1 WHEN vl_copies_category = "Awaiting results" THEN 2 WHEN vl_copies_category = "Suppressed" THEN 3 WHEN vl_copies_category = "< 200 copies" THEN 4 ELSE 5 END')
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

        return view('pages.vp.dc_report',compact('srCount','counties','region','enrolled','results','HIVstatEnrol','HEducation','HIVTested','TestFreq','HIVStatus','SART','CART','vlReceived','vlDue','vlDone','ReceivedVl','hivStatus','Cart','vlReceivedC'));
}

public function DCData()
{
    // Set batch size
    $batchSize = 3000; // Adjust as needed

    // Set headers for CSV file
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="Discodant_Couples_Consolidated.csv"',
    ];

    // Stream CSV file content directly to response
    $callback = function () use ($batchSize) {
        $file = fopen('php://output', 'w');

        // Add column headers
        $columnsToExport = [
           'sno',
            'month',
            'Year',
            'implementing_partner',
            'region',
            'County',
            'Subcounty',
            'peer_educator',
            'peer_name',
            'facility',
            'ward',
            'disability',
            'sex',
            'age',
            'phone_no',
            'first_contact_date',
            'enrol_date',
            'hiv_status_at_enrollment',
            'received_health_education',
            'tested_hiv',
            'frequency_of_hiv_test',
            'hiv_status',
            'started_on_art',
            'currently_on_art',
            'due_for_vl',
            'received_vl_test',
            'vl_copies',
            'screened_for_tb',
            'diagnosed_with_tb',
            'started_tb_treatment',
            'screened_for_sti',
            'diagnosed_with_sti',
            'treated_for_sti',
            'initiated_on_prep',
            'currently_on_prep',
            'issued_with_condoms',
            'tttended_of_pssg',
            'reached_with_eban',
            'experienced_violence',
            'received_post_violence_support',
            'programme_status',
            'remarks'

        ];
        fputcsv($file, $columnsToExport);

        // Paginate and output AYP data
       $demographicsPage = 1;
        do {
            $demographicsData = VP_DC::paginate($batchSize, $columnsToExport, 'page', $demographicsPage);
            $demographicsPage++;

            foreach ($demographicsData as $demographic) {
                fputcsv($file, $demographic->toArray());
            }
        } while ($demographicsData->hasMorePages());

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}

public function EbanDemo(){

    return view('pages.vp.ebandemoTemplate');
}
public function ServiceDemo(){

    return view('pages.vp.ebanServiceTemplate');
}

public function uploadEbanDemo(Request $request)
    {
    $request->validate([
        'ebandF' => 'required|mimes:csv',
    ]);

    if ($request->file('ebandF')->isValid()) {
        $file = $request->file('ebandF');
        $path = $file->getRealPath();

        // Log the file path for debugging
        Log::info('File path: ' . $path);

        // Open the CSV file for reading
        if (($handle = fopen($path, 'r')) !== false) {
            // Remove header if exists and store it
            $headers = fgetcsv($handle);

            if (!$headers) {
                return redirect()->route('admin.vp.index')->with('error', 'CSV file is empty.');
            }

            // Define mapping between CSV headers and database columns
        $mapping = [
                'SNo' => 'sno',
                'Month' => 'month',
                'Year' => 'year',
                'Region' => 'region',
                'Counties' => 'counties',
                'Sub county' => 'sub_county',
                'Ward' => 'ward',
                'Site Name' => 'site_name',
                'Implementing partner' => 'implementing_partner',
                'Facilitator I' => 'facilitator_i',
                'Facilitator II' => 'facilitator_ii',
                'Group: No/Name' => 'group_no_name',
                'Start date' => 'start_date',
                'End date' => 'end_date',
                'COUPLE CODE' => 'couple_code',
                'Participant Name' => 'participant_name',
                'Age' => 'age',
                'Sex' => 'sex',
                'HIV Status' => 'hiv_status'
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
                    $uniqueIdentifier = $rowData['sno'] . '-' . $rowData['month'] . '-' . $rowData['year'] . '-' . $rowData['region'] . '-' . $rowData['couple_code'];
                    $rowData['unique_identifier'] = $uniqueIdentifier;
                    $rowData['user_id'] = $user_id;
                    $batch[] = $rowData;
                    $data = fgetcsv($handle);
                }
                

                // Insert batch data into the database
                EbanDemographic::upsert($batch, uniqueBy:['unique_identifier'], update:array_keys($batch[0]));
            }

            fclose($handle);

            return redirect()->route('admin.vp.index')->with('success', 'Your Eban Demographic Data file has been uploaded successfully.');
        } else {
            return redirect()->route('admin.vp.index')->with('error', 'Unable to open the CSV file.');
        }
    }

    return redirect()->route('admin.vp.index')->with('error', 'Invalid file.');
}

public function uploadEbanService(Request $request)
    {
    $request->validate([
        'ebanSF' => 'required|mimes:csv',
    ]);

    if ($request->file('ebanSF')->isValid()) {
        $file = $request->file('ebanSF');
        $path = $file->getRealPath();

        // Log the file path for debugging
        Log::info('File path: ' . $path);

        // Open the CSV file for reading
        if (($handle = fopen($path, 'r')) !== false) {
            // Remove header if exists and store it
            $headers = fgetcsv($handle);

            if (!$headers) {
                return redirect()->route('admin.vp.index')->with('error', 'CSV file is empty.');
            }

            // Define mapping between CSV headers and database columns
        $mapping = [
                'SNo' => 'sno',
                'Month' => 'month',
                'Year' => 'year',
                'Region' => 'region',
                'Counties' => 'counties',
                'COUPLE CODE' => 'couple_code',
                'S1' => 's1',
                'S2' => 's2',
                'S3' => 's3',
                'S4' => 's4',
                'S5' => 's5',
                'S6' => 's6',
                'S7' => 's7',
                'S8' => 's8',
                'Make up sessions' => 'make_up_sessions',
                'Complete session' => 'complete_session',
                'Provide with Condom' => 'provide_with_condom',
                'PREP(R)' => 'prep_r',
                'PREP(C)' => 'prep_c',
                'PEP(R)' => 'pep_r',
                'PEP(C)' => 'pep_c',
                'PSS(R)' => 'pss_r',
                'PSS(C)' => 'pss_c',
                'HTS(R)' => 'hts_r',
                'HTS(C)' => 'hts_c',
                'FP(R)' => 'fp_r',
                'FP(C)' => 'fp_c',
                'GBV(R)' => 'gbv_r',
                'GBV(C)' => 'gbv_c',
                'STI(R)' => 'sti_r',
                'STI(C)' => 'sti_c',
                'VMMC(R)' => 'vmmc_r',
                'VMMC(C)' => 'vmmc_c',
                'AUDIT(R)' => 'audit_r',
                'AUDIT(C)' => 'audit_c',
                'CARE(R)' => 'care_r',
                'CARE(C)' => 'care_c',
                'CERVICAL CANCER-S(R)' => 'cervical_cancer_s_r',
                'CERVICAL CANCER(C)' => 'cervical_cancer_c',
                'PMTCT(R)' => 'pmtct_r',
                'PMTCT(C)' => 'pmtct_c',
                'OTHER(R)' => 'other_r',
                'OTHER(C)' => 'other_c',
                'Comments' => 'comments'

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
                    $uniqueIdentifier = $rowData['sno'] . '-' . $rowData['month'] . '-' . $rowData['year'] . '-' . $rowData['region'] . '-' . $rowData['couple_code'];
                    $rowData['unique_identifier'] = $uniqueIdentifier;
                    $rowData['user_id'] = $user_id;
                    $batch[] = $rowData;
                    $data = fgetcsv($handle);
                }
                

                // Insert batch data into the database
                EbanService::upsert($batch, uniqueBy:['unique_identifier'], update:array_keys($batch[0]));
            }

            fclose($handle);

            return redirect()->route('admin.vp.index')->with('success', 'Your Eban Service Data file has been uploaded successfully.');
        } else {
            return redirect()->route('admin.vp.index')->with('error', 'Unable to open the CSV file.');
        }
    }

    return redirect()->route('admin.vp.index')->with('error', 'Invalid file.');
}

public function EbanReport(){

        $srCount = EbanDemographic::distinct()->count('implementing_partner');
        $counties = EbanDemographic::distinct()->count('counties');
        $region = EbanDemographic::distinct()->count('region');
        $enrolled = EbanDemographic::distinct()->count();
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
            $count = EbanDemographic::whereBetween('age', $limits)->
            distinct()->count('participant_name');
            $results[$range] = $count;
        }
        $HIVStatus = EbanDemographic::select('hiv_status', DB::raw('COUNT(*) as count'))
                    ->whereIn('participant_name', function($query) {
                        $query->select('participant_name')
                              ->distinct()
                              ->from('eban_demographics');
                    })
                    ->groupBy('hiv_status')
                    ->get();
        $SexStatus = EbanDemographic::select('sex', DB::raw('COUNT(*) as count'))
                    ->whereIn('participant_name', function($query) {
                        $query->select('participant_name')
                              ->distinct()
                              ->from('eban_demographics');
                    })
                    ->groupBy('sex')
                    ->get();
         $PCondom = EbanService::select('provide_with_condom', DB::raw('COUNT(*) as count'))
                    ->whereIn('unique_identifier', function($query) {
                        $query->select('unique_identifier')
                              ->distinct()
                              ->from('eban_services');
                    })
                    ->groupBy('provide_with_condom')
                    ->get();
        $Csessions = EbanService::select('complete_session', DB::raw('COUNT(*) as count'))
                    ->whereIn('unique_identifier', function($query) {
                        $query->select('unique_identifier')
                              ->distinct()
                              ->from('eban_services');
                    })
                    ->groupBy('complete_session')
                    ->get();

    return view('pages.vp.eban_Report',compact('srCount','counties','region','enrolled','results','HIVStatus','SexStatus','PCondom','Csessions'));
}

public function ebanDownload(){

      // Set batch size
        $batchSize = 3000; // Adjust as needed

        // Set headers for CSV file
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="Eban_Consolidated.csv"',
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
                'counties',
                'sub_county',
                'ward',
                'site_name',
                'implementing_partner',
                'facilitator_i',
                'facilitator_ii',
                'group_no_name',
                'start_date',
                'end_date',
                'couple_code',
                'participant_name',
                'age',
                'sex',
                'hiv_status',

                // Columns from typologies table
                's1',
                's2',
                's3',
                's4',
                's5',
                's6',
                's7',
                's8',
                'make_up_sessions',
                'complete_session',
                'provide_with_condom',
                'prep_r',
                'prep_c',
                'pep_r',
                'pep_c',
                'pss_r',
                'pss_c',
                'hts_r',
                'hts_c',
                'fp_r',
                'fp_c',
                'gbv_r',
                'gbv_c',
                'sti_r',
                'sti_c',
                'vmmc_r',
                'vmmc_c',
                'audit_r',
                'audit_c',
                'care_r',
                'care_c',
                'cervical_cancer_s_r',
                'cervical_cancer_c',
                'pmtct_r',
                'pmtct_c',
                'other_r',
                'other_c',
                'comments'


            ];

            fputcsv($file, $columnsToExport);

            // Paginate demographics data
            $regions = EbanDemographic::select('region')->distinct()->pluck('region');

    // Loop through each region
    foreach ($regions as $region) {
        // Paginate demographics data for the current region
        $demographicsPage = 1;
        do {
            $demographicsData = EbanDemographic::where('region', $region)
                ->paginate($batchSize, ['*'], 'page', $demographicsPage);
            $demographicsPage++;

            // Retrieve typologies data for the current region
            $typologiesData = EbanService::whereIn('year', $demographicsData->pluck('year'))
                ->whereIn('month', $demographicsData->pluck('month'))
                ->where('region', $region)
                ->get();

            // Create a dictionary of typologies data for efficient lookup
            $typologiesDict = [];
            foreach ($typologiesData as $typology) {
                $key = "{$typology->year}-{$typology->month}-{$typology->region}";
                $typologiesDict[$key] = $typology->toArray();
            }

            // Merge and output data
            foreach ($demographicsData as $demographic) {
                $key = "{$demographic->year}-{$demographic->month}-{$demographic->region}";
                $typologyRow = $typologiesDict[$key] ?? [];
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
