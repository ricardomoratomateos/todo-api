<?php

namespace TodoAPI\Infrastructure\Middlewares;

use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TodoAPI\Infrastructure\Middlewares\Exceptions\IdIsRequiredException;
use TodoAPI\Infrastructure\Middlewares\Exceptions\IdShouldBeAnIntegerException;

class IdValidator
{
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $next
    ): ResponseInterface {
        $route = $request->getAttribute('route');
        $id = $route->getArgument('id');

        if (!isset($id)) {
            throw new IdIsRequiredException();
        }
        if (!is_numeric($id)) {
            throw new IdShouldBeAnIntegerException();
        }

        return $next($request, $response);
    }
}
