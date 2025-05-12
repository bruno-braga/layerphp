<?php

namespace Layerphp\Framework\Handlers;

use Layerphp\Framework\Http\Controllers\ControllerResolver;

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
