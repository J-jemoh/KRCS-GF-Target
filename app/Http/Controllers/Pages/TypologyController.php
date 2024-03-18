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
                Demographics::upsert($batch, ['sno', 'region', 'year', 'month'], array_keys($batch[0]));
            }

            fclose($handle);

            return redirect()->route('admin.fsw.index')->with('success', 'Your Demographics file has been uploaded successfully.');
        } else {
            return redirect()->route('admin.fsw.index')->with('error', 'Unable to open the CSV file.');
        }
    }

    return redirect()->route('admin.fsw.index')->with('error', 'Invalid file.');
}

    
}
