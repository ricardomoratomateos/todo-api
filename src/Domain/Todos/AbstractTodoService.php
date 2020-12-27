<?php

namespace TodoAPI\Domain\Todos;

use TodoAPI\Domain\Todos\Validations\TodosValidationsBuilder;

abstract class AbstractTodoService
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
}
