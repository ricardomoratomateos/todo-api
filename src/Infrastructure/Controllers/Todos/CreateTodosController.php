<?php

namespace TodoAPI\Infrastructure\Controllers\Todos;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use TodoAPI\Application\Todos\CreateTodo\CreateTodoCommand;
use TodoAPI\Infrastructure\Controllers\AbstractController;
use TodoAPI\Infrastructure\Handlers\HandlerFactory;

class CreateTodosController extends AbstractController
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $body = $request->getParsedBody();

        $command = new CreateTodoCommand($body['name']);

        $handler = $this->handlerFactory->make(HandlerFactory::TODOS_CREATOR);
        $handler($command);

        return $response->withStatus(201);
    }
}
