<?php

namespace TodoAPI\Infrastructure\Repositories;

use Doctrine\DBAL\Connection;
use PDO;
use TodoAPI\Domain\Todos\TodosRepositoryInterface;
use TodoAPI\Domain\Todos\Todo;

class MySQLTodosRepository implements TodosRepositoryInterface
{
    /** @var Connection $connection */
    protected $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * {@inheritDoc}
     */
    public function get(): array
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder
            ->select('id', 'name')
            ->from('todos');

        $results = $queryBuilder
            ->execute()
            ->fetchAll();

        return array_map(function ($todo) {
            return new Todo(
                $todo['id'],
                $todo['name']
            );
        }, $results);
    }

    /**
     * {@inheritDoc}
     */
    public function getById(int $id): ?Todo
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder
            ->select('id', 'name')
            ->from('todos')
            ->where('id = :id')
            ->setParameter(
                'id',
                $id,
                PDO::PARAM_INT
            );

        $results = $queryBuilder
            ->execute()
            ->fetch();

        if (empty($results)) {
            return null;
        }

        return new Todo(
            $results['id'],
            $results['name']
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getByName(string $name): ?Todo
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder
            ->select('id', 'name')
            ->from('todos')
            ->where('name = :name')
            ->setParameter(
                'name',
                $name,
                PDO::PARAM_STR
            );

        $results = $queryBuilder
            ->execute()
            ->fetch();

        if (empty($results)) {
            return null;
        }

        return new Todo(
            $results['id'],
            $results['name']
        );
    }
}
