<?php

require '../vendor/autoload.php';

use Layerphp\Framework\Http\Request;
use Layerphp\Framework\Http\Controllers\ControllerResolver;

use Layerphp\Framework\Handlers\ControllerHandler;

$req = new Request($_SERVER);

$handlers = [
	ControllerHandler::class,
];

$handlers = array_reduce($handlers, function ($c, $i) {
	if (is_null($c)) {
		$c = new $i;
		return $c;
	}

	$c->setNext(new $i);

	return $c;
});

$handlers->handle($req);
