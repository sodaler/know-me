<?php

namespace App\Http\Controllers\Swagger\v1;

use App\Http\Controllers\Controller;

/**
 * @OA\Get(
 *     path="/api/v1/card",
 *     summary="Index",
 *     tags={"Card"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\Response(response=200, description="OK",
 *          @OA\JsonContent(
 *            @OA\Property(property="data", type="array", @OA\Items(
 *              @OA\Property(property="id", type="integer"),
 *              @OA\Property(property="title", type="string"),
 *              @OA\Property(property="description", type="string"),
 *              @OA\Property(property="image", type="string"),
 *              @OA\Property(property="alt", type="string"),
 *              @OA\Property(property="slug", type="string"),
 *              @OA\Property(property="user", 
 *                  @OA\Property(property="id", type="integer"),
 *                  @OA\Property(property="name", type="string"),
 *                  @OA\Property(property="phone", type="string"),
 *                ),
 *             @OA\Property(property="skills", type="array", 
 *                  @OA\Items(
 *                    @OA\Property(property="id", type="integer"),
 *                    @OA\Property(property="title", type="string"),
 *                  )
 *                )
 *            )),
 *            @OA\Property(property="links", type="array", @OA\Items()),
 *            @OA\Property(property="meta", type="array", @OA\Items()),
 *          )),
 *     @OA\Response(response=401, description="Unauthorized"),
 * ),
 * 
 * @OA\Get(
 *      path="/api/v1/card/{id}",
 *      summary="Show",
 *      tags={"Card"},
 *      security={{ "bearerAuth": {} }},
 *      
 *      @OA\Parameter(name="id", in="path", required=true, description="Card ID"),
 *      
 *      @OA\Response(
 *        response=200,
 *        description="OK",
 *        @OA\JsonContent(
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="id", type="integer"),
 *                  @OA\Property(property="title", type="string"),
 *                  @OA\Property(property="description", type="string"),
 *                  @OA\Property(property="image", type="string"),
 *                  @OA\Property(property="alt", type="string"),
 *                  @OA\Property(property="slug", type="string"),
 *                  @OA\Property(property="user", 
 *                      @OA\Property(property="id", type="integer"),
 *                      @OA\Property(property="name", type="string"),
 *                      @OA\Property(property="phone", type="string"),
 *                  ),
 *                  @OA\Property(property="skills", type="array", 
 *                      @OA\Items(
 *                          @OA\Property(property="id", type="integer"),
 *                          @OA\Property(property="title", type="string"),
 *                      )
 *                  )
 *              )
 *           )
 *       )
 *    )
 * )
 */
class CardController extends Controller
{
    //
}