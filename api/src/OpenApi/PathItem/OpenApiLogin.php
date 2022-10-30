<?php

namespace App\OpenApi\PathItem;

use ApiPlatform\OpenApi\Model\Operation;
use ApiPlatform\OpenApi\Model\PathItem;
use ApiPlatform\OpenApi\Model\RequestBody;

class OpenApiLogin implements OpenApiPathItemInterface
{
    public function pathItem(): PathItem
    {
        $pathItem = new PathItem(
            summary: 'Login with JSON',
            post: new Operation(
                tags: ['Authentication'],
                description: 'A JSON login.',
                summary: 'Login with JSON',
                requestBody: new RequestBody(
                    content: new \ArrayObject([
                        'application/json' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'email' => ['type' => 'string', 'required' => true],
                                    'password' => ['type' => 'string'],
                                ],
                            ],
                            'example' => [
                                'email' => 'me@example.com',
                                'password' => 'testing',
                            ],
                        ],
                    ])
                ),
                responses: [
                    '200' => [
                        'description' => 'Successful login',
                    ],
                    '400' => [
                        'description' => 'If either of the body fields are missing',
                    ],
                    '401' => [
                        'description' => 'If the supplied credentials are invalid',
                    ],
                ]
            )
        );

        return $pathItem;
    }
}
