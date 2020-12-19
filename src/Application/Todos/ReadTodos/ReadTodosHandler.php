<?php
namespace TodoAPI\Application\Todos\ReadTodos;

use TodoAPI\Domain\Todos\TodosRepositoryInterface;

class ReadTodosHandler
{
    /** @var TodosRepositoryInterface $repository */
    private $repository;

    public function __construct(TodosRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ReadTodosQuery $command): ReadTodosResponse
    {
        $todos = $this->repository->get();

        return new ReadTodosResponse($todos);
    }
}
