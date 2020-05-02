<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Post;
class PostCacheListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        cache()->forget('posts'); //forget all the cache data initially  
        $post = Post::all(); //fetch all data 
        cache()->forever('posts', $post); // and put them into cache forever
    }
}
