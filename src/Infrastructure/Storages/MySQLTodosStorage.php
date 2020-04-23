<?php
namespace TodoAPI\Infrastructure\Storages;

use Doctrine\DBAL\Connection;
use TodoAPI\Domain\Todos\ITodosStorage;

class MySQLTodosStorage implements ITodosStorage
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

        return $queryBuilder->execute();
    }
}