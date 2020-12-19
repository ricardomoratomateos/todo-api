<?php
namespace TodoAPI\Domain\Todos;

interface TodosRepositoryInterface
{
    /**
     * @return Todo[]
     */
    public function get(): array;
}
