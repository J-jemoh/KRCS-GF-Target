<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HRG;

class HRGController extends Controller
{
    public function uploadHrg(Request $request){

        $request->validate([
            'hrgF'=>'required|mimes:csv',

        ]);
        if ($request->file('hrgF')->isValid()) {
            $file=$request->file('hrgF');
            $path=$file->getRealPath();
             // Log the file path for debugging
            Log::info('File path: ' . $path);

            $csvData=array_map('str_getcsv', file($path));
            // Remove header if exists and store it
            if (count($csvData) > 0 && is_array($csvData[0])) {
                $headers = array_shift($csvData);
            } else {
                return redirect()->route('admin.hrg.index')->with('error', 'CSV file is empty.');
            }
            // Define mapping between CSV headers and database columns
            $mapping = [
                'SNo'=>'sno',
                'Region'=>'region',
                'Target Group'=>'target_group',
                'Indicators'=>'indicators',
                'Quater 1'=>'pt_quater_1',
                'Quater 2'=>'pt_quater_2',
                'Quater 3'=>'pt_quater_3',
                'Quater 4'=>'pt_quater_4',
                'Quater 5'=>'pt_quater_5',
                'Quater 6'=>'pt_quater_6',
                'Quater 7'=>'pt_quater_7',
                'Quater 8'=>'pt_quater_8',
                'Quater 9'=>'pt_quater_9',
                'Quater 10'=>'pt_quater_10',
                'Quater 11'=>'pt_quater_11',
                'Quater 12'=>'pt_quater_12',
                'Total'=>'pt_total',
                'PA Quater 1'=>'pa_quater1',
                'PA Quater 2'=>'pa_quater2',
                'PA Quater 3'=>'pa_quater3',
                'PA Quater 4'=>'pa_quater4',
                'PA Quater 5'=>'pa_quater5',
                'PA Quater 6'=>'pa_quater6',
                'PA Quater 7'=>'pa_quater7',
                'PA Quater 8'=>'pa_quater8',
                'PA Quater 9'=>'pa_quater9',
                'PA Quater 10'=>'pa_quater10',
                'PA Quater 11'=>'pa_quater11',
                'PA Quater 12'=> 'pa_quater12',
                'PATotal'=> 'pa_total',
                 'Percentage'=>'percent',

            ];
            $user_id = Auth::id();
             // Get all existing data from the database
            $existingData = QPMM::all()->toArray();
            // Process CSV data and save to database
                    foreach ($csvData as $row) {
                        $data = [];
                        foreach ($headers as $index => $header) {
                            $columnName = $mapping[$header] ?? null;
                            if ($columnName) {
                                $data[$columnName] = $row[$index] ?? null;
                            }
                        }
                        $data['user_id'] = $user_id;

                        // dd($data);
                        $existingRecord = HRG::where('sno',$data['sno'])
                                        ->where('region',$data['region'])
                                        ->where('quater',$data['quater'])
                                        ->first();
                            if ($existingRecord) {
                                // Update the existing record
                                $existingRecord->update($data);
                            } else {
                                // Create a new record
                                HRG::create($data);
                            }

                    }
             return redirect()->route('admin.hrg.index')->with('success', 'Your HRG file has been uploaded successfully.');
        }
        return redirect()->route('admin.hrg.index')->with('error', 'Invalid file.');

    }
}
