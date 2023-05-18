<?php

namespace App\OpenApi;

use ApiPlatform\Core\OpenApi\Model\OpenApi;
use ApiPlatform\OpenApi\Factory\OpenApiFactoryInterface;

final class JwtDecorator implements OpenApiFactoryInterface
{
    public function __construct()
    {
    }

    public function decorate(OpenApi $openApi): OpenApi
    {
        $schemas = $openApi->getComponents()->getSecuritySchemes();
        $schemas['bearerAuth'] = new \ArrayObject([
            'type' => 'http',
            'scheme' => 'bearer',
            'bearerFormat' => 'JWT',
        ]);

        $openApi->getComponents()->setSecuritySchemes($schemas);

        foreach ($openApi->getPaths()->getPaths() as $pathItem) {
            $pathItem->getGet()->addSecurity('bearerAuth');
            $pathItem->getPost()->addSecurity('bearerAuth');
            $pathItem->getPatch()->addSecurity('bearerAuth');
            $pathItem->getDelete()->addSecurity('bearerAuth');
        }

        return $openApi;
    }
}
