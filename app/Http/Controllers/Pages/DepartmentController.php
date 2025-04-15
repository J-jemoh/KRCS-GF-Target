<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DepartmentUpdate;

class DepartmentController extends Controller
{
    

    public function index(){
        $reports=DepartmentUpdate::orderBy('created_at','DESC')->get();
        return view('pages.weekly.index',compact('reports'));
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
    return redirect()->back()->with('Weekly report for '. $weekly->week . ' for '. $weekly->department . ' has been updated successfully.');
    }
    public function show($id){
        $weekly=DepartmentUpdate::findOrFail($id);
        return view('pages.weekly.view', compact('weekly'));

    }
}
