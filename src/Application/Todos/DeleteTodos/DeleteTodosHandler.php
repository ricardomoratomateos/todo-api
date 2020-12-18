<?php
namespace TodoAPI\Application\Todos\DeleteTodos;

use TodoAPI\Application\Todos\AbstractStorageTodosHandler;
use TodoAPI\Domain\Todos\Validations\ExistWithIDValidation;

class DeleteTodosHandler extends AbstractStorageTodosHandler
{
    public function __invoke(DeleteTodosCommand $command): DeleteTodosResponse
    {
        $todos = $command->getTodos();

        $validations = [
            $this->validationsBuilder->build(ExistWithIDValidation::class),
        ];

        foreach ($validations as $validation) {
           $validation($todos);
        }

        $numberOfDeletedTodos = $this->storage->delete($todos);

        return new DeleteTodosResponse($numberOfDeletedTodos);
    }
}
