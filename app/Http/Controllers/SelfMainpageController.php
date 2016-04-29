<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Article;
use App\UserProfile;
use App\Events\ArticleReadCount;
use App\Tag;
use DB;
use Auth;
use Validator;

class SelfMainpageController extends ArticleBaseController
{
/*    private $tags;
    private $recentPosts;
    private $profile;

    public function __construct()
    {
        $this->tags = Tag::with(['user' => function ($query) {$query->where('id', Auth::id());}])->where('count', '>', '0')->orderBy('count', 'desc')->orderBy('updated_at', 'desc')->take(8)->get();
        $this->recentPosts = Article::where('article_uid', Auth::id())->orderBy('created_at', 'desc')->take(3)->get();
        $this->profile = UserProfile::where('user_id', Auth::id())->get()->first();
    }*/

    public function index()
    {
        if(Auth::check())
        {  
            //DB::enableQueryLog();
            $articles = Article::where('article_uid', Auth::id())->orderBy('updated_at', 'desc')->take(3)->get();
            //dd(DB::getQueryLog());
            return view('personal_mainpage', ['articles' => $articles, ]);
        }
    }

    public function readMore(Request $request)
    {
    	if(Auth::check())
        {
	        $article = Article::where('id', $request->input('id'))->get()->first();

            event(new ArticleReadCount($article));

	        return view('article', ['article' => $article, ]);
	    }
    }

    public function showProfile()
    {
        if(Auth::check())
        {
            $reminder = "";

            if($this->profile == null)
            {
                $reminder = "You have not set profile yet!";
            } else{
                $reminder = "Edit Personal Information";
            }
            
            return view('profile',['tags' => $this->tags, 'reminder'=>$reminder, ]);
        }
    }

    public function saveProfile(Request $request)
    {
        if(Auth::check())
        {
            $rules1 = [
            'name'   => 'required|max:100',
            'sex' => 'required',
            'country'    => 'required| max:20| min:2',
            'city' => 'required| max:20 | min:2',
            'phone'=>'required|regex:/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/',
            'description' => 'required|max:200',
            ];

            $rules2 = [
            'name'   => 'max:100',
            'country'    => 'max:20| min:2',
            'city' => 'max:20 | min:2',
            'phone'=>'regex:/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/',
            'description' => 'max:200',
            ];

            $validator1 = Validator::make($request->input(), $rules1);
            $validator2 = Validator::make($request->input(), $rules2);

             if($this->profile != null){
                if($validator2->passes()){
                    if($request->input('name') != ""){
                        $this->profile->user->name = $request->input('name');
                        $this->profile->user->save();
                        echo $this->profile->user->name;
                    }
                    if($request->input('sex') != ""){
                        $this->profile->sex = $request->input('sex');
                    }
                    if($request->input('country') != ""){
                        $this->profile->country = $request->input('country');
                    }
                    if($request->input('city') != ""){
                        $this->profile->city = $request->input('city');
                    }
                    if($request->input('phone') != ""){
                        $this->profile->phone = $request->input('phone');
                    }
                    if($request->input('description') != ""){
                        $this->profile->description = $request->input('description');
                    }
                    $this->profile->save();
                } else{
                    return redirect('/profile')->withInput()->withErrors($validator2);
                }
            } else{
                if ($validator1->passes()) {
                    UserProfile::create([
                    'user_id' => Auth::id(),
                    'phone' => $request->input('phone'),
                    'sex' => $request->input('sex'),
                    'city' => $request->input('city'),
                    'country' => $request->input('country'),
                    'description' => $request->input('description'),
                    ]);
                    
                    $user = User::where('id', Auth::id())->get()->first();
                    $user->name = ($request->input('name') == "") ? $user->name : $request->input('name');

                } else{
                    return redirect('/profile')->withInput()->withErrors($validator1);
                }

            }
            return redirect()->action('SelfMainpageController@showProfile');
        }
    }
}
