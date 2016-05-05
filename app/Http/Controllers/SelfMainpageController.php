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
/*    private $tags;
    private $recentPosts;
    private $profile;

    public function __construct()
    {
        $this->tags = Tag::with(['user' => function ($query) {$query->where('id', Auth::id());}])->where('count', '>', '0')->orderBy('count', 'desc')->orderBy('updated_at', 'desc')->take(8)->get();
        $this->recentPosts = Article::where('article_uid', Auth::id())->orderBy('created_at', 'desc')->take(3)->get();
        $this->profile = UserProfile::where('user_id', Auth::id())->get()->first();
    }*/

    public function redirectAfterLoginRegister()
    {
        return redirect()->action('SelfMainpageController@index');
    }
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


    public function index()
    {
        if(Auth::check())
        {
            $articles = Article::where('article_uid', Auth::id())->orderBy('updated_at', 'desc')->simplePaginate(3);
            return $this->base($articles);
        }
    }


    public function archives()
    {
         if(Auth::check())
        {
            $articles = Article::where('article_uid', Auth::id())->orderBy('updated_at', 'desc')->paginate(15);
            return $this->base($articles);
        }
    }

    // function base is used by index() and search() and archives() 
    private function base($articles)
    {   
        //DB::enableQueryLog();
        $data = array();
        for ($i = 0; $i < count($articles); $i++) {
            $maxLine = 6;
            $pieces = explode("\r\n", $articles[$i]->content);
            $lines = count($pieces);
            $nowLine = 1;    
            $linePos = 0;
            $result = '';
            while($nowLine <= $lines && $nowLine < $maxLine) {
                if (strlen($pieces[$linePos]) > 0) {
                    $result = $result.$pieces[$linePos]."\r\n";
                    $nowLine++;
                }
                $linePos++;
            }
                //$item = Collection::make($articles[$i]);
            //$item->put('summary', Parsedown::instance()->text($result));
            $data[$i] = Parsedown::instance()->text($result);
        }
        return view('personal_mainpage', ['articles' => $articles, 'data' => $data, ]);
    }
    
    public function search(Request $request)
    {
        $articles = Article::where('title', $request->input('search'))->orderBy('updated_at', 'desc')->simplePaginate(3);
        if($articles == null || count($articles) == 0){
            return view('not_found');
        } else{
            return $this->base($articles);
        }
    }




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
                            //dd($request->file('image');
                            $destPath = '/home/vagrant/Code/Project/LaravelProject/public/storage/uploads/'.Auth::id(); // upload path
                            $extension = $request->file('image')->getClientOriginalExtension();
                            $fileName = date('Y_m_d_H_i_s').'_'.rand(1,9999).'.'.$extension; // renameing image
                            $request->file('image')->move($destPath, $fileName);
                            $this->userProfile->portrait = 'storage/uploads/'.Auth::id().'/'.$fileName;
                            //dd($request->file('image')->getRealPath());
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
                            //dd($request->file('image');
                            $destPath = '/home/vagrant/Code/Project/LaravelProject/public/storage/uploads/'.Auth::id(); // upload path
                            $extension = $request->file('image')->getClientOriginalExtension();
                            $fileName = date('Y_m_d_H_i_s').'_'.rand(1,9999).'.'.$extension; // renameing image
                            $request->file('image')->move($destPath, $fileName);
                            //dd($request->file('image')->getRealPath());
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
