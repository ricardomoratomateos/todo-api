<?php
namespace TodoAPI\Infrastructure\Repositories;

use Doctrine\DBAL\Connection;
use TodoAPI\Domain\Todos\ITodosRepository;
use TodoAPI\Domain\Todos\Todo;

class MySQLTodosRepository implements ITodosRepository
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
}
