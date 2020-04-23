<?php
namespace TodoAPI\Tests\Unit\Infrastructure\Repositories;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\DBAL\Statement;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TodoAPI\Domain\Todos\Todo;
use TodoAPI\Infrastructure\Repositories\MySQLTodosRepository;

class MySQLTodosRepositoryTest extends TestCase
{
    public function testGetMethod()
    {
        $rawTodos = [
            ['id' => 1, 'name' => 'test'],
            ['id' => 2, 'name' => 'another test'],
        ];
        /** @var Statement|MockObject $queryBuilder */
        $statement = $this->createMock(Statement::class);
        $statement->method('fetchAll')->willReturn($rawTodos);
        /** @var QueryBuilder|MockObject $queryBuilder */
        $queryBuilder = $this->createMock(QueryBuilder::class);
        $queryBuilder->method('select')->willReturn($queryBuilder);
        $queryBuilder->method('from')->willReturn($queryBuilder);
        $queryBuilder->method('execute')->willReturn($statement);
        /** @var Connection|MockObject $connection */
        $connection = $this->createMock(Connection::class);
        $connection->method('createQueryBuilder')->willReturn($queryBuilder);

        $repository = new MySQLTodosRepository($connection);

        $this->assertContainsOnlyInstancesOf(Todo::class, $repository->get());
    }
}
