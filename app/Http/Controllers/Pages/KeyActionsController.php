<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Html;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Models\ManagementActions;
use App\Models\SRNames;

class KeyActionsController extends Controller
{
    
    public function myactions(){
        $keyActions=ManagementActions::where('user_id',Auth::id())->orderBy('created_at','DESC')->get();
        return view('keyActions.myactions',compact('keyActions'));
    }
    public function allactions(){
        $keyActions=ManagementActions::orderBy('created_at','DESC')->get();
         return view('keyActions.allActions',compact('keyActions'));
    }
    public function create(){

        return view('keyActions.create');
    }
    public function store(Request $request){

        $this->validate($request,[
            'duration'=>'required',
            'region'=>'required',
            'department'=>'required',
            'sr_name'=>'required',
            'key_issues'=>'required',
            'root_cause'=>'required',
            'mitigation_plans'=>'required',
            'timeline'=>'required',
            'sr_response'=>'required',
            'statusupdate'=>'required',

        ]);
        $status = $request->input('action') === 'submit' ? 'submitted' : 'draft';
         ManagementActions::create([
        'user_id' => auth()->id(),
        'duration'=>$request->duration,
        'region' => $request->region,
        'category' => $request->department,
        'sr_name' => $request->sr_name,
        'key_issues' => $request->key_issues,
        'root_cause' => $request->root_cause,
        'mitigation_action' => $request->mitigation_plans,
        'date' => $request->timeline,
        'sr_response' => $request->sr_response,
        'status_update'=>$request->statusupdate,
        'reference_documents'=>$request->reference_documents,
        'sr_attachmemts'=>$request->sr_attachments,
        'pr_attachments'=>$request->pr_attachments,
        'status' => $status,
    ]);
        return redirect()->route('keyActions.mine')->with('success', 'Your Management Action has been saved successfully.');
    }
    public function edit($id){

        $action=ManagementActions::findOrFail($id);
        return view('keyActions.edit',compact('action'));
    }
    public function update(Request $request, $id){
        $this->validate($request,[
            'duration'=>'required',
            'region'=>'required',
            'department'=>'required',
            'sr_name'=>'required',
            'key_issues'=>'required',
            'root_cause'=>'required',
            'mitigation_plans'=>'required',
            'timeline'=>'required',
            'sr_response'=>'required',
            'statusupdate'=>'required',

        ]);
        $action=ManagementActions::findOrFail($id);
        $status = $request->input('action') === 'submit' ? 'submitted' : 'draft';
        $action->update([
            'user_id' => auth()->id(),
            'duration'=>$request->duration,
            'region' => $request->region,
            'category' => $request->department,
            'sr_name' => $request->sr_name,
            'key_issues' => $request->key_issues,
            'root_cause' => $request->root_cause,
            'mitigation_action' => $request->mitigation_plans,
            'date' => $request->timeline,
            'sr_response' => $request->sr_response,
            'status_update'=>$request->statusupdate,
            'reference_documents'=>$request->reference_documents,
            'sr_attachmemts'=>$request->sr_attachments,
            'pr_attachments'=>$request->pr_attachments,
            'status' => $status,
    ]);
        return redirect()->back()->with('success', 'Your Management Action has been updated successfully.');

    }
    public function show($id){
        $action=ManagementActions::findOrFail($id);
         return view('keyActions.show',compact('action'));

    }
    public function mysummary(){
        $keyActions = ManagementActions::when(!Auth::user()->can('View Actions'), function ($query) {
                        // If no permission, limit to their own records
                        $query->where('user_id', Auth::id());
                    })
                    ->when(request('sr_name'), function ($query) {
                        $query->where('sr_name', 'ILIKE', '%' . request('sr_name') . '%');
                    })
                    ->orderBy('created_at', 'DESC')
                    ->get()
                    ->groupBy('category');



        return view('keyActions.actionsummary',compact('keyActions'));
    }
    public function updateStatus(Request $request, $id){
        $request->validate([
            'status_update' => 'required|string|max:255',
        ]);

        $action = ManagementActions::findOrFail($id);

        // Optional: Ensure only creator or authorized user can update
        if ($action->user_id !== Auth::id() && !Auth::user()->can('Update Actions')) {
            abort(403, 'Unauthorized');
        }

        $action->status_update = $request->status_update;
        $action->save();

        return back()->with('success', 'Status updated successfully.');
    }
     public function Statusupdate($id){

        $action = ManagementActions::find($id);

    // Check if the record exists
            if ($action) {
                // Check if the status is 'submitted', and update it to 'draft'
                if ($action->status == 'submitted') {
                    $action->status = 'draft';
                    $action->save();  // Save the changes to the database

                    return back()->with('success','Status updated successfully');
                } else {
                    return back()->with('success','Status is not submitted, no update needed');
                }
            } else {
                return response()->json([
                    'message' => 'Record not found.'
                ]);
        }   
    }
    public function getSRsByRegion($region){
    $sr_names = SRNames::where('region', $region)->pluck('sr_name');

    return response()->json($sr_names);
    }

}
