<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class PostTitleAlreadyExistException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json(
            ['message' => 'The post title already exists in our database'],
            422
        );
    }
}
