<?php

namespace Layerphp\Framework\Http\Controllers;

use stdClass;

class ControllerResolver
{
	const controllerPaths = __DIR__ . '/Controllers/';

	/* private bool $canResolveController; */
	/* private $controllerName; */

	public function __construct(private string $url)
	{
		var_dump($url);
		/* $this->controllerName = $this->parseControllerFileName($url); */
		/* var_dump($this->controllerName); */
		/* $this->canResolveController = file_exists(self::controllerPaths . $this->controllerName->fileName); */
	}

	private function parseControllerFileName(string $url): stdClass
	{
		/* $parsedUri = parse_url($url); */
		/* $rawControllerName = explode('/', $parsedUri['path'])[1]; */

		/* $obj = new stdClass; */
		/* $obj->className = ucfirst($rawControllerName) . 'Controller'; */
		/* $obj->fileName = $obj->className . '.php'; */

		/* return $obj; */

		return new stdClass;
	}
}
