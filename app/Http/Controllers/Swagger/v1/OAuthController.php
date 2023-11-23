<?php

namespace App\Http\Controllers\Swagger\v1;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;

#[
    OA\Post(
        path: "/api/v1/oauth/login",
        summary: "Login",
        requestBody: new OA\RequestBody(required: true,
            content: new OA\JsonContent(
                allOf: [
                    new OA\Schema(
                        required: ["email", "password"],
                        properties: [
                            new OA\Property(property: "email", description: "email", type: "string", example: "hello1234@mail.ru"),
                            new OA\Property(property: "password", description: "password", type: "string", example: "hello1234@mail.ru"),
                        ],
                    ),
                ],
            ),
        ),
        tags: ["Auth"],
        responses: [
            new OA\Response(response: Response::HTTP_OK, description: "Successful login",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: "token_type",
                            type: "string",
                            example: "Bearer"
                        ),
                        new OA\Property(
                            property: "expires_in",
                            type: "integer",
                            example: 3600
                        ),
                        new OA\Property(
                            property: "access_token",
                            type: "string",
                            example: "some token"
                        ),
                        new OA\Property(
                            property: "refresh_token",
                            type: "string",
                            example: "some token"
                        ),
                    ],
                ),
            ),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: "Server Error"),
        ],
    ),

    OA\Post(
        path: "/api/v1/oauth/register",
        summary: "Register",
        requestBody: new OA\RequestBody(required: true,
            content: new OA\JsonContent(
                allOf: [
                    new OA\Schema(
                        required: ["name", "email", "password"],
                        properties: [
                            new OA\Property(property: "name", description: "name", type: "string", example: "hello1234@mail.ru"),
                            new OA\Property(property: "email", description: "email", type: "string", example: "hello1234@mail.ru"),
                            new OA\Property(property: "password", description: "password", type: "string", example: "hello1234@mail.ru"),
                        ],
                    ),
                ],
            ),
        ),
        tags: ["Auth"],
        responses: [
            new OA\Response(response: Response::HTTP_OK, description: "Successful login",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: "token_type",
                            type: "string",
                            example: "Bearer"
                        ),
                        new OA\Property(
                            property: "expires_in",
                            type: "integer",
                            example: 3600
                        ),
                        new OA\Property(
                            property: "access_token",
                            type: "string",
                            example: "some token"
                        ),
                        new OA\Property(
                            property: "refresh_token",
                            type: "string",
                            example: "some token"
                        ),
                    ],
                ),
            ),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: "Server Error"),
        ],
    ),

    OA\Post(
        path: "/api/v1/oauth/logout",
        summary: "Logout",
        security: [
            [
                'bearerAuth' => []
            ]
        ],
        tags: ["Auth"],
        responses: [
            new OA\Response(response: Response::HTTP_OK, description: "Successful login",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: "message",
                            type: "string",
                            example: "Successfully logged out"
                        ),
                    ],
                ),
            ),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: "Server Error"),
        ],
    ),

    OA\Post(
        path: "/api/v1/oauth/refresh",
        summary: "Refresh tokens",
        requestBody: new OA\RequestBody(required: true,
            content: new OA\JsonContent(
                allOf: [
                    new OA\Schema(
                        required: ["refresh_token"],
                        properties: [
                            new OA\Property(property: "refresh_token", description: "refresh_token", type: "string", example: "some_token"),
                        ],
                    ),
                ],
            ),
        ),
        tags: ["Auth"],
        responses: [
            new OA\Response(response: Response::HTTP_OK, description: "Successful login",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: "token_type",
                            type: "string",
                            example: "Bearer"
                        ),
                        new OA\Property(
                            property: "expires_in",
                            type: "integer",
                            example: 3600
                        ),
                        new OA\Property(
                            property: "access_token",
                            type: "string",
                            example: "some token"
                        ),
                        new OA\Property(
                            property: "refresh_token",
                            type: "string",
                            example: "some token"
                        ),
                    ],
                ),
            ),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: "Server Error"),
        ],
    ),
]
class OAuthController extends Controller
{
}
