<?php

namespace App\Http\Controllers\Swagger\v1;

use App\Http\Controllers\Controller;

/**
 * @OA\Get(
 *   tags={"Skill"},
 *   path="/api/v1/skill",
 *   summary="Index",
 *   security={{"bearerAuth": {}}},
 *
 *   @OA\Response(
 *       response=200,
 *       description="OK",
 *
 *       @OA\JsonContent(
 *
 *           @OA\Property(property="data", type="array",
 *
 *               @OA\Items(
 *
 *                   @OA\Property(property="id", type="integer", example=1),
 *                   @OA\Property(property="title", type="string", example="Skill"),
 *               )
 *           ),
 *           @OA\Property(property="links", type="object",
 *               @OA\Property(property="first", type="string", example="http://localhost:8878/api/v1/skill?page=1"),
 *               @OA\Property(property="last", type="string", example="http://localhost:8878/api/v1/skill?page=1"),
 *               @OA\Property(property="prev", type="string", nullable=true),
 *               @OA\Property(property="next", type="string", nullable=true),
 *           ),
 *           @OA\Property(property="meta", type="object",
 *               @OA\Property(property="current_page", type="integer", example=1),
 *               @OA\Property(property="from", type="integer", example=1),
 *               @OA\Property(property="last_page", type="integer", example=1),
 *               @OA\Property(property="links", type="array",
 *
 *                   @OA\Items(
 *
 *                       @OA\Property(property="url", type="string", nullable=true),
 *                       @OA\Property(property="label", type="string", example="1"),
 *                       @OA\Property(property="active", type="boolean", example=true),
 *                   )
 *               ),
 *               @OA\Property(property="path", type="string", example="http://localhost:8878/api/v1/skill"),
 *               @OA\Property(property="per_page", type="integer", example=10),
 *               @OA\Property(property="to", type="integer", example=1),
 *               @OA\Property(property="total", type="integer", example=1),
 *           ),
 *       )
 *   ),
 *
 *   @OA\Response(response=401, description="Unauthorized"),
 * )
 *
 * @OA\Get(
 *     path="/api/v1/skill/{id}",
 *     summary="Show",
 *     tags={"Skill"},
 *     security={{"bearerAuth": {}}},
 *
 *     @OA\Parameter(name="id", in="path", required=true, description="Skill ID"),
 *
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="title", type="string", example="Skill"),
 *             )
 *         )
 *     )
 * )
 */
class SkillController extends Controller
{
    //
}
