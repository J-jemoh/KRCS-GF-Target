<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DepartmentUpdate;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Html;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

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
        $status = $request->input('action') === 'submit' ? 'submitted' : 'draft';
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
        'status' => $status,
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
         $status = $request->input('action') === 'submit' ? 'submitted' : 'draft';
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
        'status' => $status,

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
    public function updateStatus($id){

        $departmentUpdate = DepartmentUpdate::find($id);

    // Check if the record exists
    if ($departmentUpdate) {
        // Check if the status is 'submitted', and update it to 'draft'
        if ($departmentUpdate->status == 'submitted') {
            $departmentUpdate->status = 'draft';
            $departmentUpdate->save();  // Save the changes to the database

            return redirect()->back()->with('success','Status updated successfully');
        } else {
            return redirect()->back()->with('success','Status is not submitted, no update needed');
        }
    } else {
        return response()->json([
            'message' => 'Record not found.'
        ]);
    }
    }
public function downloadReportWord($id)
{
    $weekly = DepartmentUpdate::findOrFail($id);

    $phpWord = new PhpWord();
    $section = $phpWord->addSection();

    // Add basic info
    $section->addTitle("Weekly Report", 1);
    $section->addText("Department: " . $weekly->department);
    $section->addText("Region: " . $weekly->region);
    $section->addText("Week: " . $weekly->week);
    $section->addText("From: " . $weekly->start_date . " - " . $weekly->end_date);
    $section->addTextBreak(1);

    // Add contents (you might still want to wrap in try-catch later)
    $this->addHtmlContent($section, "Achievements This Week", $weekly->achievements);
    $this->addHtmlContent($section, "Work Planned Upcoming Week", $weekly->work_plan);
    $this->addHtmlContent($section, "Key Risks, Issues or Dependencies", $weekly->key_risks);
    $this->addHtmlContent($section, "Other Comments", $weekly->comments);
    $this->addHtmlContent($section, "Urgent Arising Matters Requiring SMT Intervention", $weekly->matters_arising);

    // Prepare file
    $fileName = 'weekly_report_' . $weekly->week . '.docx';
    $tempFile = tempnam(sys_get_temp_dir(), 'phpword') . '.docx';

    $writer = IOFactory::createWriter($phpWord, 'Word2007');
    $writer->save($tempFile);

    return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
}


// 💡 Function to render HTML from CKEditor into PhpWord
private function addHtmlContent($section, $title, $html){
    $section->addTitle($title, 2);

    // Sanitize and encode HTML
    $cleanHtml = strip_tags($html, '<p><br><ul><li><ol><b><i><strong><em>');
    $cleanHtml = mb_convert_encoding($cleanHtml, 'HTML-ENTITIES', 'UTF-8');

    try {
        Html::addHtml($section, $cleanHtml, false, false);
    } catch (\Exception $e) {
        \Log::error('Failed to add HTML to Word document: ' . $e->getMessage());
        $section->addText('[Unable to load content due to formatting issues.]');
    }
 
}
   public function downloadReportPdf($id){
    $weekly = DepartmentUpdate::findOrFail($id);

    $pdf = Pdf::loadView('pdf.weekly_report', compact('weekly'));

    $fileName = 'weekly_report_' . $weekly->week . '.pdf';

    return $pdf->download($fileName);
}
public function ReportSummary(){
    $user = Auth::user();

    // Start with base query
    $query = DB::table('department_updates');

    // Apply filters based on user role
    if ($user->hasRole('Super Admin')) {
        // No filtering
    } elseif ($user->hasRole('Cooperate')) {
        $query->where('department', '!=', 'Global Fund');
    } else {
        $query->where('department', 'Global Fund');
    }

 $summaries = DB::table('department_updates')
        ->select(
            'region',
            DB::raw('COUNT(*) as total_reports'),
            DB::raw("STRING_AGG(COALESCE(achievements, ''), '\n' ORDER BY id) as achievements_summary"),
            DB::raw("STRING_AGG(COALESCE(work_plan, ''), '\n' ORDER BY id) as workplan_summary"),
            DB::raw("STRING_AGG(COALESCE(key_risks, ''), '\n' ORDER BY id) as key_risks_summary")
        )
        ->groupBy('region')
        ->get();

    $perPage = 10;

        $keyReports = DepartmentUpdate::when(!Auth::user()->can('View Reports'), function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->when(request('region'), function ($query) {
                $query->where('region', 'ILIKE', '%' . request('region') . '%');
            })
            ->orderBy('created_at', 'DESC')
            ->paginate($perPage);

        $groupedActions = $keyReports->getCollection()->groupBy('region');

        // Reassign the modified collection back to the paginator
        $keyReports->setCollection($groupedActions->flatten(1));
    return view('pages.weekly.ReportSummary',compact('summaries','keyReports'));
}
}
