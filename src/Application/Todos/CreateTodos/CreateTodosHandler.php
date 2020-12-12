<?php
namespace TodoAPI\Application\Todos\CreateTodos;

use TodoAPI\Application\Todos\AbstractStorageTodosHandler;

class CreateTodosHandler extends AbstractStorageTodosHandler
{
    public function __invoke(CreateTodosCommand $command): CreateTodosResponse
    {
        $todos = $command->getTodos();
        $numberOfCreatedTodos = $this->storage->insert($todos);

        return new CreateTodosResponse($numberOfCreatedTodos);
    }
}
