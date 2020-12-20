<?php

namespace TodoAPI\Application\Todos\UpdateTodos;

use TodoAPI\Domain\Todos\Todo;

class UpdateTodosCommand
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
