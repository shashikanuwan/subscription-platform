<?php

namespace App\Http\Controllers\Subscription;

use App\Actions\Subscription\CreateSubscription;
use App\Exceptions\SubscriptionAlreadyExistsException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Subscription\CreateSubscriptionRequest;
use App\Models\Website;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreateSubscriptionController extends Controller
{
    public function __construct(protected CreateSubscription $createSubscription) {}

    /**
     * @throws SubscriptionAlreadyExistsException
     */
    public function __invoke(CreateSubscriptionRequest $request): JsonResponse
    {
        $this->createSubscription->execute(
            $request->validated('email'),
            Website::query()->find($request->validated('website_id')),
        );

        return response()->json(
            ['message' => 'Subscribed'],
            Response::HTTP_CREATED
        );
    }
}
