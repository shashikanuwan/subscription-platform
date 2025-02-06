<?php

namespace App\Actions\Post;

use App\Events\PostPublished;
use App\Exceptions\PostTitleAlreadyExistException;
use App\Models\Post;
use App\Models\Website;

class CreatePost
{
    /**
     * @throws PostTitleAlreadyExistException
     */
    public function execute(
        string $title,
        string $description,
        Website $website
    ): Post {
        if ($this->titleExists($title)) {
            throw new PostTitleAlreadyExistException;
        }

        $post = new Post;
        $post->title = $title;
        $post->description = $description;
        $post->website()->associate($website);
        $post->save();

        PostPublished::dispatch($post);

        return $post;
    }

    private function titleExists(string $title): bool
    {
        return Post::query()->where('title', $title)->exists();
    }
}
