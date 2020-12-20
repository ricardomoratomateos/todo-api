<?php

namespace TodoAPI\Infrastructure\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class HealthController
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        return $response->withStatus(200);
    }
}
