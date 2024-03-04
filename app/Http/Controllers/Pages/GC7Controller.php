<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\GC7Coverage;

class GC7Controller extends Controller
{
    //
    public function uploadCoverage(Request $request){

            $request->validate([
            'gc7_coverage'=>'required|mimes:csv',

        ]);
        if ($request->file('gc7_coverage')->isValid()) {
            $file=$request->file('gc7_coverage');
            $path=$file->getRealPath();
             // Log the file path for debugging
            Log::info('File path: ' . $path);

            $csvData=array_map('str_getcsv', file($path));
            // Remove header if exists and store it
            if (count($csvData) > 0 && is_array($csvData[0])) {
                $headers = array_shift($csvData);
            } else {
                return redirect()->route('admin.gc7')->with('error', 'CSV file is empty.');
            }
            // Define mapping between CSV headers and database columns
            $mapping = [
                'County' => 'county',
                'DHTS' => 'dhts',
                'TCS' => 'tcs',
                'PMTCT' => 'pmtct',
                'AYP' => 'ayp',
                'MSM'=>'msm',
                'FSW' => 'fsw',
                'TG' => 'tg',
                'PWID' => 'pwid',
                'HRG' => 'hrg',
                'FF' => 'ff',
                'TRUCKERS' => 'truckers',
                'DC' => 'dc',
                'PRISON' => 'prison',
                'Total Program' => 'total_program'
            ];
            $user_id = Auth::id();
             // Get all existing data from the database
            $existingData = GC7Coverage::all()->toArray();
            // Process CSV data and save to database
            foreach ($csvData as $row) {
                $data=[];
                foreach ($headers as $index => $header) {
                   $columnName = $mapping[$header] ?? null; 
                    if ($columnName) {
                        $data[$columnName] = $row[$index] ?? null;
                    }
                }
                $data['user_id'] = $user_id;
                 // Check if data already exists in the database for the same quarter and year
                   // Check if data already exists in the existing records
                    $exists = false;
                    foreach ($existingData as $existingRecord) {
                        $match = true;
                        foreach ($data as $key => $value) {
                            if ($existingRecord[$key] != $value) {
                                $match = false;
                                break;
                            }
                        }
                        if ($match) {
                            $exists = true;
                            break;
                        }
                    }

                             // If data already exists, return with an error message
                    if ($exists) {
                        return redirect()->route('admin.gc7')->with('error', 'Uploaded Data already exists.');
                    }

         // If data does not exist, create new record
                    GC7Coverage::create($data);
            }
             return redirect()->route('admin.gc7')->with('success', 'Your GC7 Coverage file has been uploaded successfully.');
        }
        return redirect()->route('admin.gc7')->with('error', 'Invalid file.');
    }
}
