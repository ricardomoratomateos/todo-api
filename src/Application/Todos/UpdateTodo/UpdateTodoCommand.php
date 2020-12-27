<?php

namespace TodoAPI\Application\Todos\UpdateTodo;

class UpdateTodoCommand
{
    private $id;

    private $name;

    /**
     * @param Todo[] $todos
     */
    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
