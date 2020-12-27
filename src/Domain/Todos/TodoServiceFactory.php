<?php

namespace TodoAPI\Domain\Todos;

class TodoServiceFactory
{
    /** @var TodosRepositoryInterface $repository */
    protected $repository;

    /** @var TodosStorageInterface $storage */
    protected $storage;

    public function __construct(
        TodosRepositoryInterface $repository,
        TodosStorageInterface $storage
    ) {
        $this->repository = $repository;
        $this->storage = $storage;
    }

    public function make(string $class): AbstractTodoService
    {
        // TODO: Check if exists
        return new $class(
            $this->repository,
            $this->storage
        );
    }
}
