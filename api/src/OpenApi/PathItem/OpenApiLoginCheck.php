<?php

namespace App\OpenApi\PathItem;

use ApiPlatform\OpenApi\Model\Operation;
use ApiPlatform\OpenApi\Model\PathItem;

class OpenApiLoginCheck implements OpenApiPathItemInterface
{
    public function pathItem(): PathItem
    {
        $pathItem = new PathItem(
            summary: 'Login check',
            get: new Operation(
                tags: ['Authentication'],
                description: 'Are you logged in?',
                summary: 'Login check',
                responses: [
                    '200' => [
                        'description' => 'You are logged in',
                    ],
                    '401' => [
                        'description' => 'You are not logged in',
                    ],
                ]
            )
        );

        return $pathItem;
    }
}
