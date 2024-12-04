<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Enums\HttpStatus;
use App\Http\Requests\Admin\StoreUpdateSeoModuleRequest;
use App\Http\Resources\SeoModuleResource;
use App\Models\SeoModule;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SeoModuleController
{
    use ApiResponse;

    public function index(): ResourceCollection
    {
        $seoModules = SeoModule::query()->latest()->paginate(16);
        return SeomoduleResource::collection($seoModules);
    }

    public function store(StoreUpdateSeoModuleRequest $request): JsonResponse
    {
        SeoModule::query()->create($request->validated());

        return $this->success('Seo module created successfully.', HttpStatus::created);
    }

    public function update(StoreUpdateSeoModuleRequest $request, SeoModule $seoModule): JsonResponse
    {
        $seoModule->update($request->validated());
        return $this->success('Seo module updated successfully.');

    }

    public function destroy(SeoModule $seoModule): JsonResponse
    {
        $seoModule->delete();
        return $this->success('Seo module deleted successfully.');

    }
}
