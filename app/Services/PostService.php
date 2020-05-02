<?php

namespace App\Services;

 
use App\Post;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use App\Http\Resources\PostResources;
use Illuminate\Support\Str;
class PostService
{
	public function __construct(PostRepository $post) {
		$this->post = $post ;
	}

	public function index() {
		return PostResources::collection($this->post->all('created_at'));
	}

    public function create(Request $request) {  
        return $this->post->create($this->getAttributes($request));
	} 

	public function show($slug) {
        return $this->post->find($slug);
	}

	public function update(Request $request, $id) {
		$attributes = $this->getAttributes($request);
		
		if($this->post->update($id, $attributes) ) { 
			return response()->json(['message' => 'post updated successfully'], 200);
		} else { 
			return response()->json(['message' => 'there is problem with updating this post'], 400);
		} 
	}

	public function delete($id) {
		if($this->post->delete($id) ) { 
			return response()->json(['message' => 'post deleted successfully'], 200);
		} else { 
			return response()->json(['message' => 'there is problem with deleting this post'], 400);
		} 
	}

	public function getAttributes($request) { 
		$attributes = $request->only('title'  , 'content'); 
		$attributes['user_id'] = auth('api')->user()->id;
		$attributes['slug'] = $request->title . '-' . Str::random(10);
		return $attributes;
	}
}