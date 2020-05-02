<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\PostRequest;
use App\Services\PostService;

class PostController 
{ 
	protected $postservice;

	public function __construct(PostService $postservice) {
		$this->postservice = $postservice;
	}
    public function index(){  
        return $this->postservice->index();
    }

    public function create(PostRequest $request) { 
       
      return $this->postservice->create($request);
    }

    public function show($slug) {  
       return  $this->postservice->show($slug); 
    }

    public function update(PostRequest $request, $id)
    {  
       return $this->postservice->update($request, $id);  
    }

    public function delete($id)
    { 
       return $this->postservice->delete($id);
    }
}