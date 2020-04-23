<?php
namespace TodoAPI\Tests\Unit\Application\Todos\ReadTodos;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TodoAPI\Application\Todos\ReadTodos\ReadTodosResponse;
use TodoAPI\Domain\Todos\Todo;

class ReadTodosResponseTest extends TestCase
{
    public function testGetTodosMethod()
    {
        /** @var Todo|MockObject $todo */
        $todo = $this->createMock(Todo::class);
        $todos = [$todo, $todo];

        $response = new ReadTodosResponse($todos);

        $this->assertSame($todos, $response->getTodos());
    }
}
