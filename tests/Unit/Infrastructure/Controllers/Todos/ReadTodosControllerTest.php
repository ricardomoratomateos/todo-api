<?php
namespace TodoAPI\Tests\Unit\Infrastructure\Controllers\Todos;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Http\Response;
use TodoAPI\Application\Todos\CreateTodos\CreateTodosHandler;
use TodoAPI\Application\Todos\CreateTodos\CreateTodosResponse;
use TodoAPI\Application\Todos\ReadTodos\ReadTodosHandler;
use TodoAPI\Application\Todos\ReadTodos\ReadTodosResponse;
use TodoAPI\Domain\Todos\ITodosRepository;
use TodoAPI\Domain\Todos\Todo;
use TodoAPI\Infrastructure\Controllers\Todos\ReadTodosController;
use TodoAPI\Infrastructure\Handlers\HandlerFactory;
use TodoAPI\Infrastructure\Repositories\RepositoryFactory;

class ReadTodosControllerTest extends TestCase
{
    public function testInvokeMethod()
    {
        /** @var Todo|MockObject $todo */
        $todo = $this->createMock(Todo::class);
        $todos = [$todo, $todo];
        /** @var CreateTodosResponse|MockObject $response */
        $response = $this->createMock(ReadTodosResponse::class);
        $response->method('getTodos')->willReturn($todos);
        $handler = $this->createMock(ReadTodosHandler::class);
        /** @var HandlerFactory|MockObject $factory */
        $factory = $this->createMock(HandlerFactory::class);
        $factory->method('make')->willReturn($handler);
        /** @var ContainerInterface|MockObject $container */
        $container = $this->createMock(ContainerInterface::class);
        $container->method('get')->willReturn($factory);

        /** @var ServerRequestInterface|MockObject $request */
        $request = $this->createMock(ServerRequestInterface::class);
        /** @var ResponseInterface|MockObject $response */
        $response = $this->createMock(Response::class);
        $response->method('withStatus')->willReturn($response);
        $response->method('withJson')->willReturn($response);

        $controller = new ReadTodosController($container);

        $this->assertSame($response, $controller($request, $response, []));
    }
}
