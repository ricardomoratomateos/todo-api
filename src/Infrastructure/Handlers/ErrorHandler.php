<?php

namespace TodoAPI\Infrastructure\Handlers;

use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;
use TodoAPI\Domain\LogicException;

class ErrorHandler
{
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        Throwable $exception
    ): ResponseInterface {
        if (get_class($exception) === InvalidArgumentException::class) {
            return $response
                ->withStatus(400)
                ->withHeader('Content-Type', 'text/html')
                ->withJson(['error' => $exception->getMessage()]);
        } elseif (get_parent_class($exception) === LogicException::class) {
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