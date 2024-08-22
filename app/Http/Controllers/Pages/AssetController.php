<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Assets;
use App\Models\AssetsIssued;

class AssetController extends Controller
{
    //

    public function index(){

        $assets=Assets::get();
        return view('pages.assets.index',compact('assets'));
    }
    public function create(){

        return view('pages.assets.create');
    }
    public function store(Request $request){
        $this->validate($request,[

            'tag_id'=>'required',
            'description'=>'required',
            'sno'=>'required',
            'purchase_date'=>'required',
            'cost'=>'required',
            'purchase_from'=>'required',
            'brand'=>'required',
            'model'=>'required'

        ]);
        Assets::create([

          'user_id'=>$request->user_id,
          'asset_tag_id'=>$request->tag_id,
          'description'=>$request->description,
          'serial_no'=>$request->sno,
          'purchase_date'=>$request->purchase_date,
          'cost'=>$request->cost,
          'purchased_from'=>$request->purchase_from,
          'brand'=>$request->brand,
          'model'=>$request->model,
          'category'=>$request->category,
          'status'=>$request->status,

        ]);
        return redirect()->route('assets.index')->with('success','Asset added successfully');

    }
    public function view($id){

        $asset=Assets::find($id);
        return view('pages.assets.view',compact('asset'));
    }
    public function edit($id){

        $asset=Assets::find($id);
        return view('pages.assets.edit',compact('asset'));

    }
    public function update(Request $request,$id){
         $asset=Assets::find($id)->update([
                  'user_id'=>$request->user_id,
                  'asset_tag_id'=>$request->tag_id,
                  'description'=>$request->description,
                  'serial_no'=>$request->sno,
                  'purchase_date'=>$request->purchase_date,
                  'cost'=>$request->cost,
                  'purchased_from'=>$request->purchase_from,
                  'brand'=>$request->brand,
                  'model'=>$request->model,
                  'category'=>$request->category,
                  'status'=>$request->status,

        ]);
        return redirect()->route('assets.index')->with('success','Asset updated successfully');
    }
    public function issueAsset(Request $request){

        $this->validate($request,[
            'region'=>'required',
            'sr_name'=>'required',
            'issue_person_name'=>'required',
            'contact'=>'required',
            'date_issued'=>'required',
            'condition'=>'required'
        ]);
        AssetsIssued::create([
            'asset_id'=> $request->asset_id,
            'user_id'=>auth()->user()->id,
            'region'=>$request->region,
            'sr_name'=>$request->sr_name,
            'person_issued'=>$request->issue_person_name,
            'person_contact'=>$request->contact,
            'issue_date'=>$request->date_issued,
            'condition'=>$request->condition

        ]);

        return redirect()->back()->with('success','Your Asset has been issued successfully');
    }
    public function returnAsset(Request $request){

        $asset=AssetsIssued::where('asset_id',$request->asset_id)->first();
        if($asset) {
        $asset->update([
            'returned_by' => $request->return_by,
            'return_date' => $request->return_date,
            'return_condition' => $request->return_condition
        ]);

        return redirect()->back()->with('success', 'Asset returned successfully');
    }

    return redirect()->back()->with('error', 'Asset not found');


    }
    public function issuedAssets(){

        $assets=AssetsIssued::get();
        return view('pages.assets.issued',compact('assets'));
    }
}
