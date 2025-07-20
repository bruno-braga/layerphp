<?php

namespace LayerPHP\Http\Controllers;

use ReflectionClass;
use stdClass;

class ControllerResolver
{
    private const controllerPaths = __DIR__ . "/Controllers/";

    private bool $canResolveController;
    private stdClass $controllerName;
    private string $controllerNamespace;
    private string $rawControllerName;

    public function __construct(private string $url)
    {
        $this->controllerName = $this->parseControllerFileName($url);
        $this->canResolveController = file_exists(
            self::controllerPaths . $this->controllerName->fileName,
        );
    }

    private function getRawControllerName(): string
    {
        return $this->getRawControllerName();
    }

    private function parseControllerFileName(string $url): stdClass
    {
        $parsedUri = parse_url($url);
        $this->rawControllerName = explode("/", $parsedUri["path"])[1];

        $obj = new stdClass();
        $obj->className = ucfirst($this->rawControllerName) . "Controller";
        $obj->fileName = $obj->className . ".php";

        return $obj;
    }

    public function getMethod()
    {
        if ($this->url === "/" . $this->rawControllerName) {
            return "index";
        }

        $explodedUrl = explode("/", $this->url);
        $lastPath = $explodedUrl[count($explodedUrl) - 1];

        return $lastPath;
    }

    public function getController()
    {
        $namespace = __NAMESPACE__ . "\\" . $this->controllerName->className;
        return new $namespace();
    }

    public function getUri(): string
    {
        return $this->url;
    }
}
