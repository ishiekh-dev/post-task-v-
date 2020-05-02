<?php

namespace App\Repositories\Contracts; 
use App\Post;

interface PostRepositoryInterface  {
 
  public function create($attributes);
  
  public function all($orderBy);

  public function find($id);
  
  public function update($id, array $attributes);
 
  public function delete($id);
}