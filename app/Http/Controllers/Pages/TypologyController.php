<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Demographics;
use App\Models\Typology;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Jobs\ProcessCsvChunk;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Schema;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;

class TypologyController extends Controller
{
    //
public function uploadDemo(Request $request)
{
    $request->validate([
        'demoF' => 'required|mimes:csv',
    ]);

    if ($request->file('demoF')->isValid()) {
        $file = $request->file('demoF');
        $path = $file->getRealPath();

        // Log the file path for debugging
        Log::info('File path: ' . $path);

        // Open the CSV file for reading
        if (($handle = fopen($path, 'r')) !== false) {
            // Remove header if exists and store it
            $headers = fgetcsv($handle);

            if (!$headers) {
                return redirect()->route('admin.fsw.index')->with('error', 'CSV file is empty.');
            }

            // Define mapping between CSV headers and database columns
            $mapping = [
                'SNo' => 'sno',
                'Month' => 'month',
                'Year' => 'year',
                'Region' => 'region',
                'County' => 'county',
                'SR Name' => 'sr_name',
                'KP Name' => 'kp_name',
                'Hotspot' => 'hotspot',
                'Hotspot Typology' => 'hotspot_typology',
                'Other Hospot' => 'other_hotspot',
                'Sub County' => 'subcounty',
                'Ward' => 'ward',
                'KP Phone' => 'kp_phone',
                'KP Type' => 'kp_type',
                'UIC' => 'uic',
                'Age' => 'age',
                'YOB' => 'yob',
                'Sex' => 'sex',
                'First Contact Date' => 'first_contact_date',
                'Enrollment Date' => 'enrol_date',
                'HIV status at Enrollment' => 'hiv_status_enrol',
                'Peer Educator' => 'peer_educator',
                'Peer Educator Code' => 'peer_educator_code'
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
                    $uniqueIdentifier = $rowData['sno'] . '-' . $rowData['month'] . '-' . $rowData['year'] . '-' . $rowData['region'] . '-' . $rowData['uic'];
                    $rowData['unique_identifier'] = $uniqueIdentifier;
                    $rowData['user_id'] = $user_id;
                    $batch[] = $rowData;
                    $data = fgetcsv($handle);
                }
                

                // Insert batch data into the database
                Demographics::upsert($batch, uniqueBy:['unique_identifier'], update:array_keys($batch[0]));
            }

            fclose($handle);

            return redirect()->route('admin.fsw.index')->with('success', 'Your Demographics file has been uploaded successfully.');
        } else {
            return redirect()->route('admin.fsw.index')->with('error', 'Unable to open the CSV file.');
        }
    }

    return redirect()->route('admin.fsw.index')->with('error', 'Invalid file.');
}
public function uploadPartInfo(Request $request)
{
    $request->validate([
        'fswF' => 'required|mimes:csv',
    ]);

    if ($request->file('fswF')->isValid()) {
        $file = $request->file('fswF');
        $path = $file->getRealPath();

        // Log the file path for debugging
        Log::info('File path: ' . $path);

        // Open the CSV file for reading
        if (($handle = fopen($path, 'r')) !== false) {
            // Remove header if exists and store it
            $headers = fgetcsv($handle);

            if (!$headers) {
                return redirect()->route('admin.fsw.index')->with('error', 'CSV file is empty.');
            }

            // Define mapping between CSV headers and database columns
            $mapping = [
                'SNo'=>'sno',
                'Year'=>'year',
                'Month'=>'month',
                'Region'=>'region',
                'KP Type' => 'kp_type',
                'UIC' => 'peer_educator_code',
                'Received Peer Education' => 'received_peer_education',
                'Clinical Services' => 'clinical_services',
                'HIV Tested' => 'hiv_tested',
                'HTS Service Point' => 'hts_service_point',
                'HIV Test Frequency' => 'hiv_test_freq',
                'HIV Status' => 'hiv_status',
                'Self-Test HIV' => 'self_test_hiv',
                'Pre-ART' => 'pre_art',
                'ART Started' => 'art_started',
                'Currently on ART' => 'currently_art',
                'Current Facility Care' => 'current_facility_care',
                'HIV Care Outcome' => 'hiv_care_outcome',
                'ART Outcome' =>'art_outcome',
                'Due VL' => 'due_vl',
                'VL Done' => 'vl_done',
                'VL Result Received' => 'vl_result_received',
                'Att VL Suppression' => 'att_vl_suppression',
                'TB Screened' => 'tb_screened',
                'TB Diagnosed' => 'tb_diagonised',
                'TB Treatment Started' => 'tb_treatment_started',
                'HIV Exposure 72hr' => 'hiv_exposure_72hr',
                'PEP 72' => 'pep_72',
                'Completed PEP' => 'completed_pep',
                'Condom Number Required' => 'condom_nmbr_reqr',
                'Condoms Distributed Number' => 'condom_distributed_nmbr',
                'Condom Provision as Per Need' => 'condom_prov_as_per_need',
                'Lubricant Required Number' => 'lubricant_req_nbr',
                'Lubricant Distributed Number' => 'lubricant_distr_nbr',
                'Lubricant Provision per Need' => 'lubricant_prov_per_need',
                'NSSP Number' => 'nssp_nmbr',
                'NSSP Distributed Number' => 'nssp_distributed_nbr',
                'Received NSSP Need' => 'received_nssp_need',
                'HEPC Screened' => 'hepc_screened',
                'HEPC Status' => 'hepc_status',
                'HEPC Treated' => 'hepc_treated',
                'HEPB Screening' => 'hepb_screening',
                'HEPB Status' => 'hepb_status',
                'On HEPB Treatment' => 'on_hepb_treatment',
                'HEPB Vaccination' => 'hepb_vaccination',
                'STI Screened' => 'sti_screened',
                'STI Diagnosed' => 'sti_diagnosied',
                'STI Treated' => 'sti_treated',
                'Drug Abuse Screened' => 'drug_abuse_screened',
                'PrEP Initiated' => 'prep_initated',
                'On PrEP' => 'on_prep',
                'Modern FP Services' => 'modern_fp_services',
                'RSSH' => 'rssh',
                'EBI' => 'ebi',
                'Exp Violence' => 'exp_violence',
                'Post Violence Support' => 'post_violence_support',
                'Program Status' => 'program_status',
                'TCA' => 'tca'    
            ];

            $user_id = Auth::id();
            $batchSize = 1000; // Adjust the batch size as needed
            $processedUics = []; 

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
                     // Check for duplicate UICs
                    if (in_array($rowData['peer_educator_code'], $processedUics)) {
                        $data = fgetcsv($handle);
                        continue; // Skip the row if it's a duplicate
                    }
                    $uniqueIdentifier = $rowData['month'] . '-' . $rowData['year'] . '-' . $rowData['region'] . '-' . $rowData['peer_educator_code'];
                    $rowData['unique_identifier'] = $uniqueIdentifier;
                    $rowData['user_id'] = $user_id;
                     // Add UIC to the processed list
                    $processedUics[] = $rowData['peer_educator_code'];
                    $batch[] = $rowData;
                    $data = fgetcsv($handle);
                }

                // Insert batch data into the database
                Typology::upsert($batch, uniqueBy:['unique_identifier'], update:array_keys($batch[0]));
            }

            fclose($handle);

            return redirect()->route('admin.fsw.index')->with('success', 'Your Typology file has been uploaded successfully.');
        } else {
            return redirect()->route('admin.fsw.index')->with('error', 'Unable to open the CSV file.');
        }
    }

    return redirect()->route('admin.fsw.index')->with('error', 'Invalid file.');
}
 public function downloadCSV()
    {
        // Fetch all demographics data from the database
        $distinctUICs = Demographics::distinct()->pluck('uic');

// Fetch demographics data where uic is distinct
        $demographics = Demographics::whereIn('uic', $distinctUICs)->get();

        // Get all column names from the demographics table
        $columns = Schema::getColumnListing('demographics');

        // Prepare data for export
        $data = [];
        $data[] = $columns;

        foreach ($demographics as $demographic) {
            $rowData = [];
            foreach ($columns as $column) {
                $rowData[] = $demographic->$column;
            }
            $data[] = $rowData;
        }

        // Generate CSV file content
        $csv = implode("\n", array_map(function ($row) {
            return implode(",", $row);
        }, $data));

        // Set headers for CSV file
        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="demographics_data.csv"',
        );

        // Return response with CSV file content
        return Response::make($csv, 200, $headers);
    
    }
    public function downloadExcel()
        {
            // Fetch all demographics data from the database
            $demographics = Demographics::all();

            // Create new PhpSpreadsheet object
            $spreadsheet = new Spreadsheet();

            // Set properties
            $spreadsheet->getProperties()->setCreator('Your Name')
                                         ->setTitle('Demographics Data');

            // Add data
            $sheet = $spreadsheet->getActiveSheet();

            // Add column headers
            $columns = Schema::getColumnListing('demographics');
            $columnIndex = 1;
            foreach ($columns as $column) {
                $cell = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($columnIndex) . '1';
                $sheet->setCellValue($cell, $column);
                $columnIndex++;
            }

            // Add data rows
            $rowIndex = 2;
            foreach ($demographics as $demographic) {
                $columnIndex = 1;
                foreach ($columns as $column) {
                    $cell = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($columnIndex) . $rowIndex;
                    $sheet->setCellValue($cell, $demographic->$column);
                    $columnIndex++;
                }
                $rowIndex++;
            }

            // Set headers for Excel file
            $headers = [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment;filename="demographics_data.xlsx"',
                'Cache-Control' => 'max-age=0',
            ];

            // Create writer
            $writer = new Xlsx($spreadsheet);

            // Output the Excel file to browser
            ob_end_clean(); // Clean output buffer
            $writer->save('php://output');
            exit();
        }
    public function RetrieveAllData(){
        // Set batch size
        $batchSize = 3000; // Adjust as needed

        // Set headers for CSV file
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="FSW_Consolidated.csv"',
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
                ->where('kp_type','FSW')
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
public function FetchMSMData(){
        // Set batch size
        $batchSize = 3000; // Adjust as needed

        // Set headers for CSV file
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="MSM_Consolidated.csv"',
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
                ->where('kp_type','MSM')
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
    public function FetchTGData(){
        // Set batch size
        $batchSize = 3000; // Adjust as needed

        // Set headers for CSV file
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="TG_Consolidated.csv"',
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
            // Paginate demographics data

    // Loop through each region
    foreach ($regions as $region) {
        // Paginate demographics data for the current region
        $demographicsPage = 1;
        do {
            $demographicsData = Demographics::where('region', $region)
                ->whereIn('kp_type', ['TG', 'TRANS MAN', 'TRANS WOMAN'])
                ->paginate($batchSize, ['*'], 'page', $demographicsPage);
            $demographicsPage++;

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


 public function FetchPWIDData(Request $request){

        $selectedYear = $request->year;
        $selectedMonth = $request->month;

        Log::info('Retrieved Typologies Data for Year: ' . $selectedYear . ', Month: ' . $selectedMonth );
        // Set batch size
        $batchSize = 3000; // Adjust as needed
        $encryptionKey = 'PWKRCS#@2024';

        // Set headers for CSV file
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="PWID_Consolidated.csv"',
            'Encryption-Key' => Crypt::encryptString($encryptionKey),
        ];
        // Stream CSV file content directly to response
        $callback = function () use ($batchSize, $headers,$encryptionKey,$selectedYear, $selectedMonth) {
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
                'tca'

            ];
            fputcsv($file, $columnsToExport);
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
            // Paginate demographics data

    // Loop through each region
    foreach ($regions as $region) {
        // Paginate demographics data for the current region
        $demographicsPage = 1;
        do {
            $demographicsData = Demographics::where('region', $region)
                ->where('kp_type','PWID')
                ->paginate($batchSize, ['*'], 'page', $demographicsPage);
            $demographicsPage++;

            // Retrieve typologies data for the current region
           // Retrieve typologies data for the current region
            // $typologiesData = Typology::whereIn('unique_identifier', $demographicsData->pluck('unique_identifier'))
            //     ->get();
            $typologiesData = Typology::whereIn('peer_educator_code', $demographicsData->pluck('uic'))
                ->where('year',$selectedYear)
                ->where('month',$selectedMonth)
                ->get();

            // Debug: Log the retrieved typologies data
            Log::info('Retrieved Typologies Data for Year: ' . $selectedYear . ', Month: ' . $selectedMonth . ', Count: ' . $typologiesData->count());

            // Create a dictionary of typologies data for efficient lookup
            // $typologiesDict = [];
            // foreach ($typologiesData as $typology) {
            //     $typologiesDict[$typology->unique_identifier] = $typology->toArray();
            // }
            $typologiesDict = [];
                foreach ($typologiesData as $typology) {
                    $typologiesDict[$typology->peer_educator_code] = $typology->toArray();
                }
            Log::info('Demographics Data: ' . $demographicsData->toJson());
            Log::info('Typologies Data: ' . $typologiesData->toJson());

            // Merge and output data
            // foreach ($demographicsData as $demographic) {
            //       $uniqueIdentifier = $demographic->unique_identifier;
            //         $typologyRow = $typologiesDict[$uniqueIdentifier] ?? [];

            //         // Merge demographics and typology data
            //         $mergedRow = array_merge($demographic->toArray(), $typologyRow);

            //         // Select only the specified columns
            //         $selectedColumns = array_intersect_key($mergedRow, array_flip($columnsToExport));
            //         fputcsv($file, $selectedColumns);
            // }
            // Merge and output data
            foreach ($demographicsData as $demographic) {
                    $uic = $demographic->uic;
                    $typologyRow = $typologiesDict[$uic] ?? [];

                    Log::info('UIC: ' . $uic);
                    Log::info('Typology Row: ' . json_encode($typologyRow));

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


