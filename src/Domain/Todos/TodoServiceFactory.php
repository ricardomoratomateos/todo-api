<?php

namespace TodoAPI\Domain\Todos;

use TodoAPI\Domain\Todos\Validations\TodosValidationsBuilder;

class TodoServiceFactory
{
    /** @var TodosRepositoryInterface $repository */
    protected $repository;

    /** @var TodosStorageInterface $storage */
    protected $storage;

    /** @var TodosValidationsBuilder $validationsBuilder */
    protected $validationsBuilder;

    public function __construct(
        TodosRepositoryInterface $repository,
        TodosStorageInterface $storage,
        TodosValidationsBuilder $validationsBuilder
    ) {
        $this->repository = $repository;
        $this->storage = $storage;
        $this->validationsBuilder = $validationsBuilder;
    }

    public function make(string $class): AbstractTodoService
    {
        // TODO: Check if exists
        return new $class(
            $this->repository,
            $this->storage,
            $this->validationsBuilder
        );
    }
}
