<?php

namespace App\OpenApi;

use ApiPlatform\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\OpenApi\OpenApi;
use App\OpenApi\PathItem\OpenApiLogin;
use App\OpenApi\PathItem\OpenApiLoginCheck;
use App\OpenApi\PathItem\OpenApiLogout;

class OpenApiFactory implements OpenApiFactoryInterface
{
    private $decorated;

    public function __construct(
        OpenApiFactoryInterface $decorated,
        private OpenApiLogin $openApiLogin,
        private OpenApiLogout $openApiLogout,
        private OpenApiLoginCheck $openApiLoginCheck,
    ) {
        $this->decorated = $decorated;
    }

    public function __invoke(array $context = []): OpenApi
    {
        $openApi = $this->decorated->__invoke($context);

        $pathItem = $this->openApiLogin->pathItem();
        $openApi->getPaths()->addPath('/auth/login', $pathItem);

        $pathItem = $this->openApiLoginCheck->pathItem();
        $openApi->getPaths()->addPath('/auth/loggedin', $pathItem);

        $pathItem = $this->openApiLogout->pathItem();
        $openApi->getPaths()->addPath('/auth/logout', $pathItem);

        return $openApi;
    }
}
