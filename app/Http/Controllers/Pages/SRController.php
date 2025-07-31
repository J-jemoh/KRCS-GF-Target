<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\SRNames;

class SRController extends Controller
{
    //

    public function index(){
        $srs=SRNames::all();
        return view('srs.index',compact('srs'));
    }
    public function create(){

        return view('srs.create');
    }
      public function import(Request $request)
{
    // Validate the file upload
    $request->validate([
        'upload_sr' => 'required|file|mimes:xlsx,xls,csv',
    ]);

    try {
        // Load the uploaded file
        $file = $request->file('upload_sr');
        $spreadsheet = IOFactory::load($file->getPathname());
        $sheet = $spreadsheet->getActiveSheet()->toArray();

        // Loop through each row, skipping the header
        foreach ($sheet as $index => $row) {
            if ($index === 0) continue; // skip header

            // Trim and clean values
            $region = isset($row[0]) ? trim($row[0]) : null;
            $sr_name = isset($row[1]) ? strtoupper(trim($row[1])) : null;

            // Skip rows with missing data
            if (!$region || !$sr_name) continue;

            // Insert or update SR record
            SRNames::updateOrCreate(
                ['sr_name' => $sr_name],
                [
                    'region' => $region,
                    'user_id' => Auth::id(), // Attach logged-in user
                ]
            );
        }

        return back()->with('success', 'Region and SR NAME data imported successfully.');
    } catch (\Exception $e) {
       
       } return back()->with('error', 'Import failed: ' . $e->getMessage());
    }
}
