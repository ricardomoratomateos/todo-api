<?php

namespace TodoAPI\Application\Todos\DeleteTodo;

class DeleteTodoResponse
{
    /** @var bool $wasDeleted */
    private $wasDeleted;

    public function __construct(bool $wasDeleted)
    {
        $this->wasDeleted = $wasDeleted;
    }

    public function wasDeleted(): bool
    {
        return $this->wasDeleted;
    }
}
