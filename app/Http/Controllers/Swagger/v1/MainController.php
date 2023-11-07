<?php

namespace App\Http\Controllers\Swagger\v1;

use App\Http\Controllers\Controller;

/**
 * @OA\Info(
 *     title="Know-me Doc API",
 *     version="1.0.0"
 * ),
 *
 * @OA\PathItem(
 *     path="/api/"
 * ),
 *
 * @OA\Components(
 *
 *     @OA\SecurityScheme(
 *         securityScheme="bearerAuth",
 *         type="http",
 *         scheme="bearer"
 *     )
 * )
 */
class MainController extends Controller
{
}
