<?php
namespace TodoAPI\Infrastructure\Repositories;

use Doctrine\DBAL\Connection;
use TodoAPI\Domain\Todos\Todo;
use TodoAPI\Domain\Todos\Validations\TodosValidatorRepositoryInterface;

class MySQLTodosValidatorRepository implements TodosValidatorRepositoryInterface
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
    public function getByIDs(array $ids): array
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder
            ->select('id', 'name')
            ->from('todos')
            ->where('id IN (:id)')
            ->setParameter(
                'id',
                $ids,
                Connection::PARAM_INT_ARRAY
            );

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
    public function getByNames(array $names): array
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder
            ->select('id', 'name')
            ->from('todos')
            ->where('name IN (:names)')
            ->setParameter(
                'names',
                $names,
                Connection::PARAM_STR_ARRAY
            );
        
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
