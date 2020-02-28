<?php


namespace Spirit\MySQL;

use Spirit\PDODatabaseBridge;

class MySQLDatabaseBridge extends PDODatabaseBridge
{

    public function getDsn(): string
    {
        $dsn = "mysql:";

        if (array_key_exists('host', $this->parameters)) {
            $dsn.= 'host=' . $this->parameters['host'] . ';';
        }

        if (array_key_exists('port', $this->parameters)) {
            $dsn.= 'port=' .$this->parameters['port'] . ';';
        }

        if (array_key_exists('dbname', $this->parameters)) {
            $dsn.= 'dbname=' .$this->parameters['dbname'] . ';';
        }

        return rtrim($dsn, ';');
    }
}
