<?php
namespace TodoAPI\Tests\Unit\Application\Todos\ReadTodos;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TodoAPI\Application\Todos\ReadTodos\ReadTodosQuery;
use TodoAPI\Application\Todos\ReadTodos\ReadTodosHandler;
use TodoAPI\Application\Todos\ReadTodos\ReadTodosResponse;
use TodoAPI\Domain\Todos\TodosRepositoryInterface;

class ReadTodosHandlerTest extends TestCase
{
    public function testInvoke()
    {
        /** @var TodosRepositoryInterface|MockObject $repository */
        $repository = $this->createMock(TodosRepositoryInterface::class);
        $repository->method('get')->willReturn([]);
        /** @var ReadTodosQuery|MockObject $command */
        $command = $this->createMock(ReadTodosQuery::class);

        $handler = new ReadTodosHandler($repository);

        $this->assertInstanceOf(ReadTodosResponse::class, $handler($command));
    }
}
