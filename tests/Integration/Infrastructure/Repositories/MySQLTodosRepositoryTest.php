<?php
namespace TodoAPI\Tests\Integration\Infrastructure\Repositories;

use TodoAPI\Domain\Todos\Todo;
use TodoAPI\Infrastructure\Repositories\MySQLTodosRepository;
use TodoAPI\Tests\Integration\AbstractDatabaseTest;

class MySQLTodosRepositoryTest extends AbstractDatabaseTest
{
    /**
     * {@inheritDoc}
     */
    public function getDataSet()
    {
        $fixture = FIXTURES_FOLDER . '/Integration/Infrastructure/Repositories/mysql_todos_repository.xml';
        return $this->createFlatXmlDataSet($fixture);
    }

    public function testGetAllTodosFromDatabase()
    {
        $expectedTodos = [
            new Todo(1, 'cook'),
            new Todo(2, 'read'),
        ];

        $repository = new MySQLTodosRepository($this->getDoctrineConnection());

        $this->assertEquals($expectedTodos, $repository->get());
    }
}
