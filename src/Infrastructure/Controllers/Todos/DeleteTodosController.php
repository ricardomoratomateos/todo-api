<?php
namespace TodoAPI\Infrastructure\Controllers\Todos;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use TodoAPI\Application\Todos\DeleteTodos\DeleteTodosCommand;
use TodoAPI\Domain\Todos\Todo;
use TodoAPI\Infrastructure\Controllers\AbstractController;
use TodoAPI\Infrastructure\Handlers\HandlerFactory;

class DeleteTodosController extends AbstractController
{
    const HANDLER = HandlerFactory::TODOS_DELETER;

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $todoId = $args['id'];

        $todo = new Todo($todoId);
        $command = new DeleteTodosCommand([$todo]);

        $handler = $this->handler;
        $handler($command);

        return $response->withStatus(204);
    }
}
