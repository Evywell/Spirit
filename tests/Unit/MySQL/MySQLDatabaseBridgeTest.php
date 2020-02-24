<?php


namespace Spirit\Test\MySQL;


use PHPUnit\Framework\TestCase;
use Spirit\MySQL\MySQLDatabaseBridge;

class MySQLDatabaseBridgeTest extends TestCase
{

    public function testDsnWithAllRequiredParameters(): void
    {
        $reflection = new \ReflectionClass(MySQLDatabaseBridge::class);
        $parameters = $reflection->getProperty('parameters');
        $parameters->setAccessible(true);

        /** @var MySQLDatabaseBridge $db */
        $db = $reflection->newInstanceWithoutConstructor();

        $parameters->setValue($db, [
            'host' => 'localhost',
            'port' => 3306,
            'dbname' => 'mydatabase'
        ]);

        $this->assertEquals("mysql:host=localhost;port=3306;dbname=mydatabase", $db->getDsn());
    }

}