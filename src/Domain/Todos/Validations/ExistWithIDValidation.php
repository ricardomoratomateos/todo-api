<?php
namespace TodoAPI\Domain\Todos\Validations;

use TodoAPI\Domain\Todos\Todo;
use TodoAPI\Domain\Todos\Validations\Exceptions\TodoDoesNotExistException;

class ExistWithIDValidation extends AbstractTodosValidation
{
    public function __invoke(array $todos): void
    {
        $ids = array_map(function ($todo) {
            /** @var Todo $todo */
            return $todo->getId();
        }, $todos);

        $savedTodos = $this->repository->getByIDs($ids);

        if (count($todos) !== count($savedTodos)) {
            throw new TodoDoesNotExistException();
        }
    }
}
