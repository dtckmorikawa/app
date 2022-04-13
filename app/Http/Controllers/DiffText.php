<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\textdiff\TextDiff;

class DiffText extends Controller
{
    public function index()
    {
        $marker=0;
        $html['source']="";
        $html['change']="";

        return view("difftest", [
            'marker' => $marker,
            'html' => $html,
        ]);
    }

    public function refresh(Request $request)
    {

        $diff = new TextDiff($request->source, $request->change);
        $html = $diff->getHtml();
        
        $marker=1;

        return view("difftest", [
            'marker' => $marker,
            'html' => $html,
        ]);

    }    
}
