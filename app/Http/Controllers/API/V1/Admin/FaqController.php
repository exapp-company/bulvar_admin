<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Enums\HttpStatus;
use App\Http\Requests\Admin\StoreUpdateFaqRequest;
use App\Http\Resources\FaqResource;
use App\Models\Faq;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FaqController
{
    use ApiResponse;

    public function index(): ResourceCollection
    {
        $faqs = Faq::query()->latest()->paginate(16);
        return FaqResource::collection($faqs);
    }

    public function store(StoreUpdateFaqRequest $request): JsonResponse
    {

        Faq::query()->create($request->validated());

        return $this->success('Faq created successfully', HttpStatus::created);
    }

    public function update(StoreUpdateFaqRequest $request, Faq $faq): JsonResponse
    {
        $faq->update($request->validated());
        return $this->success('Faq updated successfully');
    }

    public function destroy(Faq $faq): JsonResponse
    {
        $faq->delete();
        return $this->success('Faq deleted successfully');

    }
}
