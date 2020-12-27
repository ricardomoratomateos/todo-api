<?php

namespace TodoAPI\Domain\Todos;

abstract class AbstractTodoService
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
}
