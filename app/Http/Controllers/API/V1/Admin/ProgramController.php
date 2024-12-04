<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Enums\HttpStatus;
use App\Http\Requests\Admin\StoreUpdateProgramRequest;
use App\Http\Resources\ProgramResource;
use App\Models\Program;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProgramController
{
    use ApiResponse;

    public function index(): ResourceCollection
    {
        $programs = Program::query()->latest()->paginate(16);

        return ProgramResource::collection($programs);
    }

    public function store(StoreUpdateProgramRequest $request): JsonResponse
    {
        Program::query()->create($request->validated());
        return $this->success('Программа успешно создана', HttpStatus::created);

    }

    public function update(StoreUpdateProgramRequest $request, Program $program): JsonResponse
    {
        $program->update($request->validated());
        return $this->success('Программа успешно обноалена');
    }


    public function destroy(Program $program): JsonResponse
    {
        $program->delete();
        return $this->success('Программа успешно удаленна');
    }
}
