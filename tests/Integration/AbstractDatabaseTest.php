<?php
namespace TodoAPI\Tests\Integration;

use Doctrine\DBAL\Connection;
use PDO;
use PHPUnit\DbUnit\TestCaseTrait;
use PHPUnit\Framework\TestCase;

/**
 * @see https://phpunit.de/manual/7.0/en/database.html
 */
abstract class AbstractDatabaseTest extends TestCase
{
    use TestCaseTrait;

    static private $pdo = null;
    private $conn = null;
    private $doctrineConnection = null;

    /**
     * {@inheritDoc}
     */
    public function getConnection()
    {
        if ($this->conn === null) {
            if (self::$pdo == null) {
                self::$pdo = new PDO(
                  'mysql:dbname=todos_database;host=mysql',
                  'root',
                  'root'
                );
            }

          $this->conn = $this->createDefaultDBConnection(self::$pdo, 'todos_database');
        }

        return $this->conn;
    }

    public function getDoctrineConnection(): Connection
    {
        if ($this->doctrineConnection === null) {
            $params = [
                'dbname' => 'todos_database',
                'user' => 'root',
                'password' => 'root',
                'host' => 'mysql',
                'driver' => 'pdo_mysql',
            ];
            $config = new \Doctrine\DBAL\Configuration();
        
            $this->doctrineConnection = \Doctrine\DBAL\DriverManager::getConnection($params, $config);
        }

        return $this->doctrineConnection;
    }
}
