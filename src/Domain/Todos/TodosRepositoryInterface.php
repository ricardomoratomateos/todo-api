<?php

namespace TodoAPI\Domain\Todos;

interface TodosRepositoryInterface
{
    /**
     * @return Todo[]
     */
    public function get(): array;

    /**
     * @return Todo
     */
    public function getById(int $id): ?Todo;

    /**
     * @return Todo
     */
    public function getByName(string $name): ?Todo;
}
