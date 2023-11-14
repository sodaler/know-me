<?php

namespace App\Http\Controllers\Swagger\v1;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

#[
    OA\Post(
        path: "/api/v1/categories",
        summary: "Create",
        security: [
            [
                'bearerAuth' => []
            ]
        ],
        requestBody: new OA\RequestBody(required: true,
            content: new OA\JsonContent(
                allOf: [
                    new OA\Schema(
                        required: ["title", "description"],
                        properties: [
                            new OA\Property(property: "title", description: "Category's title", type: "string", example: "example title"),
                            new OA\Property(property: "description", description: "Category's description", type: "string", example: "example description"),
                            new OA\Property(property: "card_ids", description: "Category's cards", type: "array", items: new OA\Items(
                                properties: [
                                    new OA\Property(
                                        property: "card_id"
                                    ),
                                ],
                            ), example: [1, 2, 3]),
                        ]
                    )
                ],
            ),
        ),
        tags: ["Categories"],
        responses: [
            new OA\Response(response: Response::HTTP_CREATED, description: "Category created",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: "id",
                            type: "integer",
                            example: 1
                        ),
                        new OA\Property(
                            property: "title",
                            type: "string",
                            example: "title"
                        ),
                        new OA\Property(
                            property: "description",
                            type: "string",
                            example: "description"
                        ),
                        new OA\Property(
                            property: "slug",
                            type: "string",
                            example: "title-slug"
                        ),
                    ],
                ),
            ),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: "Server Error"),
        ]
    ),

    OA\Get(
        path: "/api/v1/categories",
        summary: "Index",
        security: [
            [
                'bearerAuth' => []
            ]
        ],
        tags: ["Categories"],
        responses: [
            new OA\Response(response: Response::HTTP_OK, description: "Success",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: "id",
                            type: "integer",
                            example: 1,
                        ),
                        new OA\Property(
                            property: "title",
                            type: "string",
                            example: "title",
                        ),
                        new OA\Property(
                            property: "description",
                            type: "string",
                            example: "description",
                        ),
                        new OA\Property(
                            property: "slug",
                            type: "string",
                            example: "title",
                        ),
                        new OA\Property(
                            property: "image",
                            type: "string",
                            example: "img.png",
                        ),
                        new OA\Property(
                            property: "alt",
                            type: "string",
                            example: "image",
                        ),
                        new OA\Property(property: "card_ids", description: "Category's cards", type: "array", items: new OA\Items(
                            properties: [
                                new OA\Property(
                                    property: "card_id"
                                ),
                            ],
                        ), example: [1, 2, 3]),
                    ],
                ),
            ),
        ],
    ),

    OA\Get(
        path: "/api/v1/categories/{category}",
        summary: "Show",
        security: [
            [
                "bearerAuth" => []
            ]
        ],
        tags: ["Categories"],
        parameters: [
            new OA\Parameter(
                name: "category",
                description: "Category's id",
                in: "path",
                required: true,
                example: 1,
            ),
        ],
        responses: [
            new OA\Response(response: Response::HTTP_OK, description: "Success",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: "id",
                            type: "integer",
                            example: 1,
                        ),
                        new OA\Property(
                            property: "title",
                            type: "string",
                            example: "title",
                        ),
                        new OA\Property(
                            property: "description",
                            type: "string",
                            example: "description",
                        ),
                        new OA\Property(
                            property: "slug",
                            type: "string",
                            example: "title",
                        ),
                        new OA\Property(
                            property: "image",
                            type: "string",
                            example: "img.png",
                        ),
                        new OA\Property(
                            property: "alt",
                            type: "string",
                            example: "image",
                        ),
                        new OA\Property(property: "card_ids", description: "Category's cards", type: "array", items: new OA\Items(
                            properties: [
                                new OA\Property(
                                    property: "card_id"
                                ),
                            ],
                        ), example: [1, 2, 3]),
                    ],
                ),
            ),
        ],
    ),

    OA\Patch(
        path: "/api/v1/categories/{category}",
        summary: "Update",
        security: [
            [
                'bearerAuth' => []
            ]
        ],
        requestBody: new OA\RequestBody(required: true,
            content: new OA\JsonContent(
                allOf: [
                    new OA\Schema(
                        properties: [
                            new OA\Property(property: "title", description: "Category's title", type: "string", example: "example title"),
                            new OA\Property(property: "description", description: "Category's description", type: "string", example: "example description"),
                            new OA\Property(property: "card_ids", description: "Category's cards", type: "array", items: new OA\Items(
                                properties: [
                                    new OA\Property(
                                        property: "card_id"
                                    ),
                                ],
                            ), example: [1, 2, 3]),
                        ]
                    )
                ],
            ),
        ),
        tags: ["Categories"],
        parameters: [
            new OA\Parameter(
                name: "category",
                description: "Category's id",
                in: "path",
                required: true,
                example: 1,
            ),
        ],
        responses: [
            new OA\Response(response: Response::HTTP_OK, description: "Category updated",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: "id",
                            type: "integer",
                            example: 1
                        ),
                        new OA\Property(
                            property: "title",
                            type: "string",
                            example: "title"
                        ),
                        new OA\Property(
                            property: "description",
                            type: "string",
                            example: "description"
                        ),
                        new OA\Property(
                            property: "slug",
                            type: "string",
                            example: "title-slug"
                        ),
                    ],
                ),
            ),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: "Server Error"),
        ]
    ),

    OA\Delete(
        path: "/api/v1/categories/{category}",
        summary: "Delete",
        security: [
            [
                'bearerAuth' => []
            ]
        ],
        tags: ["Categories"],
        parameters: [
            new OA\Parameter(
                name: "category",
                description: "Category's id",
                in: "path",
                required: true,
                example: 1,
            ),
        ],
        responses: [
            new OA\Response(response: Response::HTTP_OK, description: "Category deleted",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Category deleted"),
                    ],
                ),
            ),
        ],
    ),
]
class CategoryController extends Controller
{
    //
}
