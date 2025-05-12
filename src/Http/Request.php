<?php

namespace LayerPHP\Http;

class Request
{
	private string $uri;
	private string $method;

	public function __construct(private $server)
	{
		$this->uri = $server['REQUEST_URI'];
		$this->method = $server['REQUEST_METHOD'];
	}

	public function getUri(): string
	{
		return $this->uri;
	}

	public function getMethod(): string
	{
		return $this->method;
	}
}
