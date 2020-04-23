<?php
namespace TodoAPI\Domain\Todos;

interface ITodosStorage
{
    /**
     * @param Todo[] $todos
     * @return int
     */
    public function insert(array $todos): int;

    /**
     * @param Todo[] $todos
     * @return int
     */
    public function update(array $todos): int;

    /**
     * @param Todo[] $todos
     * @return int
     */
    public function delete(array $todos): int;
}
