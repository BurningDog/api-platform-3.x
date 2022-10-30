<?php

namespace App\OpenApi;

use ApiPlatform\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\OpenApi\Model\Operation;
use ApiPlatform\OpenApi\Model\PathItem;
use ApiPlatform\OpenApi\Model\RequestBody;
use ApiPlatform\OpenApi\OpenApi;

class OpenApiFactory implements OpenApiFactoryInterface
{
    private $decorated;

    public function __construct(OpenApiFactoryInterface $decorated)
    {
        $this->decorated = $decorated;
    }

    public function __invoke(array $context = []): OpenApi
    {
        $openApi = $this->decorated->__invoke($context);

        $pathItem = $this->generateLoginDocumentation();
        $openApi->getPaths()->addPath('/login-json', $pathItem);

        $pathItem = $this->generateLoginCheckDocumentation();
        $openApi->getPaths()->addPath('/loggedin', $pathItem);

        $pathItem = $this->generateLogoutDocumentation();
        $openApi->getPaths()->addPath('/logout', $pathItem);

        return $openApi;
    }

    protected function generateLoginDocumentation(): PathItem
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

    protected function generateLoginCheckDocumentation(): PathItem
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

    protected function generateLogoutDocumentation(): PathItem
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
                    ]
                ]
            )
        );

        return $pathItem;
    }
}
