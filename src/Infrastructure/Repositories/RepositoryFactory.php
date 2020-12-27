<?php

namespace TodoAPI\Infrastructure\Repositories;

use Doctrine\DBAL\Connection;

class RepositoryFactory
{
    const TODOS_REPOSITORY = 'todos-repository';
    const TODOS_VALIDATIONS_REPOSITORY = 'todos-validations-repository';

    /** @var Connection $connection */
    protected $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param string $repository
     * @return void // TODO Interface for all repositories
     */
    public function make(string $repository)
    {
        switch ($repository) {
            case self::TODOS_REPOSITORY:
                return new MySQLTodosRepository($this->connection);
            default:
                // TODO: Throw exception
                return;
        }
    }
}
