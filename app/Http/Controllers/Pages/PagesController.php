<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Target;

class PagesController extends Controller
{

    public function dashboard():View{
         return view('dashboard');
    }
    public function targetIndex():View{
        return view('pages.target.index');
    }
    public function AllTargets():View{
        $targets=Target::get();
        return view('pages.target.allTargets',compact('targets'));
    }

}
