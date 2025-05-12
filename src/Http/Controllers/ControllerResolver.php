<?php

namespace LayerPHP\Http\Controllers;

use ReflectionClass;
use stdClass;

class ControllerResolver
{
	const controllerPaths = __DIR__ . '/Controllers/';

	private bool $canResolveController;
	private $controllerName;
	private string $controllerNamespace;

	public function __construct(private string $url)
	{
		$this->controllerName = $this->parseControllerFileName($url);
		$this->canResolveController = file_exists(self::controllerPaths . $this->controllerName->fileName);
	}

	private function parseControllerFileName(string $url): stdClass
	{
		$parsedUri = parse_url($url);
		$rawControllerName = explode('/', $parsedUri['path'])[1];

		$obj = new stdClass;
		$obj->className = ucfirst($rawControllerName) . 'Controller';
		$obj->fileName = $obj->className . '.php';

		return $obj;
	}

	public function getController()
	{
		$namespace = __NAMESPACE__ . '\\' . $this->controllerName->className;
		return new $namespace;
	}
}
