<?php

namespace TodoAPI\Infrastructure\Storages;

use Doctrine\DBAL\Connection;
use TodoAPI\Domain\Todos\TodosStorageInterface;

class MySQLTodosStorage implements TodosStorageInterface
{
    /** @var Connection $connection */
    private $connection;

    /** @var TodosStorageInterface $storage */
    private $storage;

    public function __construct(
        Connection $connection,
        TodosStorageInterface $storage = null
    ) {
        $this->connection = $connection;
        $this->storage = $storage;
    }

    /**
     * {@inheritDoc}
     */
    public function insert(array $todos): int
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder
            ->insert('todos')
            ->values([
                'name' => '?',
            ]);

        $count = 0;
        foreach ($todos as $todo) {
            $clonedQueryBuilder = clone $queryBuilder;
            $clonedQueryBuilder
                ->setParameter(0, $todo->getName());

            $count += $clonedQueryBuilder->execute();
        }

        if ($this->storage) {
            return $this->storage->insert($todos);
        }

        return $count;
    }

    /**
     * {@inheritDoc}
     */
    public function update(array $todos): int
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder
            ->update('todos')
            ->set('name', '?')
            ->where('id = ?');

        $count = 0;
        foreach ($todos as $todo) {
            $clonedQueryBuilder = clone $queryBuilder;
            $clonedQueryBuilder
                ->setParameter(0, $todo->getName())
                ->setParameter(1, $todo->getId());

            $count += $clonedQueryBuilder->execute();
        }

        if ($this->storage) {
            return $this->storage->update($todos);
        }

        return $count;
    }

    /**
     * {@inheritDoc}
     */
    public function delete(array $todos): int
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder
            ->delete('todos');

        foreach ($todos as $index => $todo) {
            $queryBuilder
                ->orWhere('id = ?')
                ->setParameter($index, $todo->getId());
        }

        if ($this->storage) {
            return $this->storage->delete($todos);
        }

        return $queryBuilder->execute();
    }
}
