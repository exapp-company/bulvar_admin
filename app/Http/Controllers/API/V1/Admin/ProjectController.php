<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Enums\HttpStatus;
use App\Http\Requests\Admin\StoreUpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProjectController
{
    use ApiResponse;

    public function index(): ResourceCollection
    {
        $projects = Project::query()->latest()->paginate(16);
        return ProjectResource::collection($projects);
    }

    public function show(Project $project): ProjectResource
    {
        return ProjectResource::make($project);
    }

    public function store(StoreUpdateProjectRequest $request): JsonResponse
    {
        Project::query()->create($request->validated());

        return $this->success('Проект успешно создан.', HttpStatus::created);
    }

    public function update(StoreUpdateProjectRequest $request, Project $project): JsonResponse
    {
        $project->update($request->validated());

        return $this->success('Проект успешно обновлен.');
    }

    public function destroy(Project $project): JsonResponse
    {
        $project->delete();
        return $this->success('Проект успешно удален.');

    }
}
