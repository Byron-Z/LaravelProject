<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Article;
use App\UserProfile;
use App\User;
use App\Events\ArticleReadCount;
use App\Tag;
use DB;
use Auth;
use Validator;
use Parsedown;
use Illuminate\Support\Collection;
use Mail;

class SelfMainpageController extends ArticleBaseController
{

    //Redirect to home page after user login
    public function redirectAfterLoginRegister()
    {
        return redirect()->action('SelfMainpageController@index');
    }

    //Contact request by user
    public function contactByUser(Request $request){
        $name = $request->input('name');
        $email = $request->input('email');
        $subject = $request->input('subject');
        $msg = $request->input('message');


       Mail::send('app_notification', ['name'=> $name, 'email'=>$email, 'subject'=>$subject, 'msg'=>$msg], function ($message){
            $message->from('FancyBlog.app@gmail.com', 'FancyBlog');

            $message->to('FancyBlog.app@gmail.com')->subject('User Feedback!');
        });

        return view('contact',['msg' => "Thanks for your feedback, we will get back you ASAP!!"]);
    }

    //Show user recent posts in user mainpage
    public function index()
    {
        if(Auth::check())
        {
            $articles = Article::where('article_uid', Auth::id())->orderBy('updated_at', 'desc')->simplePaginate(3);
            return $this->base($articles);
        }
    }

    //The archives of user articles ordered by date
    public function archives()
    {
         if(Auth::check())
        {
            $articles = Article::where('article_uid', Auth::id())->orderBy('updated_at', 'desc')->paginate(15);
            return $this->base($articles);
        }
    }

    //Show articles belong to same tag
    public function gettag(Request $request)
    {
        if(Auth::check())
        {
            $tag = Tag::where('id', $request->input('id'))->get()->first();
            $articles = $tag->articles()->where('article_uid', Auth::id())->orderBy('updated_at', 'desc')->simplePaginate(20);
            return view('tag', ['articles' => $articles, 'tag' => $tag, ]);
        }
    }

    // function base is used by index() and search() and archives() 
    private function base($articles)
    {   
        $data = array();
        for ($i = 0; $i < count($articles); $i++) {
            $result = '';

            if (str_contains($articles[$i]->content, '<hr>')) {
                $length = stripos($articles[$i]->content, '<hr>');
                $request = substr($articles[$i]->content, 0, $length);
            } else if (str_contains($articles[$i]->content, '<p>')) {
                $start = stripos($articles[$i]->content, '<p>');
                $length = stripos($articles[$i]->content, '</p>') - $start - 3;
                $result = substr($articles[$i]->content, $start + 3, $length);
            } else if (str_contains($articles[$i]->content, '</h')) {
                $start = stripos($articles[$i]->content, '<h');
                $length = stripos($articles[$i]->content, '</h') - $start - 4;
                $result = substr($articles[$i]->content, $start + 4, $length);
            } else {
                $result = substr($articles[$i]->content, 0, 240);
            }

            $data[$i] = Parsedown::instance()->text($result);
        }

        return view('personal_mainpage', ['articles' => $articles, 'data' => $data, ]);
    }
    
    //Search articles based on the title of each article
    public function search(Request $request)
    {
        $articles = Article::where('title', $request->input('search'))->orderBy('updated_at', 'desc')->simplePaginate(3);
        if($articles == null || count($articles) == 0){
            return view('not_found');
        } else{
            return $this->base($articles);
        }
    }

    //Expand to show the whole content of an article
    public function readMore(Request $request)
    {
    	if(Auth::check())
        {
	        $article = Article::where('id', $request->input('id'))->get()->first();
            //$article['resolved_content'] = Parsedown::instance()->text($article->content);
            event(new ArticleReadCount($article));

	        return view('article', ['article' => $article, ]);
	    }
    }

    //Show user profile
    public function showProfile()
    {
        if(Auth::check())
        {
            $reminder = "";

            if($this->userProfile == null)
            {
                $reminder = "You have not set profile yet!";
            } else{
                $reminder = "Edit Personal Information";
            }
            
            return view('profile',['reminder'=>$reminder, ]);
        }
    }

    //Save user profile
    public function saveProfile(Request $request)
    {
        if(Auth::check())
        {
            $rules1 = [
            'name'   => 'required|max:100',
            'country'    => 'required|max:20',
            'city' => 'required|max:20 ',
            'phone'=>'required|regex:/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/',
            'description' => 'required|max:200',
            ];

            $rules2 = [
            'name'   => 'max:100',
            'country'    => 'max:20|min:2',
            'city' => 'max:20 |min:2',
            'phone'=>'regex:/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/',
            'description' => 'max:200',
            ];

            $validator1 = Validator::make($request->input(), $rules1);
            $validator2 = Validator::make($request->input(), $rules2);

             if($this->userProfile != null){
                if($validator2->passes()){
                    if ($request->hasFile('image')) {
                        if ($request->file('image')->isValid()) {
                            $destPath = '/home/vagrant/Code/Project/LaravelProject/public/storage/uploads/'.Auth::id(); // upload path
                            $extension = $request->file('image')->getClientOriginalExtension();
                            $fileName = date('Y_m_d_H_i_s').'_'.rand(1,9999).'.'.$extension; // renameing image
                            $request->file('image')->move($destPath, $fileName);
                            $this->userProfile->portrait = 'storage/uploads/'.Auth::id().'/'.$fileName;
                        }
                    }

                    if($request->input('name') != ""){
                        $this->userProfile->user->name = $request->input('name');
                        $this->userProfile->user->save();
                    }
                    if($request->input('gender') != ""){
                        $this->userProfile->gender = $request->input('gender');
                    }
                    if($request->input('country') != ""){
                        $this->userProfile->country = $request->input('country');
                    }
                    if($request->input('city') != ""){
                        $this->userProfile->city = $request->input('city');
                    }
                    if($request->input('phone') != ""){
                        $this->userProfile->phone = $request->input('phone');
                    }
                    if($request->input('description') != ""){
                        $this->userProfile->description = $request->input('description');
                    }
                    $this->userProfile->save();
                } else{
                    return "Hello!!1";
                    return redirect('/profile')->withInput()->withErrors($validator2);
                }
            } else{
                if ($validator1->passes()) {
                    $destPath = "";
                    $fileName = "";
                    if ($request->hasFile('image')) {
                        if ($request->file('image')->isValid()) {
                            $destPath = '/home/vagrant/Code/Project/LaravelProject/public/storage/uploads/'.Auth::id(); // upload path
                            $extension = $request->file('image')->getClientOriginalExtension();
                            $fileName = date('Y_m_d_H_i_s').'_'.rand(1,9999).'.'.$extension; // renameing image
                            $request->file('image')->move($destPath, $fileName);
                        }
                    }
                    UserProfile::create([
                    'user_id' => Auth::id(),
                    'phone' => $request->input('phone'),
                    'gender' => $request->input('gender'),
                    'city' => $request->input('city'),
                    'country' => $request->input('country'),
                    'description' => $request->input('description'),
                    'portrait' => 'storage/uploads/'.Auth::id().'/'.$fileName,
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
