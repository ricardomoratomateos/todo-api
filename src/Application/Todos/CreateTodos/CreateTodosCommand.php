<?php

namespace TodoAPI\Application\Todos\CreateTodos;

use TodoAPI\Domain\Todos\Todo;

class CreateTodosCommand
{
    /** @var Todo[] $todos */
    private $todos;

    /**
     * @param Todo[] $todos
     */
    public function __construct(array $todos)
    {
        $this->todos = $todos;
    }

    /**
     * @return Todo[]
     */
    public function getTodos(): array
    {
        return $this->todos;
    }
}
