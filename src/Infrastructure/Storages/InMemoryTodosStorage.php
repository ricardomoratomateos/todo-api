<?php

namespace TodoAPI\Infrastructure\Storages;

use TodoAPI\Domain\Todos\TodosStorageInterface;

class InMemoryTodosStorage implements TodosStorageInterface
{
    private const TODOS = 'todos';

    public function __construct()
    {
        if (!isset($_SESSION[self::TODOS])) {
            $_SESSION[self::TODOS] = [];
        }
    }

    /**
     * {@inheritDoc}
     */
    public function insert(array $todos): int
    {
        foreach ($todos as $todo) {
            $todoAsArray = json_decode(json_encode($todo));

            $_SESSION[self::TODOS][$todo->getId()] = $todoAsArray;
            $_SESSION[self::TODOS][$todo->getName()] = $todoAsArray;
        }

        return count($todos);
    }

    /**
     * {@inheritDoc}
     */
    public function update(array $todos): int
    {
        foreach ($todos as $todo) {
            $todoAsArray = json_decode(json_encode($todo));
            $oldTodoName = $_SESSION[self::TODOS][$todo->getId()]['name'];

            unset($_SESSION[self::TODOS][$oldTodoName]);
            $_SESSION[self::TODOS][$todo->getName()] = $todoAsArray;
        }

        return count($todos);
    }

    /**
     * {@inheritDoc}
     */
    public function delete(array $todos): int
    {
        foreach ($todos as $todo) {
            unset($_SESSION[self::TODOS][$todo->getId()]);
            unset($_SESSION[self::TODOS][$todo->getName()]);
        }

        return count($todos);
    }
}
