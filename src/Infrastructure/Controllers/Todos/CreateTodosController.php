<?php

namespace TodoAPI\Infrastructure\Controllers\Todos;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use TodoAPI\Application\Todos\CreateTodos\CreateTodosCommand;
use TodoAPI\Domain\Todos\Todo;
use TodoAPI\Infrastructure\Controllers\AbstractController;
use TodoAPI\Infrastructure\Handlers\HandlerFactory;

class CreateTodosController extends AbstractController
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $body = $request->getParsedBody();

        $todo = new Todo(null, $body['name']);
        $command = new CreateTodosCommand([$todo]);

        $handler = $this->handlerFactory->make(HandlerFactory::TODOS_CREATOR);
        $handler($command);

        return $response->withStatus(201);
    }
}
