<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PostTitleAlreadyExistException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json(
            ['message' => 'The post title already exists in our database'],
            Response::HTTP_UNPROCESSABLE_ENTITY
        );
    }
}
