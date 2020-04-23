<?php
namespace TodoAPI\Application\Todos\CreateTodos;

use TodoAPI\Domain\Todos\ITodosStorage;

class CreateTodosHandler
{
    /** @var ITodosStorage $storage */
    private $storage;

    public function __construct(ITodosStorage $storage)
    {
        $this->storage = $storage;
    }

    public function __invoke(CreateTodosCommand $command): CreateTodosResponse
    {
        $todos = $command->getTodos();
        $numberOfCreatedTodos = $this->storage->insert($todos);

        return new CreateTodosResponse($numberOfCreatedTodos);
    }
}
