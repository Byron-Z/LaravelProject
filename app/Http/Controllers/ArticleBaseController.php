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
    public function __construct()
    {
        $sidebarTags = Tag::with(['user' => function ($query) {$query->where('id', Auth::id());}])->where('count', '>', '0')->orderBy('count', 'desc')->orderBy('updated_at', 'desc')->take(8)->get();
        $recentPosts = Article::where('article_uid', Auth::id())->orderBy('created_at', 'desc')->take(3)->get();
        $userProfile = UserProfile::where('user_id', Auth::id())->get()->first();
    	
    	View::share ( 'sidebarTags', $sidebarTags );
       	View::share ( 'recentPosts', $recentPosts );
       	View::share ( 'userProfile', $userProfile );
    }
}
