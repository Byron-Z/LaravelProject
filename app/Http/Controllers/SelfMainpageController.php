<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Article;
use App\Tag;
use DB;
use Auth;

class SelfMainpageController extends Controller
{
    public function index()
    {
        DB::enableQueryLog();
        $articles = Article::where('article_uid', Auth::id())->orderBy('updated_at', 'desc')->take(3)->get();
        //dd(DB::getQueryLog());
        return view('personal_mainpage', ['articles' => $articles, ]);
    }
}
