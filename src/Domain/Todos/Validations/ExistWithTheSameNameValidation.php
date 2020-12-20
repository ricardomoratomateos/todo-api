<?php

namespace TodoAPI\Domain\Todos\Validations;

use TodoAPI\Domain\Todos\Todo;
use TodoAPI\Domain\Todos\Validations\Exceptions\ExistsTodoWithSameNameException;

class ExistWithTheSameNameValidation extends AbstractTodosValidation
{
    public function __invoke(array $todos): void
    {
        $names = array_map(function ($todo) {
            /** @var Todo $todo */
            return $todo->getName();
        }, $todos);

        $todos = $this->repository->getByNames($names);

        if (!empty($todos)) {
            throw new ExistsTodoWithSameNameException();
        }
    }
}
