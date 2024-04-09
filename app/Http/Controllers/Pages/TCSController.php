<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TCSController extends Controller
{
    //

    public function indexTCS(){

        return view('pages.typology.tcs');
    }
    public function TCSReports(){

        return view('pages.typology.tcsReport');
    }
}
