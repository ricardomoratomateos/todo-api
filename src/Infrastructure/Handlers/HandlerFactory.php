<?php

namespace TodoAPI\Infrastructure\Handlers;

use TodoAPI\Application\Todos\AbstractWriterTodosHandler;
use TodoAPI\Application\Todos\CreateTodo\CreateTodoHandler;
use TodoAPI\Application\Todos\DeleteTodo\DeleteTodoHandler;
use TodoAPI\Application\Todos\ReadTodos\ReadTodosHandler;
use TodoAPI\Application\Todos\UpdateTodo\UpdateTodoHandler;
use TodoAPI\Domain\Todos\TodoServiceFactory;
use TodoAPI\Domain\Todos\TodosRepositoryInterface;
use TodoAPI\Domain\Todos\TodosStorageInterface;
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
                return $this->buildStorageHandler(CreateTodoHandler::class);
            case self::TODOS_UPDATER:
                return $this->buildStorageHandler(UpdateTodoHandler::class);
            case self::TODOS_DELETER:
                return $this->buildStorageHandler(DeleteTodoHandler::class);
            default:
                // TODO: Throw exception
                return;
        }
    }

    private function buildStorageHandler(string $class): AbstractWriterTodosHandler
    {
        /** @var TodosStorageInterface $storage */
        $storage = $this->storageFactory->make(StorageFactory::TODOS_STORAGE);
        /** @var TodosRepositoryInterface $repository */
        $repository = $this->repositoryFactory->make(RepositoryFactory::TODOS_REPOSITORY);
        
        $serviceFactory = new TodoServiceFactory(
            $repository,
            $storage
        );

        return new $class($serviceFactory);
    }
}
