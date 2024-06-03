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
use App\Models\AYPMentorship;
use App\Models\AYP_HCBF;
use App\Models\AYP_MHMC;
use Illuminate\Support\Facades\Log;


class AYPController extends Controller
{
    
    public function AYPindex(){

        return view('pages.typology.ayp');
    }

    public function aypTemplate(){
        return view('pages.typology.aypTemplate');
    }
    public function aypMentorshipTemplate(){
        return view('pages.typology.aypMentorshipTemplate');
    }
    public function aypHCBFTemplate(){
        return view('pages.typology.aypHCBFTemplate');
    }
    public function aypMHMCTemplate(){
        return view('pages.typology.aypMHMCTemplate');
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
                    $uniqueIdentifier = $rowData['month'] . '-' . $rowData['year'] . '-' . $rowData['region'] . '-' . $rowData['peer_name'];
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

        $loggedregion=Auth::user()->region;
        if($loggedregion=='HQ'){

            $aypCounts = AYP::selectRaw('COUNT(DISTINCT sr_name) AS srCount, COUNT(DISTINCT county) AS countyCount, COUNT(DISTINCT region) AS regionCount, COUNT(DISTINCT peer_name) AS enrolledCount')
                ->first();

            #AYP Mentorship
            $aypMentorshipCounts = AYPMentorship::selectRaw('COUNT(DISTINCT implementingpartner) AS srCount, COUNT(DISTINCT counties) AS countyCount, COUNT(DISTINCT region) AS regionCount, COUNT(uniqueidentifier) AS enrolledCount')
                ->first();
             #AYP HCBF
            $aypHCBFCounts = AYP_HCBF::selectRaw('COUNT(DISTINCT implementing_partner) AS srCount, COUNT(DISTINCT county) AS countyCount, COUNT(DISTINCT region) AS regionCount, COUNT(unique_identifier) AS enrolledCount')
                ->first();
            $aypMHMCCounts = AYP_MHMC::selectRaw('COUNT(DISTINCT implementing_partner) AS srCount, COUNT(DISTINCT county) AS countyCount, COUNT(DISTINCT region) AS regionCount, COUNT(unique_identifier) AS enrolledCount')
                ->first();
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
                $aypCount = AYP::whereBetween('age', $limits)->
                distinct()->count('peer_name');
                $mentorshipCount = AYPMentorship::whereBetween('age', $limits)
                                    ->distinct()
                                    ->count('menteename');
                $hcbfCount = AYP_HCBF::whereBetween('age', $limits)
                                    ->distinct()
                                    ->count('name');
                $mhmcCount = AYP_MHMC::whereBetween('age', $limits)
                                    ->distinct()
                                    ->count('unique_identifier');
                $results[$range] = [

                    'ayp' => $aypCount,
                    'mentorship' => $mentorshipCount,
                    'hcbfd'=>$hcbfCount,
                    'mhmcd' => $mhmcCount
                ];
            }
            #gendercount
            $gendercount=AYPMentorship::select('sex', DB::raw('COUNT(*) as count'))
                        ->whereIn('menteename', function($query) {
                            $query->select('menteename')
                                  ->distinct()
                                  ->from('a_y_p_mentorships');
                        })
                        ->groupBy('sex')
                        ->get();
            $genderhcbf=AYP_HCBF::select('sex', DB::raw('COUNT(*) as count'))
                        ->whereIn('unique_identifier', function($query) {
                            $query->select('unique_identifier')
                                  ->distinct()
                                  ->from('a_y_p__h_c_b_f_s');
                        })
                        ->groupBy('sex')
                        ->get();
            $gendermhmc=AYP_MHMC::select('sex', DB::raw('COUNT(*) as count'))
                        ->whereIn('unique_identifier', function($query) {
                            $query->select('unique_identifier')
                                  ->distinct()
                                  ->from('a_y_p__m_h_m_c_s');
                        })
                        ->groupBy('sex')
                        ->get();
            $completeSessions=AYPMentorship::select('complete_session', DB::raw('COUNT(*) as count'))
                        ->whereIn('menteename', function($query) {
                            $query->select('menteename')
                                  ->distinct()
                                  ->from('a_y_p_mentorships');
                        })
                        ->groupBy('complete_session')
                        ->get();
            $completeSessionshcbf=AYP_HCBF::select('complete_sessions', DB::raw('COUNT(*) as count'))
                        ->whereIn('unique_identifier', function($query) {
                            $query->select('unique_identifier')
                                  ->distinct()
                                  ->from('a_y_p__h_c_b_f_s');
                        })
                        ->groupBy('complete_sessions')
                        ->get();
             $completeSessionsmhmc=AYP_MHMC::select('complete_sessions', DB::raw('COUNT(*) as count'))
                        ->whereIn('unique_identifier', function($query) {
                            $query->select('unique_identifier')
                                  ->distinct()
                                  ->from('a_y_p__m_h_m_c_s');
                        })
                        ->groupBy('complete_sessions')
                        ->get();
            $attendedOutreach=AYPMentorship::select('attended_outreach', DB::raw('COUNT(*) as count'))
                        ->whereIn('menteename', function($query) {
                            $query->select('menteename')
                                  ->distinct()
                                  ->from('a_y_p_mentorships');
                        })
                        ->groupBy('attended_outreach')
                        ->get();
            $ebiStatus=AYPMentorship::select('attended_ebi', DB::raw('COUNT(*) as count'))
                        ->whereIn('menteename', function($query) {
                            $query->select('menteename')
                                  ->distinct()
                                  ->from('a_y_p_mentorships');
                        })
                        ->groupBy('attended_ebi')
                        ->get();
            $Countycount=AYPMentorship::select('counties', DB::raw('COUNT(*) as count'))
                        ->whereIn('menteename', function($query) {
                            $query->select('menteename')
                                  ->distinct()
                                  ->from('a_y_p_mentorships');
                        })
                        ->groupBy('counties')
                        ->get();
            $Countycountmhmc=AYP_MHMC::select('county', DB::raw('COUNT(*) as count'))
                        ->whereIn('unique_identifier', function($query) {
                            $query->select('unique_identifier')
                                  ->distinct()
                                  ->from('a_y_p__m_h_m_c_s');
                        })
                        ->groupBy('county')
                        ->get();
             $Countycounthcbf=AYP_HCBF::select('county', DB::raw('COUNT(*) as count'))
                        ->whereIn('unique_identifier', function($query) {
                            $query->select('unique_identifier')
                                  ->distinct()
                                  ->from('a_y_p__h_c_b_f_s');
                        })
                        ->groupBy('county')
                        ->get();
            $SRcountmhmc=AYP_MHMC::select('implementing_partner', DB::raw('COUNT(*) as count'))
                        ->whereIn('unique_identifier', function($query) {
                            $query->select('unique_identifier')
                                  ->distinct()
                                  ->from('a_y_p__m_h_m_c_s');
                        })
                        ->groupBy('implementing_partner')
                        ->get();
            $SRcounthcbf=AYP_HCBF::select('implementing_partner', DB::raw('COUNT(*) as count'))
                        ->whereIn('unique_identifier', function($query) {
                            $query->select('unique_identifier')
                                  ->distinct()
                                  ->from('a_y_p__h_c_b_f_s');
                        })
                        ->groupBy('implementing_partner')
                        ->get();
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
        }
        else{

            $aypCounts = AYP::selectRaw('COUNT(DISTINCT sr_name) AS srCount, COUNT(DISTINCT county) AS countyCount, COUNT(DISTINCT region) AS regionCount, COUNT(DISTINCT peer_name) AS enrolledCount')
                ->where('region', $loggedregion)
                ->first();

            #AYP Mentorship
             $aypMentorshipCounts = AYPMentorship::selectRaw('COUNT(DISTINCT implementingpartner) AS srCount, COUNT(DISTINCT counties) AS countyCount, COUNT(DISTINCT region) AS regionCount, COUNT(uniqueidentifier) AS enrolledCount')
                ->where('region', $loggedregion)
                ->first();
            #ayp hcbf;
            $aypHCBFCounts = AYP_HCBF::selectRaw('COUNT(DISTINCT implementing_partner) AS srCount, COUNT(DISTINCT county) AS countyCount, COUNT(DISTINCT region) AS regionCount, COUNT(unique_identifier) AS enrolledCount')
                 ->where('region', $loggedregion)
                ->first();
            $aypMHMCCounts = AYP_MHMC::selectRaw('COUNT(DISTINCT implementing_partner) AS srCount, COUNT(DISTINCT county) AS countyCount, COUNT(DISTINCT region) AS regionCount, COUNT(unique_identifier) AS enrolledCount')
                ->where('region', $loggedregion)
                ->first();
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
                $aypCount = AYP::where('region',$loggedregion)->whereBetween('age', $limits)->
                distinct()->count('peer_name');
                $mentorshipCount = AYPMentorship::where('region', $loggedregion)
                                    ->whereBetween('age', $limits)
                                    ->distinct()
                                    ->count('menteename');
                $hcbfCount = AYP_HCBF::where('region', $loggedregion)
                                    ->whereBetween('age', $limits)
                                    ->distinct()
                                    ->count('name');
                $mhmcCount = AYP_MHMC::where('region', $loggedregion)
                                    ->whereBetween('age', $limits)
                                    ->distinct()
                                    ->count('unique_identifier');
                $results[$range] = [

                    'ayp' => $aypCount,
                    'mentorship' => $mentorshipCount,
                    'hcbfd' => $hcbfCount,
                    'mhmcd'=> $mhmcCount
                ];
            }
             #gendercount
            $gendercount=AYPMentorship::where('region',$loggedregion)->select('sex', DB::raw('COUNT(*) as count'))
                        ->whereIn('menteename', function($query) {
                            $query->select('menteename')
                                  ->distinct()
                                  ->from('a_y_p_mentorships');
                        })
                        ->groupBy('sex')
                        ->get();
            $genderhcbf=AYP_HCBF::where('region',$loggedregion)->select('sex', DB::raw('COUNT(*) as count'))
                        ->whereIn('unique_identifier', function($query) {
                            $query->select('unique_identifier')
                                  ->distinct()
                                  ->from('a_y_p__h_c_b_f_s');
                        })
                        ->groupBy('sex')
                        ->get();
            $gendermhmc=AYP_MHMC::select('sex', DB::raw('COUNT(*) as count'))
                        ->whereIn('unique_identifier', function($query) {
                            $query->select('unique_identifier')
                                  ->distinct()
                                  ->from('a_y_p__m_h_m_c_s');
                        })
                        ->groupBy('sex')
                        ->get();
            $completeSessions=AYPMentorship::where('region',$loggedregion)->select('complete_session', DB::raw('COUNT(*) as count'))
                        ->whereIn('menteename', function($query) {
                            $query->select('menteename')
                                  ->distinct()
                                  ->from('a_y_p_mentorships');
                        })
                        ->groupBy('complete_session')
                        ->get();
            $completeSessionshcbf=AYP_HCBF::where('region',$loggedregion)->select('complete_sessions', DB::raw('COUNT(*) as count'))
                        ->whereIn('unique_identifier', function($query) {
                            $query->select('unique_identifier')
                                  ->distinct()
                                  ->from('a_y_p__h_c_b_f_s');
                        })
                        ->groupBy('complete_sessions')
                        ->get();
            $completeSessionsmhmc=AYP_MHMC::where('region',$loggedregion)->select('complete_sessions', DB::raw('COUNT(*) as count'))
                        ->whereIn('unique_identifier', function($query) {
                            $query->select('unique_identifier')
                                  ->distinct()
                                  ->from('a_y_p__m_h_m_c_s');
                        })
                        ->groupBy('complete_sessions')
                        ->get();
            $attendedOutreach=AYPMentorship::where('region',$loggedregion)->select('attended_outreach', DB::raw('COUNT(*) as count'))
                        ->whereIn('menteename', function($query) {
                            $query->select('menteename')
                                  ->distinct()
                                  ->from('a_y_p_mentorships');
                        })
                        ->groupBy('attended_outreach')
                        ->get();
            $ebiStatus=AYPMentorship::where('region',$loggedregion)->select('attended_ebi', DB::raw('COUNT(*) as count'))
                        ->whereIn('menteename', function($query) {
                            $query->select('menteename')
                                  ->distinct()
                                  ->from('a_y_p_mentorships');
                        })
                        ->groupBy('attended_ebi')
                        ->get();
            $Countycount=AYPMentorship::where('region',$loggedregion)->select('counties', DB::raw('COUNT(*) as count'))
                        ->whereIn('menteename', function($query) {
                            $query->select('menteename')
                                  ->distinct()
                                  ->from('a_y_p_mentorships');
                        })
                        ->groupBy('counties')
                        ->get();
            $Countycountmhmc=AYP_MHMC::where('region',$loggedregion)->select('county', DB::raw('COUNT(*) as count'))
                        ->whereIn('unique_identifier', function($query) {
                            $query->select('unique_identifier')
                                  ->distinct()
                                  ->from('a_y_p__m_h_m_c_s');
                        })
                        ->groupBy('county')
                        ->get();
            $Countycounthcbf=AYP_HCBF::where('region',$loggedregion)->select('county', DB::raw('COUNT(*) as count'))
                        ->whereIn('unique_identifier', function($query) {
                            $query->select('unique_identifier')
                                  ->distinct()
                                  ->from('a_y_p__h_c_b_f_s');
                        })
                        ->groupBy('county')
                        ->get();
            $SRcountmhmc=AYP_MHMC::where('region',$loggedregion)->select('implementing_partner', DB::raw('COUNT(*) as count'))
                        ->whereIn('unique_identifier', function($query) {
                            $query->select('unique_identifier')
                                  ->distinct()
                                  ->from('a_y_p__m_h_m_c_s');
                        })
                        ->groupBy('implementing_partner')
                        ->get();
            $SRcounthcbf=AYP_HCBF::where('region',$loggedregion)->select('implementing_partner', DB::raw('COUNT(*) as count'))
                        ->whereIn('unique_identifier', function($query) {
                            $query->select('unique_identifier')
                                  ->distinct()
                                  ->from('a_y_p__h_c_b_f_s');
                        })
                        ->groupBy('implementing_partner')
                        ->get();
            #hiv status at enrollment
            $disabledstatus = AYP::where('region',$loggedregion)->select('disabled', DB::raw('COUNT(*) as count'))
                        ->whereIn('ccc_number', function($query) {
                            $query->select('ccc_number')
                                  ->distinct()
                                  ->from('a_y_p_s');
                        })
                        ->groupBy('disabled')
                        ->get();
            $testedHivStatus = AYP::where('region',$loggedregion)->select('tested_hiv', DB::raw('COUNT(*) as count'))
                        ->whereIn('ccc_number', function($query) {
                            $query->select('ccc_number')
                                  ->distinct()
                                  ->from('a_y_p_s');
                        })
                        ->groupBy('tested_hiv')
                        ->get();
            $artInitiated = AYP::where('region',$loggedregion)->select('art_initiated', DB::raw('COUNT(*) as count'))
                        ->whereIn('ccc_number', function($query) {
                            $query->select('ccc_number')
                                  ->distinct()
                                  ->from('a_y_p_s');
                        })
                        ->groupBy('art_initiated')
                        ->get();
            $stiScreeneed = AYP::where('region',$loggedregion)->select('sti_screening', DB::raw('COUNT(*) as count'))
                        ->whereIn('ccc_number', function($query) {
                            $query->select('ccc_number')
                                  ->distinct()
                                  ->from('a_y_p_s');
                        })
                        ->groupBy('sti_screening')
                        ->get();
             $stiTreated = AYP::where('region',$loggedregion)->select('treated_sti', DB::raw('COUNT(*) as count'))
                        ->whereIn('ccc_number', function($query) {
                            $query->select('ccc_number')
                                  ->distinct()
                                  ->from('a_y_p_s');
                        })
                        ->groupBy('treated_sti')
                        ->get();
           $tbScreenedd = AYP::where('region',$loggedregion)->select('tb_screened', DB::raw('COUNT(*) as count'))
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

        }
        

        return view('pages.typology.aypReport',compact('aypCounts','aypMentorshipCounts','aypHCBFCounts','aypMHMCCounts','results','disabledstatus','completeSessions','attendedOutreach','ebiStatus','Countycount','genderhcbf','completeSessionshcbf','gendermhmc','completeSessionsmhmc','Countycountmhmc','SRcountmhmc','SRcounthcbf','Countycounthcbf','testedHivStatus','artInitiated','stiScreeneed','stiTreated','tbScreenedd','vlDue','vlDone','ReceivedVl','hivStatus','Cart','gendercount'));
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
    public function uploadAYPMentorship(Request $request)
    {
    $request->validate([
        'aypMF' => 'required|mimes:csv',
    ]);

    if ($request->file('aypMF')->isValid()) {
        $file = $request->file('aypMF');
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
            'Counties' => 'counties',
            'Sub county' => 'subcounty',
            'Ward' => 'ward',
            'Venue' => 'venue',
            'Implementing partner' => 'implementingpartner',
            'Name Mentor 1' => 'nementor1',
            'Name Mentor 2' => 'nementor2',
            'Cohort Number' => 'cohortnumber',
            'Mentee Name' => 'menteename',
            'DOB' => 'dob',
            'Age' => 'age',
            'Sex' => 'sex',
            'Telephone Number' => 'phonenumber',
            'Village' => 'village',
            'Unique Identifier' => 'uniqueidentifier',
            'Start Date' => 'start_date',
            'End Date' => 'end_date',
            'Session 1' => 'session1',
            'Session 2' => 'session2',
            'Session 3' => 'session3',
            'Session 4' => 'session4',
            'Session 5' => 'session5',
            'Make Up Session' => 'makeup_session',
            'Completed All Sessions Status' => 'complete_session',
            'Services Referred' => 'services_referred',
            'Services Accessed' => 'services_accessed',
            'Attended Outreach' => 'attended_outreach',
            'Attended EBI' => 'attended_ebi',
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
                    $uniqueIdentifier = $rowData['sno'] . '-' . $rowData['month'] . '-' . $rowData['year'] . '-' . $rowData['region'] . '-' . $rowData['uniqueidentifier'];
                    $rowData['unique_id'] = $uniqueIdentifier;
                    $rowData['user_id'] = $user_id;
                    $batch[] = $rowData;
                    $data = fgetcsv($handle);
                }
                

                // Insert batch data into the database
                AYPMentorship::upsert($batch, uniqueBy:['unique_id'], update:array_keys($batch[0]));
            }

            fclose($handle);

            return redirect()->route('admin.ayp.index')->with('success', 'Your AYP Data file has been uploaded successfully.');
        } else {
            return redirect()->route('admin.ayp.index')->with('error', 'Unable to open the CSV file.');
        }
    }

    return redirect()->route('admin.ayp.index')->with('error', 'Invalid file.');
}

public function uploadHCBF(Request $request)
    {
    $request->validate([
        'hcbfF' => 'required|mimes:csv',
    ]);

    if ($request->file('hcbfF')->isValid()) {
        $file = $request->file('hcbfF');
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
                'County' => 'county',
                'Sub County' => 'sub_county',
                'Ward' => 'ward',
                'Venue' => 'venue',
                'Implementing Partner' => 'implementing_partner',
                'Facilitator 1' => 'facilitator_1',
                'Facilitator 2' => 'facilitator_2',
                'Start Date' => 'start_date',
                'End Date' => 'end_date',
                'Name' => 'name',
                'Age' => 'age',
                'Sex' => 'sex',
                'Session 1' => 'session1',
                'Session 2' => 'session2',
                'Session 3' => 'session3',
                'Session 4' => 'session4',
                'Session 5' => 'ssssion5',
                'Session 6' => 'session6',
                'Session 7' => 'session7',
                'Make Up Session Date' => 'make_up_session_date',
                'Complete Sessions' => 'complete_sessions',
                'Provided Condoms' => 'provided_condoms',
                'Risk Assessment R' => 'risk_assessment_r',
                'Risk Assessment C' => 'risk_assessment_c',
                'Vmmc R' => 'vmmc_r',
                'Vmmc C' => 'vmmc_c',
                'Ovc R' => 'ovc_r',
                'Ovc C' => 'ovc_c',
                'Prc R' => 'prc_r',
                'Prc C' => 'prc_c',
                'Pss R' => 'pss_r',
                'Pss C' => 'pss_c',
                'Hts R' => 'hts_r',
                'Hts C' => 'hts_c',
                'Sti Screening R' => 'sti_screening_r',
                'Sti Screening C' => 'sti_screening_c',
                'Sti Treatment R' => 'sti_treatment_r',
                'Sti Treatment C' => 'sti_treatment_c',
                'Legal Aid R' => 'legal_aid_r',
                'Legal Aid C' => 'legal_aid_c',
                'Pep R' => 'pep_r',
                'Pep C' => 'pep_c',
                'Pmtct R' => 'pmtct_r',
                'Pmtct C' => 'pmtct_c',
                'Fp R' => 'fp_r',
                'Fp C' => 'fp_c',
                'Others R' => 'others_r',
                'Others C' => 'others_c',
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
                    $uniqueIdentifier = $rowData['sno'] . '-' . $rowData['month'] . '-' . $rowData['year'] . '-' . $rowData['region'] . '-' . $rowData['name'];
                    $rowData['unique_identifier'] = $uniqueIdentifier;
                    $rowData['user_id'] = $user_id;
                    $batch[] = $rowData;
                    $data = fgetcsv($handle);
                }
                

                // Insert batch data into the database
                AYP_HCBF::upsert($batch, uniqueBy:['unique_identifier'], update:array_keys($batch[0]));
            }

            fclose($handle);

            return redirect()->route('admin.ayp.index')->with('success', 'Your AYP HCBF Data file has been uploaded successfully.');
        } else {
            return redirect()->route('admin.ayp.index')->with('error', 'Unable to open the CSV file.');
        }
    }

    return redirect()->route('admin.ayp.index')->with('error', 'Invalid file.');
}

public function uploadMHMC(Request $request)
    {
    $request->validate([
        'mhmcF' => 'required|mimes:csv',
    ]);

    if ($request->file('mhmcF')->isValid()) {
        $file = $request->file('mhmcF');
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
                'County' => 'county',
                'Sub County' => 'sub_county',
                'Ward' => 'ward',
                'Venue' => 'venue',
                'Implementing Partner' => 'implementing_partner',
                'Facilitator 1' => 'facilitator_1',
                'Facilitator 2' => 'facilitator_2',
                'Start Date' => 'start_date',
                'End Date' => 'end_date',
                'Name' => 'name',
                'Age' => 'age',
                'Sex' => 'sex',
                'Session 1' => 'session1',
                'Session 2' => 'session2',
                'Session 3' => 'session3',
                'Session 4' => 'session4',
                'Make Up Session Date' => 'make_up_session_date',
                'Complete Sessions' => 'complete_sessions',
                'Provided Condoms' => 'provided_condoms',
                'Risk Assessment R' => 'risk_assessment_r',
                'Risk Assessment C' => 'risk_assessment_c',
                'Vmmc R' => 'vmmc_r',
                'Vmmc C' => 'vmmc_c',
                'Ovc R' => 'ovc_r',
                'Ovc C' => 'ovc_c',
                'Prc R' => 'prc_r',
                'Prc C' => 'prc_c',
                'Pss R' => 'pss_r',
                'Pss C' => 'pss_c',
                'Hts R' => 'hts_r',
                'Hts C' => 'hts_c',
                'Sti Screening R' => 'sti_screening_r',
                'Sti Screening C' => 'sti_screening_c',
                'Sti Treatment R' => 'sti_treatment_r',
                'Sti Treatment C' => 'sti_treatment_c',
                'Legal Aid R' => 'legal_aid_r',
                'Legal Aid C' => 'legal_aid_c',
                'Pep R' => 'pep_r',
                'Pep C' => 'pep_c',
                'Pmtct R' => 'pmtct_r',
                'Pmtct C' => 'pmtct_c',
                'Fp R' => 'fp_r',
                'Fp C' => 'fp_c',
                'Others R' => 'others_r',
                'Others C' => 'others_c',
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
                    $uniqueIdentifier = $rowData['sno'] . '-' . $rowData['month'] . '-' . $rowData['year'] . '-' . $rowData['region'] . '-' . $rowData['name'];
                    $rowData['unique_identifier'] = $uniqueIdentifier;
                    $rowData['user_id'] = $user_id;
                    $batch[] = $rowData;
                    $data = fgetcsv($handle);
                }
                

                // Insert batch data into the database
                AYP_MHMC::upsert($batch, uniqueBy:['unique_identifier'], update:array_keys($batch[0]));
            }

            fclose($handle);

            return redirect()->route('admin.ayp.index')->with('success', 'Your AYP MHMC Data file has been uploaded successfully.');
        } else {
            return redirect()->route('admin.ayp.index')->with('error', 'Unable to open the CSV file.');
        }
    }

    return redirect()->route('admin.ayp.index')->with('error', 'Invalid file.');
}

public function AYPMentorshipData()
{
  
    // Set batch size
    $batchSize = 3000; // Adjust as needed

    // Set headers for CSV file
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="AYP_Mentorship_Consolidated.csv"',
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
            'counties',
            'subcounty',
            'ward',
            'venue',
            'implementingpartner',
            'nementor1',
            'nementor2',
           'cohortnumber',
            'menteename',
             'dob',
             'age',
            'sex',
            'phonenumber',
            'village',
            'uniqueidentifier',
             'start_date',
            'end_date',
            'session1',
            'session2',
             'session3',
            'session4',
            'session5',
            'makeup_session',
             'complete_session',
             'services_referred',
           'services_accessed',
            'attended_outreach',
           'attended_ebi',
            'comments'
        ];

        fputcsv($file, $columnsToExport);
        $loggedregion=Auth::user()->region;
       $query = AYPMentorship::query();

            if ($loggedregion != 'HQ') {
                $query->where('region', $loggedregion);
            }

            // Chunk the query results and process each chunk
            $query->chunk($batchSize, function ($demographicsData) use ($file,$columnsToExport) {
                foreach ($demographicsData as $demographic) {
                    $rowData = [];
                    foreach ($columnsToExport as $column) {
                        $rowData[] = $demographic->{$column};
                    }
                    fputcsv($file, $rowData);
                }
            });

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
}

public function AYPHCBFData()
{
  
    // Set batch size
    $batchSize = 3000; // Adjust as needed

    // Set headers for CSV file
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="AYP_HCBF_Consolidated.csv"',
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
            'county',
            'sub_county',
            'ward',
            'venue',
            'implementing_partner',
            'facilitator_1',
            'facilitator_2',
            'start_date',
            'end_date',
            'name',
            'age',
            'sex',
            'session1',
            'session2',
            'session3',
            'session4',
            'sssssion5',
            'session6',
            'session7',
            'make_up_session_date',
            'complete_sessions',
            'provided_condoms',
            'risk_assessment_r',
            'risk_assessment_c',
            'vmmc_r',
            'vmmc_c',
            'ovc_r',
            'ovc_c',
            'prc_r',
            'prc_c',
            'pss_r',
            'pss_c',
            'hts_r',
            'hts_c',
            'sti_screening_r',
            'sti_screening_c',
            'sti_treatment_r',
            'sti_treatment_c',
            'legal_aid_r',
            'legal_aid_c',
            'pep_r',
            'pep_c',
            'pmtct_r',
            'pmtct_c',
            'fp_r',
            'fp_c',
            'others_r',
            'others_c',
            'comments'
        ];

        fputcsv($file, $columnsToExport);
        $loggedregion=Auth::user()->region;
       $query = AYP_HCBF::query();

            if ($loggedregion != 'HQ') {
                $query->where('region', $loggedregion);
            }

            // Chunk the query results and process each chunk
            $query->chunk($batchSize, function ($demographicsData) use ($file,$columnsToExport) {
                foreach ($demographicsData as $demographic) {
                    $rowData = [];
                    foreach ($columnsToExport as $column) {
                        $rowData[] = $demographic->{$column};
                    }
                    fputcsv($file, $rowData);
                }
            });

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
}
public function AYPMHMCData()
{
  
    // Set batch size
    $batchSize = 3000; // Adjust as needed

    // Set headers for CSV file
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="AYP_MHMC_Consolidated.csv"',
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
            'county',
            'sub_county',
            'ward',
            'venue',
            'implementing_partner',
            'facilitator_1',
            'facilitator_2',
            'start_date',
            'end_date',
            'name',
            'age',
            'sex',
            'session1',
            'session2',
            'session3',
            'session4',
            'make_up_session_date',
            'complete_sessions',
            'provided_condoms',
            'risk_assessment_r',
            'risk_assessment_c',
            'vmmc_r',
            'vmmc_c',
            'ovc_r',
            'ovc_c',
            'prc_r',
            'prc_c',
            'pss_r',
            'pss_c',
            'hts_r',
            'hts_c',
            'sti_screening_r',
            'sti_screening_c',
            'sti_treatment_r',
            'sti_treatment_c',
            'legal_aid_r',
            'legal_aid_c',
            'pep_r',
            'pep_c',
            'pmtct_r',
            'pmtct_c',
            'fp_r',
            'fp_c',
            'others_r',
            'others_c',
            'comments'
        ];

        fputcsv($file, $columnsToExport);
        $loggedregion=Auth::user()->region;
       $query = AYP_MHMC::query();

            if ($loggedregion != 'HQ') {
                $query->where('region', $loggedregion);
            }

            // Chunk the query results and process each chunk
            $query->chunk($batchSize, function ($demographicsData) use ($file,$columnsToExport) {
                foreach ($demographicsData as $demographic) {
                    $rowData = [];
                    foreach ($columnsToExport as $column) {
                        $rowData[] = $demographic->{$column};
                    }
                    fputcsv($file, $rowData);
                }
            });

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
}

}
