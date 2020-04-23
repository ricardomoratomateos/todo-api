<?php
namespace TodoAPI\Application\Todos\DeleteTodos;

use TodoAPI\Domain\Todos\ITodosStorage;

class DeleteTodosHandler
{
    /** @var ITodosStorage $storage */
    private $storage;

    public function __construct(ITodosStorage $storage)
    {
        $this->storage = $storage;
    }

    public function __invoke(DeleteTodosCommand $command): DeleteTodosResponse
    {
        $todos = $command->getTodos();
        $numberOfDeletedTodos = $this->storage->delete($todos);

        return new DeleteTodosResponse($numberOfDeletedTodos);
    }
}
