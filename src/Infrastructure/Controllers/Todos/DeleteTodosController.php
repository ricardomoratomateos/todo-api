<?php

namespace TodoAPI\Infrastructure\Controllers\Todos;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use TodoAPI\Application\Todos\DeleteTodo\DeleteTodoCommand;
use TodoAPI\Infrastructure\Controllers\AbstractController;
use TodoAPI\Infrastructure\Handlers\HandlerFactory;

class DeleteTodosController extends AbstractController
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $command = new DeleteTodoCommand($args['id']);

        $handler = $this->handlerFactory->make(HandlerFactory::TODOS_DELETER);
        $handler($command);

        return $response->withStatus(204);
    }
}
