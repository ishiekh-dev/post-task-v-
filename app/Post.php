<?php

namespace App;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use App\Events\PostCreated;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['title' , 'slug' , 'content', 'created_at' , 'updated_at' , 'user_id'];

    public function setSlugAttribute($val)
    {
        $this->attributes['slug'] =   Str::slug($val, '-'); ;
    }

    protected $dispatchesEvents = [
        'created' => PostCreated::class // When a post is created then this Event will be fired
    ];
}
