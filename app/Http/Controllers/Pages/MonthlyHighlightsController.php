<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MonthlyHighlights;
use App\Models\HighlightComments;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Html;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class MonthlyHighlightsController extends Controller
{
    //

    public function myhighlights(){
    $highlights=MonthlyHighlights::where('region',auth()->user()->region)->orderBy('created_at','DESC')->get();
        return view('highlights.myhighlights',compact('highlights'));
    }
    public function allHighlights(){
        $user = Auth::user();

            if ($user->hasRole('Super Admin')) {
                // Super Admin sees all
                $highlights = MonthlyHighlights::orderBy('created_at', 'DESC')->get();
            } elseif ($user->hasRole('GFHODS')) {
                // Cooperate → Exclude GF
                $highlights = MonthlyHighlights::orderBy('created_at', 'DESC')
                            ->get();
            } else {
                // Other roles → Only GF
                $highlights = MonthlyHighlights::orderBy('created_at', 'DESC')
                            ->get();
            }

        return view('highlights.allHighlights',compact('highlights'));
    }
    public function create(){

        return view('highlights.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'region'=>'required',
            'sdate'=>'required',
            'edate'=>'required',
            'key_highlight'=>'required',
            'key_action'=>'required',
            'hq_support'=>'required',
            'month_plan'=>'required',

        ]);
        $status = $request->input('action') === 'submit' ? 'submitted' : 'draft';
         MonthlyHighlights::create([
        'user_id' => auth()->id(),
        'region' => $request->region,
        'start_date' => $request->sdate,
        'end_date' => $request->edate,
        'key_highlights' => $request->key_highlight,
        'key_action_points' => $request->key_action,
        'hq_support' => $request->hq_support,
        'next_month_plans' => $request->month_plan,
        'supervisor_comments' => $request->s_comments,
        'status' => $status,
    ]);
        return redirect()->route('monthly.mine')->with('success', 'Your Monthly Highlights saved successfully.');

    }
    public function edit($id){

        $highlight=MonthlyHighlights::findOrFail($id);
        return view('highlights.edit',compact('highlight'));

    }
    public function update(Request $request, $id){
        $highlight=MonthlyHighlights::findOrFail($id);
        $this->validate($request,[
            'region'=>'required',
            'sdate'=>'required',
            'edate'=>'required',
            'key_highlight'=>'required',
            'key_action'=>'required',
            'hq_support'=>'required',
            'month_plan'=>'required',

        ]);
        $status = $request->input('action') === 'submit' ? 'submitted' : 'draft';
         $highlight->update([
            'user_id' => auth()->id(),
            'region' => $request->region,
            'start_date' => $request->sdate,
            'end_date' => $request->edate,
            'key_highlights' => $request->key_highlight,
            'key_action_points' => $request->key_action,
            'hq_support' => $request->hq_support,
            'next_month_plans' => $request->month_plan,
            'supervisor_comments' => $request->s_comments,
            'status' => $status,
    ]);
         return redirect()->back()->with('success','Your Monthly Report created on  '. $highlight->start_date . ' has been updated successfully.');

    }
    public function show($id){
        $highlight=MonthlyHighlights::findOrFail($id);
        return view('highlights.view',compact('highlight'));

    }
    public function addComment(Request $request){
        $this->validate($request,[

            'highlight_id'=>'required',
            'comment'=>'required',
        ]);
        HighlightComments::create([

            'supervisor_id'=>auth()->user()->id,
            'monthlyhighlights_id'=>$request->highlight_id,
            'comment'=>$request->comment,
        ]);

        return redirect()->back()->with('success','Comment added successfully');

    }
      public function updateStatus($id){

        $highlight = MonthlyHighlights::find($id);

    // Check if the record exists
            if ($highlight) {
                // Check if the status is 'submitted', and update it to 'draft'
                if ($highlight->status == 'submitted') {
                    $highlight->status = 'draft';
                    $highlight->save();  // Save the changes to the database

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
    public function downloadReportWord($id){
        $highlight = MonthlyHighlights::findOrFail($id);
        $commentsHtml = '';

        foreach ($highlight->highlightComments as $comment) {
            $commentsHtml .= '<p>' . ($comment->comment ?? '') . '</p>';
        }

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        // Add basic info
        $section->addTitle("Monthly Regional Highlight Report", 1);
        $section->addText("Region: " . $highlight->region);
        $section->addText("Month: " . $highlight->created_at->format('F Y'));
        $section->addText("From: " . $highlight->start_date . " - " . $highlight->end_date);
        $section->addTextBreak(1);

        // Add contents (you might still want to wrap in try-catch later)
        $this->addHtmlContent($section, "Key Highlights", $highlight->key_highlights);
        $this->addHtmlContent($section, "Key Action Points", $highlight->key_action_points);
        $this->addHtmlContent($section, "Support needed from HQ", $highlight->hq_support);
        $this->addHtmlContent($section, "Next Month Action Plan", $highlight->next_month_plans);
        $this->addHtmlContent($section, "Supervisor Comments", $commentsHtml);

        // Prepare file
        $fileName = $highlight->region. ' MonthlyHighlight_' . $highlight->created_at->format('F Y') . '.docx';
        $tempFile = tempnam(sys_get_temp_dir(), 'phpword') . '.docx';

        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($tempFile);

        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }


    // 💡 Function to render HTML from CKEditor into PhpWord
    private function addHtmlContent($section, $title, $html){
        $section->addTitle($title, 2);

        // Sanitize and encode HTML
        $cleanHtml = strip_tags($html, '<table><thead><tbody><tr><td><th><p><br><ul><li><ol><b><i><strong><em>');
        $cleanHtml = mb_convert_encoding($cleanHtml, 'HTML-ENTITIES', 'UTF-8');

        try {
            Html::addHtml($section, $cleanHtml, false, false);
        } catch (\Exception $e) {
            \Log::error('Failed to add HTML to Word document: ' . $e->getMessage());
            $section->addText('[Unable to load content due to formatting issues.]');
        }
     
    }
    public function downloadReportPdf($id){
        $highlight = MonthlyHighlights::findOrFail($id);

        $pdf = Pdf::loadView('highlights.pdf', compact('highlight'));

        $fileName = $highlight->region. ' MonthlyHighlight_' . $highlight->created_at->format('F Y') . '.pdf';

        return $pdf->download($fileName);
    }
}
