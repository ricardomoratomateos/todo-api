<?php

namespace TodoAPI\Application\Todos\CreateTodos;

use TodoAPI\Application\Todos\AbstractStorageTodosHandler;
use TodoAPI\Domain\Todos\Validations\ExistWithTheSameNameValidation;

class CreateTodosHandler extends AbstractStorageTodosHandler
{
    public function __invoke(CreateTodosCommand $command): CreateTodosResponse
    {
        $todos = $command->getTodos();

        $validations = [
            $this->validationsBuilder->build(ExistWithTheSameNameValidation::class),
        ];

        foreach ($validations as $validation) {
            $validation($todos);
        }

        $numberOfCreatedTodos = $this->storage->insert($todos);

        return new CreateTodosResponse($numberOfCreatedTodos);
    }
}
