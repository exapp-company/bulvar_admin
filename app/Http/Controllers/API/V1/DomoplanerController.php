<?php

namespace App\Http\Controllers\API\V1;

use App\Services\Domoplaner\DomoplanerFeedService;
use App\Services\Domoplaner\DomoplanerFlatService;

class DomoplanerController
{
    public function feed(DomoplanerFeedService $feedService)
    {
        return response()->json($feedService->getAllItems());
    }

    public function flat(int $flatId, DomoplanerFlatService $flatService)
    {
        return response()->json($flatService->getFlat($flatId));
    }
}
