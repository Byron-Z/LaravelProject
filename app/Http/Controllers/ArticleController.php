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

class ArticleController extends ArticleBaseController
{

    public function create()
    {
        DB::enableQueryLog();
        $tags = Tag::with(['user' => function ($query) {$query->where('id', Auth::id());}])->orderBy('count', 'desc')->orderBy('updated_at', 'desc')->get();
        //dd(DB::getQueryLog());
        return view('create', ['tags' => $tags, ]);
    }

    public function edit($id)
    {
        $article = Article::find($id);
        $tags = Tag::with(['user' => function ($query) {$query->where('id', Auth::id());}])->orderBy('count', 'desc')->orderBy('updated_at', 'desc')->get();
        $tagUsed = $article->tags;
        $type = ['Original', 'Reproduction', 'Translation'];
        return view('edit', ['article' => $article, 'tags' => $tags, 'tagUsed' => $tagUsed, 'type' => $type[$article->type], ]);
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
            //$resolved_content = Parsedown::instance()->text($request->input('content'));
            $article = Article::firstOrCreate([
                'title' => $request->input('title'), 
                'article_uid' => Auth::id(),
                'content' => $request->input('content'),
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

    public function update(Request $request) 
    {
        $rules = [
        'title'   => 'required|max:100',
        'content' => 'required',
        'tags'    => 'required',
        ];
        $validator = Validator::make($request->input(), $rules);
        if ($validator->passes()) {
            //$resolved_content = Parsedown::instance()->text($request->input('content'));
            $article = Article::find($request->input('article-id'));
            Article::where('id', $request->input('article-id'))->update([
                'title' => $request->input('title'), 
                'article_uid' => Auth::id(),
                'content' => $request->input('content'),
                'comment_permition' => $request->has('comment_permition') ? 0 : 1 ,
                'is_public' => $request->has('is_public') ? 0 : 1 ,
                'reproduct_permition' => $request->has('reproduct_permition') ? 0 : 1 ,
                'type' => $request->has('article-type') ? $request->input('article-type') : 0 ,
            ]);

            $tag = Tag::where('tag_uid', Auth::id())->where('name', $request->input('tags'))->first();
            if (!isset($tag)) {
                $tag = Tag::firstOrCreate([
                    'tag_uid' => Auth::id(),
                    'name' => $request->input('tags'),
                ]);
                $article->tags()->attach($tag->id);
            }
            
            return redirect()->action('SelfMainpageController@index');
        } else {
            return redirect('/edit')->withInput()->withErrors($validator);
        }
    }

    public function destory($id)
    {
        $article = Article::find($id)->get()->first();
        foreach($article->tags as $tag){
            $tag->count--;
            $tag->save();
            $article->tags()->detach($tag->id);
        }
        $article->delete();
        return redirect()->action('SelfMainpageController@index');
    }

}
