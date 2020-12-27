<?php

namespace TodoAPI\Infrastructure\Controllers\Todo;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use TodoAPI\Application\Todos\UpdateTodo\UpdateTodoCommand;
use TodoAPI\Infrastructure\Controllers\AbstractController;
use TodoAPI\Infrastructure\Handlers\HandlerFactory;

class UpdateTodoController extends AbstractController
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $body = $request->getParsedBody();
        $command = new UpdateTodoCommand($args['id'], $body['name']);

        $handler = $this->handlerFactory->make(HandlerFactory::TODOS_UPDATER);
        $handler($command);

        return $response->withStatus(204);
    }
}
