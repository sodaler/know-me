<?php

namespace App\Http\Controllers\Swagger\v1;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

#[
    OA\Info(version: "1.0.0", title: "Know-me Doc API"),
    OA\PathItem(path: "/api/"),
    OA\Server(url: 'http://localhost:8878', description: "local server"),
    OA\SecurityScheme(securityScheme: "bearerAuth", type: "http", scheme: "bearer"),
]
class MainController extends Controller
{
}
