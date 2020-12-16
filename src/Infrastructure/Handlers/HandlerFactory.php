<?php
namespace TodoAPI\Infrastructure\Handlers;

use TodoAPI\Application\Todos\CreateTodos\CreateTodosHandler;
use TodoAPI\Application\Todos\DeleteTodos\DeleteTodosHandler;
use TodoAPI\Application\Todos\ReadTodos\ReadTodosHandler;
use TodoAPI\Application\Todos\UpdateTodos\UpdateTodosHandler;
use TodoAPI\Domain\Todos\ITodosRepository;
use TodoAPI\Domain\Todos\ITodosStorage;
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
              /** @var ITodosRepository $repository */
                $repository = $this->repositoryFactory->make(RepositoryFactory::TODOS_REPOSITORY);
                return new ReadTodosHandler($repository);
            case self::TODOS_CREATOR:
                /** @var ITodosStorage $storage */
                $storage = $this->storageFactory->make(StorageFactory::TODOS_STORAGE);
                return new CreateTodosHandler($storage);
            case self::TODOS_UPDATER:
              /** @var ITodosStorage $storage */
                $storage = $this->storageFactory->make(StorageFactory::TODOS_STORAGE);
                return new UpdateTodosHandler($storage);
            case self::TODOS_DELETER:
              /** @var ITodosStorage $storage */
                $storage = $this->storageFactory->make(StorageFactory::TODOS_STORAGE);
                return new DeleteTodosHandler($storage);
            default:
                // TODO: Throw exception
                return;
        }
    }
}
