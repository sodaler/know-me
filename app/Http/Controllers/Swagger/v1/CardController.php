<?php

namespace App\Http\Controllers\Swagger\v1;

use App\Http\Controllers\Controller;

/**
 * @OA\Get(
 *   tags={"Card"},
 *   path="/api/v1/card",
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
 *                   @OA\Property(property="title", type="string", example="qwe"),
 *                   @OA\Property(property="description", type="string", example="qwer"),
 *                   @OA\Property(property="image", type="string", example="qwer"),
 *                   @OA\Property(property="alt", type="string", example="qwe"),
 *                   @OA\Property(property="slug", type="string", example="qwe"),
 *                   @OA\Property(property="user", type="object",
 *                       @OA\Property(property="id", type="integer", example=4),
 *                       @OA\Property(property="name", type="string", example="admin"),
 *                       @OA\Property(property="phone", type="string", example=null),
 *                   ),
 *                   @OA\Property(property="skills", type="array",
 *
 *                       @OA\Items(
 *
 *                           @OA\Property(property="id", type="integer", example=1),
 *                           @OA\Property(property="title", type="string", example="skill"),
 *                       )
 *                   )
 *               )
 *           ),
 *           @OA\Property(property="links", type="object",
 *               @OA\Property(property="first", type="string", example="http://localhost:8878/api/v1/card?page=1"),
 *               @OA\Property(property="last", type="string", example="http://localhost:8878/api/v1/card?page=1"),
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
 *                       @OA\Property(property="label", type="string", example="&laquo; Previous"),
 *                       @OA\Property(property="active", type="boolean", example=false),
 *                   ),
 *
 *                   @OA\Items(
 *
 *                       @OA\Property(property="url", type="string", example="http://localhost:8878/api/v1/card?page=1"),
 *                       @OA\Property(property="label", type="string", example="1"),
 *                       @OA\Property(property="active", type="boolean", example=true),
 *                   ),
 *
 *                   @OA\Items(
 *
 *                       @OA\Property(property="url", type="string", nullable=true),
 *                       @OA\Property(property="label", type="string", example="Next &raquo;"),
 *                       @OA\Property(property="active", type="boolean", example=false),
 *                   ),
 *               ),
 *               @OA\Property(property="path", type="string", example="http://localhost:8878/api/v1/card"),
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
 *     path="/api/v1/card/{id}",
 *     summary="Show",
 *     tags={"Card"},
 *     security={{"bearerAuth": {}}},
 *
 *     @OA\Parameter(name="id", in="path", required=true, description="Card ID"),
 *
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="title", type="string", example="qwe"),
 *                 @OA\Property(property="description", type="string", example="qwer"),
 *                 @OA\Property(property="image", type="string", example="qwer"),
 *                 @OA\Property(property="alt", type="string", example="qwe"),
 *                 @OA\Property(property="slug", type="string", example="qwe"),
 *                 @OA\Property(property="user", type="object",
 *                     @OA\Property(property="id", type="integer", example=4),
 *                     @OA\Property(property="name", type="string", example="admin"),
 *                     @OA\Property(property="phone", type="string", example=null),
 *                 ),
 *                 @OA\Property(property="skills", type="array",
 *
 *                     @OA\Items(
 *
 *                         @OA\Property(property="id", type="integer", example=1),
 *                         @OA\Property(property="title", type="string", example="skill"),
 *                     )
 *                 )
 *             )
 *         )
 *     )
 * )
 */
class CardController extends Controller
{
    //
}
