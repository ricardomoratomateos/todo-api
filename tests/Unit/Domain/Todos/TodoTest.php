<?php
namespace TodoAPI\Tests\Unit\Domain\Todos;

use PHPUnit\Framework\TestCase;
use TodoAPI\Domain\Todos\Todo;

class TodoTest extends TestCase
{
    public function testAllOptionalValuesNull()
    {
        $todo = new Todo();

        $this->assertNull($todo->getId());
        $this->assertNull($todo->getName());
    }

    public function testAllOptionalValuesFilled()
    {
        $id = 1;
        $name = 'name';

        $todo = new Todo($id, $name);

        $this->assertSame($id, $todo->getId());
        $this->assertSame($name, $todo->getName());
    }
}
