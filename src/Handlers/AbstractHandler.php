<?php

namespace Layerphp\Framework\Handlers;

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
