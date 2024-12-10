<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Enums\HttpStatus;
use App\Http\Requests\Admin\StoreUpdateNewsRequest;
use App\Http\Resources\NewsResource;
use App\Models\News;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class NewsController
{
    use ApiResponse;

    public function index(): ResourceCollection
    {
        $news = News::query()->latest()->paginate(16);
        return NewsResource::collection($news);
    }

    public function show(News $news): NewsResource
    {
        return new NewsResource($news);
    }

    public function store(StoreUpdateNewsRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['published_at'] = now();
        News::query()->create($data);
        return $this->success('News created successfully', HttpStatus::created);
    }

    public function update(StoreUpdateNewsRequest $request, News $news)
    {
        $news->update($request->validated());
        return $this->success('News updated successfully');
    }

    public function destroy(News $news): JsonResponse
    {
        $news->delete();
        return $this->success('News deleted successfully');
    }
}
