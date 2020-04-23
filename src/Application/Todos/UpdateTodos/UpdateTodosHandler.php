<?php
namespace TodoAPI\Application\Todos\UpdateTodos;

use TodoAPI\Domain\Todos\ITodosStorage;

class UpdateTodosHandler
{
    /** @var ITodosStorage $storage */
    private $storage;

    public function __construct(ITodosStorage $storage)
    {
        $this->storage = $storage;
    }

    public function __invoke(UpdateTodosCommand $command): UpdateTodosResponse
    {
        $todos = $command->getTodos();
        $numberOfUpdatedTodos = $this->storage->update($todos);

        return new UpdateTodosResponse($numberOfUpdatedTodos);
    }
}
