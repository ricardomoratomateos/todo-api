<?php

namespace TodoAPI\Application\Todos\CreateTodo;

class CreateTodoResponse
{
    /** @var int $numberOfCreatedTodos */
    private $numberOfCreatedTodos;

    /**
     * @param int $numberOfCreatedTodos
     */
    public function __construct(int $numberOfCreatedTodos)
    {
        $this->numberOfCreatedTodos = $numberOfCreatedTodos;
    }

    public function numberOfCreatedTodos(): int
    {
        return $this->numberOfCreatedTodos;
    }
}
