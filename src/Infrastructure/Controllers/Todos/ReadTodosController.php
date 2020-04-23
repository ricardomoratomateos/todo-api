<?php
namespace TodoAPI\Infrastructure\Controllers\Todos;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use TodoAPI\Application\Todos\ReadTodos\ReadTodosCommand;
use TodoAPI\Infrastructure\Controllers\AbstractController;
use TodoAPI\Infrastructure\Handlers\HandlerFactory;

class ReadTodosController extends AbstractController
{
    const HANDLER = HandlerFactory::TODOS_READER;

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $command = new ReadTodosCommand();

        $handler = $this->handler;
        $handlerResponse = $handler($command);

        return $response->withStatus(200)->withJson($handlerResponse->getTodos());
    }
}
