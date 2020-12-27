<?php

namespace TodoAPI\Infrastructure\Storages;

use Doctrine\DBAL\Connection;

class StorageFactory
{
    const TODOS_STORAGE = 'todos-storage';

    /** @var Connection $connection */
    protected $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param string $storage
     * @return void // TODO Interface for all storages
     */
    public function make(string $storage)
    {
        switch ($storage) {
            case self::TODOS_STORAGE:
                return new MySQLTodosStorage(
                    $this->connection,
                    new InMemoryTodosStorage()
                );
            default:
                // TODO: Throw exception
                return;
        }
    }
}
