<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\SkillResource;
use App\Models\Category;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SkillController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $skills = Skill::with(['categories'])->paginate(10);

        return SkillResource::collection($skills);
    }

    public function show(Skill $skill): SkillResource
    {
        return new SkillResource($skill);
    }
}
