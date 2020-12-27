<?php

namespace TodoAPI\Application\Todos\DeleteTodo;

use TodoAPI\Application\Todos\AbstractWriterTodosHandler;
use TodoAPI\Domain\Todos\RemoveTodoService;

class DeleteTodoHandler extends AbstractWriterTodosHandler
{
    public function __invoke(DeleteTodoCommand $command): DeleteTodoResponse
    {
        /** @var RemoveTodoService $service */
        $service = $this->serviceFactory->make(RemoveTodoService::class);

        $service($command->getId());

        return new DeleteTodoResponse(1);
    }
}
