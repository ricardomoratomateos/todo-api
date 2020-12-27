<?php

namespace TodoAPI\Application\Todos\CreateTodo;

use TodoAPI\Application\Todos\AbstractWriterTodosHandler;
use TodoAPI\Domain\Todos\SaveTodoService;

class CreateTodoHandler extends AbstractWriterTodosHandler
{
    public function __invoke(CreateTodoCommand $command): CreateTodoResponse
    {
        /** @var SaveTodoService $service */
        $service = $this->serviceFactory->make(SaveTodoService::class);

        $service($command->getName());

        return new CreateTodoResponse(true);
    }
}
