<?php

require '../vendor/autoload.php';

use Layerphp\Framework\Http\Request;
use Layerphp\Framework\Http\Controllers\ControllerResolver;

$req = new Request($_SERVER);

$handlers = [
	ControllerHandler::class,
];

interface Handler
{
	public function setNext(Handler $handler): Handler;
	public function handle($request);
}

abstract class AbstractHandler implements Handler
{
	/**
	 * @var Handler
	 */
	private $nextHandler;

	public function setNext(Handler $handler): Handler
	{
		$this->nextHandler = $handler;
		return $handler;
	}

	public function handle($request)
	{
		if ($this->nextHandler) {
			return $this->nextHandler->handle($request);
		}

		return null;
	}
}

class ControllerHandler extends AbstractHandler
{
	public function handle($req)
	{
		$controllerResolver = new ControllerResolver($req->getUri());
		$c = $controllerResolver->getController();

		if ($req === "Nut") {
			return "Squirrel: I'll eat the " . $req . ".\n";
		} else {
			return parent::handle($req);
		}
	}
}



$handlers = array_reduce($handlers, function ($c, $i) {
	if (is_null($c)) {
		$c = new $i;
		return $c;
	}

	$c->setNext(new $i);

	return $c;
});

$handlers->handle($req);
