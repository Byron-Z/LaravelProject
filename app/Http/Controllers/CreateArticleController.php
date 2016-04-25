<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Parsedown;
use Validator;
use App\Article;
use App\Tag;
use DB;
use Auth;

class CreateArticleController extends Controller
{

    public function create()
    {
        DB::enableQueryLog();
        $tags = DB::table('tags')->where('tag_uid', Auth::id())->get();
        //dd(DB::getQueryLog());
        return view('create', ['tags' => $tags, ]);
    }

    public function preview(Request $request) 
    {
        if ($request->has('content')) {
    		return Parsedown::instance()->text($request->input('content'));
    	}
	}

    public function store(Request $request) 
    {
        $rules = [
        'title'   => 'required|max:100',
        'content' => 'required',
        'tags'    => 'required',
        ];
        $validator = Validator::make($request->input(), $rules);
        if ($validator->passes()) {
            $resolved_content = Parsedown::instance()->text($request->input('content'));
            $article = Article::firstOrCreate([
                'title' => $request->input('title'), 
                'article_uid' => Auth::id(),
                'content' => $resolved_content,
                'comment_permition' => $request->has('comment_permition') ? 0 : 1 ,
                'is_public' => $request->has('is_public') ? 0 : 1 ,
                'reproduct_permition' => $request->has('reproduct_permition') ? 0 : 1 ,
                'type' => $request->has('article-type') ? $request->input('article-type') : 0 ,
            ]);

            $tag = Tag::where('tag_uid', Auth::id())->where('name', $request->input('tags'))->first();
            if (isset($tag)) {
                $tag->increment('count');
            } else {
                $tag = Tag::firstOrCreate([
                    'tag_uid' => Auth::id(),
                    'name' => $request->input('tags'),
                ]);
            }

            $article->tags()->attach($tag->id);
            
            return redirect()->action('SelfMainpageController@index');
        } else {
            return redirect('/create')->withInput()->withErrors($validator);
        }
    }
}
