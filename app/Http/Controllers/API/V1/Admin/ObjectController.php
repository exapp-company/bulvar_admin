<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Enums\HttpStatus;
use App\Http\Requests\Admin\StoreUpdateObjectRequest;
use App\Http\Resources\ObjectResource;
use App\Models\MyObject;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ObjectController
{
    use ApiResponse;

    public function index(): ResourceCollection
    {
        $objects = MyObject::query()->latest()->with('project')->paginate(16);
        return ObjectResource::collection($objects);
    }

    public function show(MyObject $object): ObjectResource
    {
        return ObjectResource::make($object);
    }

    public function store(StoreUpdateObjectRequest $request): JsonResponse
    {
        MyObject::query()->create($request->validated());

        return $this->success('Обьект успешно создан.', HttpStatus::created);
    }

    public function update(StoreUpdateObjectRequest $request, object $object): JsonResponse
    {
        $object->update($request->validated());
        return $this->success('Обьект успешно обновлен.');
    }

    public function destroy(MyObject $object): JsonResponse
    {
        $object->delete();
        return $this->success('Обьект успешно удален.');

    }
}
