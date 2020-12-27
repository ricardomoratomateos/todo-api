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

    /** @var TodosRepositoryInterface $repository */
    private $repository;

    public function __construct(
        Connection $connection,
        TodosRepositoryInterface $repository = null
    ) {
        $this->connection = $connection;
        $this->repository = $repository;
    }

    /**
     * {@inheritDoc}
     */
    public function get(): array
    {
        if ($this->repository && $this->repository->get()) {
            return $this->repository->get();
        }

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
        if ($this->repository && $this->repository->getById($id)) {
            return $this->repository->getById($id);
        }

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
        if ($this->repository && $this->repository->getByName($name)) {
            return $this->repository->getByName($name);
        }

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
