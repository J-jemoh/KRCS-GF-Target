<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Regions;

class RegionController extends Controller
{
    //

    public function saveRegion(Request $request){

        $request->validate([
            'region_code'=>'required',
            'regionName'=>'required'

        ]);
        $userID=auth()->user()->id;

        $region=new Regions;
        $region->region_code=$request->region_code;
        $region->user_id=$userID;
        $region->regionName=$request->regionName;
        $region->save();
        return redirect()->route('admin.regions')->with('success','Region Created successfully');
    }
}
