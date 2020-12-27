<?php

namespace TodoAPI\Application\Todos\UpdateTodo;

class UpdateTodoResponse
{
    /** @var bool $wasUpdated */
    private $wasUpdated;

    public function __construct(bool $wasUpdated)
    {
        $this->wasUpdated = $wasUpdated;
    }

    public function wasUpdated(): bool
    {
        return $this->wasUpdated;
    }
}
