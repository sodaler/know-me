<?php

namespace App\Http\Controllers\Swagger\v1;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

#[
    OA\Get(
        path: "/api/v1/cards",
        summary: "Index",
        security: [
            [
                'bearerAuth' => []
            ]
        ],
        tags: ["Cards"],
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
                            property: "image",
                            type: "string",
                            example: "img.png",
                        ),
                        new OA\Property(
                            property: "alt",
                            type: "string",
                            example: "image-alt",
                        ),
                        new OA\Property(
                            property: "slug",
                            type: "string",
                            example: "title-slug",
                        ),
                        new OA\Property(property: "user", description: "Card's user", type: "array", items: new OA\Items(
                            properties: [
                                new OA\Property(
                                    property: "id",
                                    type: "integer",
                                    example: 1
                                ),
                                new OA\Property(
                                    property: "name",
                                    type: "string",
                                    example: "Vasya"
                                ),
                            ],
                        )),
                        new OA\Property(property: "skills", description: "skills", type: "array",
                            items: new OA\Items(
                                properties: [
                                    new OA\Property(
                                        property: "id",
                                        type: "integer",
                                        example: 1,
                                    ),
                                    new OA\Property(
                                        property: "title",
                                        type: "string",
                                        example: "card title"
                                    ),
                                ],
                            ),
                        ),
                        new OA\Property(
                            property: "status",
                            type: "string",
                            example: "created"
                        ),
                    ],
                ),
            ),
        ],
    ),

    OA\Get(
        path: "/api/v1/cards/{card}",
        summary: "Show",
        security: [
            [
                "bearerAuth" => []
            ]
        ],
        tags: ["Cards"],
        parameters: [
            new OA\Parameter(
                name: "card",
                description: "Card's id",
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
                            property: "image",
                            type: "string",
                            example: "img.png",
                        ),
                        new OA\Property(
                            property: "alt",
                            type: "string",
                            example: "image-alt",
                        ),
                        new OA\Property(
                            property: "slug",
                            type: "string",
                            example: "title-slug",
                        ),
                        new OA\Property(property: "user", description: "Card's user", type: "array", items: new OA\Items(
                            properties: [
                                new OA\Property(
                                    property: "id",
                                    type: "integer",
                                    example: 1
                                ),
                                new OA\Property(
                                    property: "name",
                                    type: "string",
                                    example: "Vasya"
                                ),
                            ],
                        )),
                        new OA\Property(property: "skills", description: "skills", type: "array",
                            items: new OA\Items(
                                properties: [
                                    new OA\Property(
                                        property: "id",
                                        type: "integer",
                                        example: 1,
                                    ),
                                    new OA\Property(
                                        property: "title",
                                        type: "string",
                                        example: "card title"
                                    ),
                                ],
                            ),
                        ),
                        new OA\Property(
                            property: "status",
                            type: "string",
                            example: "created"
                        ),
                    ],
                ),
            ),
        ],
    ),
]
class CardController extends Controller
{
    //
}
