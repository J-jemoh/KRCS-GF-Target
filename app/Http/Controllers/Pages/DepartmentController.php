<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DepartmentUpdate;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Html;

class DepartmentController extends Controller
{
    

    public function index(){
        $reports=DepartmentUpdate::where('user_id',Auth::id())->orderBy('created_at','DESC')->get();
        return view('pages.weekly.index',compact('reports'));
    }
    public function AllReports(){
        $user = Auth::user();

    if ($user->hasRole('Super Admin')) {
        // Super Admin sees all
        $reports = DepartmentUpdate::orderBy('created_at', 'DESC')->get();
    } elseif ($user->hasRole('Cooperate')) {
        // Cooperate → Exclude GF
        $reports = DepartmentUpdate::where('department', '!=', 'Global Fund')
                    ->orderBy('created_at', 'DESC')
                    ->get();
    } else {
        // Other roles → Only GF
        $reports = DepartmentUpdate::where('department', 'Global Fund')
                    ->orderBy('created_at', 'DESC')
                    ->get();
    }

    return view('pages.weekly.AllReports', compact('reports'));
    }
    public function create(){
        return view('pages.weekly.create');
    }
    public function store(Request $request){
        $this->validate($request,[

            'department'=>'required',
            'week'=>'required',
            'sdate'=>'required',
            'edate'=>'required',
            'achievments'=>'required',
            'work_plan'=>'required',
            'key_issues'=>'nullable',
            'comments'=>'nullable',
            'urgent_matters'=>'nullable',
            'region'=>'nullable',
        ]);
         DepartmentUpdate::create([
        'user_id' => auth()->id(),
        'department' => $request->department,
        'week' => $request->week,
        'start_date' => $request->sdate,
        'end_date' => $request->edate,
        'achievements' => $request->achievments,
        'work_plan' => $request->work_plan,
        'key_risks' => $request->key_issues,
        'comments' => $request->comments,
        'matters_arising' => $request->urgent_matters,
        'region'=>$request->region,
    ]);

    // Return a success response
    return redirect()->route('department.index')->with('success', 'Department Update successfully stored.');

    }
    public function edit(Request $request, $id){
        $weekly=DepartmentUpdate::findOrFail($id);
        return view('pages.weekly.edit',compact('weekly'));

    }
    public function update(Request $request, $id){
        $weekly=DepartmentUpdate::findOrFail($id);
        $this->validate($request,[

            'department'=>'required',
            'week'=>'required',
            'sdate'=>'required',
            'edate'=>'required',
            'achievments'=>'required',
            'work_plan'=>'required',
            'key_issues'=>'nullable',
            'comments'=>'nullable',
            'urgent_matters'=>'nullable',
            'region'=>'nullable',
        ]);
         $weekly->update([
        'user_id' => auth()->id(),
        'department' => $request->department,
        'week' => $request->week,
        'start_date' => $request->sdate,
        'end_date' => $request->edate,
        'achievements' => $request->achievments,
        'work_plan' => $request->work_plan,
        'key_risks' => $request->key_issues,
        'comments' => $request->comments,
        'matters_arising' => $request->urgent_matters,
        'region'=>$request->region,
    ]);
    return redirect()->back()->with('success','Weekly report for '. $weekly->week . ' for '. $weekly->department . ' has been updated successfully.');
    }
    public function show($id){
        $weekly=DepartmentUpdate::findOrFail($id);
        return view('pages.weekly.view', compact('weekly'));

    }
    public function destroy($id){
        $weekly = DepartmentUpdate::findOrFail($id);
        $weekly->delete(); // Soft delete
        return redirect()->back()->with('success', 'Report moved to trash successfully');
}
public function downloadReportWord($id)
{
    $weekly = DepartmentUpdate::findOrFail($id);

    $phpWord = new PhpWord();
    $section = $phpWord->addSection();

    // Title and header info
    $section->addTitle("Weekly Report", 1);
    $section->addText("Department: " . $weekly->department);
    $section->addText("Region: " . $weekly->region);
    $section->addText("Week: " . $weekly->week);
    $section->addText("From: " . $weekly->start_date . " - " . $weekly->end_date);
    $section->addTextBreak(1);

    // Helper function to convert CKEditor content to Word
    $this->addHtmlContent($section, "Achievements This Week", $weekly->achievements);
    $this->addHtmlContent($section, "Work Planned Upcoming Week", $weekly->work_plan);
    $this->addHtmlContent($section, "Key Risks, Issues or Dependencies", $weekly->key_risks);
    $this->addHtmlContent($section, "Other Comments", $weekly->comments);
    $this->addHtmlContent($section, "Urgent Arising Matters Requiring SMT Intervention", $weekly->matters_arising);

    // Save and return
    $fileName = 'weekly_report_' . $weekly->week . '.docx';
    $filePath = storage_path($fileName);

    $writer = IOFactory::createWriter($phpWord, 'Word2007');
    $writer->save($filePath);

    return response()->download($filePath)->deleteFileAfterSend(true);
}

// 💡 Function to render HTML from CKEditor into PhpWord
private function addHtmlContent($section, $title, $html)
{
    $section->addTitle($title, 2);
    Html::addHtml($section, $html, false, false);
}
}
