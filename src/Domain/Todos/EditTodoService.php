<?php

namespace TodoAPI\Domain\Todos;

use TodoAPI\Domain\Todos\Validations\Exceptions\ExistsTodoWithSameNameException;
use TodoAPI\Domain\Todos\Validations\Exceptions\TodoDoesNotExistException;

class EditTodoService extends AbstractTodoService
{
    /**
     * @throws TodoDoesNotExistException
     * @throws ExistsTodoWithSameNameException
     */
    public function __invoke(int $id, string $name)
    {
        $todo = $this->repository->getById($id);
        if (!$todo) {
            throw new TodoDoesNotExistException();
        }

        $todo = $this->repository->getByName($name);
        if ($todo && $todo->getId() !== $id) {
            throw new ExistsTodoWithSameNameException();
        }

        $this->storage->update([new Todo($id, $name)]);
    }
}
