<?php

namespace TodoAPI\Infrastructure\Repositories;

use TodoAPI\Domain\Todos\TodosRepositoryInterface;
use TodoAPI\Domain\Todos\Todo;

class InMemoryTodosRepository implements TodosRepositoryInterface
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
    public function get(): array
    {
        return array_map(function ($todo) {
            return new Todo(
                $todo['id'],
                $todo['name']
            );
        }, $_SESSION[self::TODOS]);
    }

    /**
     * {@inheritDoc}
     */
    public function getById(int $id): ?Todo
    {
        if (!isset($_SESSION[self::TODOS][$id])) {
            return null;
        }

        $results = $_SESSION[self::TODOS][$id];

        return new Todo(
            $results['id'],
            $results['name']
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getByName(string $name): ?Todo
    {
        if (!isset($_SESSION[self::TODOS][$name])) {
            return null;
        }

        $results = $_SESSION[self::TODOS][$name];

        return new Todo(
            $results['id'],
            $results['name']
        );
    }
}
