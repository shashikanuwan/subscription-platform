<?php

namespace App\Actions\Post;

use App\Data\PostData;
use App\Models\Post;
use Illuminate\Http\Request;

class CreatePost
{
    public function execute(Request $request): Post
    {
        $postData = PostData::validate($request->all());

        return Post::query()->create($postData);
    }
}
