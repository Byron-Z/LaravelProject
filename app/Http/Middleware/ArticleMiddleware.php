<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\Store;
use App\Article;

class ArticleMiddleware
{


    private $session;

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $articles = $this->getReadArticles();

        
        if(! is_null($articles))
        {
            $articles = $this->cleanExpiredRead($articles);
            $this->storeArticles($articles);
        }
        return $next($request);
    }

    private function getReadArticles()
    {
        return $this->session->get('read_articles', null);
    }

    private function cleanExpiredRead($articles)
    {
        $time = time();
        $throttleTime = 300; //seconds

        return array_filter($articles, function ($timestamp) use ($time,$throttleTime ){
            return  ($timestamp[0] + $throttleTime) > $time;
        });
    }

    private function storeArticles($articles)
    {
        $this->session->put('read_articles', $articles);
    }
}
