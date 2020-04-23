<?php
namespace TodoAPI\Application\Todos\DeleteTodos;

class DeleteTodosResponse
{
    /** @var int $numberOfDeletedTodos */
    private $numberOfDeletedTodos;

    /**
     * @param int $numberOfDeletedTodos
     */
    public function __construct(int $numberOfDeletedTodos)
    {
        $this->numberOfDeletedTodos = $numberOfDeletedTodos;
    }

    public function numberOfDeletedTodos(): int
    {
        return $this->numberOfDeletedTodos;
    }
}
