<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        return view('home');
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
}
