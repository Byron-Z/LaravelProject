<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Parsedown;
use Validator;
use App\Article;
use App\Attachment;
use App\Tag;
use DB;
use Auth;

class ArticleController extends ArticleBaseController
{
    // Create article
    public function create()
    {
        $tags = Tag::with(['user' => function ($query) {$query->where('id', Auth::id());}])->orderBy('count', 'desc')->orderBy('updated_at', 'desc')->get();
        return view('create', ['tags' => $tags, ]);
    }

    //Edit article
    public function edit($id)
    {
        //Get data related article from database
        $article = Article::find($id);
        $tags = Tag::with(['user' => function ($query) {$query->where('id', Auth::id());}])->orderBy('count', 'desc')->orderBy('updated_at', 'desc')->get();
        $tagUsed = $article->tags;
        $type = ['Original', 'Reproduction', 'Translation'];
        return view('edit', ['article' => $article, 'tags' => $tags, 'tagUsed' => $tagUsed, 'type' => $type[$article->type], ]);
    }

    /*When user uploads picture in summernote editor, we upload the image 
    to database directly instead of storing as base64 format in summernote*/
    public function ajaxUpload(Request $request) 
    {
        if (isset($request->file)) {
            $destPath = 'storage/uploads/'.Auth::id().'/'; // upload path
            $extension = $request->file->getClientOriginalExtension();
            $fileName = date('Y_m_d_H_i_s').'_'.rand(1,9999).'.'.$extension; // renameing image
            $request->file->move($destPath, $fileName);
            return asset($destPath.$fileName);
        } 
    }

    //Get file in website
    public function getfile($id, $filename) {
        return response()->file('storage/uploads/'.Auth::id().'/'.$filename);
    }

    //Store article data into database
    public function store(Request $request) 
    {
        $rules = [
        'title'   => 'required|max:100',
        'summernote' => 'required',
        'tags'    => 'required',
        ];
        //Use validator to check the data that user input
        $validator = Validator::make($request->input(), $rules);
        if ($validator->passes()) {
            $article = Article::firstOrCreate([
                'title' => $request->input('title'), 
                'article_uid' => Auth::id(),
                'content' => $request->input('summernote'),
                'comment_permition' => $request->has('comment_permition') ? 0 : 1 ,
                'is_public' => $request->has('is_public') ? 0 : 1 ,
                'reproduct_permition' => $request->has('reproduct_permition') ? 0 : 1 ,
                'type' => $request->has('article-type') ? $request->input('article-type') : 0 ,
            ]);

            //If user selects the exist tag, we just add the count of tag;
            //else we add a new tag into database.
            $tag = Tag::where('tag_uid', Auth::id())->where('name', $request->input('tags'))->first();
            if (isset($tag)) {
                $tag->increment('count');
            } else {
                $tag = Tag::firstOrCreate([
                    'tag_uid' => Auth::id(),
                    'name' => $request->input('tags'),
                    'count' => 1,
                ]);
            }

            $article->tags()->attach($tag->id);

            /*if ($request->hasFile('image')) {
                if ($request->file('image')->isValid()) {
                    $destPath = '/home/vagrant/Code/Project/resources/uploads/'.Auth::id(); // upload path
                    $extension = $request->file('image')->getClientOriginalExtension();
                    $fileName = date('Y_m_d_H_i_s').'_'.rand(1,9999).'.'.$extension; // renameing image
                    $request->file('image')->move($destPath, $fileName);
                    $attachment = Attachment::firstOrCreate([
                        'title' => $fileName, 
                        'article_id' => $article->id,
                        'size' => $request->file('image')->getClientSize(),
                        'extension' => $extension,
                        'save_path' => $destPath,
                    ]);
                }
            }*/
            
            return redirect()->action('SelfMainpageController@index');
        } else {
            dd($validator->errors());
            return redirect('/create')->withInput()->withErrors($validator);
        }
    }

    //update article data
    public function update(Request $request) 
    {
        $rules = [
        'title'   => 'required|max:100',
        'summernote' => 'required',
        'tags'    => 'required',
        ];
        $validator = Validator::make($request->input(), $rules);
        if ($validator->passes()) {
            //$resolved_content = Parsedown::instance()->text($request->input('content'));
            $article = Article::find($request->input('article-id'));
            Article::where('id', $request->input('article-id'))->update([
                'title' => $request->input('title'), 
                'article_uid' => Auth::id(),
                'content' => $request->input('summernote'),
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

    //delete article
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
