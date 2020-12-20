<?php

namespace TodoAPI\Infrastructure\Controllers\Todos;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use TodoAPI\Application\Todos\UpdateTodos\UpdateTodosCommand;
use TodoAPI\Domain\Todos\Todo;
use TodoAPI\Infrastructure\Controllers\AbstractController;
use TodoAPI\Infrastructure\Handlers\HandlerFactory;

class UpdateTodosController extends AbstractController
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $body = $request->getParsedBody();

        $todo = new Todo($args['id'], $body['name']);
        $command = new UpdateTodosCommand([$todo]);

        $handler = $this->handlerFactory->make(HandlerFactory::TODOS_UPDATER);
        $handler($command);

        return $response->withStatus(204);
    }
}
