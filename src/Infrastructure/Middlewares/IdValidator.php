<?php
namespace TodoAPI\Infrastructure\Middlewares;

use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

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
            throw new InvalidArgumentException("'id' param is required");
        }
        if (!is_numeric($id)) {
            throw new InvalidArgumentException("'id' param should be an integer");
        }

        return $next($request, $response);
    }
}
