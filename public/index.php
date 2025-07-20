<?php

require "../vendor/autoload.php";

use LayerPHP\Http\Request;
use LayerPHP\Http\Controllers\ControllerResolver;

use LayerPHP\Handlers\ControllerHandler;

$req = new Request($_SERVER);

$handlers = [ControllerHandler::class];

$handlers = array_reduce($handlers, function ($c, $i) {
    if ($c === null) {
        $c = new $i();
        return $c;
    }

    $c->setNext(new $i());

    return $c;
});

$handlers->handle($req);
