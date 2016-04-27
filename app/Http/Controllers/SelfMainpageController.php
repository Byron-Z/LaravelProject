<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Article;
use App\Events\ArticleReadCount;
use App\Tag;
use DB;
use Auth;

class SelfMainpageController extends Controller
{
    public function index()
    {
        if(Auth::check())
        {  
            DB::enableQueryLog();
            $articles = Article::where('article_uid', Auth::id())->orderBy('updated_at', 'desc')->take(3)->get();
            $tags = Tag::with(['user' => function ($query) {$query->where('id', Auth::id());}])->where('count', '>', '0')->orderBy('count', 'desc')->orderBy('updated_at', 'desc')->take(8)->get();
            //dd(DB::getQueryLog());
            return view('personal_mainpage', ['articles' => $articles, 'tags' => $tags,]);
        }
    }

    public function readMore(Request $request)
    {
    	if(Auth::check())
        {
	        DB::enableQueryLog();
	        $article = Article::where('id', $request->input('id'))->get()->first();

            event(new ArticleReadCount($article));

            $tags = Tag::with(['user' => function ($query) {$query->where('id', Auth::id());}])->where('count', '>', '0')->orderBy('count', 'desc')->orderBy('updated_at', 'desc')->take(8)->get();
	        //dd(DB::getQueryLog());
	        return view('article', ['article' => $article, 'tags' => $tags,]);
	    }
    }
}
