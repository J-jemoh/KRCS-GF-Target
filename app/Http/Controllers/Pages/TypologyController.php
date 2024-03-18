<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Demographics;
use App\Models\Typology;
use Auth;
use Illuminate\Support\Facades\DB;

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

        // Process CSV data in chunks
        $chunkSize = 2000; // Adjust chunk size as needed
        $totalRowsProcessed = 0;

        // Open the CSV file for reading
        if (($csv = fopen($path, 'r')) !== false) {
            // Skip header row
            $headers = fgetcsv($csv);

            while (($data = fgetcsv($csv)) !== false) {
                $row = array_combine($headers, $data);
                $rowData = [];

                foreach ($mapping as $header => $column) {
                    if (isset($row[$header])) {
                        $rowData[$column] = mb_convert_encoding($row[$header], 'UTF-8', 'UTF-8');
                    }
                }

                // Check if sno exists before accessing it
                if (isset($rowData['sno'])) {
                    $rowData['user_id'] = $user_id;

                    try {
                        // Update or create record
                        Demographics::updateOrCreate(['sno' => $rowData['sno']], $rowData);
                        $totalRowsProcessed++;
                    } catch (\Exception $e) {
                        // Log any errors during processing
                        Log::error('Error processing row: ' . $e->getMessage());
                    }
                }

                // Check if it's time to insert a new chunk
                if ($totalRowsProcessed % $chunkSize === 0) {
                    Log::info('Total rows processed: ' . $totalRowsProcessed);
                    // Commit the transaction and start a new one
                    DB::commit();
                    DB::beginTransaction();
                }
            }

            fclose($csv);
            // Commit any remaining rows
            DB::commit();
            Log::info('Total rows processed: ' . $totalRowsProcessed);
            return redirect()->route('admin.fsw.index')->with('success', 'Your Demographics information has been uploaded successfully.');
        } else {
            return redirect()->route('admin.fsw.index')->with('error', 'Failed to open file.');
        }
    }

    return redirect()->route('admin.fsw.index')->with('error', 'Invalid file.');
}



    
}
