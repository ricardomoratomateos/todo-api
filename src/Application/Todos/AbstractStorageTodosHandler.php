<?php
namespace TodoAPI\Application\Todos;

use TodoAPI\Domain\Todos\ITodosStorage;
use TodoAPI\Domain\Todos\Validations\TodosValidationsBuilder;

abstract class AbstractStorageTodosHandler
{
    /** @var ITodosStorage $storage */
    protected $storage;

    /** @var TodosValidationsBuilder $validationsBuilder */
    protected $validationsBuilder;

    public function __construct(
        ITodosStorage $storage,
        TodosValidationsBuilder $validationsBuilder
    ) {
        $this->storage = $storage;
        $this->validationsBuilder = $validationsBuilder;
    }
}
