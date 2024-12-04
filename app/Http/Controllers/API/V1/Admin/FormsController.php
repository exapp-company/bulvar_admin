<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Enums\HttpStatus;
use App\Http\Requests\Admin\StoreUpdateFormsRequest;
use App\Http\Resources\FormsResource;
use App\Models\Forms;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FormsController
{
    use ApiResponse;

    public function index(): ResourceCollection
    {
        $forms = Forms::query()->latest()->paginate(16);
        return FormsResource::collection($forms);
    }

    public function store(StoreUpdateFormsRequest $request): JsonResponse
    {
        Forms::query()->create($request->validated());

        return $this->success('Form created successfully', HttpStatus::created);
    }

    public function update(StoreUpdateFormsRequest $request, Forms $forms): JsonResponse
    {
        $forms->update($request->validated());
        return $this->success('Form updated successfully');

    }

    public function destroy(Forms $forms): JsonResponse
    {
        $forms->delete();
        return $this->success('Form deleted successfully');

    }
}
