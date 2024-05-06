<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GBV;

class GBVController extends Controller
{
    
    public function uploadGBV(Request $request){

        $request->validate([
            'gbvF'=>'required|mimes:csv',

        ]);
        if ($request->file('gbvF')->isValid()) {
            $file=$request->file('gbvF');
            $path=$file->getRealPath();
             // Log the file path for debugging
            Log::info('File path: ' . $path);

            $csvData=array_map('str_getcsv', file($path));
            // Remove header if exists and store it
            if (count($csvData) > 0 && is_array($csvData[0])) {
                $headers = array_shift($csvData);
            } else {
                return redirect()->route('admin.gbv.index')->with('error', 'CSV file is empty.');
            }
            // Define mapping between CSV headers and database columns
            $mapping = [
                'SNo'=>'sno',
                'Year'=>'year',
                'Quater'=>'quater',
                'Region'=>'region',
                'SR Name'=>'sr_name',
                'County'=>'county',
                'Sub County'=>'subcounty',
                'Ward'=>'ward',
                'Village'=>'village',
                'Reporting Month'=>'report_month',
                'Attached Paralegal'=>'paralegal',
                'Beneficiary Name'=>'bname',
                'D.O.B'=>'dob',
                'Age'=>'age',
                'Sex'=>'sex',
                'Typology'=>'typology',
                'Disability'=>'disability',
                'Disability Type'=>'disability_type',
                'Phone'=>'phone',
                'Confidant No'=>'confidant_no',
                'Abuse/Violation'=>'abuse',
                'Abuse Date'=>'abuse_date',
                'Perpetrator'=>'perpetrator',
                'Attend Legal Aid Clinic'=>'legal_clinic',
                'Litigation'=>'litigation',
                'Legal Counsel Offered'=>'legal_counsel',
                'Referral'=>'referral',
                'Case Status'=>'care_status',
                'Comment'=>'comment',

            ];
            $user_id = Auth::id();
             // Get all existing data from the database
            $existingData = GBV::all()->toArray();
            // Process CSV data and save to database
                    foreach ($csvData as $row) {
                        $data = [];
                        foreach ($headers as $index => $header) {
                            $columnName = $mapping[$header] ?? null;
                            if ($columnName) {
                                $data[$columnName] = $row[$index] ?? null;
                                $data[$columnName] = mb_convert_encoding($row[$index], 'UTF-8', 'UTF-8');
                            }
                        }
                        $data['user_id'] = $user_id;

                        // dd($data);
                        $existingRecord = GBV::where('sno',$data['sno'])
                                        ->where('region',$data['region'])
                                        ->where('quater',$data['quater'])
                                        ->first();
                            if ($existingRecord) {
                                // Update the existing record
                                $existingRecord->update($data);
                            } else {
                                // Create a new record
                                GBV::create($data);
                            }

                    }
             return redirect()->route('admin.gbv.index')->with('success', 'Your GBV file has been uploaded successfully.');
        }
        return redirect()->route('admin.gbv.index')->with('error', 'Invalid file.');

    }
    public function downloadGBV(){

        $batchSize = 3000; // Adjust as needed

    // Set headers for CSV file
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="GBV_Consolidated.csv"',
        ];

        // Stream CSV file content directly to response
        $callback = function () use ($batchSize) {
            $file = fopen('php://output', 'w');

            // Add column headers
            $columnsToExport = [
            'sno',
            'year',
            'quater',
            'region',
            'sr_name',
            'county',
            'subcounty',
            'ward',
            'village',
            'report_month',
            'paralegal',
            'bname',
            'dob',
            'age',
            'sex',
            'typology',
            'disability',
            'disability_type',
            'phone',
            'confidant_no',
            'abuse',
            'perpetrator',
            'legal_clinic',
            'litigation',
            'legal_counsel',
            'referral',
            'care_status',
            'comment',
            'abuse_date'
        ];
            fputcsv($file, $columnsToExport);
            $loggedregion=Auth::user()->region;
           $query = GBV::query();

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
