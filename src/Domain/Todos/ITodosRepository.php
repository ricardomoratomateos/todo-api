<?php
namespace TodoAPI\Domain\Todos;

interface ITodosRepository
{
    /**
     * @return Todo[]
     */
    public function get(): array;
}
