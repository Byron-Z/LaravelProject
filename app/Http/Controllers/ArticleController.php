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

class ArticleController extends Controller
{
    public function create()
    {
        DB::enableQueryLog();
        $tags = DB::table('tags')->where('tag_uid', Auth::id())->get();
        //dd(DB::getQueryLog());
        $recentPosts = Article::where('article_uid', Auth::id())->orderBy('created_at', 'desc')->take(3)->get();
        return view('create', ['tags' => $tags, 'recentPosts' => $recentPosts,]);
    }

    public function edit($id)
    {
        $article = Article::find($id);
        $tags = $article->tags;
        return view('edit', ['article' => $article, 'tags' => $tags, ]);
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

            if (str_contains($resolved_content, '<p>')) {
                $start = strpos($resolved_content, '<p>');
                $length = strpos($resolved_content, '</p>') - $start - 3;
                $summary = substr($resolved_content, $start + 3, $length);
            } else if (str_contains($resolved_content, '</h')) {
                $start = strpos($resolved_content, '<h');
                $length = strpos($resolved_content, '</h') - $start - 4;
                $summary = substr($resolved_content, $start + 4, $length);
            }

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

    public function update($id) 
    {
        $rules = [
        'title'   => 'required|max:100',
        'content' => 'required',
        'tags'    => 'required',
        ];
        $validator = Validator::make($request->input(), $rules);
        if ($validator->passes()) {
            $resolved_content = Parsedown::instance()->text($request->input('content'));
            $article = Article::where('id', $id)->update([
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

            $article->tags()->updateExistingPivot($tag->id);
            
            return redirect()->action('SelfMainpageController@index');
        } else {
            return redirect('/edit')->withInput()->withErrors($validator);
        }
    }
}
