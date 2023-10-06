<?php

namespace App\Http\Controllers\Swagger\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Post(
 *     path="/api/v1/category",
 *     summary="Create",
 *     tags={"Category"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(
 *                     @OA\Property(property="name", type="string", example="title example"),
 *                     @OA\Property(property="email", type="string", example="description example"),
 *                     @OA\Property(property="tag_ids", type="array", example="1, 2, 3")
 *                 )
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="Ok",
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(
 *                     @OA\Property(property="name", type="string", example="title example"),
 *                     @OA\Property(property="email", type="string", example="description example"),
 *                     @OA\Property(property="first_name", type="string", example="firstname example"),
 *                     @OA\Property(property="last_name", type="string", example="lastname example"),
 *                     @OA\Property(property="birthday", type="date", example="2023-07-18"),
 *                     @OA\Property(property="group", type="object",
 *                          @OA\Property(property="id", type="integer", example=1),
 *                          @OA\Property(property="title", type="string", example="group title"),
 *                     ),
 *                     @OA\Property(property="role", type="object",
 *                          @OA\Property(property="role", type="integer", example=1),
 *                          @OA\Property(property="roleHuman", type="string", example="Student"),
 *                     ),
 *                     @OA\Property(property="address", type="object",
 *                          @OA\Property(property="city", type="string", example="moscow"),
 *                          @OA\Property(property="street", type="string", example="lenina"),
 *                          @OA\Property(property="house", type="integer", example=10),
 *                     ),
 *                 )
 *             }
 *         ),
 *     ),
 * ),
 *
 * @OA\Get(
 *     path="/api/students",
 *     summary="Index",
 *     tags={"Student"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="array", @OA\Items(
 *                 @OA\Property(property="name", type="string", example="title example"),
 *                 @OA\Property(property="email", type="string", example="description example"),
 *                 @OA\Property(property="first_name", type="string", example="firstname example"),
 *                 @OA\Property(property="last_name", type="string", example="lastname example"),
 *                 @OA\Property(property="birthday", type="date", example="2023-07-18"),
 *                 @OA\Property(property="group", type="object",
 *                      @OA\Property(property="id", type="integer", example=1),
 *                      @OA\Property(property="title", type="string", example="group title"),
 *                 ),
 *                 @OA\Property(property="role", type="object",
 *                      @OA\Property(property="role", type="integer", example=1),
 *                      @OA\Property(property="roleHuman", type="string", example="Student"),
 *                 ),
 *                 @OA\Property(property="address", type="object",
 *                      @OA\Property(property="city", type="string", example="moscow"),
 *                      @OA\Property(property="street", type="string", example="lenina"),
 *                      @OA\Property(property="house", type="integer", example=10),
 *                 ),
 *             )),
 *         ),
 *     ),
 * ),
 *
 * @OA\Get(
 *     path="/api/students/{student}",
 *     summary="Show",
 *     tags={"Student"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\Parameter(
 *         description="Student's id",
 *         in="path",
 *         name="student",
 *         required=true,
 *         example=1
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="array", @OA\Items(
 *                 @OA\Property(property="name", type="string", example="title example"),
 *                 @OA\Property(property="email", type="string", example="description example"),
 *                 @OA\Property(property="first_name", type="string", example="firstname example"),
 *                 @OA\Property(property="last_name", type="string", example="lastname example"),
 *                 @OA\Property(property="birthday", type="date", example="2023-07-18"),
 *                 @OA\Property(property="group", type="object",
 *                      @OA\Property(property="id", type="integer", example=1),
 *                      @OA\Property(property="title", type="string", example="group title"),
 *                 ),
 *                 @OA\Property(property="role", type="object",
 *                      @OA\Property(property="role", type="integer", example=1),
 *                      @OA\Property(property="roleHuman", type="string", example="Student"),
 *                 ),
 *                 @OA\Property(property="address", type="object",
 *                      @OA\Property(property="city", type="string", example="moscow"),
 *                      @OA\Property(property="street", type="string", example="lenina"),
 *                      @OA\Property(property="house", type="integer", example=10),
 *                 ),
 *             )),
 *         ),
 *     ),
 * ),
 *
 * @OA\Patch(
 *     path="/api/students/{student}",
 *     summary="Update",
 *     tags={"Student"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\Parameter(
 *         description="Student's id",
 *         in="path",
 *         name="student",
 *         required=true,
 *         example=1
 *     ),
 *
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(
 *                     @OA\Property(property="name", type="string", example="title example"),
 *                     @OA\Property(property="email", type="string", example="description example"),
 *                     @OA\Property(property="first_name", type="string", example="firstname example"),
 *                     @OA\Property(property="last_name", type="string", example="lastname example"),
 *                     @OA\Property(property="birthday", type="date", example="2023-07-18"),
 *                     @OA\Property(property="group_id", type="integer", example=5),
 *                     @OA\Property(property="role", type="integer", example=2),
 *                     @OA\Property(property="address", type="object",
 *                          @OA\Property(property="city", type="string", example="moscow"),
 *                          @OA\Property(property="street", type="string", example="lenina"),
 *                          @OA\Property(property="house", type="integer", example=10),
 *                     ),
 *                 )
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="Ok",
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(
 *                     @OA\Property(property="name", type="string", example="title example"),
 *                     @OA\Property(property="email", type="string", example="description example"),
 *                     @OA\Property(property="first_name", type="string", example="firstname example"),
 *                     @OA\Property(property="last_name", type="string", example="lastname example"),
 *                     @OA\Property(property="birthday", type="date", example="2023-07-18"),
 *                     @OA\Property(property="group", type="object",
 *                          @OA\Property(property="id", type="integer", example=1),
 *                          @OA\Property(property="title", type="string", example="group title"),
 *                     ),
 *                     @OA\Property(property="role", type="object",
 *                          @OA\Property(property="role", type="integer", example=1),
 *                          @OA\Property(property="roleHuman", type="string", example="Student"),
 *                     ),
 *                     @OA\Property(property="address", type="object",
 *                          @OA\Property(property="city", type="string", example="moscow"),
 *                          @OA\Property(property="street", type="string", example="lenina"),
 *                          @OA\Property(property="house", type="integer", example=10),
 *                     ),
 *                 )
 *             }
 *         ),
 *     ),
 * ),
 *
 * @OA\Delete(
 *     path="/api/students/{student}",
 *     summary="Delete",
 *     tags={"Student"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\Parameter(
 *         description="Student's id",
 *         in="path",
 *         name="student",
 *         required=true,
 *         example=1
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="deleted"),
 *         ),
 *     ),
 * ),
 *
 * @OA\Get(
 *     path="/api/students/{student}/generate_pdf",
 *     summary="User info export via pdf",
 *     tags={"Student"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\Parameter(
 *         description="Student's id",
 *         in="path",
 *         name="student",
 *         required=true,
 *         example=1
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="PDF successfully generated"),
 *             @OA\Property(property="download_link", type="string", example="http://localhost:8000/storage/reports/user_1_report.pdf")
 *         )
 *     )
 * )
 */

class CategoryController extends Controller
{
    //
}
