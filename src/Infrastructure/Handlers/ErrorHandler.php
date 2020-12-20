<?php

namespace TodoAPI\Infrastructure\Handlers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;
use TodoAPI\Domain\LogicException;
use TodoAPI\Infrastructure\Middlewares\Exceptions\InvalidArgumentException;

class ErrorHandler
{
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        Throwable $exception
    ): ResponseInterface {
        $class = get_parent_class($exception);
        if (
            $class === InvalidArgumentException::class ||
            $class === LogicException::class
        ) {
            return $response
                ->withStatus(400)
                ->withHeader('Content-Type', 'text/html')
                ->withJson($exception);
        }

        return $response
            ->withStatus(500)
            ->withHeader('Content-Type', 'text/html');
    }
}
