<?php

namespace App\Http\Controllers\Pages;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Target;


class TargetController extends Controller
{

    //
    public function uploadTarget(Request $request):RedirectResponse{

        $request->validate([
            'targetF'=>'required|mimes:csv',

        ]);
        if ($request->file('targetF')->isValid()) {
            $file=$request->file('targetF');
            $path=$file->getRealPath();
             // Log the file path for debugging
            Log::info('File path: ' . $path);

            $csvData=array_map('str_getcsv', file($path));
            // Remove header if exists and store it
            if (count($csvData) > 0 && is_array($csvData[0])) {
                $headers = array_shift($csvData);
            } else {
                return redirect()->route('admin.target')->with('error', 'CSV file is empty.');
            }
            // Define mapping between CSV headers and database columns
            $mapping = [
                'SNo'=>'sno',
                'Module' => 'module',
                'Quater' => 'quater',
                'Year' => 'year',
                'Region' => 'reqion',
                'SR' => 'sr',
                'County'=>'county',
                'Defined(Q1)' => 'defined_q1',
                'Defined (Q2)' => 'defined_q2',
                'Defined(Target)' => 'defined_target',
                'Defined(Sem)' => 'defined_sem',
                'Defined(Performance)' => 'defined_performance',
                'HTS(Q1)' => 'hts_q1',
                'HTS(Q2)' => 'hts_q2',
                'HTS(Target)' => 'hts_target',
                'HTS(Sem)' => 'hts_sem',
                'HTS(Performance)' => 'hts_performance',
                'Prep(Q1)' => 'prep_q1',
                'Prep(Q2)' => 'prep_q2',
                'Prep(Target)' => 'prep_target',
                'Prep(Total)' => 'prep_total',
                'Prep(Performance)' => 'prep_performance'
            ];
            $user_id = Auth::id();
             // Get all existing data from the database
            $existingData = Target::all()->toArray();
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
                        $existingRecord = Target::where('sno',$data['sno'])->first();
                            if ($existingRecord) {
                                // Update the existing record
                                $existingRecord->update($data);
                            } else {
                                // Create a new record
                                Target::create($data);
                            }

                    }
             return redirect()->route('admin.target')->with('success', 'Your Target file has been uploaded successfully.');
        }
        return redirect()->route('admin.target')->with('error', 'Invalid file.');

    }
}
