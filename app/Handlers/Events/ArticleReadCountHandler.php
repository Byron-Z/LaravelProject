<?php

namespace App\Handlers\Events;

use App\Events\ArticleReadCount;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Article;
use Illuminate\Http\Request;
use Illuminate\Session\Store;

class ArticleReadCountHandler
{
    /**
     * Create the event listener.
     * Request
     * @return void
     */
    public function __construct(Store $session)
    {
        //
        $this->session = $session;
    }

    /**
     * Handle the event.
     *
     * @param  ArticleReadCount $event
     * @return void
     */
    public function handle(ArticleReadCount $event)
    {
        //
        if(! $this->isArticleRead($event->article))
        {
            $event->article->read_count += 1;
            $event->article->save();
            $this->storeArticle($event->article);
        }
        
    }

    private function isArticleRead(Article $article)
    {
        $read = $this->session->get('read_articles',[]);

        return array_key_exists($article->id, $read);
    }

    private function storeArticle(Article $article)
    {
        $key = 'read_articles.' . $article->id;
        $this->session->push($key, time());
    }
}
