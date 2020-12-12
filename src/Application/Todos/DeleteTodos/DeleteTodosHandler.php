<?php
namespace TodoAPI\Application\Todos\DeleteTodos;

use TodoAPI\Application\Todos\AbstractStorageTodosHandler;

class DeleteTodosHandler extends AbstractStorageTodosHandler
{
    public function __invoke(DeleteTodosCommand $command): DeleteTodosResponse
    {
        $todos = $command->getTodos();
        $numberOfDeletedTodos = $this->storage->delete($todos);

        return new DeleteTodosResponse($numberOfDeletedTodos);
    }
}
