<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AYP;
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

            return redirect()->route('admin.ayp.index')->with('success', 'Your AYP Demographics file has been uploaded successfully.');
        } else {
            return redirect()->route('admin.ayp.index')->with('error', 'Unable to open the CSV file.');
        }
    }

    return redirect()->route('admin.ayp.index')->with('error', 'Invalid file.');
}
}
