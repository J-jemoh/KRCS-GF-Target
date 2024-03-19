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
                    $rowData['user_id'] = $user_id;
                    $batch[] = $rowData;
                    $data = fgetcsv($handle);
                }

                // Insert batch data into the database
                Demographics::upsert($batch, ['sno','month', 'year', 'region','uic'], array_keys($batch[0]));
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
                'Year'=>'year',
                'Month'=>'month',
                'Region'=>'region',
                'Peer Educator Code' => 'peer_educator_code',
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
                    $rowData['user_id'] = $user_id;
                    $batch[] = $rowData;
                    $data = fgetcsv($handle);
                }

                // Insert batch data into the database
                Typology::upsert($batch, ['year', 'month', 'region','peer_educator_code'], array_keys($batch[0]));
            }

            fclose($handle);

            return redirect()->route('admin.fsw.index')->with('success', 'Your Demographics file has been uploaded successfully.');
        } else {
            return redirect()->route('admin.fsw.index')->with('error', 'Unable to open the CSV file.');
        }
    }

    return redirect()->route('admin.fsw.index')->with('error', 'Invalid file.');
}
 public function downloadCSV()
    {
        // Fetch all demographics data from the database
        $demographics = Demographics::all();

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
       // $demographics = Demographics::with('typology')->get();
         // Retrieve data from demographics table
    $demographicsData = Demographics::select('*')->get();

    // Retrieve data from typologies table
    $typologiesData = Typology::select('*')->get();

    // Merge data from both tables
    $mergedData = [];
    foreach ($demographicsData as $demographic) {
        $mergedRow = $demographic->toArray();
        foreach ($typologiesData as $typology) {
            if ($demographic->year === $typology->year &&
                $demographic->month === $typology->month &&
                $demographic->region === $typology->region) {
                $mergedRow = array_merge($mergedRow, $typology->toArray());
                break; // Found matching typology, move to the next demographic
            }
        }
        $mergedData[] = $mergedRow;
    }

    // Set headers for CSV file
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="FSW_Consolidated.csv"',
    ];

    // Stream CSV file content directly to response
    $callback = function () use ($mergedData) {
        $file = fopen('php://output', 'w');

        // Add column headers
        fputcsv($file, array_keys($mergedData[0]));

        // Add data rows
        foreach ($mergedData as $row) {
            fputcsv($file, $row);
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
     //    $demographics = Demographics::join('typologies', function ($join) {
     //    $join->on('typologies.year', '=', 'demographics.year')
     //         ->on('typologies.month', '=', 'demographics.month')
     //         ->on('typologies.region', '=', 'demographics.region');
     //        })
     //        ->select('demographics.*', 'typologies.*')
     //        ->get();

     // // return $demographics->toJson();
     //        // Prepare data for export
     //        $data = [];

     //        // Add column headers
     //        $columns = array_merge(
     //            array_keys($demographics->first()->getAttributes()),
     //            array_keys($demographics->first()->typology->getAttributes())
     //        );

     //        $data[] = $columns;

     //        foreach ($demographics as $demographic) {
     //            $rowData = [];
     //            foreach ($columns as $column) {
     //                $rowData[] = $demographic->$column;
     //            }
     //            $data[] = $rowData;
     //        }

     //        // Generate CSV file content
     //        $csv = implode("\n", array_map(function ($row) {
     //            return implode(",", $row);
     //        }, $data));

     //        // Set headers for CSV file
     //        $headers = [
     //            'Content-Type' => 'text/csv',
     //            'Content-Disposition' => 'attachment; filename="FSW_Consolidated.csv"',
     //        ];

     //        // Return response with CSV file content
     //        return response()->make($csv, 200, $headers);


    }



    
}

