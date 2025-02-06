<?php

namespace App\Http\Controllers\Post;

use App\Actions\Post\CreatePost;
use App\Exceptions\PostTitleAlreadyExistException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\CreatePostRequest;
use App\Models\Website;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreatePostController extends Controller
{
    public function __construct(protected CreatePost $createPost) {}

    /**
     * @throws PostTitleAlreadyExistException
     */
    public function __invoke(CreatePostRequest $request): JsonResponse
    {
        $this->createPost->execute(
            $request->validated('title'),
            $request->validated('description'),
            Website::query()->findOrFail($request->validated('website_id')),
        );

        return response()->json(
            ['message' => 'Post saved'],
            Response::HTTP_CREATED
        );
    }
}
