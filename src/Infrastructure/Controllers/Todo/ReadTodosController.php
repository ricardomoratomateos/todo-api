<?php

namespace TodoAPI\Infrastructure\Controllers\Todo;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use TodoAPI\Application\Todos\ReadTodos\ReadTodosQuery;
use TodoAPI\Infrastructure\Controllers\AbstractController;
use TodoAPI\Infrastructure\Handlers\HandlerFactory;

class ReadTodosController extends AbstractController
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $command = new ReadTodosQuery();

        $handler = $this->handlerFactory->make(HandlerFactory::TODOS_READER);
        $handlerResponse = $handler($command);

        return $response->withStatus(200)->withJson($handlerResponse->getTodos());
    }
}
