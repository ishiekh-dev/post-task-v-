<?php

namespace App\Repositories; 
use   App\Post;
use  App\Repositories\Contracts\PostRepositoryInterface; 
use Carbon\Carbon;

class PostRepository implements PostRepositoryInterface  {
  CONST CACHE_KEY = 'posts';
  protected $post;

  public function __construct(Post $post) {
    $this->post = $post;
  }
  public function create($attributes)  {
    return $this->post->create($attributes);
  }
  
  public function all($orderBy) {  
    
    $cacheKey = $this->getCacheKey();  
    return cache()->remember($cacheKey , Carbon::now()->addMinutes(5)  , function () use($orderBy) {
      return Post::orderBy($orderBy, 'desc')->get();
    }); 
     
  }

  public function find($slug) {
    return $this->post->where('slug' , $slug)->first();
  }
  
  public function update($id, array $attributes) {
    if ($postFound = $this->post->find($id) ) {
      return $postFound-->update($attributes);
    } else { 
      return 0 ;
    }  
  }
 
  public function delete($id)
  {
    if ($postFound = $this->post->find($id) ) {
      return $postFound->delete();
    } else { 
      return 0 ;
    } 
  }

  public function getCacheKey() { return self::CACHE_KEY; }
}