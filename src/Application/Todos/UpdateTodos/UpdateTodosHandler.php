<?php

namespace TodoAPI\Application\Todos\UpdateTodos;

use TodoAPI\Application\Todos\AbstractStorageTodosHandler;
use TodoAPI\Domain\Todos\Validations\ExistWithIDValidation;
use TodoAPI\Domain\Todos\Validations\ExistWithTheSameNameValidation;

class UpdateTodosHandler extends AbstractStorageTodosHandler
{
    public function __invoke(UpdateTodosCommand $command): UpdateTodosResponse
    {
        $todos = $command->getTodos();

        $validations = [
            $this->validationsBuilder->build(ExistWithTheSameNameValidation::class),
            $this->validationsBuilder->build(ExistWithIDValidation::class),
        ];

        foreach ($validations as $validation) {
            $validation($todos);
        }

        $numberOfUpdatedTodos = $this->storage->update($todos);

        return new UpdateTodosResponse($numberOfUpdatedTodos);
    }
}
