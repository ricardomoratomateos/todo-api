<?php
namespace TodoAPI\Application\Todos\ReadTodos;

use TodoAPI\Domain\Todos\ITodosRepository;

class ReadTodosHandler
{
    /** @var ITodosRepository $repository */
    private $repository;

    public function __construct(ITodosRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ReadTodosCommand $command): ReadTodosResponse
    {
        $todos = $this->repository->get();

        return new ReadTodosResponse($todos);
    }
}
