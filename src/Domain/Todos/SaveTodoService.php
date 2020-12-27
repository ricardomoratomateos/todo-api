<?php

namespace TodoAPI\Domain\Todos;

use TodoAPI\Domain\EventHandler;
use TodoAPI\Domain\Todos\Validations\Exceptions\ExistsTodoWithSameNameException;

class SaveTodoService extends AbstractTodoService
{
    /**
     * @throws ExistsTodoWithSameNameException
     */
    public function __invoke(string $name)
    {
        $todo = $this->repository->getByName($name);
        if ($todo) {
            throw new ExistsTodoWithSameNameException();
        }

        $this->storage->insert([new Todo(null, $name)]);

        EventHandler::handle(new TodoWasCreated());
    }
}
