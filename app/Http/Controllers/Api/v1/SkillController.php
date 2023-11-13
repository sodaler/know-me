<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Skill\SkillResource;
use App\Models\Skill;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SkillController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $skills = Skill::paginate(10);

        return SkillResource::collection($skills);
    }

    public function show(Skill $skill): SkillResource
    {
        return new SkillResource($skill);
    }
}
