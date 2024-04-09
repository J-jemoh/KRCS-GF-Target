<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Jobs\ProcessCsvChunk;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Schema;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\File;
use App\Models\PMTCT;
use App\Models\Typology;
use Auth;
use Illuminate\Support\Facades\Log;


class PMTCTController extends Controller
{
    public function pmtctTemplate(){

        return view('pages.typology.pmtctTemplate');
    }

    
    public function uploadPmtct(Request $request)
    {
    $request->validate([
        'pmctF' => 'required|mimes:csv',
    ]);

    if ($request->file('pmctF')->isValid()) {
        $file = $request->file('pmctF');
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
            'SR Name' => 'sr_name',
            'County' => 'county',
            'Sub County' => 'sub_county',
            'Care Facility' => 'care_facility',
            'Name' => 'name',
            'Mother CCC No' => 'mother_ccc_no',
            'DOB' => 'dob',
            'Age' => 'age',
            'Phone' => 'phone_number',
            'Lactating' => 'lactating',
            'Pregnant' => 'pregnant',
            'No of ANC Visits' => 'no_of_anc_visits',
            'Delivery at Facility' => 'delivery_at_facility',
            'HEI ID' => 'hei_id',
            'HEI DOB' => 'hei_dob',
            'Age in Months' => 'age_in_months',
            'Sex' => 'sex',
            'Date of Enrolment' => 'date_of_enrolment',
            'Received Prophylaxis at 6 wks' => 'received_prophylaxis_at_6_wks',
            'DNA PCR Status at 6-8 wks' => 'dna_pcr_status_at_6_8_wks',
            'DNA PCR Status at 6 months' => 'dna_pcr_status_at_6_months',
            'DNA PCR Status at 12 months' => 'dna_pcr_status_at_12_months',
            'Test Result of AB at 18 months' => 'test_result_of_ab_at_18_months',
            'Confirm Test Results' => 'confirm_test_results',
            'Linked Facility' => 'linked_facility',
            'HEI CCC Number' => 'hei_ccc_number',
            'Final Outcome' => 'final_outcome',
            'HEI Remarks' => 'hei_remarks',
            'Reached by Expert Mother' => 'reached_by_expert_mother',
            'Attended PSSG' => 'attended_pssg',
            'ART Status' => 'art_status',
            'Due for VL' => 'due_for_vl',
            'VL Done' => 'vl_done',
            'Received VL Result' => 'received_vl_result',
            'VL Copies' => 'vl_copies',
            'Screened for STI' => 'screened_for_sti',
            'Diagnosed for STI' => 'diagonsed_for_sti',
            'Treated for STI' => 'treated_for_sti',
            'Cervical Cancer Screening' => 'cervical_cancer_screening',
            'CaCx Results' => 'cacx_results',
            'Treated for CaCx' => 'treated_for_cacx',
            'Reached with FP Information' => 'reached_with_fp_information',
            'Screened for Pregnancy Intention' => 'screened_for_pregnancy_intention',
            'Currently on FP' => 'currently_on_fp',
            'Screened for TB' => 'screened_for_tb',
            'TB Diagnosis' => 'tb_diagnosis',
            'Referred for TB Treatment' => 'reffered_for_tb_treatment',
            'Experienced Violence' => 'experienced_violence',
            'Received Post Violence Support' => 'received_post_violence_support',
            'Remarks Comments' => 'remarks_comments',
            'Unique Identifier' => 'unique_identifier'

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
                    $uniqueIdentifier = $rowData['sno'] . '-' . $rowData['month'] . '-' . $rowData['year'] . '-' . $rowData['region'] . '-' . $rowData['mother_ccc_no'];
                    $rowData['unique_identifier'] = $uniqueIdentifier;
                    $rowData['user_id'] = $user_id;
                    $batch[] = $rowData;
                    $data = fgetcsv($handle);
                }
                

                // Insert batch data into the database
                PMTCT::upsert($batch, uniqueBy:['unique_identifier'], update:array_keys($batch[0]));
            }

            fclose($handle);

            return redirect()->route('admin.fsw.index')->with('success', 'Your PMTCT Data file has been uploaded successfully.');
        } else {
            return redirect()->route('admin.fsw.index')->with('error', 'Unable to open the CSV file.');
        }
    }

    return redirect()->route('admin.fsw.index')->with('error', 'Invalid file.');
}

    public function pmtctReports(){
        $srCount = PMTCT::distinct()->count('sr_name');
        $counties = PMTCT::distinct()->count('county');
        $region = PMTCT::distinct()->count('region');
        $enrolled = PMTCT::distinct()->count('mother_ccc_no');
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
            $count = PMTCT::whereBetween('age', $limits)->
            distinct()->count('mother_ccc_no');
            $results[$range] = $count;
        }
        #hiv status at enrollment
        $lactatingstatus = PMTCT::select('lactating', DB::raw('COUNT(*) as count'))
                    ->whereIn('mother_ccc_no', function($query) {
                        $query->select('mother_ccc_no')
                              ->distinct()
                              ->from('p_m_t_c_t_s');
                    })
                    ->groupBy('lactating')
                    ->get();
        $PregnantStatus = PMTCT::select('pregnant', DB::raw('COUNT(*) as count'))
                    ->whereIn('mother_ccc_no', function($query) {
                        $query->select('mother_ccc_no')
                              ->distinct()
                              ->from('p_m_t_c_t_s');
                    })
                    ->groupBy('pregnant')
                    ->get();
        $expertMothers = PMTCT::select('reached_by_expert_mother', DB::raw('COUNT(*) as count'))
                    ->whereIn('mother_ccc_no', function($query) {
                        $query->select('mother_ccc_no')
                              ->distinct()
                              ->from('p_m_t_c_t_s');
                    })
                    ->groupBy('reached_by_expert_mother')
                    ->get();
        $artStatus = PMTCT::select('art_status', DB::raw('COUNT(*) as count'))
                    ->whereIn('mother_ccc_no', function($query) {
                        $query->select('mother_ccc_no')
                              ->distinct()
                              ->from('p_m_t_c_t_s');
                    })
                    ->groupBy('art_status')
                    ->get();
         $dueVL = PMTCT::select('due_for_vl', DB::raw('COUNT(*) as count'))
                    ->whereIn('mother_ccc_no', function($query) {
                        $query->select('mother_ccc_no')
                              ->distinct()
                              ->from('p_m_t_c_t_s');
                    })
                    ->groupBy('due_for_vl')
                    ->get();
        $ArtOutcome = Typology::select('art_outcome', DB::raw('COUNT(*) as count'))
        ->where('kp_type','FSW')
        ->groupBy('art_outcome')
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

        return view('pages.typology.pmtct',compact('srCount','counties','region','enrolled','results','lactatingstatus','PregnantStatus','expertMothers','artStatus','dueVL','ArtOutcome','vlDue','vlDone','ReceivedVl','hivStatus','Cart'));
}
}