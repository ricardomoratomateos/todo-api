<?php

namespace TodoAPI\Domain\Todos;

use TodoAPI\Domain\EventHandler;
use TodoAPI\Domain\Todos\Validations\Exceptions\TodoDoesNotExistException;

class RemoveTodoService extends AbstractTodoService
{
    /**
     * @throws TodoDoesNotExistException
     */
    public function __invoke(int $id)
    {
        $todo = $this->repository->getById($id);
        if (!$todo) {
            throw new TodoDoesNotExistException();
        }

        $this->storage->delete([$todo]);

        EventHandler::handle(new TodoWasDeleted);
    }
}
