<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MonthlyHighlights;

class MonthlyHighlightsApiController extends Controller
{
    //
     public function all(){
        $highlights = MonthlyHighlights::orderBy('created_at', 'DESC')->get();
        return response()->json($highlights);
    }
    public function show($id){
    $highlight = MonthlyHighlights::find($id);

    if (!$highlight) {
        return response()->json(['message' => 'Highlight not found'], 404);
    }

    return response()->json($highlight);
}

}
