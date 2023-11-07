<?php

namespace App\Http\Controllers\Swagger\v1;

use App\Http\Controllers\Controller;

/**
 * @OA\Post(
 *     path="/api/v1/oauth/login",
 *     summary="Login",
 *     tags={"Auth"},
 *
 *     @OA\RequestBody(
 *
 *         @OA\JsonContent(
 *             allOf={
 *
 *                 @OA\Schema(
 *
 *                     @OA\Property(property="email", type="string", example="email@mail.com"),
 *                     @OA\Property(property="password", type="string", example="password"),
 *                 )
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Ok",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="token_type", type="string", example="Bearer"),
 *                 @OA\Property(property="expires_in", type="integer", example=3600),
 *                 @OA\Property(property="access_token", type="string", example="sdfsddsdsgfdweqwdv"),
 *                 @OA\Property(property="refresh_token", type="string", example="sdfsddsdsgfdweqwdv"),
 *             ),
 *         ),
 *     ),
 * ),
 *
 * @OA\Post(
 *     path="/api/v1/oauth/register",
 *     summary="Register",
 *     tags={"Auth"},
 *
 *     @OA\RequestBody(
 *
 *         @OA\JsonContent(
 *             allOf={
 *
 *                 @OA\Schema(
 *
 *                     @OA\Property(property="name", type="string", example="name_ex"),
 *                     @OA\Property(property="email", type="string", example="email_ex"),
 *                     @OA\Property(property="password", type="string", example="password_ex"),
 *                 )
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Ok",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="token_type", type="string", example="Bearer"),
 *                 @OA\Property(property="expires_in", type="integer", example=3600),
 *                 @OA\Property(property="access_token", type="string", example="sdfsddsdsgfdweqwdv"),
 *                 @OA\Property(property="refresh_token", type="string", example="sdfsddsdsgfdweqwdv"),
 *             ),
 *         ),
 *     ),
 * ),
 *
 * @OA\Post(
 *     path="/api/v1/oauth/logout",
 *     summary="Logout",
 *     tags={"Auth"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\Response(
 *         response=200,
 *         description="Ok",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="message", type="string", example="Successfully logged out"),
 *         ),
 *     ),
 * ),
 *
 * @OA\Post(
 *     path="/api/v1/oauth/refresh",
 *     summary="Refresh token",
 *     tags={"Auth"},
 *
 *     @OA\RequestBody(
 *
 *         @OA\JsonContent(
 *             allOf={
 *
 *                 @OA\Schema(
 *
 *                     @OA\Property(property="refresh_token", type="string", example="sdfgsssdfasdfqweqwcvx"),
 *                 )
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Ok",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="token_type", type="string", example="Bearer"),
 *                 @OA\Property(property="expires_in", type="integer", example=3600),
 *                 @OA\Property(property="access_token", type="string", example="sdfsddsdsgfdweqwdv"),
 *                 @OA\Property(property="refresh_token", type="string", example="sdfsddsdsgfdweqwdv"),
 *             ),
 *         ),
 *     ),
 * )
 */
class OAuthController extends Controller
{
}
