<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Parsedown;

class ArticleController extends Controller
{

    public function create()
    {
        return view('create');
    }

    public function preview(Request $request) {
    	if ($request->has('content')) {
    		return Parsedown::instance()->text($request->input('content'));
    	} else {
    		return "Wrong";
    	}
    	//dd($request->input('content'));
    	//return Parsedown::instance()->text($request->input('content'));
	}
}
