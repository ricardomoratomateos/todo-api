<?php

namespace TodoAPI\Application\Todos;

use TodoAPI\Domain\Todos\TodosStorageInterface;
use TodoAPI\Domain\Todos\Validations\TodosValidationsBuilder;

abstract class AbstractStorageTodosHandler
{
    /** @var TodosStorageInterface $storage */
    protected $storage;

    /** @var TodosValidationsBuilder $validationsBuilder */
    protected $validationsBuilder;

    public function __construct(
        TodosStorageInterface $storage,
        TodosValidationsBuilder $validationsBuilder
    ) {
        $this->storage = $storage;
        $this->validationsBuilder = $validationsBuilder;
    }
}
