<?php

namespace App\OpenApi\PathItem;

use ApiPlatform\OpenApi\Model\Operation;
use ApiPlatform\OpenApi\Model\PathItem;

class OpenApiLogout implements OpenApiPathItemInterface
{
    public function pathItem(): PathItem
    {
        $pathItem = new PathItem(
            summary: 'Log out',
            get: new Operation(
                tags: ['Authentication'],
                description: 'Log out',
                summary: 'Log out',
                responses: [
                    '200' => [
                        'description' => 'You are now logged out',
                    ],
                ]
            )
        );

        return $pathItem;
    }
}
