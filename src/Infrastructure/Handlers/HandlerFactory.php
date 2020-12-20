<?php

namespace TodoAPI\Infrastructure\Handlers;

use TodoAPI\Application\Todos\AbstractStorageTodosHandler;
use TodoAPI\Application\Todos\CreateTodos\CreateTodosHandler;
use TodoAPI\Application\Todos\DeleteTodos\DeleteTodosHandler;
use TodoAPI\Application\Todos\ReadTodos\ReadTodosHandler;
use TodoAPI\Application\Todos\UpdateTodos\UpdateTodosHandler;
use TodoAPI\Domain\Todos\TodosRepositoryInterface;
use TodoAPI\Domain\Todos\TodosStorageInterface;
use TodoAPI\Domain\Todos\Validations\TodosValidationsBuilder;
use TodoAPI\Domain\Todos\Validations\TodosValidatorRepositoryInterface;
use TodoAPI\Infrastructure\Repositories\RepositoryFactory;
use TodoAPI\Infrastructure\Storages\StorageFactory;

class HandlerFactory
{
    const TODOS_READER = 'todos-reader';
    const TODOS_CREATOR = 'todos-creator';
    const TODOS_UPDATER = 'todos-updater';
    const TODOS_DELETER = 'todos-deleter';

    /** @var RepositoryFactory $repositoryFactory */
    protected $repositoryFactory;

    /** @var StorageFactory $storageFactory */
    protected $storageFactory;

    public function __construct(
        RepositoryFactory $repositoryFactory,
        StorageFactory $storageFactory
    ) {
        $this->repositoryFactory = $repositoryFactory;
        $this->storageFactory = $storageFactory;
    }

    /**
     * @param string $handler
     * @return void // TODO Interface for all handlers
     */
    public function make(string $handler)
    {
        switch ($handler) {
            case self::TODOS_READER:
              /** @var TodosRepositoryInterface $repository */
                $repository = $this->repositoryFactory->make(RepositoryFactory::TODOS_REPOSITORY);
                return new ReadTodosHandler($repository);
            case self::TODOS_CREATOR:
                return $this->buildStorageHandler(CreateTodosHandler::class);
            case self::TODOS_UPDATER:
                return $this->buildStorageHandler(UpdateTodosHandler::class);
            case self::TODOS_DELETER:
                return $this->buildStorageHandler(DeleteTodosHandler::class);
            default:
                // TODO: Throw exception
                return;
        }
    }

    private function buildStorageHandler(string $class): AbstractStorageTodosHandler
    {
      /** @var TodosStorageInterface $storage */
        $storage = $this->storageFactory->make(StorageFactory::TODOS_STORAGE);
      /** @var TodosValidatorRepositoryInterface $validatorRepository */
        $validatorRepository = $this->repositoryFactory->make(RepositoryFactory::TODOS_VALIDATIONS_REPOSITORY);
        $validationsBuilder = new TodosValidationsBuilder($validatorRepository);

        return new $class($storage, $validationsBuilder);
    }
}
