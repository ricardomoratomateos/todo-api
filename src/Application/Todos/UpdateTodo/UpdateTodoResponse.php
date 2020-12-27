<?php

namespace TodoAPI\Application\Todos\UpdateTodo;

class UpdateTodoResponse
{
    /** @var int $numberOfUpdatedTodos */
    private $numberOfUpdatedTodos;

    /**
     * @param int $numberOfUpdatedTodos
     */
    public function __construct(int $numberOfUpdatedTodos)
    {
        $this->numberOfUpdatedTodos = $numberOfUpdatedTodos;
    }

    public function numberOfUpdatedTodos(): int
    {
        return $this->numberOfUpdatedTodos;
    }
}
