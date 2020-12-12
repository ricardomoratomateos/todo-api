<?php
namespace TodoAPI\Application\Todos\UpdateTodos;

use TodoAPI\Application\Todos\AbstractStorageTodosHandler;

class UpdateTodosHandler extends AbstractStorageTodosHandler
{
    public function __invoke(UpdateTodosCommand $command): UpdateTodosResponse
    {
        $todos = $command->getTodos();
        $numberOfUpdatedTodos = $this->storage->update($todos);

        return new UpdateTodosResponse($numberOfUpdatedTodos);
    }
}
