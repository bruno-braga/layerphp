<?php

namespace LayerPHP\Handlers;

use LayerPHP\Http\Controllers\ControllerResolver;

class ControllerHandler extends AbstractHandler
{
    public function handle($req)
    {
        $uri = $req->getUri();

        $controllerResolver = new ControllerResolver($uri);
        $controllerMethod = $controllerResolver->getMethod();

        $c = $controllerResolver->getController();

        $hasMethod = method_exists($c, $controllerMethod);

        if (!$hasMethod) {
            return http_response_code(404);
        }

        $c->{$controllerMethod}();
    }
}
