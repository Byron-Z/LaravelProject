<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Article;
use App\Tag;
use App\UserProfile;
use Auth;
use View;


class ArticleBaseController extends Controller
{
    
    protected $sidebarTags;
    protected $recentPosts;
    protected $userProfile;

    public function __construct()
    {
        $this->middleware('auth');
        $this->sidebarTags = Tag::with(['user' => function ($query) {$query->where('id', Auth::id());}])->where('count', '>', '0')->orderBy('count', 'desc')->orderBy('updated_at', 'desc')->take(8)->get();
        $this->recentPosts = Article::where('article_uid', Auth::id())->orderBy('created_at', 'desc')->take(3)->get();
        $this->userProfile = UserProfile::where('user_id', Auth::id())->get()->first();

    	View::share ( 'sidebarTags', $this->sidebarTags );
       	View::share ( 'recentPosts', $this->recentPosts );
       	View::share ( 'userProfile', $this->userProfile );
    }
}
