<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\GC7Coverage;
use App\Models\PfTarget;

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
                'Sno'=>'sno',
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
                                        $existingRecord = GC7Coverage::where('sno',$data['sno'])->first();
                                            if ($existingRecord) {
                                                // Update the existing record
                                                $existingRecord->update($data);
                                            } else {
                                                // Create a new record
                                                GC7Coverage::create($data);
                                            }

                                    }
             return redirect()->route('admin.gc7')->with('success', 'Your GC7 Coverage file has been uploaded successfully.');
        }
        return redirect()->route('admin.gc7')->with('error', 'Invalid file.');
    }
    public function uploadPFTarget(Request $request){

            $request->validate([
            'pf_targets'=>'required|mimes:csv',

        ]);
        if ($request->file('pf_targets')->isValid()) {
            $file=$request->file('pf_targets');
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
                'SNo'=>'sno',
                'Coverage Indicator' => 'coverage_indicator',
                'Baseline(Dec 2023)' => 'baseline_dec',
                'June24 Target' => 'june_target',
                'P1' => 'period1',
                'P2' => 'period2',
                'P3'=>  'period3',
                'P4' => 'period4',
                'P5' => 'period5',
                'P6' => 'period6',
            ];
            $user_id = Auth::id();
             // Get all existing data from the database
            $existingData = PfTarget::all()->toArray();
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
                                        $existingRecord = PfTarget::where('sno',$data['sno'])->first();
                                            if ($existingRecord) {
                                                // Update the existing record
                                                $existingRecord->update($data);
                                            } else {
                                                // Create a new record
                                                PfTarget::create($data);
                                            }

                                    }
             return redirect()->route('admin.gc7')->with('success', 'Performance Target  uploaded successfully.');
        }
        return redirect()->route('admin.gc7')->with('error', 'Invalid file.');
    }
    public function updateTarget(Request $request,$id){

        $target=PfTarget::find($id);
        $target->update($request->all());
        return redirect()->back()->with('success','Coverage Indicator updated successfully');
    }
}
