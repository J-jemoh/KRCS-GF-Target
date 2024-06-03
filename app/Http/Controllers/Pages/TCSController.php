<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TCS;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Jobs\ProcessCsvChunk;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Schema;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class TCSController extends Controller
{
    //

    public function indexTCS(){

        return view('pages.typology.tcs');
    }
    public function TCSReports(){
        $srCount = TCS::distinct()->count('sr');
        $counties = TCS::distinct()->count('county');
        $region = TCS::distinct()->count('region');
        $enrolled = TCS::count();

        return view('pages.typology.tcsReport',compact('srCount','counties','region','enrolled'));
    }
    public function tcsTemplate(){

        return view('pages.typology.tcsTemplate');
    }
     public function tcsvisualize(){
        $logedregion= Auth::user()->region;
        if($logedregion=='HQ'){
        $srCount = TCS::distinct()->count('sr');
        $counties = TCS::distinct()->count('county');
        $regions = TCS::distinct()->count('region');
        $enrolled = TCS::count();
        }
        else{
        $srCount = TCS::where('region',$logedregion)->distinct()->count('sr');
        $counties = TCS::where('region',$logedregion)->distinct()->count('county');
        $regions = TCS::where('region',$logedregion)->distinct()->count('region');
        $enrolled = TCS::where('region',$logedregion)->count();
        }

        if($logedregion=='HQ'){
        $ageRanges = [
            '0-18' => [0, 18],
            '19-24' => [19, 24],
            '25-50' => [25, 50],
            'Above 50' => [51, 999], // Adjust upper limit accordingly
        ];

        // Group by age ranges and count occurrences
        $results = [];
        foreach ($ageRanges as $range => $limits) {
            $count = TCS::whereBetween('age', $limits)->count();
            $results[$range] = $count;
        }
        $Gender = TCS::select('sex', DB::raw('COUNT(*) as count'))->groupBy('sex')->get();
        $region = TCS::select('region', DB::raw('COUNT(*) as count'))->groupBy('region')->get();
        $county = TCS::select('county', DB::raw('COUNT(*) as count'))->groupBy('county')->orderBy('count','DESC')->get();
        $tracingOutcome=TCS::select('tracing_outcome_3', DB::raw('COUNT(*) as count'))->groupBy('tracing_outcome_3')->orderBy('count','DESC')->get();
        }
        else{
            $ageRanges = [
            '0-18' => [0, 18],
            '19-24' => [19, 24],
            '25-50' => [25, 50],
            'Above 50' => [51, 999], // Adjust upper limit accordingly
        ];

        // Group by age ranges and count occurrences
        $results = [];
        foreach ($ageRanges as $range => $limits) {
            $count = TCS::where('region',$logedregion)->whereBetween('age', $limits)->count();
            $results[$range] = $count;
        }
        $Gender = TCS::where('region',$logedregion)->select('sex', DB::raw('COUNT(*) as count'))->groupBy('sex')->get();
        $region = TCS::where('region',$logedregion)->select('region', DB::raw('COUNT(*) as count'))->groupBy('region')->get();
        $county = TCS::where('region',$logedregion)->select('county', DB::raw('COUNT(*) as count'))->groupBy('county')->orderBy('count','DESC')->get();
        $tracingOutcome=TCS::where('region',$logedregion)->select('tracing_outcome_3', DB::raw('COUNT(*) as count'))->groupBy('tracing_outcome_3')->orderBy('count','DESC')->get();
        }
        

        return view('pages.typology.tcsVisualize',compact('srCount','counties','regions','enrolled','results','Gender','region','county','tracingOutcome'));
    }
    public function uploadTCS(Request $request){

        $request->validate([
        'tcsF' => 'required|mimes:csv',
    ]);

    if ($request->file('tcsF')->isValid()) {
        $file = $request->file('tcsF');
        $path = $file->getRealPath();

        // Log the file path for debugging
        Log::info('File path: ' . $path);

        // Open the CSV file for reading
        if (($handle = fopen($path, 'r')) !== false) {
            // Remove header if exists and store it
            $headers = fgetcsv($handle);

            if (!$headers) {
                return redirect()->route('admin.tcs.index')->with('error', 'CSV file is empty.');
            }

            // Define mapping between CSV headers and database columns
            $mapping = [
                'SNo' => 'sno',
                'Month' => 'month',
                'Year' => 'year',
                'Region' => 'region',
                'SR' => 'sr',
                'County' => 'county',
                'Sub County' => 'sub_county',
                'Health Facility' => 'health_facility',
                'Community Tracing Focal Person' => 'community_tracing_focal_person',
                'CCC Number' => 'ccc_number',
                'DOB' => 'dob',
                'Age' => 'age',
                'Sex' => 'sex',
                'Pregnant_Lactating' => 'pregnant_lactating',
                'Missed Appointment Date' => 'missed_appointment_date',
                'Date listed as a Defaulter' => 'date_listed_as_defaulter',
                'Date of Community Tracing' => 'date_of_community_tracing',
                'Tracing outcome ' => 'tracing_outcome',
                'Date of Community Tracing_2' => 'date_of_community_tracing_2',
                'Tracing outcome' => 'tracing_outcome_2',
                'Date of Community Tracing_3' => 'date_of_community_tracing_3',
                'Tracing outcome' => 'tracing_outcome_3',
                'Linked Facility' => 'linked_facility',
                'Date Received at linked facility' => 'date_received_at_linked_facility',
                'Remarks' => 'remarks',

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
                    $uniqueIdentifier = $rowData['month'] . '-' . $rowData['year'] . '-' . $rowData['region'] . '-' . $rowData['ccc_number'];
                    $rowData['unique_identifier'] = $uniqueIdentifier;
                    $rowData['user_id'] = $user_id;
                    $batch[] = $rowData;
                    $data = fgetcsv($handle);
                }
                

                // Insert batch data into the database
                TCS::upsert($batch, uniqueBy:['unique_identifier'], update:array_keys($batch[0]));
            }

            fclose($handle);

            return redirect()->route('admin.tcs.index')->with('success', 'Your TCS file has been uploaded successfully.');
        } else {
            return redirect()->route('admin.tcs.index')->with('error', 'Unable to open the CSV file.');
        }
    }

    return redirect()->route('admin.tcs.index')->with('error', 'Invalid file.');

    }
    public function TCSdata()
{
  
    // Set batch size
    $batchSize = 3000; // Adjust as needed

    // Set headers for CSV file
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="TCS_Consolidated.csv"',
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
            'sr',
            'county',
            'sub_county',
            'health_facility',
            'community_tracing_focal_person',
            'ccc_number',
            'dob',
            'age',
            'sex',
            'pregnant_lactating',
            'missed_appointment_date',
            'date_listed_as_defaulter',
            'date_of_community_tracing',
            'tracing_outcome',
            'date_of_community_tracing_2',
            'tracing_outcome_2',
            'date_of_community_tracing_3',
            'tracing_outcome_3',
            'linked_facility',
            'date_received_at_linked_facility',
            'remarks',
        ];

        fputcsv($file, $columnsToExport);
        $loggedregion=Auth::user()->region;
       $query = TCS::query();

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
