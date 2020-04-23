<?php
namespace TodoAPI\Tests\Unit\Application\Todos\ReadTodos;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TodoAPI\Application\Todos\ReadTodos\ReadTodosCommand;
use TodoAPI\Application\Todos\ReadTodos\ReadTodosHandler;
use TodoAPI\Application\Todos\ReadTodos\ReadTodosResponse;
use TodoAPI\Domain\Todos\ITodosRepository;

class ReadTodosHandlerTest extends TestCase
{
    public function testInvoke()
    {
        /** @var ITodosRepository|MockObject $repository */
        $repository = $this->createMock(ITodosRepository::class);
        $repository->method('get')->willReturn([]);
        /** @var ReadTodosCommand|MockObject $command */
        $command = $this->createMock(ReadTodosCommand::class);

        $handler = new ReadTodosHandler($repository);

        $this->assertInstanceOf(ReadTodosResponse::class, $handler($command));
    }
}
