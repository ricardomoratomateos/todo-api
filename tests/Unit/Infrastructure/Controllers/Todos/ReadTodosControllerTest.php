<?php
namespace TodoAPI\Tests\Unit\Infrastructure\Controllers\Todos;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Http\Response;
use TodoAPI\Domain\Todos\ITodosRepository;
use TodoAPI\Domain\Todos\Todo;
use TodoAPI\Infrastructure\Controllers\Todos\ReadTodosController;
use TodoAPI\Infrastructure\Repositories\RepositoryFactory;

class ReadTodosControllerTest extends TestCase
{
    public function testInvokeMethod()
    {
        /** @var Todo|MockObject $todo */
        $todo = $this->createMock(Todo::class);
        $todos = [$todo, $todo];
        /** @var ITodosRepository|MockObject $repository */
        $repository = $this->createMock(ITodosRepository::class);
        $repository->method('get')->willReturn($todos);
        /** @var RepositoryFactory|MockObject $factory */
        $factory = $this->createMock(RepositoryFactory::class);
        $factory->method('make')->willReturn($repository);
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
