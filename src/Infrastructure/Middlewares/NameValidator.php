<?php

namespace TodoAPI\Infrastructure\Middlewares;

use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TodoAPI\Infrastructure\Middlewares\Exceptions\NameIsRequiredException;

class NameValidator
{
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $next
    ): ResponseInterface {
        $body = $request->getParsedBody();
        if (!isset($body['name'])) {
            throw new NameIsRequiredException();
        }

        return $next($request, $response);
    }
}
