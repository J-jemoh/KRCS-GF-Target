<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UploadSettings;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    //

    public function index(){
  
        return view('settings.index');
    }

    public function storeUploadSetting(Request $request){

        $this->validate($request,[

            'month'=>'required',
            'year'=>'required',
            'start_date'=>'required',
            'end_date'=>'required'
        ]);

        $setting=UploadSettings::create([
            'user_id' => Auth::user()->id,
            'month' =>$request->month,
            'year' =>$request->year,
            'start_date' =>$request->start_date,
            'end_date' =>$request->end_date

        ]);
      return redirect()->back()->with('success','Setting saved successfully');

    }

}
