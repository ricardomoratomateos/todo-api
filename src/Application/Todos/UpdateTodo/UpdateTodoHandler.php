<?php

namespace TodoAPI\Application\Todos\UpdateTodo;

use TodoAPI\Application\Todos\AbstractWriterTodosHandler;
use TodoAPI\Domain\Todos\EditTodoService;

class UpdateTodoHandler extends AbstractWriterTodosHandler
{
    public function __invoke(UpdateTodoCommand $command): UpdateTodoResponse
    {
        /** @var EditTodoService $service */
        $service = $this->serviceFactory->make(EditTodoService::class);

        $service(
            $command->getId(),
            $command->getName()
        );

        return new UpdateTodoResponse(true);
    }
}
