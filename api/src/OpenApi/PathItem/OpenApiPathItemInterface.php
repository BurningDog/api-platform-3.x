<?php

namespace App\OpenApi\PathItem;

use ApiPlatform\OpenApi\Model\PathItem;

interface OpenApiPathItemInterface
{
    public function pathItem(): PathItem;
}
