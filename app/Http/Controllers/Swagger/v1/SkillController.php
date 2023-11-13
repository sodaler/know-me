<?php

namespace App\Http\Controllers\Swagger\v1;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

#[
    OA\Get(
        path: "/api/v1/skills",
        summary: "List of skills",
        security: [
            [
                'bearerAuth' => []
            ]
        ],
        tags: ["Skills"],
        responses: [
            new OA\Response(response: Response::HTTP_OK, description: "success",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: "data",
                            type: "array",
                            items: new OA\Items(
                                properties: [
                                    new OA\Property(
                                        property: "id",
                                        type: "integer",
                                        example: 1
                                    ),
                                    new OA\Property(
                                        property: "title",
                                        type: "string",
                                        example: "example"
                                    ),
                                ]
                            )
                        ),
                        new OA\Property(
                            property: "links",
                            properties: [
                                new OA\Property(property: "first", type: "string", example: "http://localhost:8878/api/v1/skill?page=1"),
                                new OA\Property(property: "last", type: "string", example: "http://localhost:8878/api/v1/skill?page=2"),
                                new OA\Property(property: "prev", type: "string", nullable: true),
                                new OA\Property(property: "next", type: "string", nullable: true),

                            ],
                            type: "object"
                        ),
                        new OA\Property(
                            property: "meta",
                            properties: [
                                new OA\Property(property: "current_page", type: "integer", example: 1),
                                new OA\Property(property: "from", type: "integer", example: 1),
                                new OA\Property(property: "last_page", type: "integer", example: 1),
                                new OA\Property(property: "links", type: "array",
                                    items: new OA\Items(
                                        properties: [
                                            new OA\Property(property: "url", type: "string", nullable: true),
                                            new OA\Property(property: "label", type: "string", example: 1),
                                            new OA\Property(property: "active", type: "boolean", nullable: true),
                                        ]
                                    )
                                ),
                                new OA\Property(property: "path", type: "string", example: "http://localhost:8878/api/v1/skill"),
                                new OA\Property(property: "per_page", type: "integer", example: 10),
                                new OA\Property(property: "to", type: "integer", example: 1),
                                new OA\Property(property: "total", type: "integer", example: 1),
                            ],
                            type: "object"
                        )
                    ],
                    type: "object"
                )
            ),
            new OA\Response(response: Response::HTTP_UNAUTHORIZED, description: "Unauthorized"),
        ],
    )
]
class SkillController extends Controller
{
    //
}
